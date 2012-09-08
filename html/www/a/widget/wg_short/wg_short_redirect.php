<?php
include("../../php/class.ezSQL.php");
if(isset($_GET['c']) && !empty($_GET['c'])) { $c=$db->escape($_GET['c']); } else { die("C&oacute;digo inv&aacute;lido!"); }

$url = $db->get_var("SELECT shortUrl FROM short WHERE shortCode='".$c."'");
if($db->num_rows>0)
	{
	header("Location: $url");
	}
	else {
    	die("Este enlace no existe");
	}
?>