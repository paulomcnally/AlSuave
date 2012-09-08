<?php
include("../../php/class.ezSQL.php");
if(isset($_POST['key'])) { if(!is_numeric($_POST['key'])) { die("Key no es Integer"); } else { $key=$_POST['key']; } } else { die("No envio Key"); }
if(isset($_POST['show'])) { if(!is_numeric($_POST['show'])) { die("Show no es Integer"); } else { $show=$_POST['show']; } } else { die("No envio Show"); }

$links=$db->get_results("SELECT W.webId AS w,W.webTitle AS title,W.webUrl AS url, U.userName AS user FROM web W, click C, user U
WHERE W.userId=U.userId
AND W.webTitle<>'Disculpen por el error'
AND W.webStatus='1'
AND U.userId=C.userId
AND C.webId IN (SELECT webId FROM web WHERE userId='".$key."')
GROUP BY W.userId ORDER BY RAND()
LIMIT ".$show."");
if($db->num_rows>0)
	{
	echo "<ul>";
	foreach($links as $link)
		{
		$c = curl_init('http://alsuave.info/remote/?u='.$link->url);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		$alsuave_url = curl_exec($c);
		curl_close($c);
		echo "<li><a onclick='alsuave.pgo(this.href,".$link->w.",".$key."); return false;' href='".$alsuave_url."'>".ucfirst(strtolower($link->title))."</a></li>";
		}
	echo "</ul>";
	}
?>