	<?php 
	
	require("../functions.php");
	
	require("../class/Food.class.php");
	$Food = new Food($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../css.php");

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
	
	$food = "";
	$foodError = "";
	$content = "";
	$contentError = "";
	$drinks = "";
	$drinksError = "";
	$amount = "";
	$amountError = "";
	$error = "";
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
//	var_dump($_POST);
	if( isset($_POST["food"]) &&
		isset($_POST["content"]) &&
		isset($_POST["drinks"]) &&
		isset($_POST["amount"]) &&
		empty($foodError) &&
		empty($contentError) &&
		empty($drinksError) &&
		empty($amountError) 
	){
		
		$Food->saveFood($Helper->cleanInput($_POST["food"]), $_POST["content"],($_POST["drinks"]), $_POST["amount"]);
		
	}
?>

<?php require("../header.php"); ?>

	<body class="addFood_background" background="../addFood_page.jpeg">

	<div class="container">
	
		<div class="row">
		
			<div class="col-sm-9">
			<br>
			<?=$msg;?>
			<p>
				<a href="addFood.php"><?=$_SESSION["userEmail"];?></a>
			</p>
			
			<h3><a href="data.php"> < Mine tagasi</a></h3>
			<h1>Salvesta söögikordade andmed</h1>
			
		<form method="POST">
		
			<p style="color:red;"><?=$error;?></p>
			<label>Söögikord</label><br>
			<select name="food">
			<option value="" disabled selected>Vali söögikord</option>
			<option value="Hommikusöök">Hommikusöök</option>
			<option value="Lõunaoode">Lõunaoode</option>
			<option value="Lõunasöök">Lõunasöök</option>
			<option value="Õhtuoode">Õhtuoode</option>
			<option value="Õhtusöök">Õhtusöök</option>

			</select>
			
			<input name="content" type="text" placeholder="Sisaldab">
			
			<br><br>
			<label>Jook</label><br>
			<select name="drinks">
			<option value="" disabled selected>Vali jook</option>
			<option value="Vesi">Vesi</option>
			<option value="Piim">Piim</option>
			<option value="Mahl">Mahl</option>
			<option value="Jogurt">Jogurt</option>
			<option value="Keefir">Keefir</option>
			<option value="Kohv">Kohv</option>
			<option value="Tee">Tee</option>
			<option value="Karastusjook">Karastusjook</option>
			<option value="Alkohoolne jook">Alkohoolne jook</option>
			</select>
			<input name="amount" type="text" placeholder="Sisesta kogus liitrites">
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