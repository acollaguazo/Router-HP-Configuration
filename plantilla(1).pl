#!/usr/bin/perl

use Net::Telnet ();
use DBI;

#declaracion de variables
$sec =0;$min=0,$hora=0,$dia=0,$mes=0,$year=0,$wdia=0;
$host1 = "192.168.0.1";
$name1 = "R1_GYE";

#variables recibidas
$hostname = "$ARGV[0]";
$interfaz = "$ARGV[1]";
$ipv4 = "$ARGV[2]";
$mascara = "255.255.255.0";
$descripcion = "$ARGV[3]";
$mensaje = "$ARGV[4]";

#variables enviadas con comandos del router
$var_hostname = "sysname $hostname";
$var_interfaz = "interface $interfaz";
$var_IP = "ip address $ipv4 $mascara";
$var_descripcion = "description $descripcion";
$var_mensaje = "\% $mensaje \%";
$comando = "system-view\n$var_hostname\n$var_interfaz\n$var_IP\n$var_descripcion\nquit\nheader motd $var_mensaje\nquit\nsave\ny\n\ny";

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


print "\n\nIntentando establecer sesion Telnet\n";

#parametros para ingresar al router
my $username='admin';
my $passwd='admin';
my ($t, @output);
$t = new Net::Telnet (Timeout => 10, Prompt => '/[\]%#>]$/');
if($t->open(Host => $host1, Errmode => 'return' )!=1)
{
print "No se pudo estabecer sesion con $name1 con su ip $host1 \n";
sleep 2;
next;
}
$t->login($username,$passwd);
print "\nSesion Telnet con $name1 establecida exitosamente\n";
sleep 4;

$t->cmd(String => $comando,Prompt => '/[\]%#>]$/');
print "\nGuardando......\n";
sleep 3;

@output =$t->cmd(String => 'screen-length disable');
#print @output;
@output =$t->cmd(String => 'display current-configuration',Prompt => '/return/');


## Realizando Backup de la ultima informacion agregada
$file="/usr/asrl/BackupRouter/$hostname-$now.txt";
open FH, ">$file" or die "cant open '$file': $!";
foreach ( @output )
{
print FH $_;
}
close FH;



#cerrar la sesion Telnet

print "\n\nPLANTILLA BASICA GUARDADA EXITOSAMENTE\n";
