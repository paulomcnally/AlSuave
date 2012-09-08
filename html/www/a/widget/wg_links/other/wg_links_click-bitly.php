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

die("Agregado---".make_bitly_url($url,'paulomcnally','R_db8ed30851988819554940ee5b3a2bcf','json'));
?>