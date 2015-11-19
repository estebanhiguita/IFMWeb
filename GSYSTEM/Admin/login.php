<?php 

session_start();
if(isset($_SESSION["nombre"])){
  header("location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>GSystem | Log in</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

  <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- CSS -->
        <link rel="stylesheet" href="dist/css/alertify.min.css"/>
      </head>
      <body class="login-page">
        <div class="login-box">
          <div class="login-logo">
            <a href="#"><b>G</b>SYSTEM</a>
          </div><!-- /.login-logo -->
          <div class="login-box-body">
            <p class="login-box-msg">Inicia sesión para ingresar</p>
            <form method="post" action="server/sesion.php">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario" name="txtUsuario"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Clave" name="txtClave"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-8">    

                </div><!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div><!-- /.col -->
              </div>
            </form>

          </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="dist/js/jquery-1.11.2.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="dist/js/bootstrap.min.js" type="text/javascript"></script>


        <script src="dist/js/alertify.min.js"></script>


        <?php if(isset($_GET["error"])){ ?>
        <script type="text/javascript">
          $(function(){
            alertify.error("El usuario o clave no son correctos");
          });
        </script>
        <?php } ?>
      </body>
      </html>