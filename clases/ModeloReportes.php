<?php

/**
 * Description of ModeloReportes
 *
 * @author Pedro T Hernandez <pedrothdc@pixelariumstudio.es>
 */
class ModeloReportes {

    private $bd = null;
    private $tabla = "Reportes";

    function __construct($bd) {
        $this->bd = $bd;
    }

    function add(Reportes $objeto) {
        $sql = "INSERT INTO $this->tabla VALUES (null, :usuario, :sector, CURDATE(), :lt, :lg, :titulo, :descripcion, :estado )";

        $param['usuario'] = $objeto->getUsuario();
        $param['sector'] = $objeto->getSector();
        $param['lt'] = $objeto->getLat();
        $param['lg'] = $objeto->getLong();
        $param['titulo'] = $objeto->getTitulo();
        $param['descripcion'] = $objeto->getDescripcion();
        $param['estado'] = $objeto->getEstado();
        $r = $this->bd->setConsulta($sql, $param);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico();
    }

    function delete($id) {
        $sql = "DELETE FROM $this->tabla WHERE id=:id";
        $param['id'] = $id;
        $r = $this->bd->setConsulta($sql, $param);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function edit(Reportes $objeto) {
        $asignacion = "sector=:sector, usuario=:usuario, lt=:lt, lg=:lg, titulo=:titulo, descripcion=:descripcion, estado=:estado";
        $condicion = "id=:id";
        $param['sector'] = $objeto->getSector();
        $param['usuario'] = $objeto->getUsuario();
        $param['lt'] = $objeto->getLat();
        $param['lg'] = $objeto->getLong();
        $param['titulo'] = $objeto->getTitulo();
        $param['descripcion'] = $objeto->getDescripcion();
        $param['estado'] = $objeto->getEstado();
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function get($id) {
        $sql = "SELECT * FROM $this->tabla where id=:id";
        $param['id'] = $id;
        $r = $this->bd->setConsulta($sql, $param);
        if ($r) {
            $reportes = new Reportes();
            $reportes->set($this->bd->getFila());
            return $reportes;
        }
        return null;
    }

    function getJSON($id) {
        return $this->get($id)->getJSON();
    }

    function getListJSON($pagina = 0, $rpp = 3, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from " . $this->tabla;
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while ($fila = $this->bd->getFila()) {
            $objeto = new Reportes();
            $objeto->set($fila);
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

    function getListJSONFull($condicion = "1=1", $parametros = array(), $orderby = "1") {
        $sql = "select * from "
                . $this->tabla .
                " where $condicion order by $orderby";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while ($fila = $this->bd->getFila()) {
            $objeto = new Reportes();
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
                $objeto = new Reportes();
                $objeto->set($fila);
                $list[] = $objeto;
            }
            return $list;
        }
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

}
