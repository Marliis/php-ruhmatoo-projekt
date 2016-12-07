<?php 

class Person {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
	
	function save ($date, $weight, $height) {
			
			//käsk
			$stmt=$this->connection->prepare("INSERT INTO PersonData (date, weight, height, user_id) VALUES(?, ?, ?, ?)");
			
			
			echo $this->connection->error;
		
			$stmt->bind_param("siii", $date, $weight, $height, $_SESSION["userId"]);
		
			if($stmt->execute()) {
				echo "salvestamine õnnestus";
			} else {
		 		echo "ERROR ".$stmt->error;
			}
		
		$stmt->close();
			
	}		
		
	
	function update($id, $date, $weight, $height, $training, $food){
    	
		$stmt = $this->connection->prepare("UPDATE PersonData SET date=?, weight=?, height=?, training=?, food=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("siissi", $date, $weight, $height, $training, $food, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// ınnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
			
	}
} 	
	
?>	