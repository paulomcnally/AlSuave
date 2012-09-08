<?php
//mail('pmcnally@llamadas.com.ni','Test Send Mail Php Class','Esto es una prueba');
include("class.phpmailer.php");
$mailer=new phpmailer();
$destinos=array(
		array(
			"nombre"=>"Paulo McNally",
			"email"=>"pmcnally@llamadas.com.ni"
		),
		array(
			"nombre"=>"Paulo McNally",
			"email"=>"paulomcnally@gmail.com"
		)
	);
$mensaje='';
$mensaje="Mensaje:<br><br>";
$mensaje.="Ejemplo de envio de mensaje con la clase phpmailer";
		
//Mensaje plano:
$mensaje_plano='';

$mensaje_plano="Mensaje:\n\n";
$mensaje_plano.="Ejemplo de envio de mensaje con la clase phpmailer";

//Enviar email:
$mailer->From='testprogramacion@llamadasheladas.com';
$mailer->FromName='Test Programacion';
$mailer->Host='';
$mailer->Mailer='mail';
$mailer->Subject='Notificacion de reportes no enviados el dia '.$ayer;
$mailer->Body=$mensaje;
$mailer->AltBody=$mensaje_plano;
foreach($destinos as $destino)
	{
	$mailer->AddAddress($destino["email"],$destino["nombre"]);
	}
if(!$mailer->Send())
	{
	$mailer->ClearAddresses();
	echo "Error";
	return false;
	}
	else
		{
		echo 'Mensaje enviado';
		}
$mailer->ClearAddresses();