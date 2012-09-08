<?php
include("php/load.php");
wg_header("Salir");
wg_main();
if(isset($_SESSION['userSession']))
	{
	session_unset($_SESSION['userSession']);
	$show->notify(1,"Exito!","Su session ha finalizado con exito.");
	}
	else
		{
		$show->notify(0,"Session inexistente","No ha iniciado session.<br />Dirijase al menu acceder para iniciar session.");
		}
wg_footer();
?>