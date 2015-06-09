<?php
/**
 * Archivo PHP que nos sirve para los pasos previos a la llamada del servidor REST
 * Dividimos la URL en partes para poder analizar lo que se queire hacer
 * Una vez seccionado todo creamos un objeto REST de la clase REST para realizar todo el proceso
 * 
 * @author Pedro T. Hernandez <pedrothdc@pixelariumstudio.es>
 */

require '../require/comun.php';
$metodo = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];
$pos = strpos($uri, "/rest/");
$peticion = substr($uri, $pos);
$argumentos = explode("/", rtrim($peticion, "/"));
$tabla = "";
$id = "";
$idhasta = "";
$json = "";
$json = file_get_contents("php://input");
if(isset($argumentos[2])){
    $tabla = $argumentos[2];
}
if(isset($argumentos[3])){
    $id = $argumentos[3];
}
if(isset($argumentos[4])){
    $idhasta = $argumentos[4];
}
$rest = new ServidorRF($metodo, $tabla, $id, $idhasta, $json);
$s = $rest->procesar();
echo $s;

