<?php

/**
 * Description of ModeloHorario
 *
 * @author tomas
 */
class ModeloHorario {

    private $bd = null;
    private $tabla = "Horarios";

    function __construct($bd) {
        $this->bd = $bd;
    }

    function get($id) {
        $sql = "SELECT * FROM $this->tabla where id=:id";
        $param['id'] = $id;
        $r = $this->bd->setConsulta($sql, $param);
        if ($r) {
            $objeto = new Horario();
            $objeto->set($this->bd->getFila());
            return $objeto;
        }else{
            return null;
        }
    }
   
    function getJSON($id) {
        $objeto = $this->get($id);
        return $objeto->getJSON();
    }

    function add(Horario $objeto) {
        $sql = "insert into " . $this->tabla . " values( null, :sector, :dia, :regado)";
        $parametros["dia"] = $objeto->getLogin();
        $parametros["sector"] = sha1($objeto->getClave());
        $parametros["regado"] = $objeto->getNombre();
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

    /**
     * Este metodo recibe la asignacion del update, la condicion where y un array de parametros para preparar la consulta
     * Devuelve un entero con el numero de filas afectadas
     * @param String $asignacion
     * @param String $condicion
     * @param Array $parametros
     * @return INT
     */
    function editConsulta($asignacion, $condicion = "1=1", $parametros = array()) {
        $sql = "update $this->tabla set $asignacion where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function edit(Horario $objeto, $idpk) {
        $asignacion = "dia = :dia,sector = :sector, regado = :regado";
        $condicion = "id = :idpk";
        $parametros["dia"] = $objeto->getDia();
        $parametros["sector"] = $objeto->getSector();
        $parametros["regado"] = $objeto->getRegado();
        $parametros["idpk"] = $idpk;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function getConsulta($condicion = "1=1", $parametros = array(), $orderby = "1") {
        $list = array();
        $sql = "select * from $this->tabla where $condicion order by $orderby";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $horario = new Horario();
                $horario->set($fila);
                $list[] = $horario;
            }
        }
        return $list;
    }

    function getListPagina($pagina = 0, $rpp = 5, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from "
                . $this->tabla .
                " where $condicion order by $orderby limit $pos, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        $respuesta = array();
        while ($fila = $this->bd->getFila()) {
            $objeto = new Horario();
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
            $objeto = new Horario();
            $objeto->set($fila);
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }
    
      function getListJSONFull($condicion = "1=1", $parametros = array(), $orderby = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from "
                . $this->tabla .
                " where $condicion order by $orderby";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while ($fila = $this->bd->getFila()) {
            $objeto = new Horario();
            $objeto->set($fila);
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }


    function getListJSON2($id1 = 0, $id2 = 6, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $sql = "select * from "
                . $this->tabla .
                " where $condicion order by $orderby limit $id1, $id2";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while ($fila = $this->bd->getFila()) {
            $objeto = new Horario();
            $objeto->set($fila);
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

    function getList($principio = 0, $rpp = 5, $condicion = "1=1", $orderby = 1, $parametros = array()) {
        $list = array();
        $sql = "select * from $this->tabla WHERE $condicion order by $orderby limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return null;
        } else {
            while ($fila = $this->bd->getFila()) {
                $objeto = new Horario();
                $objeto->set($fila);
                $list[] = $objeto;
            }
            return $list;
        }
    }

    function count($parametros = array()) {
        $sql = "select count(*) from $this->tabla ";
        $r = $this->bd->setConsulta($sql, $parametros);

        if ($r) {
            $f = $this->bd->getFila();
            return $f[0];
        }
        return -1;
    }

}
