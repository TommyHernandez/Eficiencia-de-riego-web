<?php

/**
 * Clase servidor Restfull
 * Para poder entender bien esta clase hay que tener en cuenta el funcionamiento de los modelos y los objetos.
 *  Se crean objetos por cada una de las tablas y por cada tabla tambien existe un modelo que nos facilita el trabajo directo con la base de datos.
 * 
 *
 * @author Pedro T Hernandez <pedrothdc@pixelariumstudio.es>
 */
class ServidorRF {

    private $tipo, $tabla, $id1, $id2, $json;

    function __construct($tipo, $tabla, $id1 = null, $id2 = null, $json = null) {
        $this->tipo = $tipo;
        $this->tabla = $tabla;
        $this->id1 = $id1;
        $this->id2 = $id2;
        $this->json = $json;
        header("Content-Type: application/json");
    }

    /**
     * Procesa el tipo de peticion recivida leyendo el metodo por el que llega para conocer que es lo que se desea hacer. 
     * 
     * 
     */
    function procesar() {
        if ($this->tipo == "GET") {
            return $this->listar();
        } else if ($this->tipo == "POST") {
            return $this->crear();
        } else if ($this->tipo == "PUT") {
            return $this->modificar();
        } else if ($this->tipo == "DELETE") {
            return $this->borrar();
        } else {
            header("HTTP/1.0 400 Peticion erronea");
        }
    }

    /**
     * Se ejecuta al llevar la peticon por metodo GET sirve para mostrar el contenido que tiene la base de datos
     * @return string JSON
     */
    function listar() {
        
        $bd = new BaseDatos();
        switch ($this->tabla) {
            case horario:
                $modelo = new ModeloHorario($bd);
                $r = $modelo->getListJSON();

                break;
            case "usuarios":
                $modelo = new ModeloUsuario($bd);
                $r = $modelo->getListJSON();
                break;
            case "sectores":
                $modelo = new ModeloSector($bd);
                if ($this->id1 == null && $this->id2 == null) {
                    $r = $modelo->getListJSONFull();
                } else {
                    $r = $modelo->getListJSONLimit($id1, $id2);
                }
                break;
            case "lecturas":
                $modelo = new ModeloLectura($bd);
                $r = $modelo->getListJSONFull();
                break;
            case "reportes":
                $modelo = new ModeloReportes($bd);
                $r = $modelo->getListJSONFull();
                break;
            case "horarios":
                $modelo = new ModeloHorario($bd);                
                if ($this->id1 != null && $this->id2 == "") {
                    $r = $modelo->getJSON($this->id1);                    
                } else if ($this->id1 == null && $this->id2 == null) {                    
                    $r = $modelo->getListJSONFull();
                } else if ($this->id1 != null && $this->id2 != null) {
                    $r = $modelo->getJSON2($this->id1, $this->id2);
                }
                break;
            default :
                $r = '{"estado:" la seccion o tabla que buscas no esta definida"}';
        }
        if (!$r) {
            header("HTTP/1.0 403 Error");
        } else {
            return $r;
        }
    }

    /**
     * Ejecuta este metodo cuando es un metodo POST que crea contenido (o añade contenido) a la base de datos
     * @return string JSON
     */
    function crear() {
        $bd = new BaseDatos();
        $yison = $this->json;
        if ($this->json != null) {
            $this->json = json_decode($yison); //convertimos el JSON que llega en un objeto PHP
            switch ($this->tabla) {
                case "lectura":
                    $modelo = new ModeloLectura($bd);
                    $ci = $this->json->contadori;
                    $cf = $this->json->contadorf;
                    $eficiencia = $this->json->eficiencia;
                    $sector = $this->json->sector;
                    $objeto = new Lectura(null, $ci, $cf, $eficiencia, $sector);
                    $r = $modelo->add($objeto);
                    break;
                case "usuario":
                    $modelo = new ModeloUsuario($bd);
                    $login = $this->json->login;
                    $isRoot = $this->json->isroot;
                    $r = $objeto = new Usuario(null, $login, $this->json->clave, $this->json->email, $this->json->nombre, $isRoot);
                    $modelo->add($objeto);
                    break;
                case "reportes":
                    $modelo = new ModeloReportes($bd);
                    $sector = $this->json->sector;
                    $usuario = $this->json->usuario;
                    $fecha = "";
                    $lt = $this->json->lt;
                    $lg = $this->json->lg;
                    $titulo = $this->json->titulo;
                    $descripcion = $this->json->descripcion;
                    $objeto = new Reportes(null, $usuario, $sector, $fecha, $lt, $lg, $titulo, $descripcion, "nueva");
                    $r = $modelo->add($objeto);
                    break;
                default:
                    header("HTTP/1.0 400 Peticion erronea");
            }
        }
        if ($r == -1) {
            return '{"estado": "' . $r . '"}';
        } else {
            return '{"estado": 1}';
        }
    }

    /**
     * Se ejecuta al recivir una peticion put para actualizar los datos.
     * El funcionamiento es obvio, en este caso no está terminado por que no se contemplo
     * 
     * @return String JSON
     */
    function modificar() {
        $bd = new BaseDatos();
        if ($this->id1 != null && $this->json != null) {
            $this->json = json_decode($this->json);
            if ($this->tabla == "reportes") {
                $r = $modelo->editJson($this->id1, $this->json->estado);
            } else if ($this->tabla == "horarios") {
                $modelo = new ModeloHorario($bd);
                $id = $this->id1;
                $r = $modelo->editConsulta("regado = 1", "where sector = $id");
            }
        }
        if ($r == -1) {
            header("HTTP/1.0 403 Error");
        } else {
            return '{"estado": 1}';
        }
    }

    /**
     * Metodo que la ejecuta DELETE borra informacion de la base de datos, en esta caso tambien se implementa un pequelo sitema de seguridad
     * para evitar que cualquiera borre del servidor se incorpora una palabra clave encriptada, dicha palabra llegara como objeto JSON
     * 
     * @return String JSON
     */
    function borrar() {
        $bd = new BaseDatos();
        $apiKey = md5("pixel");
        if ($this->id1 != null && $this->json != null) {
            $this->json = json_decode($this->json);
            if ($this->tabla == "reportes" && $this->json->apikey == $apiKey) {
                $modelo = new ModeloReportes($bd);
                $r = $modelo->delete($this->id1);
            } else if ($this->tabla == "lecturas" && $this->json->apikey == $apiKey) {
                $modelo = new ModeloLectura($bd);
                $modelo->delete($id);
            }
        }
        if ($r != -1) {
            return '{"estado": 1}';
        } else {
            header("HTTP/1.0 404 No se puede Borrar");
        }
    }

}
