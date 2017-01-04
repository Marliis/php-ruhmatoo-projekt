<?php 
class Food {
	
	private $connection;
	
	function __construct($mysqli){
		
		//this viitab klassile (this == User)
		$this->connection = $mysqli;
		
	}

	function displayFood() {
		// Check connection
		if ($this->connection->error) {
		    die("Connection failed");
		} 

		$sql = "SELECT food, content, drinks, amount, user_id FROM FoodData";

		$result = $this->connection->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
				echo "TOIT:" . $row["food"]. ", SISU: " . $row["content"]. ", JOOGID: " . $row["drinks"]. ", KOGUS: " . $row["amount"]. "<br>";
		    }
		} else {
		    echo "Tulemused puuduvad";
		}
	}
}
?>