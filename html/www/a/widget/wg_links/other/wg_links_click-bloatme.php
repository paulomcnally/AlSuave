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

$c = curl_init('http://bloat.me/remote?website_url='.$url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$url = substr($page,1125,20);
die("Agregado---".$url);
?>