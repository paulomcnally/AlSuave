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

function get_digg_url($u,$app_key)
	{
	$return_xml = file_get_contents('http://services.digg.com/url/short/create?type=xml&appkey='.urlencode($app_key).'&url='.urlencode($u));
	$digg_url = get_match('/short_url="(.*)"/isU',$return_xml);
	return $digg_url;
	}

/* function that runs a regex to scrub for the url */
function get_match($regex,$content)
	{
	preg_match($regex,$content,$matches);
	return $matches[1];
	}

/* important! set a fake user agent */
ini_set('user_agent','Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');

die("Agregado---".get_digg_url($url,'e80376afc831c965f8a8a58f5c0e3c7e'));
?>