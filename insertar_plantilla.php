<?php		
	//recibiendo variables del metodo GET
	$Name_Router	=$_GET['Name_Router'];
	$Name_Ethernet	=$_GET['Name_Ethernet'];
	$IP_Ethernet	=$_GET['IP_Ethernet'];
	$Descripcion_Ethernet	=$_GET['Descripcion_Ethernet'];
	$Mensaje	=$_GET['Mensaje'];
	//$Aceptando	=$_GET['ACEPTANDO'];

	$parametros = "$Name_Router $Name_Ethernet $IP_Ethernet '$Descripcion_Ethernet' '$Mensaje'";
	
	echo exec("sudo perl /usr/asrl/Scripts/plantilla.pl $parametros");
	
	header("Location:../menu.php#PlantillaBasic");
	
?>
