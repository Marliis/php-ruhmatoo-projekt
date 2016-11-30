<?php
	
	// RÜHMATÖÖ
	//functions.php
	require("../../config.php");
	
	session_start();
	$database = "if16_health_diary";


function signup ($Name, $Age, $Email, $password, $Gender) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (Name, Age, Email, password, Gender) VALUES (?,?,?,?,?)");
		echo $mysqli->error;
		$stmt->bind_param("sisss",$Name, $Age, $Email, $password, $Gender);
		if ($stmt->execute()) {
			echo "salvestamine ınnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}


	}

	function login($Email, $password) {
		
		$error = "";
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("

			SELECT id, Email, password, created

			FROM user_sample

			WHERE Email = ?

		");

		echo $mysqli->error;
		//asendan küsimärgi
		$stmt->bind_param("s", $Email);
		//määran tupladele muutujad
		$stmt->bind_result($id, $EmailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		//küsin rea andmeid
		if($stmt->fetch()) {
			//oli rida
			// võrdlen paroole
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb) {
				echo "kasutaja ".$id." logis sisse";
				$_SESSION["userId"] = $id;
				$_SESSION["Email"] = $EmailFromDb;
			
				//$_SESSION["Name"] = $NameFromDB;
				//suunaks uuele lehele

				} else {
				$error = "parool vale";
			}

			} else {
			//ei olnud 
			$error = "sellise emailiga ".$Email." kasutajat ei olnud";
		}

		return $error;

		}

	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
?>