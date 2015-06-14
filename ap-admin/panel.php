<?php
require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT
$sesion->administrador("../index.php");
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

        <title>Admin-Panel</title>
        <!-- Bootstrap core CSS -->
        <link href="../css/vendor/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="../css/vendor/bootstrap-theme.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../css/vendor/dashboard.css" rel="stylesheet" type="text/css">
        <link href="../css/vendor/toastr.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Eficiencia</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../index.php">inicio</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Perfil</a></li>
                        <li><a href="../usuario/phplogout.php">Log out</a></li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="#">Bienvenido</a></li>
                        <li>
                            <a class="" type="button" data-toggle="collapse" data-target="#li-usuarios" aria-expanded="false" aria-controls="li-usuarios">
                                Usuarios
                            </a>
                            <div class="collapse" id="li-usuarios">
                                <div class="well">
                                    <ul>
                                        <li><a id="lstbtnusers" href="#">Listar</a></li>
                                        <li><a id="btverinsertar" href="#">Añadir</a></li>
                                    </ul>
                                </div>
                            </div>

                        </li>
                        <li>
                            <a class="" type="button" data-toggle="collapse" data-target="#li-sectores" aria-expanded="false" aria-controls="li-sectores">
                                Sectores
                            </a>
                            <div class="collapse" id="li-sectores">
                                <div class="well">
                                    <ul>
                                        <li><a id="lstbtnsectores" href="#">Listar</a></li>
                                        <li><a id="addbtnsectores" href="#">Añadir</a></li>
                                    </ul>
                                </div>
                            </div>

                        </li>
                          <li>
                            <a class="" type="button" data-toggle="collapse" data-target="#li-horarios" aria-expanded="false" aria-controls="li-horarios">
                                Horarios
                            </a>
                            <div class="collapse" id="li-horarios">
                                <div class="well">
                                    <ul>
                                        <li><a id="lstbtnhorarios" href="#">Listar</a></li>
                                        <li><a id="addbtnhorarioss" href="#">Añadir</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a id="btnlecturas" href="#">Lecturas</a></li>
                        <li><a href="../reportes/viewreportes.php">Reportes</a></li>
                    </ul>
                </div>
               
                
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

                    <div class="" id="divajax"></div>

                </div>
            </div>
        </div>
        <!-- == Añadimos todos los modales == -->        
        <?php include '../include/modales.php'; ?>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/codigo.js"></script>
        <script src="js/codigo-sectores.js"></script>
        <script src="js/codigo-lectura.js"></script>
        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="../js/vendor/toastr.min.js"></script>
        <script src="js/codigohorarios.js"></script>

    </body>
</html>