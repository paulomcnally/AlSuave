<?php
function wg_admin_user_list($p)
	{
	$login = new login;
	$login->requirelogin();
	$r = 5; 
	if (!$p) { $i = 0; $p = 1; } else { $i = ($p - 1) * $r; } 
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	$tr=$db->get_var("SELECT count(1) FROM user");
	$q=$db->get_results("SELECT * FROM user ORDER BY userId DESC LIMIT ".$i.",".$r."");
	$tp=ceil($tr / $r);
	if($db-num_rows>0)
		{
?>
<table class="p_table" cellpadding="1" cellspacing="0" border="0">
	<thead>
	<tr>
    	<td>
        	Nombre
        </td>
        <td>
        	Correo
        </td>
        <td>
        	Fecha
        </td>
    </tr>
    </thead>
<?php
		foreach($q as $row)
			{
?>
	<tr>
    	<td>
        	<?php echo $row->userName; ?>
        </td>
        <td>
        	<?php echo $row->userEmail; ?>
        </td>
        <td>
        	<?php echo $row->userDate; ?>
        </td>
    </tr>
<?php
			}
?>
</table>
<?php
		}
	}
?>

<?php
function wg_admin_click()
	{
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	$q=$db->get_results("SELECT U.userName as userName, W.webTitle as webTitle, C.clickDateTime as clickDateTime
						FROM click C, user U, web W
						WHERE YEAR(C.clickDateTime)=YEAR(NOW())
						AND MONTH(C.clickDateTime)=MONTH(NOW())
						AND DAY(C.clickDateTime)=DAY(NOW())
						AND C.webId 
						IN(SELECT webId FROM web WHERE userId='".$_SESSION['userSession']."' AND webStatus=1)
						AND C.userId=U.userId
						AND C.webId=W.webId");
	if($db-num_rows>0)
		{
?>
<table class="p_table" cellpadding="1" cellspacing="0" border="0">
	<thead>
	<tr>
    	<td>
        	Usuario
        </td>
        <td>
        	Web
        </td>
        <td>
        	Fecha
        </td>
    </tr>
    </thead>
<?php
		foreach($q as $row)
			{
?>
	<tr>
    	<td>
        	<?php echo $row->userName; ?>
        </td>
        <td>
        	<?php echo $row->webTitle; ?>
        </td>
        <td>
        	<?php echo $row->clickDateTime; ?>
        </td>
    </tr>
<?php
			}
?>
</table>
<?php
		}
	}
function user_counter()
	{
	global $db;
	$all=$db->get_var("select count(1) as total from `user`");

	$q=$db->query("SELECT COUNT(1) FROM web WHERE webStatus=1 GROUP BY userId");
	$witchweb=$db->num_rows;
	$hoy=$db->get_var("select count(1) from `user` WHERE year(userDate)=year(now()) and month(userDate)=month(now()) and day(userDate)=day(now())");
	?>
    <div>Usuarios: <?php echo $all; ?> | Webs: <?php echo $witchweb; ?> | Registrados hoy: <?php echo $hoy; ?></div>
    <?php
	}
?>