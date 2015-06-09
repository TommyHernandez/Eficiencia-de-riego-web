<?php
require_once '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloLectura($bd);
$pagina = Leer::get("pagina");
if (isset($pagina)) {
    $pagina = Leer::get("pagina");
}else{
    $pagina = 0;
}
$filas = $modelo->getList($pagina, 6);
$enlaces = Paginacion::getEnlacesPaginacion($pagina, $modelo->count(), 6 ,"viewlecturas.php");
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
          <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Eficieciencia Riego</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Inicio</a></li>
                        <li><a href="#about">Sobre</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Graficas <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tablas <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="viewhorario.php">Horarios</a></li>
                                <li><a href="viewlecturas.php">Lecturas</a></li>               
                            </ul>
                        </li>
                        <li><a href="reportes/viewreportes.php">Reportes</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>   
          <div style="clear: both; height: 100px;"></div>
        <div class="container container-fluid">
            <div></div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover animated slideInRight">
                        <thead>
                            <tr>
                                <th>Contador Inicial</th>
                                <th>Contador Final</th>
                                <th>Eficiencia</th>
                                <th>fecha</th>
                                <th>sector</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filas as $indice => $objeto) { ?>
                                <tr>
                                    <td><?php echo $objeto->getContadorI(); ?> </td>
                                    <td><?php echo $objeto->getContadorF(); ?> </td>
                                    <td><?php echo $objeto->getEficiencia(); ?> </td>
                                    <td><?php echo $objeto->getFecha(); ?> </td>
                                    <td><?php echo $objeto->getSector()?></td>
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
    </body>
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/vendor/bootstrap.min.js"></script>

</html>
