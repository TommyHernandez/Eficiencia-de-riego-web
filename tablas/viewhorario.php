<?php
require_once '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloHorario($bd);
$pagina = Leer::get("pagina");
if (isset($pagina)) {
    $pagina = Leer::get("pagina");
} else {
    $pagina = 0;
}
$filas = $modelo->getList($pagina, 7, "1=1", 2);
$enlaces = Paginacion::getEnlacesPaginacion($pagina, $modelo->count(), 6, "viewhorario.php");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Pagina web para la eficiencia de riego">
        <meta name="author" content="Pedro hernandez">
        <link rel="icon" href="../imagenes/favicon.png">

        <title>Eficiencia de riego</title>
        <!-- Bootstrap core CSS -->
        <link href="../css/vendor/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="../css/vendor/bootstrap-theme.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/animate.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->          
    </head>
    <body>
        <?php include '../include/menu-sub.php'; ?>

        <div style="clear: both; height: 100px;"></div>
        <div class="container container-fluid">
            <div></div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover animated slideInRight">
                        <thead>
                            <tr>
                              
                                <th>Sector</th>
                                <th>Dia</th>
                                <th>Metodo</th>
                                <th>Regado</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filas as $indice => $objeto) { ?>
                                <tr>
                                    
                                    <td><?php echo $objeto->getSector(); ?> </td>
                                    <td><?php echo $objeto->getDia() ?> </td>
                                    <td><?php echo "Rebombeo" ?></td>
                                    <td><?php if ($objeto->getRegado()) { ?>
                                            <span style="color:greenyellow"> Si</span>
                                        <?php } else { ?>
                                            <span style="color:red"> No</span>
                                        <?php } ?> </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th colspan="12">
                                    <?php echo $enlaces["inicio"]; ?>
                                    <?php echo $enlaces["anterior"]; ?>
                                    <?php echo $enlaces["primero"]; ?>
                                    <?php echo $enlaces["segundo"]; ?>
                                    <?php echo $enlaces["actual"]; ?><!-- normalmente -->
                                    <?php echo $enlaces["cuarto"]; ?>
                                    <?php echo $enlaces["quinto"]; ?>
                                    <?php echo $enlaces["siguiente"]; ?>
                                    <?php echo $enlaces["ultimo"]; ?>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                </div>             

            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php include '../include/footer.php'; ?>
    </body>
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/vendor/bootstrap.min.js"></script>

</html>
