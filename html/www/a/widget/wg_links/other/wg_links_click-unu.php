<?php
session_start();
include("../../php/class.login.php");
include("../../php/class.show.php");
include("../../php/class.ezSQL.php");
$login = new login;
$login->requirelogin();
$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
if(isset($_POST['webId'])) { $webId = $db->escape($_POST['webId']); } else { die("No reconocimos la web"); }
$db->query("INSERT INTO click (clickId,clickDateTime,userId,webId,logId) VALUES(NULL,'".date("Y-m-d H:i:s")."','".$_SESSION['userSession']."','".$webId."','".$login->mylog()."')");

$url = $db->get_var("SELECT webUrl FROM web WHERE webId='".$webId."'");
function get_unu_url($u)
	{
		$unuurl = 'http://u.nu/unu-api-simple?url='.urlencode($u);
		$ch = curl_init();  
		$timeout = 5;  
		curl_setopt($ch,CURLOPT_URL,$unuurl);  
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
		$unuurl = curl_exec($ch);  
		curl_close($ch);
		return trim($unuurl);
	}
die("Agregado---".get_unu_url($url));
?>