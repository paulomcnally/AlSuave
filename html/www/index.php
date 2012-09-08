<?php
include("a/php/class.ezSQL.php");
$feed = $db->get_row("SELECT webTitle,webFeed FROM web WHERE webFeed>'' AND webStatus=1 ORDER BY RAND() LIMIT 1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Al Suave.info - Has v&iacute;nculos cortos para tus enlaces privados</title>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAARlKw18YEWsOFgRsRMQNq0BQ0KFTAKC-lpLvvFUKRG89Zj_dHJxQaVmqKErrpZfLgBOBTXNWUk3zv3A"></script>
    <script type="text/javascript">
 
    google.load("feeds", "1");
 
    function initialize() {
      var feed = new google.feeds.Feed("<?php echo $feed->webFeed; ?>");
      feed.load(function(result) {
        if (!result.error) {
          var container = document.getElementById("feed");
          for (var i = 0; i < result.feed.entries.length; i++) {
            var entry = result.feed.entries[i];
            var div = document.createElement("div");
			div.innerHTML='<a href="'+entry.link+'" target="_blank">'+entry.title+'</a>';
            //div.appendChild(document.createTextNode(entry.title));
            container.appendChild(div);
          }
        }
      });
    }
    google.setOnLoadCallback(initialize);
 
    </script>
<style type="text/css">
body { font-family:Arial, Helvetica, sans-serif; font-size:12px; }
#url {font-size:1.4em; padding:0.2em 0.2em; vertical-align: middle; width:460px;}
#url:focus {background-color: #fffebc;}
#make {font-size:1em; padding:0.4em 0.8em; background-color:#999; vertical-align: middle; border: 1px solid #0e82d0; color: #FFF; -webkit-border-radius: 3px; -moz-border-radius: 3px; background: #4086cb url(a/img/blue.gif) repeat-x left top; cursor:pointer;}
#make:hover {background: #4086cb url(a/img/blue-hover.gif) repeat-x left top; cursor:pointer;}
#wrapper {margin:100px auto 0 auto;width:600px;}
#r { margin-top:20px;font-size:1em;font-family:Arial;color:#03C;}
.extencion{margin:0;padding:5px;background:#F2EB91;border:1px solid #B5B91A;text-align:center;}
.extencion a{text-decoration:none;}
.extencion a:hover{text-decoration:underline;}
</style>
</head>

<body>
	<div class="extencion"><a href="https://chrome.google.com/extensions/detail/mggjmokblfmedbohhjdopdinfmadhfld" target="_blank">AlSuave  1.0 extension de Google Chrome</a></div>
	<div id="wrapper">
    	<input name="url" id="url" type="text" />
        <input type="button" id="make" name="make" value="Hacer" />
        <img style="display:none;" id="loading" src="a/img/loading.gif" alt="cargando..." align="absmiddle" />
        <div id="r"></div>
        <div  style="margin-top:20px; font-size:16px; color:#03F; font-weight:bold;">
			Publicaciones recientes en <?php echo $feed->webTitle; ?>
        </div>
        <div id="feed"></div>
	</div>
    <div align="center" style="margin:20px 0 0 0;">
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
    <div align="center" style="margin:20px 0 0 0;">
    <a href="http://www.crservers.com.ar/" target="_blank">
  <img alt="CrServers Hosting" src="http://s164.photobucket.com/albums/u17/tipitapaenlinea/crserversbanner.jpg" style="border:none;" />
</a>
    </div>
<script type="text/javascript" src="a/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#make").bind("click",function(){
		if($("#url").val()=="") { $("#r").html('Escriba una direccion URL'); return false; }
		$("#loading").show();
		$.ajax({
			type: "GET",
			url: "a/widget/wg_short/wg_short.php",
			data: "u="+$("#url").val(),
			success:function(r)
				{
				$("#loading").hide();
				$("#r").html(r);
				}
		});
	});
});
</script>
<script type="text/javascript">
   var infolink_pid = 83479;
   var infolink_wsid = 0;
</script>
<script type="text/javascript" src="http://resources.infolinks.com/js/infolinks_main.js"></script>
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
