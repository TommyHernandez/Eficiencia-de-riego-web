<?php
require_once '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloReportes($bd);
$id = Leer::get("id");
if (isset($id)) {
    $id = Leer::get("id");
} else {
    header("Location: ../index.php=error=-2");
    exit();
}
$objeto = $modelo->get($id);
$modelouser = new ModeloUsuario($bd);
$usuario = $modelouser->get($objeto->getUsuario());
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
        <section>
            <div class="container">
                <div class="row underline">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Reporte Nº #<?php echo $objeto->getId(); ?></h2>
                        <h3 class="section-subheading text-muted"></h3>
                    </div>
                </div>
            </div>
        </section>
        <div class="container container-fluid light-gray">           
            <div class="row">
                <div class="animated slideInUp col-md-4">
                    <div>
                        <h4><?php echo $usuario->getLogin(); ?></h4>
                    </div>
                    <div class="avatar">
                        <img src="../imagenes/noavatar.jpg" alt="No Avatar!" class="img-circle">
                    </div>
                    <div class="fecha"><span><?php echo $objeto->getFecha(); ?></span></div>
                    <div class="col-md-12">
                        <table class="table-bordered">
                            <tr><th>Latitud:</th><td id="lat"><?php echo $objeto->getLat(); ?></td></tr>
                            <tr><th>Longitug:</th><td id="long"><?php echo $objeto->getLong(); ?></td></tr>
                        </table>                        
                    </div>
                    <div id ="sector" class="sector"><?php echo $objeto->getSector(); ?></div>
                </div>
                <div id="report-info" class="col-md-8 animated slideInUp">
                    <div class="title">
                        <h3><?php echo $objeto->getTitulo(); ?></h3>                        
                    </div>

                    <article class="contentido">
                        <?php echo $objeto->getDescripcion(); ?>
                    </article>

                </div>
            </div>
            <?php if ($sesion->isAdminLogin()){ ?>
            <div class="row formulario-delete">
                <form>
                    <input type="hidden" name="id" value="<?php $objeto->getId(); ?>">
                    <input type="submit" id="borrar" class="btn btn-warning" value="Eliminar el Reporte" />
                </form>
            </div>
            <?php }?>
        </div>
        <div class="row">
            <div id="mapa" class="animated slideInUp"></div> 
        </div>
        <?php include '../include/footer.php'; ?>
    </body>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="../js/vendor/bootstrap.min.js"></script>
    <script src="../js/vendor/gmaps.min.js"></script>
    <script>
        $('document').ready(function () {
            var lat = $('#lat').text();
            var long = $('#long').text();
            map = new GMaps({
                div: '#mapa',
                lat: lat,
                lng: long
            });
            var marker = map.addMarker({
                lat: lat,
                lng: long,
                title: 'Lima',
                infoWindow: {
                    content: '<h4>Sector:  ' + $("#sector").text() + '</h4>'
                }
            });
            //circle options.
            var circleOptions = {
                strokeColor: '#00786c',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#00786c',
                fillOpacity: 0.35,
                map: map,
                center: new google.maps.LatLng(lat, long),
                radius: 3000
            };
//create circle
            area = new google.maps.Circle(circleOptions);
            area.bind(map, marker);
        })
    </script>
</html>