	<?php
	require("/home/marlodam/config.php");
	/* ALUSTAN SESSIOONI */
	session_start();
		
	/* ÜHENDUS */
	$database = "if16_health_diary";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
?>