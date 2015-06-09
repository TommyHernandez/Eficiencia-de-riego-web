<?php

/**
 * Description of ModeloUsuario
 *
 * @author Pedro T Hernandez <pedrothdc@pixelariumstudio.es>
 */
class ModeloUsuario {

    private $bd = null;
    private $tabla = "Usuarios";

    function __construct($bd) {
        $this->bd = $bd;
    }

    function activa($id) {
        $condicion = "isactivo=0 and md5(concat(email,'" . Configuracion::PEZARANA . "', login))=:id'";
        $parametros["id"] = $id;
        $asignacion = "isactivo=1";
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function actualiza($login) {
        $condicion = "login = :login";
        $parametros["login"] = $login;
        $asignacion = "fechalogin = now()";
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function add(Usuario $objeto) {
        $sql = "insert into " . $this->tabla . " values(null, :login, :clave, :email, :nombre, :root)";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["email"] = $objeto->getEmail();
        $parametros["root"] = $objeto->getIsroot();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $r;
    }

    function autentifica($login, $clave) {
        $condicion = "login = :login and clave=:clave and isactivo=1";
        $parametros["login"] = $login;
        $parametros["clave"] = sha1($clave);
        $r = $this->getConsulta($condicion, $parametros);
        if (sizeof($r) == 1) {
            $this->actualiza($login);
            return $r[0];
        }
        return false;
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

    function delete(Usuario $objeto) {
        $sql = "delete from $this->tabla where login = :login";
        $parametros["login"] = $objeto->getLogin();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
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

    function deletePorLogin($login) {
        return $this->delete(new Usuario($login));
    }

    /**
     * Le pasas el login y la clave y te devuelve  si el usuario se conecta o no.
     * La clave debe de estar ya encriptada en SHA1.
     * @param string $login
     * @param string $clave
     * @return Usuario 
     */
    function login($login, $clave) {
        $sql = "select * from $this->tabla WHERE login=:login";
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        $fila = $this->bd->getFila();
        $usuario = new Usuario();
        $usuario->set($fila);
        if ($usuario->getClave() != $clave) {
            return FALSE;
        } else {
            return $usuario;
        }
    }

    function edit(Usuario $objeto, $id) {
        $condicion = "id = :id";
        $asignacion = " null, :login, :clave, :email, :nombre, isroot= :root";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = $objeto->getClave();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["id"] = $id;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function editConClave(Usuario $objeto, $login, $claveold) {
        $asignacion = "login = :login, clave = :clave,"
                . "nombre = :nombre, apellidos = :apellidos, "
                . "email = :email";
        $condicion = "login = :loginpk and clave = :claveold";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["loginpk"] = $login;
        $parametros["claveold"] = sha1($claveold);
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function editSinClave(Usuario $objeto, $login) {
        $asignacion = "login = :login,"
                . "nombre = :nombre, apellidos = :apellidos, "
                . "email = :email";
        $condicion = "login = :loginpk";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["loginpk"] = $login;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function editConsulta($asignacion, $condicion = "1=1", $parametros = array()) {
        $sql = "update $this->tabla set $asignacion where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function existe($login) {
        $condicion = "login = :login";
        $parametros["login"] = $login;
        $r = $this->getConsulta($condicion, $parametros);
        if (sizeof($r) >= 1) {
            return '{"existe": true}';
        }
        return '{"existe": false}';
    }

    function get($id) {
        $condicion = "id = :id";
        $parametros["id"] = $id;
        $r = $this->getConsulta($condicion, $parametros);
        if (sizeof($r) >= 1) {
            return $r[0];
        }
        return null;
    }

    function getJSON($id) {
        return $this->get($id)->getJSON();
    }

    function getConsulta($condicion = "1=1", $parametros = array(), $orderby = "1") {
        $list = array();
        $sql = "select * from $this->tabla where $condicion order by $orderby";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $usuario = new Usuario();
                $usuario->set($fila);
                $list[] = $usuario;
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
            $objeto = new Usuario();
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
            $objeto = new Usuario();
            $objeto->set($fila);
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

    function selectHtml($id, $name, $valorSeleccionado = "", $blanco = true, $condicion = "1=1", $parametros = array(), $orderby = "1", $textoBlanco = "&nbsp;") {
        $select = "<select name='$name' id='$id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        $lista = $this->getConsulta($condicion, $parametros, $orderby);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getLogin() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .= "<option $selected value='" . $objeto->getLogin() . "'>" . $objeto->getApellidos() . ", " . $objeto->getNombre() . "</option>";
        }
        $select .= "</select>";
        return $select;
    }

    function getListJSON2($condicion = "1=1", $parametros = array(), $orderby = "1") {
        $sql = "select * from "
                . $this->tabla .
                " where $condicion order by $orderby";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[ ";
        while ($fila = $this->bd->getFila()) {
            $objeto = new Categoria();
            $objeto->set($fila);
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

}
