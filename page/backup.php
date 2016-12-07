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