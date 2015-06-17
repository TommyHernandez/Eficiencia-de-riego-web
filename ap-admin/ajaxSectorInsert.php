<?php
header('Content-Type: application/json');
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloSector($bd);
$id = Leer::get("id");
$objeto = new Sector($id,Leer::get("olivos"),Leer::get('contador'),Leer::get("nombre"),Leer::get("riego"));
$r = $modelo->add($objeto);

if ($r) {
     echo "{";
    echo '"estado":true}';
    
}else{
   echo '{"estado":false}'; 
}