<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$objeto = new Usuario();
$objeto->setLogin(Leer::get("login"));
$objeto->setClave(Leer::get("clave"));
$objeto->setNombre(Leer::get("nombre"));
$objeto->setEmail(Leer::get("email"));
$objeto->setIsRoot(Leer::get("root"));
$r = $modelo->add($objeto);
if ($r != -1) {
     echo "{";
    echo '"estado":true}';
    
}else{
     echo "{";
    echo '"estado":false}';
}