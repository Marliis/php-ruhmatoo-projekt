<?php 
	
	require("../functions.php");
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Athlete.class.php");
	$Athlete = new Athlete($mysqli);
	
	$error = "";

	
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
<?php require("../header.php"); ?>

	<div class="container">
	
		<div class="row">
		
			<div class="col-sm-9">
			<br>
			<?=$msg;?>
			<p>
				<a href="addTraining.php"><?=$_SESSION["userEmail"];?></a>
			</p>
			
			<h1>Salvesta treeningu andmed</h1>
			
		<form method="POST">
		
			<p style="color:red;"><?=$error;?></p>
			<label>Treeningu laad</label><br>
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
			<label>Treeningu kestvus</label><br>
			<input name="WorkoutHours" type="WorkoutHours" placeholder="Sisesta tunnid">
			
			<br><br>
			<label>Läbitud kilomeetrid</label><br>
			<input name="Kilometers" type="Kilometers" placeholder="Sisesta kilomeetrid">
			
			<br><br>
			<label>Enesetunne</label><br>
			<select name="Enesetunne"> 
			<option value="Vali sobiv">Vali sobiv</option>
			<option value="Suurepärane">Suurepärane</option>
			<option value="Hea">Hea</option>
			<option value="Keskmine">Keskmine</option>
			<option value="Rahuldav">Rahuldav</option>
			<option value="Halb">Halb</option> </select>
			
			<br><br>
			<label>Kommentaar</label><br>
			<input name="comment" type="comment" placeholder="Lisa kommentaar">
			
			<br><br>
			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Salvesta">

		</form>	
		</div>
<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php");?>