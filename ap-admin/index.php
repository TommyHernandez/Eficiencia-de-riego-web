<?php
require '../require/comun.php';
$acc = 1;
if (isset($_GET["acc"])) {
    $acc = $_GET["acc"];
}
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

        <title>Admin-Login</title>
        <!-- Bootstrap core CSS -->
        <link href="../css/vendor/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="../css/vendor/bootstrap-theme.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                   <div class="logo"></div>
                    <form class="form-signin" action="../usuario/phplogin.php" method="POST">
                        <h2 class="form-signin-heading">Panel de Administración</h2>
                        <label for="user" class="sr-only">Usuario</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required>
                        <br/>
                        <label for="inputPassword" class="sr-only">Clave</label>
                        <input type="password" id="clave" name="clave" class="form-control" placeholder="clave" required>
                        
                        <br/> <button class="btn btn-lg btn-primary btn-block" type="submit">Conectar</button>
                    </form> 
                    <?php if ($acc == 0) { ?>
                        <p class="bg-warning">Tu usuario NO tiene Acceso al Panel, mala suerte...</p>
                    <?php } ?>
                </div>
                <div class="col-md-4">

                </div>

            </div>
        </div> <!-- /container -->
    </body>
</html>
<?php
if($sesion->isAdminLogin()){
    header("Location: panel.php");
}else{
    
}
?>