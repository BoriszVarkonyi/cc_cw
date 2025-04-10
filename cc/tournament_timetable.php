<?php include "includes/db.php" ?>
<?php ob_start(); ?>

<?php

$t_id = $_GET["t_id"];

if (isset($_POST["save"])) {

	$get_timet_info = "SELECT * FROM tournaments WHERE id = $t_id";
	$get_timet_info_do = mysqli_query($connection, $get_timet_info);

	if ($row = mysqli_fetch_assoc($get_timet_info_do)) {

		$dates = json_decode($row["timetable"]);
	}

	$start_date = $_POST["start_date_input"];
	$end_date = $_POST["end_date_input"];
	$type_of_booking = $_POST["type_of_booking"];

	$dates->start_date = $start_date;
	$dates->end_date = $end_date;
	$dates->type_of_booking = $type_of_booking;

	$dates = json_encode($dates);

	$qry_update_dates = "UPDATE tournaments SET timetable = '$dates' WHERE id = $t_id";
	$qry_update_dates_do = mysqli_query($connection, $qry_update_dates);

	header("Location: tournament_timetable.php?t_id=$t_id");
}

if (isset($_POST["new_weapon_control"])) {

	$get_timet_info = "SELECT * FROM tournaments WHERE id = $t_id";
	$get_timet_info_do = mysqli_query($connection, $get_timet_info);

	if ($row = mysqli_fetch_assoc($get_timet_info_do)) {

		$appointments = json_decode($row["appointments"]);
	}

	$st = $_POST["st_t"];
	$ed = $_POST["ed_t"];
	$exact_date = $_POST["date_to_select"];
	$min_fencer = $_POST["min_fencer"];

	//update timetable with st and ed
	$get_timet_info = "SELECT * FROM tournaments WHERE id = $t_id";
	$get_timet_info_do = mysqli_query($connection, $get_timet_info);

	if ($row = mysqli_fetch_assoc($get_timet_info_do)) {

		$dates = json_decode($row["timetable"]);
	}
	$st_id = $exact_date . "_st";
	$ed_id = $exact_date . "_ed";
	$dates->$st_id = $st;
	$dates->$ed_id = $ed;

	var_dump($dates);

	//updatedb
	$string = json_encode($dates);
	$qry_update = "UPDATE tournaments SET timetable = '$string' WHERE id = '$t_id'";
	$do_upadte = mysqli_query($connection, $qry_update);

	$period = new DatePeriod(

		new DateTime($st . ':00'),
		new DateInterval('PT' . $min_fencer . "M"),
		new DateTime(date('H:i', strtotime($ed . ':00')))


	);

	foreach ($period as $key => $value) {

		$hourmin = $value->format('H:i');
		$appointments->$exact_date->$hourmin = new stdClass;

		//echo $value->format('H:i') . "<br>";
	}

	$appointments->$exact_date->min_fencer = $min_fencer;

	$appointments = json_encode($appointments);

	$qry_update_appointments = "UPDATE tournaments SET appointments = '$appointments' WHERE id = $t_id";
	$qry_update_appointments_do = mysqli_query($connection, $qry_update_appointments);

	//header("Location: tournament_timetable.php?t_id=$t_id");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CC Create Competition</title>
	<link rel="stylesheet" href="../css/basestyle.min.css">
	<link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body class="fencers">
	<?php include "includes/header.php"; ?>
	<div class="modal_wrapper hidden" id="modal_1">
		<div class="modal">
			<div class="modal_header red">
				<p class="modal_title">Editing Tournament's starting date and ending date will remove all weapon control phrases</p>
			</div>
			<div class="modal_footer">
				<p class="modal_footer_text">This change cannot be undone.</p>
				<div class="modal_footer_content">
					<button type="button" class="modal_decline_button" onclick="toggleModal(1)">Cancel</button>
					<button type="submit" class="modal_confirmation_button">Okay</button>
				</div>
			</div>
		</div>
	</div>
	<div class="panel">
		<div id="title_stripe">
			<p class="page_title">Tournament's Timetable</p>
			<div class="stripe_button_wrapper">
				<button type="button" class="stripe_button" onclick="history.back()">
					<p>Go back</p>
					<img src="../assets/icons/close_black.svg"/>
				</button>
				<button type="submit" name="save" form="tournament_timetable" class="stripe_button primary">
					<p>Save</p>
					<img src="../assets/icons/save_black.svg"/>
				</button>
			</div>
		</div>
		<div id="panel_main">
			<form id="tournament_timetable" class="form_wrapper" action="" method="POST">

				<?php

				$get_timet_info = "SELECT * FROM tournaments WHERE id = $t_id";
				$get_timet_info_do = mysqli_query($connection, $get_timet_info);


				if ($row = mysqli_fetch_assoc($get_timet_info_do)) {

					$dates = json_decode($row["timetable"]);
				}

				$get_app_info = "SELECT * FROM tournaments WHERE id = $t_id";
				$get_app_info_do = mysqli_query($connection, $get_app_info);


				if ($row = mysqli_fetch_assoc($get_app_info_do)) {

					$appointments = json_decode($row["appointments"]);
				}

				?>

				<div>
					<div>
						<label for="">STARTING DATE</label>
						<input type="date" class="start_date_input" name="start_date_input" value="<?php echo $dates->start_date; ?>">
					</div>
					<div>
						<label for="">ENDING DATE</label>
						<input type="date" class="end_date_input" name="end_date_input" value="<?php echo $dates->end_date; ?>">
					</div>
				</div>
				<div>
					<div>
						<label for="">TYPE OF APPOINTMENT BOOKING</label>
						<div class="option_container">
							<input type="radio" <?php if (isset($dates->type_of_booking) && $dates->type_of_booking == 'team') {
													echo "checked";
												} ?> class="option_button" name="type_of_booking" id="teams" value="team"/>
							<label for="teams">Book appointment as teams</label>
							<input type="radio" <?php if (isset($dates->type_of_booking) && $dates->type_of_booking == 'fencer') {
													echo "checked";
												} ?> class="option_button" name="type_of_booking" id="fencers" value="fencer"/>
							<label for="fencers">Book appointment as fencers</label>
						</div>
					</div>
					<div>
						<button type="button" onclick="toggleWcPhase()" id="add_new_wc_button">Add New Weapon Control Phase</button>
					</div>
				</div>
			</form>

			<form id="tournament_weapon_control" class="form_wrapper hidden" action="" method="POST">
				<div>
					<div>
						<label for="">DATE</label>
						<div class="search_wrapper narrow">
							<button type="button" class="search select input" onfocus="isOpen(this)" onblur="isClosed(this)" tabindex="3">
								<input type="text" name="date_to_select" placeholder="Select Date">
							</button>
							<button type="button"><img src="../assets/icons/arrow_drop_down_black.svg"></button>
							<div class="search_results">

								<?php

								$period = new DatePeriod(

									new DateTime($dates->start_date),
									new DateInterval('P1D'),
									new DateTime(date('Y-m-d', strtotime($dates->end_date . "+1 days")))
								);

								foreach ($period as $key => $value) {

									if ($key == "min_fencer") {
										continue;
									}

									$checker = 0;

									$dateshow = $value->format('Y-m-d');

									if ($appointments != "") {

										foreach ($appointments as $keydate => $timevalue) {

											if ($keydate == $dateshow) {

												$checker++;
											}
										}
									}

									if ($checker == 0) {
								?>

										<button type="button" onclick="selectSystem(this)"><?php echo $dateshow; ?></button>

								<?php }
								} ?>
							</div>
						</div>
					</div>
					<div>
						<label for="">STARTING TIME</label>
						<input type="time" class="" name="st_t" step="3600">
					</div>
					<div>
						<label for="">ENDING TIME</label>
						<input type="time" class="" name="ed_t" step="3600">
					</div>
					<div>
						<label for="">MINUTE / FENCER</label>
						<input type="number" class="number_input centered" placeholder="#" name="min_fencer" step="1">
					</div>
					<div class="row">
						<button class="panel_submit secondary relative" type="button" onclick="toggleWcPhase()">Cancel</button>
						<input type="submit" value="Add" class="panel_submit relative" name="new_weapon_control">
					</div>
				</div>
			</form>
			<div class="wrapper" id="wc_phases_table">
				<label for="">WEAPON CONTROL PHASES</label>
				<table class="full" id="wc_phrases_table">
					<thead>
						<tr>
							<th>
								<p>DATE</p>
							</th>
							<th>
								<p>STARTING TIME</p>
							</th>
							<th>
								<p>ENDING TIME</p>
							</th>
							<th>
								<p>MIN. / FENCER</p>
							</th>
						</tr>
					</thead>
					<tbody>

						<?php

						if ($appointments != "") {

							foreach ($appointments as $keydate => $timevalue) {

								if ($keydate == "min_fencer") {
									continue;
								}

						?>
								<tr>
									<td><?php echo $keydate ?></td>

									<?php

									$timearray = [];
									$valuearray = [];

									foreach ($timevalue as $keyvalue => $empty) {

										array_push($timearray, $keyvalue);
										array_push($valuearray, $empty);
									}
									?>
									<td><?php echo $timearray[0]; ?></td>
									<td><?php echo $timearray[count($timearray) - 2]; ?></td>

									<td><?php echo end($valuearray) ?></td>
								</tr
						<?php
							}
						}

						?>
					</tbody>
				</table>
			</div>



			<?php

			if (isset($dates->start_date) && isset($dates->end_date) && isset($dates->type_of_booking)) {

			?>
				<!--
				<form id="tournament_weapon_control" class="form_wrapper" action="" method="POST">
					<div>
						<div>
							<label for="">DATE</label>
							<div class="search_wrapper narrow">
								<button type="button" class="search select input" tabindex="3">
									<input type="text" name="date_to_select" placeholder="Select Date">
								</button>
								<button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
								<div class="search_results">

									<?php

									$period = new DatePeriod(

										new DateTime($dates->start_date),
										new DateInterval('P1D'),
										new DateTime(date('Y-m-d', strtotime($dates->end_date . "+1 days")))
									);

									foreach ($period as $key => $value) {

										if ($key == "min_fencer") {
											continue;
										}

										$checker = 0;

										$dateshow = $value->format('Y-m-d');

										if ($appointments != "") {

											foreach ($appointments as $keydate => $timevalue) {

												if ($keydate == $dateshow) {

													$checker++;
												}
											}
										}

										if ($checker == 0) {
									?>

											<button type="button" onclick="selectSystem(this)"><?php echo $dateshow; ?></button>

									<?php }
									} ?>
								</div>
							</div>
						</div>
						<div>
							<label for="">STARTING TIME</label>
							<input type="time" class="" name="st_t" step="">
						</div>
						<div>
							<label for="">ENDING TIME</label>
							<input type="time" class="" name="ed_t" step="">
						</div>
						<div>
							<label for="">MINUTE / FENCER</label>
							<input type="number" class="number_input centered" placeholder="#" name="min_fencer" step="">
						</div>
						<input type="submit" value="Add" class="panel_submit" name="new_weapon_control">
					</div>
				</form>
								-->
			<?php } ?>

		</div>
	</div>
	<script src="javascript/cookie_monster.js"></script>
<script src="javascript/main.js"></script>
	<script src="javascript/list.js"></script>
	<script src="javascript/competitions.js"></script>
	<script src="javascript/search.js"></script>
	<script src="javascript/tournament_timetable.js"></script>
	<script src="javascript/modal.js"></script>
</body>
</html>