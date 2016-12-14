<?php 
class Athlete {
	
	private $connection;
	
	function __construct($mysqli) {
		
	$this->connection = $mysqli;
		
	}


	function saveAthlete ($TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment) {
			
			//käsk
			$stmt=$this->connection->prepare("INSERT INTO AthleteData_2 (TypeOfTraining, WorkoutHours, Kilometers, feeling, comment, user_id) VALUES(?, ?, ?, ?, ?, ?)");
			
			$stmt->bind_param("sddssi", $TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment, $created, $_SESSION["userId"]);
			
			echo $this->connection->error;
		
			if($stmt->execute()) {
				echo "SALVESTAMINE ÕNNESTUS!";
			} else {
		 		echo "ERROR ".$stmt->error;
			}
		
		$stmt->close();
			
	}		
		
	
	function update($id, $TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment){
    	
		$stmt = $this->connection->prepare("UPDATE AthleteData_2 SET TypeOfTraining=?, WorkoutHours=?, Kilometers=?, feeling=?, comment=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("sddssi", $TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// ınnestus
			echo "SALVESTAMINE ÕNNESTUS!";
		}
		
		$stmt->close();
			
	}
} 
?>	