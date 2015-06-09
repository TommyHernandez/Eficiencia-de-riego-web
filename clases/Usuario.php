<?php

/**
 * Description of Usuario
 *
 * @author Pedro T Hernandez <pedrothdc@pixelariumstudio.es>
 */
class Usuario {

    private $id, $login, $clave, $email, $nombre, $isRoot;

    function __construct($id = 0, $login = "", $clave = "", $email = "", $nombre = "", $isRoot = 0) {
        $this->id = $id;
        $this->login = $login;
        $this->clave = $clave;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->isRoot = $isRoot;
    }

    function set($datos, $inicio = 0) {
        $this->id = $datos[0 + $inicio];
        $this->login = $datos[1 + $inicio];
        $this->clave = $datos[2 + $inicio];
        $this->email = $datos[3 + $inicio];
        $this->nombre = $datos[4 + $inicio];
        $this->isRoot = $datos[5 + $inicio];
    }

    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getClave() {
        return $this->clave;
    }

    function getEmail() {
        return $this->email;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIsRoot() {
        return $this->isRoot;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIsRoot($isRoot) {
        $this->isRoot = $isRoot;
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
