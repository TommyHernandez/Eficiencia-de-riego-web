<?php

/**
 * Clase servidor Restfull
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
     * 
     * @return type
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
     * 
     * @return string
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
            case "sector":
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
     * 
     * @return string
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
                    //return '{"estado":"te sabes el chiste ese del switch que no estaba programado, pues esto es lo mismo"}';
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
     * 
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
     * 
     */
    function borrar() {
        $bd = new BaseDatos();
        if ($this->id1 != null && $this->json != null) {
            $this->json = json_decode($this->json);
            if ($this->tabla == "reportes" && $this->json->apikey == md5("pixel")) {
                $modelo = new ModeloReportes($bd);
                $r = $modelo->delete($this->id1);
            } else if ($this->tabla == "lecturas" && $this->json->apikey == md5("pixel")) {
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
