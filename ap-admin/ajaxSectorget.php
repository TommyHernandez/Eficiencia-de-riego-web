<?php
header('Content-Type: application/json');
require '../require/comun.php';
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloSector($bd);
 echo $modelo ->getJSON($id);
