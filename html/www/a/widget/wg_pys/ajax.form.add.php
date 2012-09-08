<div style="padding:10px;">
	<div id="loadBoxing" style="border:1px solid #CCC; margin:2px; padding:2px; display:none;"></div>
	<div><strong>Titulo:</strong></div>
	<div>
   	  <input name="t_title" id="t_title" type="text" style="width:400px;" />
    </div>
    <div><strong>Contenido:</strong></div>
    <div>
    	<textarea name="t_text" rows="5" id="t_text" style="width:400px;"></textarea>
  </div>
    <div>
    	<input type="button" id="addTopicNow" name="addTopicNow" value="Agregar" />
        <input type="button" id="CancelTopicNow" name="CancelTopicNow" value="Cancelar" />
    </div>
    <div align="left">
    	<ul>
        	<li>No HTML, BBCODE, JavaScript</li>
            <li>No escriba todo un parrafo en may&uacute;usculas</li>
            <li>Escriba las palabras completas (q->que)</li>
    	</ul>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#addTopicNow").bind("click",function() {
		var tt = $("#t_title").val();
		var tx = $("#t_text").val();
		if(tt=="") { $("#loadBoxing").show().html('Escriba un titulo'); $("#t_title").focus(); return false; }
		if(tx=="") { $("#loadBoxing").show().html('Escriba el contenido'); $("#t_text").focus(); return false; }
		$("#loadBoxing").show().html('Guardando...');
		$(this).val('Guardando...').attr("disabled","disabled");
		$.ajax({
			type: "POST",
			url: "widget/wg_pys/wg_pys_function.php?a=addtopic",
			data: "pysTitle="+tt+"&pysText="+tx,
			success: function(rs)
				{
				var r = rs.split("---");
				if(r[0].valueOf()=="Agregado")
					{
					$("#loadBoxing").show().html('<a href="./preguntas_y_sugerencias.php?i='+r[1]+'">Ver el tema publicado</a>');
					$("#t_title").val("");
					$("#t_text").val("");
					}
					else
						{
						$("#loadBoxing").show().html(r[0]);
						$(this).val('Agregar').attr("disabled","");
						}
				}
		});
	});
	
	$("#CancelTopicNow").bind("click",function() {
		$.unblockUI();
	});
});
</script>