<?php 
class Food {
	
	private $connection;
	
	function __construct($mysqli){
		
		//this viitab klassile (this == User)
		$this->connection = $mysqli;
		
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function saveFood ($food, $content, $drinks, $amount) {
		
		

		$stmt =  $this->connection->prepare("INSERT INTO FoodData (food, content, drinks, amount) VALUES (?,?)");

		$stmt->bind_param("ssss", $food, $content, $drinks, $amount);
		
		echo $this->connection->error;
		
		$stmt->bind_param("ssss", $food, $content, $drinks, $amount);

		if ($stmt->execute()) {

			echo "salvestamine õnnestus";

		} else {

			echo "ERROR ".$stmt->error;
		}
			$stmt->close();
	
		}
		
		
	function update($id, $food, $content, $drinks, $amount) {
		
		$stmt = $this->connection->prepare("UPDATE FoodData SET food=?, content=?, drinks=?, amount=? WHERE id=? AND delete IS NULL");
		$stmt->bind_param("ss", $food, $content, $drinks, $amount);
		
		//kas onnestus salvestada
		if($stmt->execuse()){
			//onnestus
			echo "salvestus onnestus!";
		}
		
		$stmt->close();
	}
}
?>