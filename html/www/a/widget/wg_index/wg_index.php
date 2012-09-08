<?php
function wg_index()
	{
	$login = new login;
	$login->requirelogin();
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
?>
<div class="wg_my_sites_container">
<div align="center" style="border-bottom:1px solid #CCC; background:#A7F5FE; font-size:18px; padding:10px 0;">
	Conversemos un rato
</div>
<div align="center" style=" width:90%; margin:0 auto 0 auto;">
<object width="250" height="400" id="obj_1278048883534"><param name="movie" value="http://alsuavechat.chatango.com/group"/><param name="AllowScriptAccess" VALUE="always"/><param name="AllowNetworking" VALUE="all"/><param name="AllowFullScreen" VALUE="true"/><param name="flashvars" value="cid=1278048883534&b=100&d=0033FF&k=0099FF&l=999999&r=80&s=1"/><embed id="emb_1278048883534" src="http://alsuavechat.chatango.com/group" width="250" height="400" allowScriptAccess="always" allowNetworking="all" type="application/x-shockwave-flash" allowFullScreen="true" flashvars="cid=1278048883534&b=100&d=0033FF&k=0099FF&l=999999&r=80&s=1"></embed></object><br>[ <a href="http://alsuavechat.chatango.com/clonegroup?ts=1278048883534">Copy this</a> | <a href="http://chatango.com/creategroup?ts=1278048883534">Start New</a> | <a href="http://alsuavechat.chatango.com">Full Size</a> ]
</div>
<div align="center" style="border-bottom:1px solid #CCC; background:#A7F5FE; font-size:18px; padding:10px 0;">
	Los m&aacute;s activos
</div>
<div align="center" style=" width:90%; margin:0 auto 0 auto;">
<?php
$clickers = $db->get_results("SELECT count(1) as Total, U.userName as Name, (SELECT webUrl FROM web WHERE userId = C.userId LIMIT 1) as Web FROM click C, user U
WHERE C.userId = U.userId
GROUP BY C.userId ORDER BY count(1) DESC LIMIT 10");
if($db->num_rows>0)
	{
	?>
    <table style="border:1px solid #0CF; margin-top:10px; width:600px;" cellpadding="2px">
    	<thead>
        	<tr style="background:#06F; color:#FFF; font-weight:bold; text-align:center;">
            	<td>Cantidad</td>
                <td>Usuario</td>
                <td>Web (Vis&iacute;talo se lo merece)</td>
            </tr>
        </thead>
        <tbody>
    <?php
	foreach($clickers as $clicker)
		{
		if(strlen($clicker->Web) > 0)
			{
			$web = "<a href='http://www.alsuave.info/go/?u=".$clicker->Web."' target='_blank'>".$clicker->Web."</a>";
			}
			else
				{
				$web = "Aun sin web el nos aporta! Sigue el ejemplo!";
				}
		?>
        	<tr>
            	<td><?php echo $clicker->Total; ?></td>
                <td><?php echo $clicker->Name; ?></td>
                <td><?php echo $web; ?></td>
            </tr>
		<?php
		}
	?>
    	</tbody>
   	</table>
    <?php
	}
?>
</div>

<div align="center" style="border-bottom:1px solid #CCC; border-top:1px solid #CCC; background:#A7F5FE; font-size:18px; padding:10px 0; margin-top:10px;">
	Los temas m&aacute;s recientes en <a href="http://www.alsuave.info/a/preguntas_y_sugerencias.php">Preguntas y Respuestas</a>
</div>
<?php
	$topics = $db->get_results("SELECT P.pysId as Id,P.pysTitle as Title, DATE_FORMAT(P.pysDateTime ,'%d/%m/%Y') as Fecha, U.userName as Name
FROM pys P, user U
WHERE P.userId = U.userId
ORDER BY P.pysId DESC LIMIT 5");
	if($db->num_rows>0)
		{
		foreach ($topics as $topic)
			{
		?>
        <div class="p_tr" style="margin:0 10px;"> <a href="preguntas_y_sugerencias.php?i=<?php echo $topic->Id; ?>"><?php echo $topic->Title; ?>.</a> Escr&iacute;to por: <?php echo $topic->Name; ?> en <?php echo $topic->Fecha; ?></div>
        <?php
			}
		}
	}
?>