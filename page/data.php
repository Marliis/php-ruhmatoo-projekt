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
	
	if( isset($_POST["date"]) &&
		isset($_POST["weight"]) &&
		isset($_POST["height"]) &&
		isset($_POST["training"]) &&
		isset($_POST["food"]) &&
		!empty($_POST["dateError"]) &&
		!empty($_POST["weightError"]) &&
		!empty($_POST["heightError"]) &&
		!empty($_POST["trainingError"]) &&
		!empty($_POST["foodError"])
	){
			
	$date = "";
	$dateError = "";
	
			$date =  new DateTime($_POST['date']);
			$date =  $date->format('Y-m-d');
	
?>
<h1>Kasutaja andmed</h1>
<p>
	Tere tulemast <a href="user.php">!</a>
	<a href="?logout=1">Logi välja</a>
</p>

<form method = "POST"> 

		<label><h3>Tänane kuupäev</h3></label>
		<input name="date" type="date" value="<?=$date;?>"><?php echo $dateError;?>
		<br><br>
		
		<label>Sisesta kaal</label><br>
		<input name="weight" type="weight" value="<?=$weight;?>"><?php echo $weightError;?>
		<br><br>
		
		<label>Sisesta pikkus</label><br>
		<input name="height" type="height" value="<?=$height;?>"><?php echo $heightError;?>
		<br><br>
		
		<label>Lisa treening</label><br>
		<input name="training" type="training" value="<?=$training;?>"><?php echo $trainingError;?>
		<br><br>
		
		<label>Lisa söögikord</label><br>
		<input name="food" type="food" value="<?=$food;?>"><?php echo $foodError;?>
		<br><br>
		
		<input type="submit" value="Salvesta">
</form>


<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php");?>