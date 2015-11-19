<?php 
	session_start();
	unset($_POST["txtUsuario"]);
	session_destroy();
	header("location: ../login.php");
 ?>