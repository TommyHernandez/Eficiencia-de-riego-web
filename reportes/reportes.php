<?php
require_once '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloReportes($bd);
$pagina = Leer::get("pagina");
if (isset($pagina)) {
    $pagina = Leer::get("pagina");
} else {
    $pagina = 0;
}
$filas = $modelo->getList($pagina, 8);
$enlaces = Paginacion::getEnlacesPaginacion($pagina, $modelo->count(), 6, "reportes.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Pagina web para la eficiencia de riego">
        <meta name="author" content="Pedro hernandez">
        <link rel="icon" href="../imagenes/favicon.png">
        <meta charset="UTF-8">
        <title>Reportes-flex</title>
        <!-- Bootstrap core CSS -->
        <link href="../css/vendor/bootstrap.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="../css/vendor/bootstrap-theme.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/vendor/toastr.min.css" type="text/css" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->    
    </head>
    <body>
        <?php include '../include/menu-sub.php';
        ?>
        <section>
            <div class="container">
                <div class="row underline">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Listado de incidencias</h2>
                        <h3 class="section-subheading text-muted"></h3>
                    </div>
                </div>
            </div>
        </section>
        <div class="container container-fluid">


        </div>

    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/vendor/bootstrap.min.js"></script>
    <script src="../js/vendor/toastr.min.js"></script>

</html>
