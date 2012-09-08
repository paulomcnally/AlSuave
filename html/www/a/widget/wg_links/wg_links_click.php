<?php
session_start();
include("../../php/class.login.php");
include("../../php/class.show.php");
include("../../php/class.ezSQL.php");
include("../../php/class.ip.php");
$login = new login;
$p_ip = new p_ip;
$login->requirelogin();
$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
if(isset($_POST['webId'])) { $webId = $db->escape($_POST['webId']); } else { die("No reconocimos la web"); }
$db->query("INSERT INTO click (clickId,clickDateTime,userId,webId,logId,userIp,navegador) VALUES(NULL,'".date("Y-m-d H:i:s")."','".$_SESSION['userSession']."','".$webId."','".$login->mylog()."','".$p_ip->myIp()."','".$_SERVER['HTTP_USER_AGENT']."')");

$url = $db->get_var("SELECT webUrl FROM web WHERE webId='".$webId."'");
// Envio del correo
include("../../php/class.phpmailer.php");
// Variables que usara el correo
$clickeado = $db->get_row("SELECT U.userEmail AS nombre,U.userEmail AS correo FROM web W, user U WHERE W.userId=U.userId
AND W.webId='".$webId."'");
$clicker = $db->get_var("SELECT userName FROM user WHERE userId='".$_SESSION['userSession']."'");
$mailer=new phpmailer();
$destinos=array(array("nombre"=>"Paulo McNally","email"=>"paulomcnally@gmail.com"),array("nombre"=>$clickeado->nombre,"email"=>$clickeado->correo));
$mensaje='';
$mensaje="Hola: ".$clickeado->nombre."<br><br>";
$mensaje.=$clicker." visito tu enlace (".$url.")<br>Devuelvele el favor visitando su sitio. Encuentra su sitio en http://alsuave.info/a/enlaces_disponibles.php<br><br>Att: www.alsuave.info<br>".date("d/M/Y H:i:s");

$mensaje_plano='';
$mensaje_plano="Hola: ".$clickeado->nombre."\n\n";
$mensaje_plano.=$clicker." visito tu enlace (".$url.")\nDevuelvele el favor visitando su sitio. Encuentra su sitio en http://alsuave.info/a/enlaces_disponibles.php\n\nAtt: www.alsuave.info\n".date("d/M/Y H:i:s");

//Enviar email:
$mailer->From='robot@alsuave.info';
$mailer->FromName='AlSuave.Info';
$mailer->Host='';
$mailer->Mailer='mail';
$mailer->Subject=$clicker.' visito tu enlace';
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
		function make_bitly_url($url,$login,$appkey,$format = 'xml',$version = '2.0.1')
	{
	$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
	$response = file_get_contents($bitly);
	if(strtolower($format) == 'json')
		{
		$json = @json_decode($response,true);
		return $json['results'][$url]['shortUrl'];
		}
		else //xml
			{
			$xml = simplexml_load_string($response);
			return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
		}
	}

die("Agregado---".make_bitly_url($url,'paulomcnally','R_4e1d4f7f7d36ee492bc3da1d59bd78ec','json'));
		}
?>