<?php
header('Content-Type: application/json');
require '../require/comun.php';
echo"hola";
$bd = new BaseDatos();
$modelo = new ModeloHorario($bd);
$objeto = new Horario(null,Leer::get("sector"),Leer::get('dia'),0);
var_dump($objeto);
$r = $modelo->add($objeto);
echo $r;
if ($r) {
    echo '{"estado":true}';
    
}else{
   echo '{"estado":false}'; 
}