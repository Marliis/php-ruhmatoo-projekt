<?php 
class Food {
	
	private $connection;
	
	function __construct($mysqli){
		
		//this viitab klassile (this == User)
		$this->connection = $mysqli;
		
	}

	// funktsioon kuupäevade järjestamiseks arrays usortiga
	function orderByDate($array){

		function date_compare($a, $b){
			$t1 = strtotime($a['details']['created']);
			$t2 = strtotime($b['details']['created']);
			return $t2 - $t1;
		}
		usort($array, 'date_compare');

		return $array;

	}

	// kuupäevad valides saadame uuele aadressile
	function search($startDate, $endDate){

		header("Location: checkTraining.php?startDate=" . $startDate . "&endDate=" . $endDate);

	}

	function displayResults($startDate, $endDate){

		// kontrollime ühendust
		if ($this->connection->error) {
		    die("Connection failed");
		}

		// kui otsime kuupäevadega
		if (!empty($startDate) && !empty($endDate)){

			$sql_extra = " AND created BETWEEN '" . $startDate . "' AND '" . $endDate . "'";

		}

		$array = "";

		// toit arraysse
		$sql = "SELECT user_id, food, content, drinks, amount, created FROM FoodData WHERE user_id = " . $_SESSION["userId"] . $sql_extra;
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0) {
		    // iga toit arraysse
		    while($row = $result->fetch_assoc()) {

				$array[$row["created"]] = array("type" => "food",

							"details" =>

							array(	"food" => $row["food"],
									"content" => $row["content"],
									"drinks" => $row["drinks"],
									"amount" => $row["amount"],
									"created" => $row["created"]
							)
				);

		    }
		}

		// persondata arraysse
		$sql = "SELECT user_id, weight, height, created FROM PersonData WHERE user_id = " . $_SESSION["userId"] . $sql_extra;
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0) {
			// iga persondata arraysse
			while($row = $result->fetch_assoc()) {

				$array[$row["created"]] = array("type" => "person",

					"details" =>

						array(	"weight" => $row["weight"],
								"height" => $row["height"],
								"created" => $row["created"]
						)
				);

			}
		}

		// treenngud arraysse
		$sql = "SELECT user_id, TypeOfTraining, WorkoutHours, Kilometers, feeling, comment, created FROM AthleteData_2 WHERE user_id = " . $_SESSION["userId"] . $sql_extra;
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0) {
			// iga treening arraysse
			while($row = $result->fetch_assoc()) {

				$array[$row["created"]] = array("type" => "training",

					"details" =>

						array(	"TypeOfTraining" => $row["TypeOfTraining"],
								"WorkoutHours" => $row["WorkoutHours"],
								"Kilometers" => $row["Kilometers"],
								"feeling" => $row["feeling"],
								"comment" => $row["comment"],
								"created" => $row["created"]
						)
				);

			}
		}

		// kui array pole tühi paneme kuupäevade järgi õigesse järjekorda
		if(!empty($array)){
			$array = self::orderByDate($array);
		} else {
			// kui ei leidnud tabelist tulemusi saadame info selle kohta
			$array = array("type" => "not_found", "detail" => array("error" => "empty"));

		}

		// saadame info, et tabel joonistada
		return $array;


	}
}
?>