<?php 

	require("../functions.php");
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Person.class.php");
	$Person = new Person($mysqli);
	
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
	$error = "";
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	if( isset($_POST["date"]) &&
		isset($_POST["weight"]) &&
		isset($_POST["height"]) &&
		!empty($_POST["date"]) &&
		!empty($_POST["weight"]) &&
		!empty($_POST["height"])
	  ) {
//		echo "siin";
		
		$Person->save($Helper->cleanInput($_POST["date"]), $Helper->cleanInput($_POST["weight"]), $Helper->cleanInput($_POST["height"]));
	}
	
		$date =  new DateTime($_POST["date"]);
		$date =  $date->format("Y-m-d");
	
?>

<?php require("../header.php"); ?>

	<div class="container">
	
		<div class="row">
		
			<div class="col-sm-9">
			<h1>Sinu treening- ja toitumispäevik</h1>
			<p>
			Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?></a>, nüüd saad hakata oma andmeid sisestama!
			<a href="?logout=1">Logi välja</a>
			</p><br>
		
		<form method="POST">
			<p style="color:red;"><?=$error;?></p>
			<label>Tänane kuupäev</label><br>
			<input name="date" type="date" value="<?=$date;?>"><?php echo $dateError;?>
			<br><br>
		
			<label>Kehakaal</label><br>
			<input name="weight" type="weight" placeholder=kg value="<?=$weight;?>"><?php echo $weightError;?>
			<br><br>
		
			<label>Pikkus</label><br>
			<input name="height" type="height" placeholder=cm value="<?=$height;?>"><?php echo $heightError;?>
			<br><br>
			
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
			

			<input class="btn btn-success btn-sm hidden-xs" style = "background-color:blue" type="submit" value="Logi sisse">

			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Salvesta">


		</form>	
		</div>
<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php");?>