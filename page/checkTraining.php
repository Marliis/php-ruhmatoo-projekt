	<?php 
	
	require("../functions.php");
	
	require("../class/Results.class.php");
	$Results = new Food($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);

	require("../css.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();

	}

	//var_dump($_POST);
	if( !empty($_POST["startDate"]) &&
		!empty($_POST["endDate"])
	) {
		$Results->search($Helper->cleanInput($_POST["startDate"]), $Helper->cleanInput($_POST["endDate"]));
	}

?>

<?php require("../header.php"); ?>

	<body class="addTraining_background" background="../add_checkTraining_page.jpeg">

	<div class="container">

		<div class="row">

			<div class="col-sm-9">
				<br>
				<?
				$msg="";
				?>
				<p>
					<a href="addTraining.php"><?=$_SESSION["userEmail"];?></a>
				</p>
				<h3><a href="data.php"> < Mine tagasi</a></h3>
				<h1>Tulemused</h1>
	
				<div class="row">
					<div class="col-sm-9">

						<form method="POST">

							<div class="row">
								<div class="col-md-4">
									<label>Alguskuupäev</label><br>
									<input name="startDate" type="date" value="<?php if(isset($_GET["startDate"])){ echo $_GET["startDate"]; } ?>">
								</div>
								<div class="col-md-4">
									<label>Lõpukuupäev</label><br>
									<input name="endDate" type="date" value="<?php if(isset($_GET["endDate"])){ echo $_GET["endDate"]; } ?>">
								</div>
								<div class="col-md-4">
									<br />
									<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Otsi">
									<?php if(isset($_GET["startDate"]) or isset($_GET["endDate"])){ ?>
										<a class="btn btn-danger btn-sm hidden-xs" href="checkTraining.php">Taasta</a>
									<?php } ?>
								</div>
							</div>


						</form>

						<table class="table table-bordered">
							<tbody>
							<?php

							$startDate = $Helper->cleanInput($_GET["startDate"]);
							$endDate = $Helper->cleanInput($_GET["endDate"]);

								// võtame tulemused
								$array = $Results->displayResults($startDate, $endDate);

								// kui pole tulemusi
								if($array["type"] == "not_found"){

									?>
									<tr class="error">
										<td><small>Tulemusi ei leitud!</small></td>
									</tr>
									<?php
									// kui leidis tulemusi
								} else {

									foreach($array as $result){

											$type = $result["type"];
											if($type == "food"){ $typeText = "Söögikord"; }
											if($type == "person"){ $typeText = "Andmed"; }
											if($type == "training"){ $typeText = "Treening"; }

											$details = $result["details"];

											$phpdate = strtotime( $details["created"] );
											$date = date( 'd.m.Y', $phpdate );

											?>
											<tr class="<?php echo $type; ?>">
												<td class="text-center"><img src="../<?php echo $type; ?>.png"/></td>
												<td><small><?php echo $date; ?></small><br /><?php echo $typeText; ?></td>
												<?php if($type == "food"){ ?>
												<td><small><?php echo $details["food"]; ?></small><br /><?php echo $details["content"]; ?></td>
												<td><small><?php echo $details["drinks"]; ?></small><br /><?php echo $details["amount"]; ?>l</td>
												<?php } ?>
												<?php if($type == "person"){ ?>
												<td><small>Kaal</small><br /><?php echo $details["weight"]; ?>kg</td>
												<td><small>Pikkus</small><br /><?php echo $details["height"]; ?>cm</td>
												<?php } ?>
												<?php if($type == "training"){ ?>
													<td><small><?php echo $details["TypeOfTraining"]; ?></small><br /><?php echo $details["WorkoutHours"]; ?>h - <?php echo $details["Kilometers"]; ?>km</td>
													<td><small><?php echo $details["feeling"]; ?></small> - <small><?php echo $details["comment"]; ?></small></td>
												<?php } ?>
											</tr>
											<?php

										}

									}
							?>
							</tbody>
						</table>

					</div>
				</div>

			</div>

		</div>

	</div>
		<br>
<br>
<br>
<br>
<br>
<?php require("../footer.php");?>