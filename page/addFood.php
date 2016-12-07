	<?php 
	
	require("../functions.php");
	
	require("../class/Food.class.php");
	$Food = new Food($mysqli);
	
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
	
	$food = "";
	$foodError = "";
	$content = "";
	$contentError = "";
	$drinks = "";
	$drinksError = "";
	$amount = "";
	$amountError = "";
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	if( isset($_POST[""]) &&
		isset($_POST["food"]) &&
		isset($_POST["content"]) &&
		isset($_POST["drinks"]) &&
		isset($_POST["amount"]) &&
		!empty($_POST["foodError"]) &&
		!empty($_POST["contentError"]) &&
		!empty($_POST["drinksError"]) &&
		!empty($_POST["amountError"]) 
	){
		
		$Person->save($Helper->cleanInput($Helper->cleanInput($_POST["food"]), $_POST["content"],($_POST["drinks"]), $_POST["amount"]));
		
	}
?>
<h1>Kasutaja andmed</h1>
<p>
	Tere tulemast <a href="addFood.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi välja</a>
</p>
	<br><br>
	<label>Söögikord</label><br>
	<select name="food">
	<option value="" disabled selected>Vali söögikord</option>
	<option value="Hommikusöök">Hommikusöök</option>
	<option value="Vahepala">Vahepala</option>
	<option value="Lõunasöök">Lõunasöök</option>
	<option value="Õhtu-oode">Õhtu oode</option>
	<option value="Õhtusöök">Õhtusöök</option>

	</select>
	
	<input name="content" type="text" placeholder="Sisaldab">
	
	<br><br>
	<label>Joogid</label><br>
	<select name="drinks">
	<option value="" disabled selected>Vali joogid</option>
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
	
	<input type="submit" value="Salvesta">
	
</form>


<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php");?>