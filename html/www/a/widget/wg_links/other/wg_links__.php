<?php
function wg_links()
	{
	$hoy = date("Y-m-d");
	$d1 = date("Y-m-d",strtotime("$hoy - 1 day"));
	$d2 = date("Y-m-d",strtotime("$hoy - 2 day"));
	$d3 = date("Y-m-d",strtotime("$hoy - 3 day"));
	$p_ip = new p_ip;
	$login = new login;
	$login->requirelogin();
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	$q=$db->get_results("SELECT WW.webId AS webId, WW.webTitle AS webTitle, WW.webUrl AS webUrl, UU.userName AS userName FROM web WW, user UU
WHERE WW.webId NOT IN (SELECT webId FROM click
WHERE userId=".$_SESSION['userSession']."
AND SUBSTRING(clickDateTime,1,10) IN ('".$hoy."','".$d1."','".$d2."','".$d3."')
GROUP BY webId
ORDER BY clickDateTime DESC)
AND WW.webTitle<>'Disculpen por el error'
AND WW.userId<>".$_SESSION['userSession']."
AND WW.userId=UU.userId
AND WW.webStatus = 1
GROUP BY WW.userId
ORDER BY RAND()");
	
	if($db->num_rows>0)
		{
?>
<script type="text/javascript">
	function addClick(id)
		{
		$("#link_"+id).html('Creando enlace remoto...');
			$.ajax({
				type: "POST",
				url: "widget/wg_links/wg_links_click.php",
				data: "webId="+id,
				success:function(r)
					{
					var rs = r.split('---');
					if(rs[0].valueOf()=="Agregado")
						{
						$("#link_"+id).html('<a href="'+rs[1]+'" target="_blank">'+rs[1]+'</a>');
						}
						else
							{
							show.error(r,6000);
							$("#link_"+id).html('Error. Refresque la pagina!');
							}
					}
			});
		}
	function disable(id)
		{
		$("#linkd_"+id).html('Cancelando...');
		$.ajax({
				type: "POST",
				url: "widget/wg_links/wg_links_delete.php",
				data: "webId="+id,
				success:function(r)
					{
					if(r.valueOf()=="Cancelado")
						{
						$("#linkd_"+id).html('Cancelado!');
						}
						else
							{
							show.error(r,6000);
							$("#linkd_"+id).html('Error cancelando el sitio');
							}
					}
			});
		}
</script>
<div class="wg_my_sites_container">
<?php
		$rango = array();
		array_push($rango,$login->myinfo("userRange"));
		foreach($q as $link)
			{
?>
	<div class="p_tr">
        <div class="wg_links_name"><?php echo $link->userName; ?></div>
        <div class="wg_links_title"><?php echo $link->webTitle; ?></div>
        <div class="wg_links_url" id="link_<?php echo $link->webId; ?>"><a onclick="addClick(<?php echo $link->webId; ?>); return false;" href="#">Generar enlace</a></div>
        <?php if(in_array(1,$rango)) { ?>
      	<div class="wg_links_edit" id="linkd_<?php echo $link->webId; ?>"><a onclick="disable(<?php echo $link->webId; ?>); return false;" href="#">Cancelar</a></div>
        <?php } ?>
    </div>
<?php
			}
?>
</div>
<?php
		}
		else
			{
			$clickDateTime = $db->get_var("SELECT C.clickDateTime as clickDateTime FROM click C, log L
										  WHERE L.logId = C.logId
										  AND L.logIp = '".$p_ip->myIp()."'
										  ORDER BY C.clickDateTime DESC LIMIT 1");
?>
			<div style="margin-top:20px; text-align:center;">
            	<span>
            	No tiene enlaces disponibles, intenta acceder con otra IP.
                La IP: <strong><?php echo $p_ip->myIp(); ?></strong> ya tiene un registro: <strong><?php echo $clickDateTime; ?></strong>. Esta IP tendra enlaces disponibles hasta: <strong><?php echo date("Y-m-d",strtotime("$clickDateTime + 4 day")); ?></strong>
				</span>
            </div>
<?php
			}
	}
?>