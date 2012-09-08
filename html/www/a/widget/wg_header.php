<?php
session_start();
$rdn = rand(3,999);
function wg_header($title)
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<script type="text/javascript" src="js/jquery.js?<?php echo $rdn; ?>"></script>
<script type="text/javascript" src="js/jquery.hotkeys.js?<?php echo $rdn; ?>"></script>
<script type="text/javascript" src="js/show.min.js?<?php echo $rdn; ?>"></script>
<script type="text/javascript" src="js/polin.js?<?php echo $rdn; ?>"></script>
<script type="text/javascript" src="js/jquery.flot.min.js?<?php echo $rdn; ?>"></script>
<script type="text/javascript" src="js/jquery.blockUI.js?<?php echo $rdn; ?>"></script>
<link type="text/css" href="css/style.css?<?php echo $rdn; ?>" rel="stylesheet" />
<link type="text/css" href="css/widget.css?<?php echo $rdn; ?>" rel="stylesheet" />
</head>
<body>
<?php
	}
?>