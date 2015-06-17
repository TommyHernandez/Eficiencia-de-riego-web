<?php

/**
 * Description of Sector
 *
 * @author tomas
 */
class Sector {

    private $id, $olivos, $contador, $nombre, $metodo;

    function __construct($id = 0, $olivos = 0, $contador = "", $nombre = "", $metodo = "") {
        $this->id = $id;       
        $this->olivos = $olivos;
        $this->contador = $contador;
        $this->nombre = $nombre;
        $this->metodo = $metodo;
    }

    function set($datos, $inicio = 0) {
        $this->id = $datos[0 + $inicio];
        $this->olivos = $datos[1 + $inicio];
        $this->contador = $datos[2 + $inicio];
        $this->nombre = $datos[3 + $inicio];
        $this->metodo = $datos[4 + $inicio];
    }

    function getId() {
        return $this->id;
    }

    function getSector() {
        return $this->sector;
    }

    function getOlivos() {
        return $this->olivos;
    }

    function getContador() {
        return $this->contador;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getMetodo() {
        return $this->metodo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSector($sector) {
        $this->sector = $sector;
    }

    function setOlivos($olivos) {
        $this->olivos = $olivos;
    }

    function setContador($contador) {
        $this->contador = $contador;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setMetodo($metodo) {
        $this->metodo = $metodo;
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
