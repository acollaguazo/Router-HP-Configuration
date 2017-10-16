<html>
<head>
<title> SESION ESTABLECIDA</title>
</head>
<body>

<?php	
	//recibiendo variables del metodo GET
	$usuario=$_GET['username'];
	$password=$_GET['password'];


	//conexion a la base de datos
	$conexion = @mysql_connect("localhost","root","grupo2") or die('No se pudo conectar');
	mysql_select_db('proyectoASRL',$conexion) or die('No se pudo seleccionar la base de datos');
	

	$sql = "SELECT Usuario, Clave FROM `Administrador` WHERE Usuario='$usuario' AND Clave='$password'";
	$consulta_login = mysql_query($sql);

	if(mysql_num_rows($consulta_login)){
		while ($row =mysql_fetch_object($consulta_login)){
		}
		//Volver a pag de menu
		header("Location:../menu.php");
	}
	else{
		//Volver a pag de Login
		header("Location:../login.php");
	}


	mysql_close($conexion);

?>

</body>
</html>
