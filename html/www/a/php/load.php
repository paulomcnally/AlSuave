<?php
	/*
	 * This File load all structure from the web site
	 */
	 
	define("EZSQL_DB_USER", "");			// <-- mysql db user
	define("EZSQL_DB_PASSWORD", "");		// <-- mysql db password
	define("EZSQL_DB_NAME", "");		// <-- mysql db pname
	define("EZSQL_DB_HOST", "");	// <-- mysql server host
	 
	include("class.ezSQL.php");				// MySQL 
	include("class.ip.php");				// IP
	include("class.login.php");				// User, Session
	include("class.style.php");				// Style Web
	include("class.show.php");				// Show notification
	include("class.pmail.php");				// Send Mails
	include("widget/load.php");				// Style Web
?>