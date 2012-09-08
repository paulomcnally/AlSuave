<?php
class pmail {
	public function sendTo($mailTo,$subject,$content,$mailFrom,$nameFrom)
		{
		$dateTime = date("D d F Y - H:i:s");
		
		$header .= "From: $nameFrom <$mailFrom>\r\n";
		$header .= "Return-Path: $nameFrom <$mailFrom>\r\n";
		$header .= "Cc: paulomcnally@gmail.com\r\n";
		$header .= "Content-Type: text/html; charset=utf-8\r\n";
		$header .= "Content-Transfer-Encoding: 8bit\r\n";
		if(mail($mailTo, $subject, $content, $header))
			{
			//echo "Mensaje enviado";
			}
			else
				{
				//echo "Error al enviar el mensaje";
				}
		}

}
$pmail = new pmail;
?>