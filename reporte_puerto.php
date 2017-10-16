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
	$HostName=$_GET['NombreRouter'];
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
		<td><b>Empresa</td>
		<td><b>HostName</td>
		<td><b>NameInterfaz</td>
		<td><b>IPaddress</td>
		<td><b>Mascara</td>
		<td><b>Gateway</td>
		<td><b>Fecha de Configuración</td></b>
	</tr>

<?php
	$result = mysql_query("SELECT Ciudad, Empresa, HostName, NameInterfaz, IPaddress, Mascara, Gateway,Puerto.FechaInsert FROM Configuracion, EquipoRed, Puerto WHERE EquipoRed.IdEquipo = Configuracion.IdEquipo and Configuracion.IdPort= Puerto.IdPort and HostName = '$HostName' ");
	while($row = mysql_fetch_array($result)){
?>
<tr>
	<td><b> <?php echo $row["Empresa"]; ?> </td> 
	<td><b> <?php echo $row["HostName"]; ?> </td>
	<td><b> <?php echo $row["NameInterfaz"]; ?> </td>
	<td><b> <?php echo $row["IPaddress"]; ?> </td>
	<td><b> <?php echo $row["Mascara"]; ?> </td>
	<td><b> <?php echo $row["Gateway"]; ?> </td>
	<td><b> <?php echo $row["FechaInsert"]; ?> </td></b>
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

