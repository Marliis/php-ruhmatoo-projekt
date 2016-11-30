<?php
	
	// RÜHMATÖÖ
	//functions.php
	require("../../config.php");
	
	session_start();
	$database = "if16_health_diary";

<<<<<<< HEAD

function signup ($Name, $Age, $Email, $password, $Gender) {
=======
function signup ($name, $gender, $age, $email, $password) {
>>>>>>> 19fb98d81d90da83b7967a525f72a1c97ccc8fa2
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);

		$stmt = $mysqli->prepare("INSERT INTO user_sample (Name, Age, Email, password, Gender) VALUES (?,?,?,?,?)");

		echo $mysqli->error;

		$stmt->bind_param("sisss",$Name, $Age, $Email, $password, $Gender);

		if ($stmt->execute()) {

			echo "salvestamine ınnestus";

		} else {

			echo "ERROR ".$stmt->error;

		}
<<<<<<< HEAD

	}

	function login($Email, $password) {

=======
	}
	
	function login($email, $password) {
		
>>>>>>> 19fb98d81d90da83b7967a525f72a1c97ccc8fa2
		$error = "";

		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);

		$stmt = $mysqli->prepare("

			SELECT id, Email, password, created

			FROM user_sample

			WHERE Email = ?

		");

		echo $mysqli->error;

		//asendan k¸sim‰rgi

		$stmt->bind_param("s", $Email);

		//m‰‰ran tupladele muutujad

		$stmt->bind_result($id, $EmailFromDb, $passwordFromDb, $created);

		$stmt->execute();

		//k¸sin rea andmeid

		if($stmt->fetch()) {

			//oli rida

			// vırdlen paroole

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
<<<<<<< HEAD

			} else {

=======
		
		} else {
>>>>>>> 19fb98d81d90da83b7967a525f72a1c97ccc8fa2
			//ei olnud 

			$error = "sellise emailiga ".$Email." kasutajat ei olnud";

		}
<<<<<<< HEAD

		return $error;

		}


=======
		
		return $error;
	}
>>>>>>> 19fb98d81d90da83b7967a525f72a1c97ccc8fa2
?>