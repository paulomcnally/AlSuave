<?php
function wg_friend()
	{
	$login = new login;
	$login->requirelogin();
	?>
    <div align="center" style="margin:30px;">
    Coloca el siguiente c&oacute;digo en tu p&aacute;gina web para que aparezcan los enlaces de las web amigas.
    </div>
    <div align="center">
<textarea name="code" id="code" style="width:80%; height:400px;" readonly="readonly">
<div id="_as_load"></div>
<script type="text/javascript" src="http://alsuave.info/alsuave.js"></script>
<script type="text/javascript">
//Configuracion
var _as_cantidad_de_enlaces = 10;
var _as_mi_api_key = <?php echo $_SESSION['userSession']; ?>;
// Apariencia
var _as_iframe_ancho = 300;
var _as_iframe_alto = 160;
var _as_iframe_border = 1;
var _as_iframe_borderStyle = "solid";
var _as_iframe_borderColor = "CCCCCC";
var _as_body_font_size = 12;
var _as_body_font_family = "Arial";
var _as_a_color = "FF0000";
var _as_body_background = "FFFFFF";
// Inicia la carga de la pagina con los enlaces amigos
alsuave._iframe('_as_load',_as_mi_api_key,_as_cantidad_de_enlaces,_as_iframe_ancho,_as_iframe_alto,_as_iframe_border,_as_iframe_borderStyle,_as_iframe_borderColor,_as_body_font_size,_as_body_font_family,_as_body_background,_as_a_color);
// www.alsuave.info
</script>
</textarea>
    </div>
    <?php
	}
?>