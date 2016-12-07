<?php 
	
	require("../functions.php");
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Athlete.class.php");
	$Athlete = new Athlete($mysqli);

	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
	//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	
	if (isset($_POST["TypeOfTraining"]) && 
		isset($_POST["WorkoutHours"]) &&
		isset($_POST["Kilometers"]) && 
 		isset($_POST["feeling"]) && 
 		isset($_POST["comment"]) && 
		!empty($_POST["TypeOfTraining"]) && 
		!empty($_POST["WorkoutHours"]) && 
		!empty($_POST["Kilometers"]) && 
		!empty($_POST["feeling"]) && 
		!empty($_POST["comment"]) 
	  ) {
		 
		$Athlete->saveAthlete($Helper->cleanInput($_POST["TypeOfTraining"]), $Helper->cleanInput($_POST["WorkoutHours"]), $Helper->cleanInput($_POST["Kilometers"]), $Helper->cleanInput($_POST["feeling"]), $Helper->cleanInput($_POST["comment"]));
		
	}


?>
<h1>Treeningu andmete sisestamine.</h1>
<?=$msg;?>
<p>
	Tere tulemast <a href="addTraining.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi välja</a>
</p>



<h1>Salvesta treeningu andmed</h1>
<form method="POST">
			
	<label><h3>Treeningu laad</h3></label>
	<select name="TypeOfTraining"> 
	<option value="Vali sobiv">Vali sobiv</option>
	<option value="Jalgpall">Jalgpall</option>
	<option value="Jalgrattasõit">Jalgrattasõit</option>
	<option value="Jooksmine">Jooksmine</option>
	<option value="Kepikõnd">Kepikõnd</option>
	<option value="Korvpall">Korvpall</option>
	<option value="Käimine">Käimine</option>
	<option value="Rulluisutamine">Rulluisutamine</option>
	<option value="Suusatamine">Suusatamine</option>
	<option value="Tennis">Tennis</option>
	<option value="Uisutamine">Uisutamine</option>
	<option value="Ujumine">Ujumine</option>
	<option value="Võrkpall">Võrkpall</option> </select>
	
	<br><br>
	<label><h3>Treeningu kestvus</h3></label>
	<input name="WorkoutHours" type="WorkoutHours" placeholder="Sisesta tunnid">
	
	<br><br>
	<label><h3>Läbitud kilomeetrid</h3></label>
	<input name="Kilometers" type="Kilometers" placeholder="Sisesta kilomeetrid">
	
	<br><br>
	<label><h3>Enesetunne</h3></label>
	<select name="Enesetunne"> 
	<option value="Vali sobiv">Vali sobiv</option>
	<option value="Suurepärane">Suurepärane</option>
	<option value="Hea">Hea</option>
	<option value="Keskmine">Keskmine</option>
	<option value="Rahuldav">Rahuldav</option>
	<option value="Halb">Halb</option> </select>
	
	<br><br>
	<label><h3>Kommentaar</h3></label>
	<input name="comment" type="comment" placeholder="Lisa kommentaar">
	
	<br><br>
	<input type="submit" value="Salvesta">
	
</form>
<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php"); ?>