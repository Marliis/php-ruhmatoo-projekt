<?php
	
	require("../../config.php");
	require ("functions.php");
	
	if(isset ($_SESSION["userId"])) {
			header("Location: data.php");
	}

	
	//MUUTUJAD
	$loginEmail = "";
	$loginEmailError = "";
	$loginPassword = "";
	$loginPasswordError = "";
	
	$firstName = "";
	$lastName = "";
	$firstNameError = "";
	$lastNameError = "";
	$SignupEmail = "";
	$signupEmailError = "";
	$signupPassword = "";
	$signupPasswordError = "";
	$gender = "";
	$genderError = "";

	if ( isset ( $_POST["loginEmail"] ) ) {
		if ( empty ( $_POST["loginEmail"] ) ) {
			$loginEmailError = "See väli on kohustuslik!";
		} else {
			$loginEmail = $_POST["loginEmail"];
		}
	}

	if (isset ($_POST["firstName"]) ){
		if (empty ($_POST["firstName"]) ){
			$firstNameError = "See väli on kohustuslik!";		
		} else {
			if (!preg_match("/^[a-zA-Z õäöüšž-]*$/",$_POST["firstName"])) { 
				$firstNameError = "Pole nimi!"; 
			}else{
				$firstName = $_POST["firstName"];
			}
		}
	}
	
	if (isset ($_POST["lastName"]) ){
		if (empty ($_POST["lastName"]) ){
			$lastNameError = "See väli on kohustuslik!";		
		} else {
			if (!preg_match("/^[a-zA-Z õäöüšž-]*$/",$_POST["lastName"])) { 
				$lastNameError = "Pole nimi!"; 
			}else{
				$lastName = $_POST["lastName"];
			}
		}
	}	

	$gender = "";

	if (isset ($_POST["gender"]) ) {
		if (empty ($_POST["gender"]) ) { 
			$genderError = "See väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
	}

	if (isset ($_POST["signupEmail"]) ) {
		if (empty ($_POST["signupEmail"]) ) { 
			$signupEmailError = "See väli on kohustuslik!";
		} else {
			$signupEmail = $_POST["signupEmail"];
		}
	}
	
		if (isset ($_POST["signupPassword"]) ) {
		if (empty ($_POST["signupPassword"]) ) { 
			$signupPasswordError = "See väli on kohustuslik!";
		} else {
			if (strlen ($_POST["signupPassword"]) <= 8 ){
				$signupPasswordError = "Parool peab olema 8 tähemärki pikk!";
			}
		}
	}
	
	var_dump($signupPasswordError);
	if (isset($_POST["signupPassword"]) &&
		isset($_POST["signupEmail"]) &&
		isset($_POST["gender"]) &&
		isset($_POST["firstName"]) &&
		isset($_POST["lastName"]) &&
		empty($signupEmailError) && 
		empty($genderError) && 
		empty($signupPasswordError) &&
		empty($firstNameError) &&
		empty($lastNameError)) {
			
		echo "Salvestan...<br>";
		echo "eesnimi".$firstName."<br>";
		echo "perenimi".$lastName."<br>";
		echo "email ".$signupEmail."<br>";
		$password = hash("sha512", $_POST["signupPassword"]);
		echo "parool ".$_POST["signupPassword"]."<br>";
		echo "räsi ".$password."<br>";
		echo "sugu ".$gender."<br>";

		$signupEmail = cleanInput($signupEmail);
		$password = cleanInput($password);

		signup($firstName, $lastName, $signupEmail, $password, $gender);
		}

		$error = "";

		if(isset($_POST["loginEmail"]) &&
			isset($_POST["loginPassword"]) &&
			!empty($_POST["loginEmail"]) &&
			!empty($_POST["loginPassword"])
		) {

			//login sisse
			$error = login($_POST["loginEmail"], $_POST["loginPassword"]);
		}
?>
	
<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehekülg</title>
	</head>
	<body>

		<h1>Logi sisse</h1>
		
		<form method="POST">
			<p style="color:red;"><?=$error;?></p>
			
			<input name="loginEmail" type="email" value="<?=$loginEmail;?>" placeholder="E-mail"> <?php echo $loginEmail; ?>
			<br><br>
			
			<input name="loginPassword" type="password" placeholder="Parool">
			<br><br>
			
			<input type="submit" value="Logi sisse">
			
		</form>
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
			
			<label>Eesnimi</label><br>
			<input name="firstName" type="text"> <?php echo $firstNameError; ?>
			<br><br>
			
			<label>Perekonnanimi</label><br>
			<input name="lastName" type="text"> <?php echo $lastNameError; ?>
			<br><br>
			
			<label>Sugu</label><br>
			
			<?php if($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked> Male<br>
			<?php } else{ ?>
					<input type="radio" name="gender" value="male" > Male<br>
			<?php } ?>
			
			<?php if($gender == "female") { ?>
					<input type="radio" name="gender" value="female" checked> Female<br>
			<?php } else { ?>
					<input type="radio" name="gender" value="female" > Female<br>
			<?php } ?>
			<br>
			
			<label>E-maili aadress</label><br>
			<input name="signupEmail" type="email"> <?php echo $signupEmailError?>
			<br>
			
			<label>Parool</label><br>
			<input name="signupPassword" type="password" value="<?=$signupPassword;?>"> <?php echo $signupPasswordError; ?>
			<br><br>
			
			<label>Kinnita parool</label><br>
			<input name="signupPassword" type="password" value="<?=$signupPassword;?>"> <?php echo $signupPasswordError; ?> 
			<br><br>
			<br>
			<input type="submit" value="Loo kasutaja">
			
		</form>
	</body>
</html>