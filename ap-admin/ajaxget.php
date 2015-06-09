<?php
header('Content-Type: application/json');
require '../require/comun.php';
$login = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
 echo $modelo ->getJSON($login);
