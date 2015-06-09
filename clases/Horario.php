<?php

/**
 * Description of Horario
 *
 * @author tomas
 */
class Horario {

    private $id, $dia, $sector, $regado;

    function __construct($id = 0, $sector = 0, $dia = "", $regado = "0") {
        $this->id = $id;
        $this->dia = $dia;
        $this->sector = $sector;
        $this->regado = $regado;
    }

    function set($datos, $inicio = 0) {
        $this->id = $datos[0 + $inicio];        
        $this->sector = $datos[1 + $inicio];
        $this->dia = $datos[2 + $inicio];
        $this->regado = $datos[3 + $inicio];
    }

    function getId() {
        return $this->id;
    }

    function getDia() {
        return $this->dia;
    }

    function getSector() {
        return $this->sector;
    }

    function getRegado() {
        return $this->regado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDia($dia) {
        $this->dia = $dia;
    }

    function setSector($sector) {
        $this->sector = $sector;
    }

    function setRegado($regado) {
        $this->regado = $regado;
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
