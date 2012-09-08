<?php
include("../php/load.php");
if(isset($_POST['u']) and !empty($_POST['u'])) { $u=$_POST['u']; } else { die("User"); }
if(isset($_POST['p']) and !empty($_POST['p'])) { $p=$_POST['p']; } else { die("Password"); }
if($login->logear($u,$p))
	{
	echo "Bienvenido";
	}
	else
		{
		echo "Datos incorrectos";
		} 

?>