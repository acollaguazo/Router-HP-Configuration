<?php		
	//recibiendo variables del metodo GET
	$Ruta_Estatica	=$_GET['Ruta'];
	
	echo exec("sudo perl /usr/asrl/Scripts/ruta.pl '$Ruta_Estatica'");
	
	header("Location:../menu.php#RouteStatic");
	
?>
