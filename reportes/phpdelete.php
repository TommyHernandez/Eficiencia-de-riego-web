<?php

require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT
$sesion->administrador("../index.php");
$id = Leer::request("id");
$bd = new BaseDatos();
$modelo = new ModeloReportes($bd);
$r = $modelo->delete($id);

if ($r != -1) {
    header("Location: viewreportes.php?result=1");
} else {
    header("Location: viewreportes.php?result=$r");
}
