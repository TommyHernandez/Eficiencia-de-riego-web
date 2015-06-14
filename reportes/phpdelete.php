<?php
require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT
$sesion->administrador("../index.php");
$id = Leer::post("id");
if($id != null){
    $bd = new BaseDatos();
    $modelo = new ModeloReportes($bd);
    $r = $modelo->delete($id);
    
    if($r != -1){
        header("Location: viewreportes.php?result=1");
    }else {
        header("Location: viewreportes.php?result=$r");
    }
}