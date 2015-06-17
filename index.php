<?php
require './require/comun.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Pagina web para la eficiencia de riego">
        <meta name="author" content="Pedro hernandez">
        <link rel="icon" href="/imagenes/favicon.png">

        <title>Eficiencia de riego</title>

        <!-- Bootstrap core CSS -->
        <link href="css/vendor/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/vendor/bootstrap-theme.min.css" rel="stylesheet">        
        <link href="css/vendor/epoch.min.css" rel="stylesheet">        

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- librerias de google -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/vendor/chart.js"></script>
        <!-- toastadas -->
        <link type="text/css" rel="stylesheet" href="css/vendor/toastr.min.css" />
        <script src="js/vendor/toastr.min.js"></script>
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-fixed-top color-nav">
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
                        <li id="showModalSobre"><a  href="#">Sobre</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Graficas <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#oliv">Olivos por sector</a></li>
                                <li><a href="#eficiancia">Eficiencia</a></li>
                                <li><a href="#litros">Litros por sector </a></li>                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tablas <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="tablas/viewhorario.php">Horarios</a></li>
                                <li><a href="tablas/viewlecturas.php">Lecturas</a></li>               
                            </ul>
                        </li>
                        <li><a href="reportes/viewreportes.php">Reportes</a></li>
                        <?php if ($sesion->isAutentificado()) { ?>
                        <li><a href="usuario/phplogout.php">Log out</a></li>
                        <?php } else { ?>
                            <li><a href="ap-admin">Login</a></li>
                            <?php } ?>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>

            <header class="cabecera">
                <div class="container">
                    <div class="intro-text">
                        <div class="intro-lead-in"></div>
                        <div class="intro-heading"></div>
                        <a href="#" class="page-scroll btn btn-xl">Saber Más</a>
                    </div>
                </div>
            </header>
            <section>
                <div class="container">
                    <div class="row underline">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">Gráficas</h2>
                            <h3 class="section-subheading text-muted"></h3>
                        </div>
                    </div>
                </div>
            </section>
            <!-- = GRAFICA 1 == -->
            <section id="">
                <div id="oliv" class="container"  class="seccion">
                    <div class="row">
                        <div>
                            <h2>Olivos por sector</h2>
                        </div>
                        <div class="col-md-8">
                            <div id="olv-sec" class="margin-auto" ></div>                    
                        </div>
                        <div class="col-md-4">
                            <h4>Filtros</h4>
                            <br/>
                            <form>
                                <div class="form-group">
                                    <label for="filtroolivo">Filtar por</label>
                                    <select id="filtroolivo" name="filtroolivo" class="form-control">
                                        <option selected="selected" value="sector">Sector</option>
                                        <option value="zona">Zona</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button id="filtro-olivos" class="btn btn-default"> Filrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </section>
            <script>

            </script>
            <!-- = GRAFICA 2 == -->
            <section id="eficiencia" class="light-gray seccion">
                <div class="container">
                    <div class="row">
                        <div>
                            <h2>Eficiencia del sector</h2>
                        </div>
                        <div class="col-md-4">
                            <h4>Filtro</h4>
                            <br>
                            <form>
                                <div class="form-group">
                                    <label for="filtroeficiencia">Filtar por</label>
                                    <select name="filtroeficiencia" class="form-control">
                                        <option selected="selected">Sector</option>
                                        <option>Zona</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button id="filtro-eficiencia" class="btn btn-default"> Filrar </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div id="tarta" class="margin-auto"></div>

                        </div>
                    </div>
                </div>
            </section>
            <script>
                google.load('visualization', '1.0', {'packages': ['corechart']});

                // Set a callback to run when the Google Visualization API is loaded.
                google.setOnLoadCallback(drawChart);
                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                function drawChart() {
                    // Create the data table.
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Topping');
                    data.addColumn('number', 'Slices');
                    data.addRows([
                        ['S1', 10],
                        ['S2', 15],
                        ['S3', 15],
                        ['S4', 40],
                        ['S5', 20]
                    ]);
                    // Set chart options
                    var options = {'title': 'Eficiencia por sector',
                        'width': 600,
                        'height': 400};

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('tarta'));
                    chart.draw(data, options);
                }
            </script>
            <!-- = GRAFICA 3 == -->
            <section id="litros" class="seccion seccion">
                <div class="container">
                    <div class="row">
                        <div>
                            <h2></h2>
                        </div>
                        <div class="col-md-8">
                           <canvas id="litros" width="400" height="400"></canvas>
                        </div>
                        <div class="col-md-4">

                        </div> 
                    </div>
                </div>
            </section>
            <!-- Modal para SOBRE -->
            <div id="modalSobre" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Sobe El Sistema</h4>
                        </div>
                        <div class="modal-body">
                            <p>Eficiencia de Riego es uan aplicacion pensada para una cooperativa de regantes, la aplicacion permite facilmente controlar:
                            <ul>
                                <li>Averias</li>
                                <li>Estadisticas de Litros por sectores</li>
                                <li>Estadisticads de olivos</li>
                                <li>Aladir nuevos Sectores</li>
                                <li>Gestionar horarios de riego</li>
                                <li>Eficiencia por sector</li>                                
                            </ul>
                          </p>
                          <P> La aplicación consta de un cliente Andorid que recupera informacion del servidor y la que le proporciona el propio usuario,
                              generando resultados en el dispositivo, como la eficiencia de un sector, los horarios de riego o los reportes que hay. La aplicacion 
                              permite informar de averías y notificar mediante un mapa su posición. Es posible ver toda esta informacion de manera
                              más extendida en la web.
                          </P>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">OK!</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->



            <?php include './include/footer.php'; ?>
        <!-- == Fin Secciones == --> 
        <script src="js/frontend.js"></script>
    </body>
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->   
    <script src="js/vendor/bootstrap.min.js"></script>

</html>
