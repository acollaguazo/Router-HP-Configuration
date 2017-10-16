#!/usr/bin/perl

use Net::Telnet ();
use DBI;

#declaracion de variables
$sec =0;$min=0,$hora=0,$dia=0,$mes=0,$year=0,$wdia=0;
$host1 = "192.168.0.1";
$name1 = "R1_GYE";

#variables para la base de datos
$dbname = 'proyectoASRL';
$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbkey  = 'grupo2';

#obtenemos la fecha y hora del sistema
$time=time();
($sec,$min,$hora,$dia,$mes,$year,$wdia,undef,undef)=localtime($time);

##ajustamos el dato del año
$year=$year+1900;
$mes=$mes+1;

##Creamos una nueva variable, la cual contendra la fecha y hora en formato año-mes-dia-hora-minutos
$now="$year-$mes-$dia-$hora-$min";

#conectarse a la base de datos
$dbh = DBI->connect("DBI:mysql:$dbname;host=$dbhost", $dbuser,$dbkey) or die "Error de conexion: $DBI::errstr";
## Leer los registros de la tabla
$sth = $dbh->prepare("select HostName, IPaddress from EquipoRed, Puerto, Configuracion");
$sth->execute();
while ($row = $sth->fetchrow_hashref) {
#definimos la ip a la cual hacer telnet.
my $host=$row->{IPaddress};

#extraemos el nombre del enrutador
$name=$row->{HostName};
print "\n\n\n\nIntentando establecer sesion Telnet con\n";
print "NOMBRE: " . $row->{HostName} . "\n";
print "IP_interfaz0/1: " . $row->{IPaddress} . "\n";


#parametros para ingresar al router
my $username='admin';
my $passwd='admin';
my ($t, @output);
$t = new Net::Telnet (Timeout => 10, Prompt => '/[%#>]$/');
if($t->open(Host => $host1, Errmode => 'return' )!=1)
{
print "No se pudo estabecer sesion con $name1 con su ip $host \n";
sleep 2;
next;
}
$t->login($username,$passwd);
print "\nSesion Telnet con $name1 establecida exitosamente\n";
sleep 4;
$t->cmd(String => 'screen-length disable');
@output = $t->cmd(String => 'display current-configuration',Prompt => '/return/');
print @output;

$file="/usr/asrl/BackupRouter/$name1-$now.txt";
open FH, ">$file" or die "cant open '$file': $!";
foreach ( @output )
{
print FH $_;
}
close FH;


$file1 = "/usr/asrl/VersionRouter/version$name1";
@output = $t->cmd("screen-length disable");
@output = $t->cmd(String => 'display version', Prompt => '/[%#>]$/');
print @output;
open FH, ">$file1" or die "cant open '$file1': $!";
foreach ( @output )
{
print FH $_;
}
close FH;


#cerrar la sesion Telnet
}
#cerramos la conexion a la base de datos.
$sth->finish();
$dbh->disconnect;
