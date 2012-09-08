<?php
include("php/load.php");
wg_header("Preguntas y Sugerencias");
wg_main();
if(isset($_GET['i'])){if(!empty($_GET['i'])){$i=$_GET['i'];} else {$i=0;}} else {$i=0;}
wg_pys($i);
wg_footer();
?>