<?php
header('Content-Type: application/json');
require '../require/comun.php';
$id = Leer::get("id");
$pagina = Leer::get("pagina");
$bd = new BaseDatos();
$modelo = new ModeloHorario($bd);
$r=$modelo->delete($id);
if ($r) {
    echo "{";
    echo '"estado":true, "pagina":'.$pagina."}";
} else{
   
}