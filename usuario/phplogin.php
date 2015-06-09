<?php

require '../require/comun.php';
$login = Leer::post("usuario");
$clave = sha1(Leer::post("clave"));
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$objeto = $modelo->login($login, $clave);
if ($objeto) {   
    $sesion->setUsuario($objeto);
    if ($objeto->getIsRoot() == 1) {
        header("Location: ../ap-admin/panel.php");
    } else {

        header("Location: ../ap-admin?acc=0"); //Enviamos por GET un 0 para indicar que no tiene permisos
    }
} else {
    header("Location: ../index.php?er=-1");
    $sesion->cerrar();
}
 
 