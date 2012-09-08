<?php
if(isset($_GET['u']) && !empty($_GET['u'])) { $u=$_GET['u']; } else { die("U esta vacia"); }

if (preg_match("/^(ftp|http|https):\/\/([a-z0-9-]\.+)*/i", $u))
	{
	?>
    <div align="center" style="margin-top:50px;">
    	<span style="font-family:Arial, Helvetica, sans-serif; color:#06F; font-weight:bold;">En 6 segundos ser&aacute; redireccionado. Por favor espere! Si su navegador no redirecciona precione <a href="<?php echo $u; ?>" target="_self">aqu&iacute;</a></span>
    </div>
    <META http-equiv="refresh" content="6; URL=<?php echo $u; ?>" />
    <?php
	}
	else
		{
		die("No es un enlace v&aacute;lido");
		}
?>
<div align="center" style="margin-top:10px;">
<script type="text/javascript"><!--
google_ad_client = "pub-9262159992567637";
/* TipitapaEnLinea Galeria de Fotos 728x90 */
google_ad_slot = "3359003660";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script> 
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js"> 
</script> 
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9369055-4");
pageTracker._trackPageview();
} catch(err) {}</script>