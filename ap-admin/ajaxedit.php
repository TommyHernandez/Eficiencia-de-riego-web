<?php
/**
 * SIN TERMINAR
 */
header('Content-Type: application/json');
require '../require/comun.php';
$id = Leer::get("id");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$objeto = $modelo->get($id);
var_dump($objeto);
$objeto->setLogin(Leer::get("login"));
if(isset(Leer::get("clave"))){
    $objeto->setClave(Leer::get("clave"));
}
$objeto->setNombre(Leer::get("nombre"));
$objeto->setEmail(Leer::get("email"));
$objeto->setIsroot(Leer::get("isroot"));

var_dump($objeto);
//$r = $modelo->edit($objeto, $id);
if ($r) {
    echo "{";
    echo '"estado":true}';
    
}else{
    echo "{";
    echo '"estado":false}';
}
$bd->closeConexion();
