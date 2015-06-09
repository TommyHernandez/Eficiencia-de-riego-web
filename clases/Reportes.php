<?php

/**
 * Description of Reportes
 *
 * @author Pedro T Hernandez <pedrothdc@pixelariumstudio.es>
 */
class Reportes {

    private $id, $usuario, $sector, $fecha, $lt, $lg,$titulo, $descripcion, $estado;

    function __construct($id = 0, $usuario = "", $sector = 0, $fecha = "", $lt = 0, $lg = 0, $titulo = "No title", $descripcion = "", $estado = "nueva") {
        $this->id = $id;
         $this->usuario = $usuario;
        $this->sector = $sector;       
        $this->fecha = $fecha;
        $this->lt = $lt;
        $this->lg = $lg;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }
    function getLt() {
        return $this->lt;
    }

    function getLg() {
        return $this->lg;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function setLt($lt) {
        $this->lt = $lt;
    }

    function setLg($lg) {
        $this->lg = $lg;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

        function set($datos, $inicio = 0) {
        $this->id = $datos[0 + $inicio];
        $this->usuario = $datos[1 + $inicio];
        $this->sector = $datos[2 + $inicio];        
        $this->fecha = $datos[3 + $inicio];
        $this->lt = $datos[4 + $inicio];
        $this->lg = $datos[5 + $inicio];
        $this->titulo = $datos[6 + $inicio];
        $this->descripcion = $datos[7 + $inicio];
        $this->estado = $datos[8 + $inicio];
    }

    function getId() {
        return $this->id;
    }

    function getSector() {
        return $this->sector;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getLat() {
        return $this->lt;
    }

    function getLong() {
        return $this->lg;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSector($sector) {
        $this->sector = $sector;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setLat($lt) {
        $this->lt = $lt;
    }

    function setLong($lg) {
        $this->lg = $lg;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getJSON() {
        $prop = get_object_vars($this);
        $resp = '{ ';
        foreach ($prop as $key => $value) {
            $resp.='"' . $key . '":' . json_encode(htmlspecialchars_decode($value)) . ',';
        }
        $resp = substr($resp, 0, -1) . "}";
        return $resp;
    }

}
