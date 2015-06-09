<?php
header('Content-Type: application/json');
require_once 'require/comun.php';
$bd = new BaseDatos();
$tabla = $_GET["tabla"];
switch ($tabla){
    case "sectores":
        $modelo = new ModeloSector($bd);
        if($sectores){
            
        }else{}
        break;
    case "lecturas":
        $modelo = new ModeloUsuario($bd);
        
        break;
    case "horario":
        $modelo = new ModeloUsuario($bd);
        
        break;
}



 
echo '{"usuarios":'.$modelo->getListJSON($pagina, Configuracion::RPP).'}';

