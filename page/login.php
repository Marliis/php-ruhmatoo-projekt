<?php
	
	require("../functions.php");
	
	require("../class/User.class.php");
	$User=new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper=new Helper($mysqli);
	
	require("../css.php");

	//kas kasutaja on sisse logitud
	if (isset ($_SESSION["userId"])) {
		
		header("Location: data.php");
		exit();	
	}
	

	// MUUTUJAD
	$firstName="";	
	$lastName="";
	$gender="";
	$signupEmail="";
	$signupgenderError="";
	$lastNameError="";
	$signupEmailError = "";
	$signupPasswordError = "";
	$firstNameError = "";
	$loginEmail = "";
	$loginEmailError = "";
	$loginPassword = "";
	$loginPasswordError = "";
	
	
	// kas sisse logimisel oli e-post olemas
	if ( isset ( $_POST["loginEmail"] ) ) {
			
		if ( empty ( $_POST["loginEmail"] ) ) {
			
			// oli email, kuid see oli tühi
			$loginEmailError = "See väli on kohustuslik!";
			
		} else {
			
			// email on õige, salvestan väärtuse muutujasse
			$loginEmail = $_POST["loginEmail"];		
		}	
	}
	
	
	// kas kasutaja loomisel oli e-post olemas
	if ( isset ( $_POST["signupEmail"] ) ) {
		
		if ( empty ( $_POST["signupEmail"] ) ) {
			
			// oli email, kuid see oli tühi
			$signupEmailError = "See väli on kohustuslik!";
			
		} else {
			
			// email on õige, salvestan väärtuse muutujasse
			$signupEmail = $_POST["signupEmail"];
			
		}		
	}
	
	
	// kas sisse logimisel oli parool olemas
	if ( isset ( $_POST["loginPassword"] ) ) {
		
		if ( empty ( $_POST["loginPassword"] ) ) {
			
			// oli parool, kuid see oli tühi
			$loginPasswordError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et parool on ja see ei olnud tühi
			// VÄHEMALT 8
			
			if ( strlen($_POST["loginPassword"]) < 8 ) {
				
				$loginPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
				
			}		
		}
	}
	
	
	// kas kasutaja loomisel oli parool olemas
	if ( isset ( $_POST["signupPassword"] ) ) {
		
		if ( empty ( $_POST["signupPassword"] ) ) {
			
			// oli parool, kuid see oli tühi
			$signupPasswordError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et parool on ja see ei olnud tühi
			// VÄHEMALT 8
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
				
			}		
		}
	}
	
	
	$gender = "male";
	// KUI Tühi
	// $gender = "";
	
	if ( isset ( $_POST["gender"] ) ) {
		if ( empty ( $_POST["gender"] ) ) {
			$genderError = "See väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
	}
	
	
	if ( isset($_POST["firstName"] ) ) {
		if ( empty( $_POST["firstName"] ) ) {
			$firstNameError = "See väli on kohustuslik!";
		} else {
			$firstName = $_POST["firstName"];
		}
	}
	
	
	if ( isset($_POST["signupName"] ) ) {
		if ( empty( $_POST["signupName"] ) ) {
			$signupNameError = "See väli on kohustuslik!";
		} else {
			$signupName = $_POST["signupName"];
		}
	}
	
	
	if ( isset($_POST["lastName"] ) ) {
		if ( empty( $_POST["lastName"] ) ) {
			$lastNameError = "See väli on kohustuslik!";
		} else {
			$lastName = $_POST["lastName"];
		}
	}
	
		
	// Kus tean et ühtegi viga ei olnud ja saan kasutaja andmed salvestada
	if ( isset($_POST["firstName"]) &&
		 isset($_POST["gender"]) && 
		 isset($_POST["lastName"]) &&
		 isset($_POST["signupEmail"]) &&
		 isset($_POST["signupPassword"]) &&	
		 empty($firstNameError) && 
		 empty($signupgenderError) && 
		 empty($lastNameError) && 
		 empty($signupEmailError) && 
		 empty($signupPasswordError)
	   ) {
		
		echo "Salvestan...<br>";
		//echo "email ".$signupEmail."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		//echo "parool ".$_POST["signupPassword"]."<br>";
		//echo "räsi ".$password."<br>";
		
		//echo $serverPassword;
	// KASUTAN FUNKTSIOONI
		$signupEmail = $Helper->cleanInput($signupEmail);
		
		$User->signUp($signupEmail, $Helper->cleanInput($password));
		
	
	}
	
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"]));
		
	}
	
	

?>	
<?php require("../header.php"); ?>

	<div class="container">
	
		<div class="row">
		
			<div class="col-sm-3">
			<h1>LOGI SISSE</h1>
		
		<form method="POST">
			<p style="color:red;"><?=$error;?></p>
			<label>E-post</label><br>
			<input name="loginEmail" type="email" value="<?=$loginEmail;?>"> <?php echo $loginEmailError;?>
			
			<br><br>
			
			<label>Parool</label><br>
			<input name="loginPassword" type="password" value="<?=$loginPassword;?>"><?php echo $loginPasswordError;?>
			
			<br>
			
			<p class="forgotPassword">
			<a data-label="unustasid-parooli" onclick="trackgavent($(this));
			return false;"
			href="forgotPassword.php? lang=1">Unustasid parooli?</a>
			</p>
						
			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Logi sisse">

		</form>	
		</div>
		
		<body class="background" background="../first_page.jpeg">

		<div class="col-sm-3 col-sm-offset-3">
		<h1>LOO KASUTAJA</h1>
		
		<form method="POST">
		
			<label>Eesnimi</label><br>
			<input name="firstName" type="name" value="<?=$firstName;?>"> <?php echo $firstNameError; ?>
			
			<br><br>
			
			<label>Perekonnanimi</label><br>
			<input name="lastName" type="name" value="<?=$lastName;?>"> <?php echo $lastNameError; ?>			
			
			<br><br>
			<label>Sugu</label><br>
			 <?php if($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked> Mees<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="male" > Mees<br>
			 <?php } ?>
			 
			 <?php if($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked> Naine<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="female" > Naine<br>
			 <?php } ?>
			 
			<br>
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<label>Parool</label><br>
			<input name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			
			<label>Kinnita parool</label><br>
			<input name="signupPassword" type="password"> <?php echo $signupPasswordError; ?> 
			<br><br>						
			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Loo kasutaja">
			
				</form>
			</div>
							
		</div>
		
	</div>

	</div>
<?php require("../footer.php"); ?>