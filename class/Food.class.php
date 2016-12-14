<?php 
class Food {
	
	private $connection;
	
	function __construct($mysqli){
		
		//this viitab klassile (this == User)
		$this->connection = $mysqli;
		
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function saveFood ($food, $content, $drinks, $amount) {

		$stmt =  $this->connection->prepare("INSERT INTO FoodData (food, content, drinks, amount, user_id) VALUES (?, ?, ?, ?, ?)");

		$stmt->bind_param("sssdi", $food, $content, $drinks, $amount, $_SESSION["userId"]);
		
		echo $this->connection->error;

		if ($stmt->execute()) {

			echo "SALVESTAMINE ÕNNESTUS!";

		} else {

			echo "ERROR ".$stmt->error;
		}
			$stmt->close();
	
		}
		
		
	function update($id, $food, $content, $drinks, $amount) {
		
		$stmt = $this->connection->prepare("UPDATE FoodData SET food=?, content=?, drinks=?, amount=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("sssdi", $food, $content, $drinks, $amount, $id);
		
		//kas onnestus salvestada
		if($stmt->execuse()){
			//onnestus
			echo "SALVESTAMINE ÕNNESTUS!";
		}
		
		$stmt->close();
	}
}
?>