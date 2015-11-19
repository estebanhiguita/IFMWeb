<?php 
session_start();
// define('DB_TYPE', 'mysql');
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'gs');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_CHARSET', 'utf8');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'gs');
define('DB_USER', 'ana');
define('DB_PASS', 'ana');
define('DB_CHARSET', 'utf8');


$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);


$sql = "SELECT nombre, clave FROM tbl_persona WHERE usuario = ?";
$query = $db->prepare($sql);
$query->bindValue(1, $_POST["txtUsuario"]);
$query->execute();
$resultado = $query->fetch();
    
if($resultado != false){
	if($resultado->clave == $_POST["txtClave"]){
		$_SESSION["nombre"] = $resultado->nombre;
		header("location: ../index.php");
	}else{
		header("location: ../login.php?error=1");
	}
}else{
	header("location: ../login.php?error=1");
}

?>