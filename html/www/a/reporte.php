<?php
include("php/load.php");
wg_header("Reporte");
wg_main();
if(isset($_GET['get']) & !empty($_GET['get']))
	{
	$fecha = $_GET['get'];
	}
	else
		{
		$fecha = date("Y-m-d");
		}
		
wg_report($fecha);
wg_footer();
?>