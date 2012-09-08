<?php
$values = array("Api Key"=>"k", "numero de enlaces"=>"s");
foreach($values as $i=>$value)
	{
	if(isset($_GET[$value]))
		{
		if(empty($_GET[$value]))
			{
			die("No envio ".$i." del contenedor");
			}
		if(!is_numeric($_GET[$value]))
			{
			die("El ".$i." no es un valor num&eacute;rico");
			}
		}
		else
			{
			die("No recibimos el valor: ".$i);
			}
	}
$styles = array("color"=>"cr", "color de fondo"=>"cf", "tipo de letra"=>"ff", "tama&ntilde;o de letra"=>"fz");
foreach($styles as $s=>$style)
	{
	if(isset($_GET[$style]))
		{
		if(empty($_GET[$style]))
			{
			die("No envio ".$s." del contenedor");
			}
		}
		else
			{
			die("No recibimos el valor: ".$s);
			}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web Amigas www.alsuave.info</title>
</head>
<body>
<style type="text/css">
body { 
	margin:0; 
	padding:0;
	font-size: <?php echo $_GET['fz']; ?>px;
	font-family: <?php echo $_GET['ff']; ?>;
	background-color: #<?php echo $_GET['cf']; ?>;
}
li { list-style:none; }
ul { margin:5px; padding:0;  }
a { text-decoration:none; color: #<?php echo $_GET['c']; ?>; }
a:hover { text-decoration:underline; }
#alsuave { margin:0 auto; position:relative; overflow:hidden; widows:50%;}
</style>
<div id="alsuave"></div>
<div style="margin-top:300px;">
<script type="text/javascript"><!--
google_ad_client = "pub-2015513932539714";
/* 728x90, 1 */
google_ad_slot = "4729299986";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<script type="text/javascript" src="alsuave.js"></script>
<script type="text/javascript">
alsuave.pload(<?php echo $_GET['k']; ?>,<?php echo $_GET['s']; ?>);
</script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9369055-4");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>
