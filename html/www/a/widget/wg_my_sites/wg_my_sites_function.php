<?php
session_start();
if(isset($_GET['a']) and !empty($_GET['a']))
	{
	include("../../php/class.ezSQL.php");
	include("../../php/class.login.php");
	include("../../php/class.show.php");
	
	if(isset($_POST['webId'])) { $webId = $_POST['webId']; } else { $webId=""; }
	if(isset($_POST['webTitle'])) { $webTitle = $_POST['webTitle']; } else { $webTitle=""; }
	if(isset($_POST['webUrl'])) { $webUrl = $_POST['webUrl']; } else { $webUrl=""; }
	if(isset($_POST['webFeed'])) { $webFeed = $_POST['webFeed']; } else { $webFeed=""; }
	switch($_GET['a'])
		{
		case "add":
			if($n = $db->query("SELECT webId FROM web WHERE webUrl='".$webUrl."'"))
				{
				die("Esta p&aacute;gina ya ha sido registrada!");
				}
				else
					{
					$db->query("INSERT INTO web (webId,webTitle,webUrl,webFeed,webStatus,webDateTime,userId) VALUES (NULL,'".$webTitle."','".$webUrl."','".$webFeed."','1','".date("Y-m-d H:m:s")."','".$_SESSION['userSession']."')");
					die("Agregado");		
					}
		break;
		case "delete":		
		if(isset($_POST['webId'])) { $webId = $_POST['webId']; } else { $webId=""; }
		if($n = $db->query("SELECT webUrl FROM web WHERE webId='".$webId."'"))
				{
				$userId = $db->get_var("SELECT userId FROM web WHERE webId='".$webId."'");
				if($userId==$_SESSION['userSession'])
					{
					$db->query("DELETE FROM web WHERE webId =".$webId);
					die("El sitio ha sido borrado");
					}else{
					die("Esta web no te pertenece. Saludos");
					}				
				}
				
				
		break;
		case "update":
			if($n = $db->query("SELECT webUrl FROM web WHERE webId='".$webId."'"))
				{
				$userId = $db->get_var("SELECT userId FROM web WHERE webId='".$webId."'");
				if($userId==$_SESSION['userSession'])
					{
					$db->query("UPDATE web SET webTitle='".$webTitle."', webUrl='".$webUrl."', webFeed='".$webFeed."' WHERE webId='".$webId."'");
					die("Editado");
					}
					else
						{
						die("Esta web no te pertenece. Saludos");
						}
				}
				else
					{
					die("El identificador de la p&aacute;gina no existe");
					}
		break;
		}
	}
if(!$login->logged())
	{
	$show->notify(0,"Session inactiva","Al parecer no ha iniciado session o su session ha caducado, le recomendamos iniciar session para poder ejecutar esta acción.",0);
	}

function add($t,$u,$f)
	{
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	$login = new login;
	}