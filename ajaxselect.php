<?php

header('Content-Type: application/json');
require_once 'require/comun.php';
$sectores = Leer::get("sectores");
$litros = Leer::get("litros");
$bd = new BaseDatos();
$tabla = $_GET["tabla"];
switch ($tabla) {
    case "sectores":
        $modelo = new ModeloSector($bd);
        if ($sectores) {
            $modelo->getJsonOlivosZona();
            echo $modelo->getJsonSectorOlivos();
        } else {
            $modelo = new ModeloSector($bd);
            echo $modelo->getJsonOlivosZona();
        }
        break;
    case "lecturas":
        $modelo = new ModeloLectura($bd);

        if (!$litros) {
            echo $modelo->getJsonSectorEficiencia();
        } else {

            echo $modelo->getJsonSectorLitros();
        }
        break;
    case "horario":
        $modelo = new ModeloUsuario($bd);

        break;
}


