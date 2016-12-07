<?php 
class Athlete {
	
	private $connection;
	
	function __construct($mysqli) {
		
	$this->connection = $mysqli;
		
	}


	function saveAthlete ($TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment) {
			
			//käsk
			$stmt=$this->connection->prepare("INSERT INTO AthleteData_2 (TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment) VALUES(?, ?, ?, ?, ?)");
			
			$stmt->bind_param("siiss", $TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment);
			
			echo $this->connection->error;
		
			$stmt->bind_param("siiss", $TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment);
		
			if($stmt->execute()) {
				echo "salvestamine õnnestus";
			} else {
		 		echo "ERROR ".$stmt->error;
			}
		
		$stmt->close();
			
	}		
		
	
	function update($id, $TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment){
    	
		$stmt = $this->connection->prepare("UPDATE AthleteData_2 SET TypeOfTraining=?, WorkoutHours=?, Kilometers=?, feeling=?, comment=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("siissi", $TypeOfTraining, $WorkoutHours, $Kilometers, $feeling, $comment, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// ınnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
			
	}
} 

?>	