<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$controlon ="`". "wc_" . $_GET["date"] . "_" . $comp_id . "`";
$title = $_GET["date"];

$query_get_max = "SELECT * FROM $controlon WHERE hour = 999";
$query_get_max_do = mysqli_query($connection, $query_get_max);

global $maxinperiod;

if($row = mysqli_fetch_assoc($query_get_max_do)){

   $maxinperiod = $row["ids"];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $title ?>'s weapon control</title>
	<link rel="stylesheet" href="../css/basestyle.min.css">
	<link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
	<?php include "includes/navigation.php"; ?>
	<main>
		<div id="title_stripe">
			<p class="page_title"><?php echo $title ?>'s weapon control</p>
		</div>
		<div id="page_content_panel_main">
			<div id="dates_weapon_control_wrapper">

				<?php

				$query = "SELECT * FROM $controlon";
				$query_do = mysqli_query($connection, $query);

				$rowsave = "";

				while($row = mysqli_fetch_assoc($query_do)){

					$ora = $row["hour"];

					if($ora == 999){

						$rowsave = 999;

					}
					if($rowsave != $ora){

						$rowsave = $ora;


						$query_in = "SELECT * FROM $controlon WHERE hour = $ora";
						$query_in_do = mysqli_query($connection, $query_in);

						$foroneperiod = array();

						$actual = 0;

						while($row = mysqli_fetch_assoc($query_in_do)){

						$actual = $actual + (strlen($row["ids"]) / 2);


						array_push($foroneperiod, strlen($row["ids"]) / 2);
						}

						?>

						<div class="period" id="period_1" onclick="togglePeriodPanel(this)">
					<div>
						<p><?php echo $ora . ":00" . " - " . $ora . ":59" ?></p>
						<p><?php echo $maxinperiod * 6 ?> / <?php echo $actual ?></p>
					</div>
					<div class="gray">
						<p><?php echo $maxinperiod * 6 ?> / <?php echo $actual ?></p>
					</div>
					<div>
						<div>

								<?php

								$oraig = $ora + 6;
								$perc = 0;

								for ($i=$ora; $i < $oraig ; $i++) {

									?>

									<div id='<?php echo $ora . "_" . $perc?>' class='ten_minutes_wrapper' onclick=''>
											<p><?php echo $ora ?>:00 - <?php echo $ora ?>:<?php echo $perc ?>9</p>
												<p><?php echo $maxinperiod ?> / <?php echo $foroneperiod[$perc]; ?></p>
										</div>


									<?php

									$perc++;
									?>


									<div class="hidden fencers_wrapper" id="<?php echo $ora . "_" . $perc?>">
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>

						</div>


								<?php
								}
								?>


						</div>
						<div>
							<button type="button">
								<img src="../assets/icons/person_add_alt_1_black.svg">
							</button>
							<button type="button">
								<img src="../assets/icons/person_remove_black.svg">
							</button>
						</div>

					</div>
				</div>

<?php


					}
					else{


					}


				}

				?>













				<!-- <div class="period" id="period_2" onclick="togglePeriodPanel(this)">
					<div>
						<p>11:25 - 23:14</p>
						<p>25 / 4</p>
					</div>
					<div class="gray">
						<p>25 / 4</p>
					</div>
					<div>
						<div>
							<div class="selected">
								<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
						</div>
						<div>
							<button type="button">
								<img src="../assets/icons/person_add_alt_1_black.svg">
							</button>
							<button type="button">
								<img src="../assets/icons/person_remove_black.svg">
							</button>
						</div>
						<div>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
						</div>
					</div>
				</div>
				<div class="period" id="period_3" onclick="togglePeriodPanel(this)">
					<div>
						<p>11:25 - 23:14</p>
						<p>25 / 4</p>
					</div>
					<div class="gray">
						<p>25 / 4</p>
					</div>
					<div>
						<div>
							<div class="selected">
								<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
						</div>
						<div>
							<button type="button">
								<img src="../assets/icons/person_add_alt_1_black.svg">
							</button>
							<button type="button">
								<img src="../assets/icons/person_remove_black.svg">
							</button>
						</div>
						<div>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
						</div>
					</div>
				</div>
				<div class="period" id="period_4" onclick="togglePeriodPanel(this)">
					<div>
						<p>11:25 - 23:14</p>
						<p>25 / 4</p>
					</div>
					<div class="gray">
						<p>25 / 4</p>
					</div>
					<div>
						<div>
							<div class="selected">
								<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
						</div>
						<div>
							<button type="button">
								<img src="../assets/icons/person_add_alt_1_black.svg">
							</button>
							<button type="button">
								<img src="../assets/icons/person_remove_black.svg">
							</button>
						</div>
						<div>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
						</div>
					</div>
				</div>
				<div class="period" id="period_5" onclick="togglePeriodPanel(this)">
					<div>
						<p>11:25 - 23:14</p>
						<p>25 / 4</p>
					</div>
					<div class="gray">
						<p>25 / 4</p>
					</div>
					<div>
						<div>
							<div class="selected">
								<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
						</div>
						<div>
							<button type="button">
								<img src="../assets/icons/person_add_alt_1_black.svg">
							</button>
							<button type="button">
								<img src="../assets/icons/person_remove_black.svg">
							</button>
						</div>
						<div>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
						</div>
					</div>
				</div>
				<div class="period" id="period_6" onclick="togglePeriodPanel(this)">
					<div>
						<p>11:25 - 23:14</p>
						<p>25 / 4</p>
					</div>
					<div class="gray">
						<p>25 / 4</p>
					</div>
					<div>
						<div>
							<div class="selected">
								<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
							<div>
							<p>10:00 - 10:10</p>
								<p>8 / 1</p>
							</div>
						</div>
						<div>
							<button type="button">
								<img src="../assets/icons/person_add_alt_1_black.svg">
							</button>
							<button type="button">
								<img src="../assets/icons/person_remove_black.svg">
							</button>
						</div>
						<div>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
							<p>Ember</p>
						</div>
					</div>
				</div>-->
			</div>
		</div>
	</main>
	<script src="javascript/cookie_monster.js"></script>
	<script src="javascript/main.js"></script>
	<script src="javascript/dates_weapon_control.js"></script>
</body>
</html>