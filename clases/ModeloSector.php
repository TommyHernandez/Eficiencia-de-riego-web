<?php

/**
 * Description of ModeloSector
 *
 * @author Pedro T Hernandez <pedrothdc@pixelariumstudio.es>
 */
class ModeloSector {

    private $bd = null;
    private $tabla = "Sectores";

    function __construct($bd) {
        $this->bd = $bd;
    }

    function getJSON($id) {
        return $this->get($id)->getJSON();
    }

    function add(Sector $objeto) {
        $sql = "insert into " . $this->tabla . " values( :id, "
                . ":olivos, :contador, :nombre, :metodo)";
        $parametros["id"] = $objeto->getId();
        $parametros["olivos"] = $objeto->getOlivos();
        $parametros["contador"] = $objeto->getContador();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["metodo"] = $objeto->getMetodo();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $r;
    }

    function delete($id) {
        $sql = "delete from" . $this->tabla . " where id = :id";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $r;
    }

    function editConsulta($asignacion, $condicion = "1=1", $parametros = array()) {
        $sql = "update $this->tabla set $asignacion where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function edit(Sector $objeto, $idpk) {
        $asignacion = "sector = :sector, olivos = :olivos, contador = :contador, nombre = : nombre, metodo = : metodo";
        $condicion = "id = :idpk";
        $parametros["sector"] = $objeto->getSector();
        $parametros["olivos"] = $objeto->getOlivos();
        $parametros["contador"] = $objeto->getContador();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["metodo"] = $objeto->getMetodo();
        $parametros["idpk"] = $idpk;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function getConsulta($condicion = "1=1", $parametros = array(), $orderby = "1") {
        $list = array();
        $sql = "select * from $this->tabla where $condicion order by $orderby";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $objeto = new Sector();
                $objeto->set($fila);
                $list[] = $objeto;
            }
        }
        return $list;
    }

    function getListPagina($pagina = 0, $rpp = 10, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from "
                . $this->tabla .
                " where $condicion order by $orderby limit $pos, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        $respuesta = array();
        while ($fila = $this->bd->getFila()) {
            $objeto = new Sector();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        return $respuesta;
    }

    function getListJSON($pagina = 0, $rpp = 3, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from "
                . $this->tabla .
                " where $condicion order by $orderby limit $pos, $rpp";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while ($fila = $this->bd->getFila()) {
            $objeto = new Sector();
            $objeto->set($fila);
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

    function getJsonOlivosZona() {
        $sql = "SELECT contador, sum(olivos) FROM `Sectores` group by contador";
        $parametros = array();
        $this->bd->setConsulta($sql, $parametros);
        $resp = "{ ";
        while ($fila = $this->bd->getFila()) {
            $resp.='"' . $fila[0] . '":' . json_encode(htmlspecialchars_decode($fila[1])) . ',';
        }
        $resp = substr($resp, 0, -1) . "}";
        return $resp;
    }

    function getJsonSectorOlivos($condicion = "1=1", $parametros = array(), $orderby = "1") {

        $sql = "select id,olivos from "
                . $this->tabla .
                " where $condicion order by $orderby ";
        $this->bd->setConsulta($sql, $parametros);
        $resp = "{ ";
        while ($fila = $this->bd->getFila()) {
            $resp.='"' . $fila[0] . '":' . json_encode(htmlspecialchars_decode($fila[1])) . ',';
        }
        $resp = substr($resp, 0, -1) . "}";
        return $resp;
    }

    function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $f = $this->bd->getFila();
            return $f[0];
        }
        return -1;
    }

    function deleteID($id) {
        $sql = "delete from $this->tabla where id = :id";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

}
