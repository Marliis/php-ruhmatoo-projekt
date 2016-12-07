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
	
	$date = "";
	$dateError = "";
	$weight = "";
	$weightError = "";
	$height = "";
	$heightError = "";
	$training = "";
	$trainingError = "";
	$food = "";
	$foodError = "";
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
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
		
		$Person->save($Helper->cleanInput($Helper->cleanInput($_POST["date"]), $_POST["weight"]), $Helper->cleanInput($_POST["height"]), $Helper->cleanInput($_POST["training"]), $Helper->cleanInput($_POST["food"]));
		
	}
	
			
	
	
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
					
		<p class="addFood">
		<a data-label="Lisa söögikord" onclick="trackgavent($(this));
		return false;"
		href="addFood.php? lang=1">Lisa söögikord</a>
		</p>
			
		<p class="addTraining">
		<a data-label="Lisa treening" onclick="trackgavent($(this));
		return false;"
		href="addTraining.php? lang=1">Lisa treening</a>
		</p>
		
		<input type="submit" value="Salvesta">
</form>


<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php");?>