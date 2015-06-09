<?php
require '../clases/require/comun.php';
$login = Leer::get("login");
$bd = new BaseDatos();
$modelolog = new ModeloLog($bd);
$tipo = "logout";
        $log = new Log($login,$tipo);
        $modelolog->add($log);
$sesion->cerrar();
header("Location: ../");