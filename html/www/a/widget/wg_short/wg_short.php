<?php
include("../../php/class.ezSQL.php");
if(isset($_GET['u']) && !empty($_GET['u'])) { $u=$_GET['u']; } else { die("U esta vacia"); }

$domain = "http://alsuave.info/";

if (preg_match("/^(ftp|http|https):\/\/([a-z0-9-]\.+)*/i", $u))
	{
	if($e = $db->query("SELECT shortId FROM short WHERE shortUrl='".$u."'"))
		{
		$shortCode = $db->get_var("SELECT shortCode FROM short WHERE shortUrl='".$u."'");
		die($domain.$shortCode);
		}
	$date=date("Y-m-d H:i:s");
	$now = strtotime($date);
	$code = strtoupper(substr(md5($now.rand()),0,5));
    $db->query("INSERT INTO short (shortId,shortCode,shortUrl,shortDateTime,userId) VALUES(NULL,'".$code."','".$u."','".date("Y-m-d H:i:s")."','0')");

	die($domain.$code);
	}
	else {
    	die("Al parecer no es un URL v&aacute;lida");
	}
?>