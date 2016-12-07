<?php 
	
	require("../functions.php");
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
			$date =  new DateTime($_POST['date']);
			$date =  $date->format('Y-m-d');
	
?>
<h1>Kasutaja andmed</h1>
<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi välja</a>
</p>

<form method = "POST"> 

		<label><h3>Tänane kuupäev</h3></label>
		<input name="date" type="date" value="<?=$date;?>"><?php echo $dateError;?>
		<br><br>
		
</form>


<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php"); ?>