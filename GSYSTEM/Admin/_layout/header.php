<?php 

session_start();
if(!isset($_SESSION["nombre"])){
  header("location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>IFM | Panel</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="dist/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link href="dist/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

    <!-- CSS -->
    <link rel="stylesheet" href="dist/css/alertify.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="dist/css/themes/bootstrap.min.css"/>


    <link rel="stylesheet" href="dist/css/dropzone.css"/>


    <link rel="stylesheet" href="dist/css/site-demos.css">

    <link rel="stylesheet" href="dist/js/pickadata/themes/default.css">
    <link rel="stylesheet" href="dist/js/pickadata/themes/default.date.css">


    <style>
      .alertify-notifier .ajs-message.ajs-success {
        background: rgba(91,189,114,.95);
        color: #fff;
      }

      .dt-bootstrap{
        padding: 30px;
      }

      .table{
        text-align: center;
        vertical-align: middle;
      }

      .table > thead > tr> th{
        text-align: center;
        vertical-align: middle;
      }

      .table > tbody > tr> td{
        text-align: center;
        vertical-align: middle;
      }

    </style>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
      <body class="skin-blue sidebar-mini">
        <div class="wrapper">

          <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>I</b>FM</span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>I</b>nfocusMadrid</span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
              </a>
              <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                  <!-- User Account: style can be found in dropdown.less -->
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                      <span class="hidden-xs"><?php
                       echo $_SESSION["nombre"]; ?></span>
                     </a>
                     <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                        <p>
                          <?php 
                          echo $_SESSION["nombre"]; ?>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-right">
                          <a href="server/cerrar.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>

            </nav>
          </header>
          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <!-- /.search form -->
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <ul class="sidebar-menu">
                <li class="header">Menu Navegación</li>

                <li>
                  <a href="index.php">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
                </li>
                

                <li>
                  <a href="niff.php">
                    <i class="fa fa-institution"></i> <span>Fondo</span>
                  </a>
                </li>

                <li>
                  <a href="unidades.php">
                    <i class="fa fa-list-alt"></i> <span>Servicios</span>
                  </a>
                </li>

                <li>
                  <a href="noticia.php">
                    <i class="fa fa-newspaper-o"></i> <span>Nosotros</span>
                  </a>
                </li>

                <li>
                  <a href="expertos.php">
                    <i class="fa fa-users"></i> <span>Equipo</span>
                  </a>
                </li>
                
                <li>
                  <a href="partners.php">
                    <i class="fa fa-suitcase"></i> <span>Clientes</span>
                  </a>
                </li>

                <li>
                  <a href="backup.php">
                    <i class="fa fa-archive"></i> <span>Generar backup</span>
                  </a>
                </li>

              </ul>
            </section>
            <!-- /.sidebar -->
          </aside>



