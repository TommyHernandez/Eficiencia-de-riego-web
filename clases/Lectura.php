<?php
/**
 * Description of Lectura
 *
 * @author Pedro T Hernandez <pedrothdc@pixelariumstudio.es>
 */
class Lectura {

    private $id, $contadorI, $contadorF, $eficiencia, $fecha, $sector;

    function __construct($id=0, $contadorI=0, $contadorF=0, $eficiencia=0,$sector= 0,$fecha="") {
        $this->id = $id;
        $this->contadorI = $contadorI;
        $this->contadorF = $contadorF;
        $this->eficiencia = $eficiencia;
        $this->fecha = $fecha;
        $this->sector = $sector;
    }

    function set($datos, $inicio = 0) {
        $this->id = $datos[0 + $inicio];
        $this->contadorI = $datos[1 + $inicio];
        $this->contadorF = $datos[2 + $inicio];
        $this->eficiencia = $datos[3 + $inicio];
        $this->fecha = $datos[4 + $inicio];
        $this->sector = $datos[5 + $inicio];
    }

    function getId() {
        return $this->id;
    }
    function getSector() {
        return $this->sector;
    }

    function setSector($sector) {
        $this->sector = $sector;
    }

        function getContadorI() {
        return $this->contadorI;
    }

    function getContadorF() {
        return $this->contadorF;
    }

    function getEficiencia() {
        return $this->eficiencia;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setContadorI($contadorI) {
        $this->contadorI = $contadorI;
    }

    function setContadorF($contadorF) {
        $this->contadorF = $contadorF;
    }

    function setEficiencia($eficiencia) {
        $this->eficiencia = $eficiencia;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
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
