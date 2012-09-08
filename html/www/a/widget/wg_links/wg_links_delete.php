<?php
session_start();
include("../../php/class.login.php");
include("../../php/class.show.php");
include("../../php/class.ezSQL.php");
$login = new login;
$login->requirelogin();
$rango = array();
array_push($rango,$login->myinfo("userRange"));
if(!in_array(1,$rango)) { die("Solo administradores pueden ejecutar esta funci&oacute;n."); }

$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

if(isset($_POST['webId'])) { $webId = $db->escape($_POST['webId']); } else { die("No reconocimos la web"); }

$url = $db->get_var("SELECT webUrl FROM web WHERE webId='".$webId."'");
// Envio del correo
include("../../php/class.phpmailer.php");
// Variables que usara el correo
$usuario = $db->get_row("SELECT U.userEmail AS nombre,U.userEmail AS correo FROM web W, user U WHERE W.userId=U.userId
AND W.webId='".$webId."'");

$mailer=new phpmailer();
$destinos=array(array("nombre"=>"Paulo McNally","email"=>"paulomcnally@gmail.com"),array("nombre"=>$usuario->nombre,"email"=>$usuario->correo));
$mensaje='';
$mensaje="Hola: ".$usuario->nombre."<br><br>";
$mensaje.="Analizamos tu sitio web (".$url.") y confirmamos que no cumpe con las normas de www.alsuave.info<br><br><strong>Normas:</strong> http://www.box.net/shared/hygjxotsnl<br><br>Att: www.alsuave.info<br>".date("d/M/Y H:i:s");

$mensaje_plano='';
$mensaje_plano="Hola: ".$usuario->nombre."\n\n";
$mensaje_plano.="Analizamos tu sitio web (".$url.") y confirmamos que no cumpe con las normas de www.alsuave.info<br><br>Normas: http://www.box.net/shared/hygjxotsnl<br><br>Att: www.alsuave.info<br>".date("d/M/Y H:i:s");

//Enviar email:
$mailer->From='robot@alsuave.info';
$mailer->FromName='AlSuave.Info';
$mailer->Host='';
$mailer->Mailer='mail';
$mailer->Subject='Cancelamos tu sitio';
$mailer->Body=$mensaje;
$mailer->AltBody=$mensaje_plano;
foreach($destinos as $destino)
	{
	$mailer->AddAddress($destino["email"],$destino["nombre"]);
	}
if(!$mailer->Send())
	{
	$mailer->ClearAddresses();
	echo "Error al notificar por email.";
	}
	else
		{
		$db->query("UPDATE web SET webStatus='0' WHERE webId='".$webId."'");
		die("Cancelado");
		}


?>