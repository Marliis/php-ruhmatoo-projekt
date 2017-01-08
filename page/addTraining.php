<?php 
	
	require("../functions.php");
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../class/Athlete.class.php");
	$Athlete = new Athlete($mysqli);

	require("../css.php");
	
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
	
	$TypeOfTraining = "";
	$WorkoutHours = "";
	$Kilometers = "";
	$feeling = "";
	$comment = "";
	$TypeOfTrainingError = "";
	$WorkoutHoursError = "";
	$KilometersError = "";
	$feelingError = "";
	$commentError = "";
	$error = "";
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	var_dump($_POST);
	if (isset($_POST["TypeOfTraining"]) && 
		isset($_POST["WorkoutHours"]) &&
		isset($_POST["Kilometers"]) && 
 		isset($_POST["feeling"]) && 
 		isset($_POST["comment"]) && 
		empty($TypeOfTraining) && 
		empty($WorkoutHours) && 
		empty($Kilometers) && 
		empty($feeling) && 
		empty($comment) 
	  ) {
		 
		$Athlete->saveAthlete($Helper->cleanInput($_POST["TypeOfTraining"]), $_POST["WorkoutHours"], ($_POST["Kilometers"]), $_POST["feeling"], ($_POST["comment"]));
		
	}
?>

<?php require("../header.php"); ?>

	<body class="addTraining_background" background="../add_checkTraining_page_2.jpeg">

	<div class="container">
	
		<div class="row">
		
			<div class="col-sm-9">
			<br>
			<?
			$msg;
			?>
			<p>
				<a href="addTraining.php"><?=$_SESSION["userEmail"];?></a>
			</p>
			<h3><a href="data.php"> < Mine tagasi</a></h3>
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
			<select name="feeling"> 
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