<?php 
	require("functions.php");
	
	// RÜHMATÖÖ
	// kas on sisseloginud, kui ei ole siis
	// suunata login lehele
	if (!isset ($_SESSION["userId"])) {
		
		header("Location: login.php");
	}
	
	//kas logout on aadressireal?
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
	
	}
?>

<h1>Andmete sisestamine</h1>
<?=$msg;?>
<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi välja</a>
</p>