<?php
date_default_timezone_set("America/Managua");
function _gmail( $destino, $asunto, $mensaje )
	{
	require_once 'class.phpmailer.php';
	$mail = new PHPMailer ();
	$mail->From			= "no-reply@alsuave.info";
	$mail->FromName		= "AlSuave.Info";
	$mail->Subject		= $asunto;
	$mail->Body			= $mensaje;
	$mail->Host			= 'ssl://smtp.gmail.com';
	$mail->Port			= 465;
	$mail->SMTPAuth		= true;
	$mail->Username		= 'no-reply@alsuave.info';
	$mail->Password		= 'E45874';
	$mail->AddAddress ( $destino );
	$mail->AddBCC ( "paulomcnally@gmail.com" );
	$mail->IsHTML (true);
	$mail->IsSMTP();
	if(!$mail->Send())
		{
		return true;
		}
		else
			{
			return false;
			}
	}

function _gmail_footer()
	{
	$str = "<br />";
	$str .= "-------------------------------------------------";
	$str .= "<br />";
	$str .= "Has recibido este mensaje porque estas registrado en www.alsuave.info.";
	$str .= "<br />";
	$str .= "Si no deseas seguir recibiendo estos mensajes puedes solicitar que tu cuenta sea cancelada.";
	$str .= "<br />";
	$str .= "Env&iacute;a un mensaje para solicitar la cancelaci&oacute;n de tu cuenta a polin@alsuave.info.";
	$str .= "<br />";
	$str .= "www.alsuave.info";
	$str .= "<br />";
	$str .= date( "Y-m-d H:i:s" );	
	}
?>