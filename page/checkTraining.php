	<?php 
	
	require("../functions.php");
	
	require("../class/Results.class.php");
	$Results = new Food($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	
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
?>

<?php require("../header.php"); ?>

	<div class="container">
	
		<div class="row">
			<div class="col-sm-9">
				<?php
					$Results->displayFood();
				?>
			</div>
		</div>
<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php");?>