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
                        <li><a href="#">Ayuda</a></li>
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
                        <li><a id="btnlecturas" href="#">Lecturas</a></li>
                    </ul>
                </div>
                <!-- Definbimos el dialogo modal que se mostrará para la inserción y la edición de usuarios -->
                <div id="dialogomodalinsertar" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Usuarios</h4>
                            </div>
                            <!-- dialog body -->
                            <div class="modal-body">
                                <?php
                                include '../include/formulrioinsercionusuario.php';
                                ?>
                            </div>
                            <!-- dialog buttons -->
                            <div class="modal-footer">
                                <button type="button" id="btisi" class="btn btn-success">Enviar</button>
                                <button type="button" id="btino" class="btn btn-warning">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    </div><!-- ./modal -->
                    <div id="dialogomodal" class="modal fade">
                     <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Eliminar Usuario</h4>
                            </div>
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <span id="contenidomodal">Contenido modal</span>
                                </div>
                                <!-- dialog buttons -->
                                <div class="modal-footer">
                                    <button type="button" id="btsi" class="btn btn-success">Aceptar</button>
                                    <button type="button" id="btno" class="btn btn-warning">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./modal2 -->
                    
                       <div id="dialogomodalinsertarS" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Usuarios</h4>
                            </div>
                            <!-- dialog body -->
                            <div class="modal-body">
                                <?php
                                include '../include/formulrioinsercionsector.php';
                                ?>
                            </div>
                            <!-- dialog buttons -->
                            <div class="modal-footer">
                                <button type="button" id="btisi" class="btn btn-success">Enviar</button>
                                <button type="button" id="btino" class="btn btn-warning">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    </div><!-- ./modal Sectores -->
                    
                     <div id="modaldeleteSector" class="modal fade">
                     <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Eliminar Usuario</h4>
                            </div>
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <span id="contenidomodal">Contenido modal</span>
                                </div>
                                <!-- dialog buttons -->
                                <div class="modal-footer">
                                    <button type="button" id="btsi" class="btn btn-success">Aceptar</button>
                                    <button type="button" id="btno" class="btn btn-warning">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./modal 2 Sectores -->
                
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

                    <div class="" id="divajax"></div>

                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/codigo.js"></script>
        <script src="js/codigo-sectores.js"></script>
        <script src="js/codigo-lectura.js"></script>
        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="../js/vendor/toastr.min.js"></script>

    </body>
</html>