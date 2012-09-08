<?php
if(isset($_GET['a']) && !empty($_GET['a']))
	{
	session_start();
	include("../../php/class.ezSQL.php");
	if(isset($_POST['bloqueoIp']) && !empty($_POST['bloqueoIp'])) { $bloqueoIp=$db->escape($_POST['bloqueoIp']); }
	else { die("Error al recibir la IP"); }
	if($r=$db->query("SELECT bloqueoId FROM bloqueo WHERE bloqueoIp='".$bloqueoIp."' and userId='".$_SESSION['userSession']."'"))
		{
		die("La ip ".$bloqueoIp." ya ha sido registrada!");
		}
		else
			{
			$db->query("INSERT INTO bloqueo (bloqueoId,bloqueoIp,userId) VALUES(NULL,'".$bloqueoIp."','".$_SESSION['userSession']."')");
			die('Agregado');
			}
	}
function wg_locked()
	{
	$login = new login;
	$login->requirelogin();
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	$q=$db->get_results("SELECT * FROM bloqueo WHERE userId='".$_SESSION['userSession']."'");
	if($db->num_rows>0)
		{
?>
<div class="wg_locked_container">
<?php
		foreach($q as $ip)
			{
?>
	<div class="p_tr">
    	<div class="wg_locked_td"><?php echo $ip->bloqueoIp; ?></div>
    </div>
<?php
			}
?>
	
</div>
<?php
		}
?>
<div>
	<div class="wg_locked_td">
		<input type="text" name="bloqueoIp" id="bloqueoIp"  />
        <input class="p_button" type="button" name="add" id="add" value="Agregar" />
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#add").click(function(){

		if($("#bloqueoIp").val()=="") { show.error('Escriba una direcci&oacute;n IP.',6000); $("#bloqueoIp").focus(); return false; }
		if( !polin.isIp( $("#bloqueoIp").val() ) ) { show.error('Escriba una direcci&oacute;n IP valida.',6000); $("#bloqueoIp").focus(); return false; }
		$(this).attr("disabled","disabled").val("Guardando...");
		$.ajax({
			type: "POST",
			url: "widget/wg_locked/wg_locked.php?a=add",
			data: "bloqueoIp="+$("#bloqueoIp").val(),
			success:function(r)
				{
				if(r.valueOf()=="Agregado")
					{
					location.reload();
					}
					else
						{
						$("#add").attr("disabled","").val("Agregar");
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