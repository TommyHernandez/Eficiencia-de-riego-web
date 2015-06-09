<?php ?>
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
                        <li><a href="#about">Sobre</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Graficas <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Olivos por sector</a></li>
                                <li><a href="#">Litros por sector</a></li>
                                <li><a href="#">Olivos por zona  </a></li>
                                <li><a href="#">Eficiencia por sector</a></li>
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
            <div class="container"  class="seccion">
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
                                <select name="filtroolivo" class="form-control">
                                    <option selected="selected">Sector</option>
                                    <option>Zona</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default"> Filrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </section>
        <script>
            google.load("visualization", "1", {packages: ["corechart"]});

            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Sector", "Olivos", {role: "style"}],
                    ["s1", 12725, "#b87333"],
                    ["s2", 16127, "silver"],
                    ["s3", 10444, "gold"],
                    ["s4", 10200, "color: #e5e4e2"],
                    ["s5", 7695, "blue"],
                    ["s6", 12751, "color: #e5e4e2"],
                    ["s7", 13224, "color: #e5e4e2"]
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                    {calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"},
                    2]);

                var options = {
                    title: "Olivos Por Sector",
                    width: 600,
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: {position: "none"},
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("olv-sec"));
                chart.draw(view, options);
            }
        </script>
        <!-- = GRAFICA 2 == -->
        <section id="" class="light-gray seccion">
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
                                <label for="filtroolivo">Filtar por</label>
                                <select name="filtroolivo" class="form-control">
                                    <option selected="selected">Sector</option>
                                    <option>Zona</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ver como</label>
                                <select name="grafica-e" class="form-control">
                                    <option selected="selected">Tarta</option>
                                    <option>Barras</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default"> Filrar </button>
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
        <section id="" class="seccion seccion">
            <div class="container">
                <div class="row">
                    <div>
                        <h2></h2>
                    </div>
                    <div class="col-md-8">
                        <div id="barras" ></div>
                    </div>
                    <div class="col-md-4">

                    </div> 
                </div>
            </div>
        </section>
        <!-- = GRAFICA 4 == -->
        <section id="" class="light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8">

                    </div>
                </div>
            </div>
        </section>
        <!-- == Fin Secciones == --> 
        <script src="js/frontend.js"></script>
    </body>
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->   
    <script src="js/vendor/bootstrap.min.js"></script>
</html>
