<?php
function wg_main()
	{
	$logged=0;
	$p_ip = new p_ip;
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	$login = new login;
	if($login->logged())
		{
		$logged=1;
		}
		else
			{
			$logged=0;
			}
	$query=$db->get_results("SELECT * FROM menu WHERE menuViewer=".$logged."
							AND menuRange IN (".$login->myinfo("userRange").")
							 ORDER BY menuOrden ASC");
	if($db->num_rows>0)
		{
?>
<div class="wg_main_container">
<div class="wg_main_button"><a href="#"><?php echo $p_ip->myIp(); ?></a></div>
<?php
		foreach($query as $menu)
			{
			$menu->menuName == "Salir" ? $className = "wg_main_button_salir" : $className = "wg_main_button";
?>
			<div class="<?php echo $className; ?>"><a href="<?php echo $menu->menuPermalink; ?>" target="_self"><?php echo $menu->menuName; ?></a></div>
<?php
					
			}
?>
</div>
<div id="auxiliar">
</div>
<?php
if($login->logged())
	{
	$tip = $db->get_var("SELECT tipText FROM `tips`ORDER BY RAND() LIMIT 1");
?>
<div id="tips"><?php echo $tip; ?></div>
<?php
	}
		}
	}
?>