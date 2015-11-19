<?php
//MySQL connection parameters



//Includes class
require_once('../api/Config/Config.php');
require_once('backup/Dump.php');
require '_layout/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Backups
			<small>Version 1.0</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-lock"></i> Inicio</a></li>
			<li class="active">Backups</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron text-center">
					<h1>Hola, <?php echo $_SESSION["nombre"]; ?></h1>
					<p>El backup de tus datos se ha generado.</p>
					<p><a class="btn btn-primary btn-lg" href="backup/<?php echo $nameBackup; ?>" download role="button">Descargar</a></p>
				</div>
			</div>
		</div>

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php
require '_layout/footer.php';
?>

