<?php
function wg_report($date)
	{
	$login = new login;
	$login->requirelogin();
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	$pag = $db->get_results("SELECT SUBSTRING(C.clickDateTime,1,10) AS clickDateTime FROM
						click C, user U, web W
						WHERE C.webId IN (SELECT webId FROM web WHERE userId='".$_SESSION['userSession']."')
						AND U.userId = C.userId
						AND W.webId = C.webId
						GROUP BY YEAR(C.clickDateTime),MONTH(C.clickDateTime),DAY(C.clickDateTime)
						ORDER BY C.clickId DESC
						LIMIT 7");
	$paginas = "";
	if($db->num_rows>0)
		{
		foreach($pag as $p)
			{
			$dia = date("D",strtotime($p->clickDateTime));
			$dia = str_replace("Mon","Lunes",$dia);
			$dia = str_replace("Thu","Martes",$dia);
			$dia = str_replace("Wed","Miercoles",$dia);
			$dia = str_replace("Tue","Jueves",$dia);
			$dia = str_replace("Fri","Viernes",$dia);
			$dia = str_replace("Sat","Sabado",$dia);
			$dia = str_replace("Sun","Domingo",$dia);
			$paginas.="<a href='reporte.php?get=".$p->clickDateTime."' target='_self'>".$dia."(".$p->clickDateTime.")</a> | ";
			}
		}
?>
<div align="center" style="padding:15px;"><?php echo $paginas; ?></div>
<?php	

	$q=$db->get_results("SELECT U.userName AS userName,W.webUrl AS webUrl, C.clickDateTime AS clickDateTime FROM
						click C, user U, web W
						WHERE C.webId IN (SELECT webId FROM web WHERE userId='1')
						AND YEAR(C.clickDateTime) = YEAR('".$date."')
						AND MONTH(C.clickDateTime) = MONTH('".$date."')
						AND DAY(C.clickDateTime) = DAY('".$date."')
						AND U.userId = C.userId
						AND W.webId = C.webId
						GROUP BY C.clickDateTime");
	if($db->num_rows>0)
		{
?>
<div class="wg_my_sites_container">
<div align="center" style="border-bottom:1px solid #CCC; background:#A7F5FE; font-size:18px; padding:10px 0;">
	Click de hoy <?php echo date("d/m/Y") . " (" . $db->num_rows . ")"; ?>
</div>
<?php
		foreach($q as $report)
			{
?>
	<div class="p_tr">
    	<div class="wg_links_name"><?php echo $report->userName; ?></div>
        <div class="wg_links_title"><?php echo $report->webUrl; ?></div>
        <div class="wg_links_title"><?php echo $report->clickDateTime; ?></div>
        
    </div>
<?php
			}
?>
</div>
<?php
		}
		else
			{
?>
			<div style="margin-top:20px; text-align:center;">
            	<span>
            	No hay registro de clicks hoy <?php echo date("d/m/Y"); ?>
				</span>
            </div>
<?php
			}
?>
<div align="center" style=" width:90%; margin:0 auto 0 auto;">
<div id="reportLoad" style="height:270px;"></div>
</div>
<?php
// Datos graficados
$hoy = date("Y-m-d",strtotime("+1 days"));
$inicio = date("Y-m-d",strtotime($hoy. " -10 days"));
$data=array();
$labels=array();
$maxvalue=10;
$total=0;
for ($i=0;$i<10;$i++)
	{
	$current=$inicio;
	if($i>0)
		{
		$current=date("Y-m-d",strtotime($current." +$i day"));
		}
	$totales=$db->get_var("SELECT count(1) as total FROM click
						WHERE YEAR(clickDateTime) = '".date("Y",strtotime($current))."'
						AND MONTH(clickDateTime) = '".date("m",strtotime($current))."'
						AND DAY(clickDateTime) = '".date("d",strtotime($current))."'
						AND webId IN (SELECT W.webId FROM web W WHERE W.userId='".$_SESSION['userSession']."' )
						");
	if($totales==0)
		{
		array_push($data,$i.',0');
		array_push($labels,$i.',"'.date("d-M",strtotime($current)).'"');
		}
		else
			{
			array_push($data,$i.','.$totales);
			array_push($labels,$i.',"'.date("d-M",strtotime($current)).'"');
			$total=$total+$totales;
			if($maxvalue<$row["total"])
				{
				$maxvalue=$row["total"];
				}
			}
	}
$maxvalue=$maxvalue+10;
$data=join("],[",$data);
$data="[".$data."]";
$labels=join("],[",$labels);
$labels="[".$labels."]";
$total=number_format($total,2,".",",");
?>
<script type="text/javascript">
var info = {
			data:[<?php echo $data; ?>],
			color:"#2F84FF",
			shadowSize:4
				}
var options={
	yaxis:		{
				max: <?php echo $maxvalue; ?>
				},
	xaxis:		{
				ticks: [<?php echo $labels; ?>]
				},
	lines:		{
				show: true,
				lineWidth:2,
				fill:true,
				fillColor:"#CFE3FF"
				},
	points:		{
				show: true,
				radius:3,
				lineWidth:0,
				fillColor:"#2F84FF"
				},
	grid:		{
				borderWidth:0,
				autoHighlight:true
				}
			}
	$.plot($("#reportLoad"), [ info ], options);
</script>
<?php
	}
?>