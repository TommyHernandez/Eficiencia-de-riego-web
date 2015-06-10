<?php

?>
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
                        <li class="active"><a href="../index.php">Inicio</a></li>
                        <li><a href="../index.php">Sobre</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Graficas <span class="caret"></span></a>
                           <ul class="dropdown-menu" role="menu">
                                <li><a href="../index.php#oliv">Olivos por sector</a></li>
                                <li><a href="../index.php#eficiancia">Eficiencia</a></li>
                                <li><a href="../index.php#litros">Litros por zector </a></li>                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tablas <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="../tablas/viewhorario.php">Horarios</a></li>
                                <li><a href="../tablas/viewlecturas.php">Lecturas</a></li>               
                            </ul>
                        </li>
                        <li><a href="../reportes/viewreportes.php">Reportes</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <!-- Contenido-->