<?php

/**
 * Description of ServidorRF
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

    function listar() {
        $bd = new BaseDatos();
        switch ($this->tabla) {
            case horario:
                $modelo = new ModeloHorario($bd);
                $r = $modelo->getListJSON();
                //echo $r;
                break;
            case usuarios:
                $modelo = new ModeloUsuario($bd);
                $r = $modelo->getListJSON();
                break;
            case sector:
                $modelo = new ModeloSector($bd);
                $r = $modelo->getListJSON();
                break;
            case lectura:
                $modelo = new ModeloLectura($bd);
                $r = $modelo->getListJSON();
                break;
            case "reportes":
                $modelo = new ModeloReportes($bd);
                $r = $modelo->getListJSON();
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

    function modificar() {
        $bd = new BaseDatos();
        if ($this->id1 != null && $this->json != null) {
            if ($this->tabla == "reportes") {
                $this->json = json_decode($this->json);
                $r = $modelo->editJson($this->id1, $this->json->estado);
            }
        }
        if (!$r) {
            header("HTTP/1.0 403 Error");
        } else {
            
        }
    }

    function borrar() {
        header("HTTP/1.0 404 No se puede Borrar");
    }

}
