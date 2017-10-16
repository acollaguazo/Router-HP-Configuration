<html>
<head>
    <title> REPORTES DE EQUIPOS </title>
    <meta charset = "utf-8">
    <link rel="stylesheet" href="../recursos/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <style>
    body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
    body {font-size:20px;}
    .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
    .w3-half img:hover{opacity:1}
    
    body{ 
        background-image: url(../recursos/fondo.png); 
        background-position : center; 
        backface-visibility: 
        background-repeat : no-repeat; 
        background-attachment : fixed; 
        } 
    </style>

</head>
<body>
   <?php
	$Ciudad=$_GET['Ciudad'];
	$db_user="root";
	$db_password="grupo2";
	$db_name="proyectoASRL";
	$db_server="localhost";
	$con = mysql_connect($db_server,$db_user,$db_password);
	mysql_select_db($db_name, $con) or die("No se puede conectar a la base de datos");
   ?>

<table class="w3-cyan w3-center w3-opacity w3-margin" border="2">
	<tr>
		<td class="w3-center w3-border w3-border-blue" colspan="9"> <h1 sytle="font-size:150%;"> CONSULTA SOBRE EQUIPOS</h1></td>
	</tr>
	<tr class="w3-blue">
		<td><b>Ciudad</td>
		<td><b>Empresa</td>
		<td><b>Tipo</td>
		<td><b>HostName</td>
		<td><b>Modelo</td>
		<td><b>VersionIOS</td>
		<td><b>Usuario</td>
		<td><b>Fecha de Configuración</td></b>
		<td><b>Configuracion de Puertos</td></b>
	</tr>

<?php
	$result = mysql_query("SELECT Ciudad, Empresa,Tipo, HostName, Modelo,VersionIOS, Usuario, FechaInsert FROM EquipoRed,Administrador, Login WHERE EquipoRed.IdEquipo = Login.IdEquipo and Login.IdAdmin = Administrador.IdAdmin and EquipoRed.Ciudad = '$Ciudad'");
	while($row = mysql_fetch_array($result)){
?>
<tr>
	<td><b> <?php echo $row["Ciudad"]; ?> </td> 
	<td><b> <?php echo $row["Empresa"]; ?> </td>
	<td><b> <?php echo $row["Tipo"]; ?> </td>
	<td><b> <?php echo $row["HostName"]; ?> </td>
	<td><b> <?php echo $row["Modelo"]; ?> </td>
	<td><b> <?php echo $row["VersionIOS"]; ?> </td>
	<td><b> <?php echo $row["Usuario"]; ?> </td>
	<td><b> <?php echo $row["FechaInsert"]; ?> </td></b>
	<td><b> 
    	    	<form action="reporte_puerto.php" class="w3-center" method="get">
    	      		<div class="w3-section" > </div>
				<?php $valor= $row["FechaInsert"]; ?>
	    	      	<button type="submit" name="NombreRouter" value ="<?php echo $row["HostName"]; ?>" class="w3-button w3-teal w3-margin-bottom">VER</button>
        	</form>
	</td></b>
</tr>

<?php
}
?>
</table>

        <form action="../menu.php#Reportes" class="w3-center w3-padding-large" >
          <div class="w3-section" > </div>
          <button type="submit" class="w3-button w3-padding-large w3-teal w3-margin-bottom">REGRESAR A MENÚ</button>
        </form>
</body>
</html>

