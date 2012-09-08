<?php
include("../../php/class.ezSQL.php");
include("../../php/class.ip.php");
include("../../php/class.phpmailer.php");
include("../../php/class.pop3.php");
include("../../php/class.smtp.php");
include("../../php/class.login.php");
include("../../php/class.show.php");

if(isset($_POST['w'])) { if(!is_numeric($_POST['w'])) { die("w no es Integer"); } else { $w=$_POST['w']; } } else { die("No envio w"); }
if(isset($_POST['u'])) { if(!is_numeric($_POST['u'])) { die("u no es Integer"); } else { $u=$_POST['u']; } } else { die("No envio u"); }

$ip = $p_ip->myIp();
$db->query("INSERT INTO visitas(visitaId,visitaDateTime,visitaIp,visitaNavegador,visitaSource,webId,userId) VALUES(NULL,'".date("Y-m-d H:i:s")."','".$ip."','".$_SERVER['HTTP_USER_AGENT']."','".$PHP_SELF."','".$w."','".$u."')");

$url = $db->get_var("SELECT webUrl FROM web WHERE webId = ".$w);
$clickeado = $db->get_row("SELECT U.userEmail as correo, U.userName as nombre FROM web W, user U
							WHERE W.webId = ".$w." AND W.userId = U.userId");
$clickeador = $db->get_row("SELECT U.userEmail as correo, U.userName as nombre FROM user U WHERE userId = ".$u);
$admins = $db->get_results("SELECT U.userEmail as correo, U.userName as nombre FROM user U WHERE U.userRange = '1,2'");
$mailer=new phpmailer();
$mensaje_clickeado='';
$mensaje_clickeado="Hola: ".$clickeado->nombre."<br><br>";
$mensaje_clickeado.="Han visitado tu sitio (".$url.") desde una de las web de ".$clickeador->nombre."<br>Esto ha generado trafico y un nuevo usuario para tu sitio, si deseas agradecerle a ".$clickeador->nombre." puedes agregar en tu sitio un panel de webs amigas y asi compartiras tus usuarios con todos nosotros.<br><br>Puedes encontrar tu codigo de panel en esta direcci&oacute;n: http://alsuave.info/a/webs_amigas.php<br><br>Att: www.alsuave.info<br>".date("d/M/Y H:i:s");
$mensaje_plano_clickeado='';
$mensaje_plano_clickeado="Hola: ".$clickeado->nombre."\n\n";
$mensaje_plano_clickeado.="Han visitado tu sitio (".$url.") desde una de las web de ".$clickeador->nombre."\nEsto ha generado trafico y un nuevo usuario para tu sitio, si deseas agradecerle a ".$clickeador->nombre." puedes agregar en tu sitio un panel de webs amigas y asi compartiras tus usuarios con todos nosotros.\n\nPuedes encontrar tu codigo de panel en esta direcci&oacute;n: http://alsuave.info/a/webs_amigas.php\n\nAtt: www.alsuave.info\n".date("d/M/Y H:i:s");

//Enviar email:
$mailer->From='robot@alsuave.info';
$mailer->FromName='AlSuave.Info';
$mailer->Host='';
$mailer->Mailer='mail';
$mailer->Subject=$clickeador->nombre.' Has ganado un nuevo usuario en tu web';
$mailer->Body=$mensaje_clickeado;
$mailer->AltBody=$mensaje_plano_clickeado;
$mailer->AddAddress($clickeado->correo,$clickeado->nombre);

if(!$mailer->Send())
	{
	$mailer->ClearAddresses();
	echo "Error al notificar por email.";
	}
// Procedemos a notificar al Clickeador
$mailer->ClearAddresses();
$mensaje_clickeador='';
$mensaje_clickeador="Hola: ".$clickeador->nombre."<br><br>";
$mensaje_clickeador.="Han visitado el sitio (".$url.") desde una de tus web <br>Esto ha generado trafico y un nuevo usuario para ".$clickeado->nombre.", ".$clickeado->nombre." ha sido notificado y seguro ya esta agregando el servicio de webs amigas para compartir trafico de usuarios contigo.<br><br>Att: www.alsuave.info<br>".date("d/M/Y H:i:s");
$mensaje_plano_clickeador='';
$mensaje_plano_clickeador="Hola: ".$clickeador->nombre."\n\n";
$mensaje_plano_clickeador.="Han visitado el sitio (".$url.") desde una de tus web <br>Esto ha generado trafico y un nuevo usuario para ".$clickeado->nombre.", ".$clickeado->nombre." ha sido notificado y seguro ya esta agregando el servicio de webs amigas para compartir trafico de usuarios contigo.\n\nAtt: www.alsuave.info\n".date("d/M/Y H:i:s");
$mailer->Body=$mensaje_clickeador;
$mailer->AltBody=$mensaje_plano_clickeador;
$mailer->AddAddress($clickeador->correo,$clickeador->nombre);
if(!$mailer->Send())
	{
	$mailer->ClearAddresses();
	echo "Error al notificar por email.";
	}
$mailer->ClearAddresses();
$mensaje_clickeador='';
$mensaje_admins.="Desde una web de ".$clickeador->nombre." han visitado el sitio (".$url.") que pertenece a ".$clickeado->nombre."<br><br>Att: www.alsuave.info<br>".date("d/M/Y H:i:s");
$mensaje_plano_admins.="Desde una web de ".$clickeador->nombre." han visitado el sitio (".$url.") que pertenece a ".$clickeado->nombre."\n\nAtt: www.alsuave.info\n".date("d/M/Y H:i:s");
$mailer->Body=$mensaje_admins;
$mailer->AltBody=$mensaje_plano_admins;
foreach($admins as $admin)
	{
	$mailer->AddAddress($admin->correo,$admin->nombre);
	}
if(!$mailer->Send())
	{
	$mailer->ClearAddresses();
	echo "Error al notificar por email.";
	}
die("Registrado");
?>