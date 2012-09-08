<?php
session_start();
if(isset($_GET['a']) and !empty($_GET['a']))
	{
	include("../../php/class.ezSQL.php");
	include("../../php/class.login.php");
	include("../../php/class.ip.php");
	include("../../php/class.show.php");
	include("../../php/class.phpmailer.php");

	$login->requirelogin();
	switch($_GET['a'])
		{
		case "add":
			if(isset($_POST['textarea_comments'])) { if(!empty($_POST['textarea_comments'])) { $text = htmlentities($_POST['textarea_comments'],ENT_NOQUOTES,"utf-8"); } else { die("Escriba un comentario"); } } else { die("No envio el comentario"); }
			if(isset($_POST['id'])) { if(is_numeric($_POST['id'])) { $id = $_POST['id']; } else { die("No es un Numero"); } } else { die("No envio el Id del Tema"); }
			
			$db->query("INSERT INTO pysr (pysrId,pysrText,pysrDateTime,userId,pysId) VALUES (NULL,'".$text."','".date("Y-m-d H:m:s")."','".$_SESSION['userSession']."','".$id."')");
			
			$ptitle=$db->get_var("SELECT pysTitle FROM pys WHERE pysId='".$id."'");
			die("Agregado");
		break;
		case "abuso":
			if(!isset($_SESSION['abuso']))
				{
				$_SESSION['abuso'] = $_SESSION['userSession'] . $_POST['id'] . $_POST['idr'];
				}
				else
					{
					if($_SESSION['abuso'] == $_SESSION['userSession'] . $_POST['id'] . $_POST['idr'])
						{
						die("Ya reporto esta respuesta!");
						}
					}
			
			if(isset($_POST['id'])) { if(is_numeric($_POST['id'])) { $id = $_POST['id']; } else { die("No es un Numero de Tema (".$id.")"); } } else { die("No envio el Id del Tema"); }
			if(isset($_POST['idr'])) { if(is_numeric($_POST['idr'])) { $idr = $_POST['idr']; } else { die("No es un Numero de Comentario"); } } else { die("No envio el Id de la Respuesta"); }
			// Notificamos por email
			$mailer=new phpmailer();
			$mensaje='';
			$mensaje=$login->myinfo("userName")." reporto el siguiente comentario:<br><br>";
			$mensaje.="http://alsuave.info/a/preguntas_y_sugerencias.php?i=".$id."#c_".$idr."<br><br>Att: www.alsuave.info<br>".date("d/M/Y H:i:s");

			$mensaje_plano='';
			$mensaje_plano=$login->myinfo("userName")." reporto el siguiente comentario:\n\n";
			$mensaje_plano.="http://alsuave.info/a/preguntas_y_sugerencias.php?i=".$id."#c_".$idr."\n\nAtt: www.alsuave.info\n".date("d/M/Y H:i:s");
			$mailer->From='robot@alsuave.info';
			$mailer->FromName='AlSuave.Info';
			$mailer->Host='';
			$mailer->Mailer='mail';
			$mailer->Subject=$login->myinfo("userName").' reporto un comentario.';
			$mailer->Body=$mensaje;
			$mailer->AltBody=$mensaje_plano;
			$mailer->AddAddress("paulomcnally@gmail.com","Paulo McNally");
			if(!$mailer->Send())
				{
				$mailer->ClearAddresses();
				echo "Error al notificar por email.";
				}
				else
					{
					die("Reportado");
					}
		break;
		case "addtopic":
			if(isset($_POST['pysTitle'])) { if(!empty($_POST['pysTitle'])) { $pysTitle = htmlentities($_POST['pysTitle'],ENT_NOQUOTES,"utf-8"); } else { die("Escriba un titulo"); } } else { die("No envio el titulo"); }
			if(isset($_POST['pysText'])) { if(!empty($_POST['pysText'])) { $pysText = htmlentities($_POST['pysText'],ENT_NOQUOTES,"utf-8"); } else { die("Escriba el contenido"); } } else { die("No envio el contenido"); }
			$db->query("INSERT INTO pys (pysId,pysTitle,pysText,pysDateTime,userId) VALUES(NULL,'".$pysTitle."','".$pysText."','".date("Y-m-d H:i:s")."','".$_SESSION['userSession']."')");
		die("Agregado---".$db->insert_id);
		break;
		}
	}