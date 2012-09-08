<?php
function wg_my_sites()
	{
	$login = new login;
	$login->requirelogin();
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	$q=$db->get_results("SELECT * FROM web WHERE userId='".$_SESSION['userSession']."'");
	if($db->num_rows>0)
		{
?>
<div class="wg_my_sites_container">
<script type="text/javascript">
function editme(id,title,url,feed)
		{
		$.ajax({
			type: "POST",
			url: "widget/wg_my_sites/ajax.form.edit.php",
			data: "webId="+id+"&webTitle="+title+"&webUrl="+url+"&webFeed="+feed,
			success: function(r)
				{
				$.blockUI({ message: r }); 
				}
		});
		}
		
		
function deleteme(id)
		{
		//version 0.0000000000000000000000000000000001.. porque no tengo la estructura de las tablas y me da pereza abirir los archivos xDDDDDDDDDDDDDDDDDDDDD
		
		$.ajax({
			type: "POST",
			url: "widget/wg_my_sites/wg_my_sites_function.php?a=delete",
			data: "webId="+id,
			success: function(r)
				{
				//$.blockUI({ message: r }); 
				location.reload();
				}
		});
		
		}		
</script>
<?php
		foreach($q as $web)
			{
?>
	<div class="p_tr">
    	<div class="wg_my_sites_status"><img src="widget/wg_my_sites/<?php echo $web->webStatus; ?>.png" width="16" height="16" alt="Status" /></div>
     	<div class="wg_my_sites_name"><strong><?php echo $web->webTitle; ?></strong> <span>(<?php echo $web->webUrl; ?>) | <span>(<?php echo $web->webFeed; ?>)</span></div>
    	<div class="wg_my_sites_delete" id="eliminar"><a href="#" onclick="deleteme(<?php echo $web->webId; ?>); return false;">Eliminar</a></div>
        <div class="wg_my_sites_edit"><a href="#"  onclick="editme(<?php echo $web->webId; ?>,'<?php echo $web->webTitle; ?>','<?php echo $web->webUrl; ?>','<?php echo $web->webFeed; ?>'); return false;">Editar</a></div>
    </div>
<?php
			}
?>
</div>
<?php
		}
?>
<div class="wg_my_sites_container_add">
	<div>
    	<h3>Nombre del sitio</h3>
    	<input name="webTitle" id="webTitle" type="text" />
    </div>
    <div>
    	<h3>Url (incluir http://)</h3>
    	<input name="webUrl" id="webUrl" type="text" />
    </div>
    <div>
    	<h3>Url Feed RSS (incluir http://)</h3>
    	<input name="webFeed" id="webFeed" type="text" />
    </div>
</div>
<div class="wg_my_sites_buttom_main">
	<input class="p_button" name="addNew" id="addNew" type="button" value="Agregar" />
	<input class="p_button" name="add" id="add" type="button" value="Agregar nuevo sitio" />
</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#add").click(function(){
		if($(".wg_my_sites_container_add").is(":hidden"))
			{
			$(this).val("Cancelar");
			$("#addNew").show();
			$(".wg_my_sites_container_add").show();
			}
			else
				{
				$(this).val("Agregar nuevo sitio");
				$(".wg_my_sites_container_add").hide();
				$("#addNew").hide();
				}
	});
	
	$("#addNew").click(function(){
		if($("#webTitle").val()=="") { show.error('Escriba un nombre para el sitio web.',6000); $("#webTitle").focus(); return false; }
		if($("#webUrl").val()=="") { show.error('Escriba una url para el sitio web.',6000); $("#webUrl").focus(); return false; }
		if(!polin.isUrl($("#webUrl").val())) { show.error('Al parecer la url del sitio no es valida, recuerde anteponer http://',6000); $("#webUrl").focus(); return false;  }
		if($("#webFeed").val().length>0) 
			{ 
			if(!polin.isUrl($("#webFeed").val()))
				{
				show.error('Al parecer la url de las feed RSS no es valida, recuerde anteponer \n Deje el campo vacio si no desea agregar url de feed RSS',6000); $("#webFeed").focus(); return false; 
				}
			}
		$("#addNew").attr("disabled","disabled").val("Guardando...");
		$.ajax({
			type: "POST",
			url: "widget/wg_my_sites/wg_my_sites_function.php?a=add",
			data: "webId=0&webTitle="+$("#webTitle").val()+"&webUrl="+$("#webUrl").val()+"&webFeed="+$("#webFeed").val(),
			success:function(r)
				{
				if(r.valueOf()=="Agregado")
					{
					location.reload();
					}
					else
						{
						$("#addNew").attr("disabled","").val("Agregar");
						show.error(r,6000);
						}
				}
		});
	});
});
</script>
<?php
	}
?>