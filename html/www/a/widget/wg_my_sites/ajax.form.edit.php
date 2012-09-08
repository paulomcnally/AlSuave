<?php
if(isset($_POST['webId'])) { $webId = $_POST['webId']; }
if(isset($_POST['webTitle'])) { $webTitle = $_POST['webTitle']; }
if(isset($_POST['webUrl'])) { $webUrl = $_POST['webUrl']; } 
if(isset($_POST['webFeed'])) { $webFeed = $_POST['webFeed']; }
?>
<div style="padding:10px;">
	<div id="loadBoxing" style="border:1px solid #CCC; margin:2px; padding:2px; display:none;"></div>
	<div><strong>Titulo:</strong></div>
	<div>
   	 	<input name="webTitle_edit" id="webTitle_edit" type="text" style="width:400px;" value="<?php echo $webTitle; ?>" />
    </div>
    <div><strong>Url:</strong></div>
    <div>
    	<input name="webUrl_edit" id="webUrl_edit" type="text" style="width:400px;" value="<?php echo $webUrl; ?>" />
  	</div>
    <div><strong>Feed:</strong></div>
    <div>
    	<input name="webFeed_edit" id="webFeed_edit" type="text" style="width:400px;" value="<?php echo $webFeed; ?>" />
  	</div>
    <div>
    	<input type="button" id="edit" name="edit" value="Editar" />
        <input type="button" id="cancel" name="cancel" value="Cancelar" />
    </div>
    <div align="left">
    	<ul>
        	<li>Recuerde anteponer http://</li>
            <li>No registre la misma web con noticias diferentes, solo se acepta 1 web por dominio</li>
    	</ul>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
						   
	$("#edit").click(function() {
							  
		var webTitle = $("#webTitle_edit").val();
		var webUrl = $("#webUrl_edit").val();
		var webFeed = $("#webFeed_edit").val();
		var webId = <?php echo $webId; ?>;
	
		
		if(webTitle=="") { $("#loadBoxing").show().html('Escriba un nombre para el sitio web.'); $("#webTitle_edit").focus(); return false; }
		
		if(webUrl=="") { $("#loadBoxing").show().html('Escriba una url para el sitio web.'); $("#webUrl_edit").focus(); return false; }
		
		if(!polin.isUrl(webUrl)) { $("#loadBoxing").show().html('Al parecer la url del sitio no es valida, recuerde anteponer http://'); $("#webUrl_edit").focus(); return false; }
		
		
		$("#loadBoxing").show().html('Modificando...');
		
		$("#edit").val('Modificando...').attr("disabled","disabled");
		
		$.ajax({
			type: "POST",
			url: "widget/wg_my_sites/wg_my_sites_function.php?a=update",
			data: "webId="+webId+"&webTitle="+webTitle+"&webUrl="+webUrl+"&webFeed="+webFeed,
			success: function(rs)
				{
				if(rs.valueOf()=="Editado")
					{
					$("#loadBoxing").show().html('Espere mientras la pagina carga nuevamente.');
					location.reload();
					}
					else
						{
						$("#loadBoxing").show().html(rs);
						$("#edit").val('Editar').attr("disabled","");
						}
				}
		});
		});
	
	$("#cancel").click(function() {
		$.unblockUI();
	});
});
</script>