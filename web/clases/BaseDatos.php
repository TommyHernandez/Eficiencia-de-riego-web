<?php

class BaseDatos {

    private $conexion;
    private $sentencia;

    //constructor

    function __construct() {
        try {
            $this->conexion = new PDO('mysql:host=' . Configuracion::SERVIDOR . ';dbname=' . Configuracion::BASEDATOS,
                    Configuracion::USUARIO,
                    Configuracion::CLAVE,
                    array(PDO::ATTR_PERSISTENT => true,
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'));
        } catch (PDOException $e) {
            $this->conexion = null;
        }
    }

    //métodos públicos

    function closeConexion() {
        $this->closeConsulta();
        $this->conexion = null;
    }

    function closeConsulta() {
        if ($this->sentencia != null) {
            $this->sentencia->closeCursor();
            $this->sentencia = null;
        }
    }

    function getAutonumerico() {
        return $this->conexion->lastInsertId();
    }

    function getError(){
        return $this->sentencia->errorInfo();
    }

    function getFila() {
        if ($this->sentencia != null) {
            return $this->sentencia->fetch();
        }
        return false;
    }

    function getNumeroFilas() {
        if ($this->sentencia != null) {
            return $this->sentencia->rowCount();
        }
        return -1;
        //según la documentación no devuelve siempre el número de filas después de un select (depende del SGBD)
    }

    function isConectado() {
        return $this->conexion != null;
    }

    function setBaseDatos($baseDatos) {
        return $this->conexion->query("use $baseDatos") !== false;
    }

    function setConexion($servidor, $usuario, $clave, $baseDatos) {
        try {
            $this->conexion = new PDO('mysql:host=' . $servidor . ';dbname=' . $baseDatos, $usuario, $clave, array(PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'));
            return true;
        } catch (PDOException $e) {
            $this->conexion = null;
            return false;
        }
    }

    //consultas preparadas con parámetros con nombre
    function setConsulta($consulta, $parametros = array()) {
        $this->sentencia = $this->conexion->prepare($consulta);
        foreach ($parametros as $indice => $valor) {
            $this->sentencia->bindValue($indice, $valor);
        }
        return $this->sentencia->execute();
    }

    //consultas preparadas con parámetros posicionales
    function setConsultaPreparada($consulta, $parametros) {
        $this->sentencia = $this->conexion->prepare($consulta);
        $pos = 1;
        foreach ($parametros as $valor) {
            $this->sentencia->bindValue($pos, $valor);
            $pos++;
        }
        /* foreach ($parametros as $i => $valor) {
          $this->sentencia->bindValue($i+1, $valor);
          } */
        return $this->sentencia->execute();
    }

    function setConsultaSQL($consulta) {
        $this->sentencia = $this->conexion->query($consulta);
        if ($this->sentencia === false) {
            $this->sentencia = null;
            return false;
        } else {
            return true;
        }
    }

    // transacciones

    function setTransaccion() {
        $this->conexion->beginTransaction();
    }

    function anulaTransaccion() {
        $this->conexion->rollBack();
    }

    function validaTransaccion() {
        $this->conexion->commit();
    }

    function ejecutaTransaccion($consultas, $parametros) {
        $this->setTransaccion();
        $error = false;
        foreach ($consultas as $i => $consulta) {
            $resultado = $this->setConsulta($consulta, $parametros[$i]);
            if ($resultado === false || $this->getNumeroFilas() < 1) {
                $error = true;
                break;
            }
        }
        if ($error) {
            $this->anulaTransaccion();
            return false;
        } else {
            $this->validaTransaccion();
            return true;
        }
    }

}