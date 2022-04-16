<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
	function dealWithTime($string, $whattogive)
	{
		$array = explode(':', $string);

		if ($whattogive == "h") {
			return $array[0];
		} else if ($whattogive == "m") {
			return $array[1];
		} else {
			return null;
		}
	}

	//get tournament id from comp_id
	$qry_get_tid = "SELECT ass_tournament_id FROM competitions WHERE comp_id = '$comp_id'";
	$do_get_tid = mysqli_query($connection, $qry_get_tid);
	if ($row = mysqli_fetch_assoc($do_get_tid)) {
		$t_id = $row['ass_tournament_id'];
	}

	//get appointments table
	$qry_select_app = "SELECT timetable, appointments FROM tournaments WHERE id = '$t_id'";
	$do_select_app = mysqli_query($connection, $qry_select_app);
	if ($row = mysqli_fetch_assoc($do_select_app)) {
		$appointment_string = $row['appointments'];
		$timetable_string = $row['timetable'];

		$appointments = json_decode($appointment_string);
		$timetable_obj = json_decode($timetable_string);
	}


?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Weapon Control</title>
	<link rel="stylesheet" href="../css/basestyle.min.css">
	<link rel="stylesheet" href="../css/mainstyle.min.css">
	<link rel="stylesheet" href="../css/print_style.min.css" media="print">
	<link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>
<body>
	<?php include "includes/navigation.php"; ?>
	<main>
		<div id="title_stripe">
			<p class="page_title">Weapon Control Bookings</p>
		</div>
		<div id="page_content_panel_main">
			<table class="wrapper">
			<?php
						foreach ($appointments as $day => $value) {
						?>
							<!-- ONE DAY -->
							<div class="appointment_day" id="day_<?php echo $day ?>">
								<p class="appointment_day_title"><?php echo $day ?></p>
								<input type="date" name="current_day" value="<?php echo $day ?>" hidden readonly>

								<!-- ONE APPOINTMENT-->


								<div class="appointment_table">
									<?php
									$c = 0;
									foreach ($appointments->$day as $time => $foo) {
										$c++;
									}
									$c = $c - 1;
									reset($appointments->$day);
									$start_hour = dealWithTime($timetable_obj->{$day . "_st"}, "h");
									$end_hour = dealWithTime($timetable_obj->{$day . "_ed"}, "h");
									for ($hour = $start_hour; $hour < $end_hour; $hour++) {
									?>
										<div class="appointment_row">
											<?php

											for ($minute = 0; $minute < 60; $minute += $value->min_fencer) {
												if (strlen($minute) == 1) {
													$minute = 0 . $minute;
												}
												if (strlen($hour) == 1) {
													$hour = 0 . $hour;
												}
												if (is_array($appointments->$day->{$hour . ":" . $minute})) {
													$class = "red";
												} else {
													$class = "green";
												}
												$kell = $hour . ":" . $minute;
											?>
												<div style="flex-direction: column;" class="appointment <?php echo $class ?>">
													<p><?php echo $hour . ":" . $minute ?></p>
													<p><?php if (gettype($value->$kell) == "object") {
														echo "";
													}else{
														echo $value->$kell[0];
													}


													?></p>
												</div>
											<?php
											}

											?>
										</div>
									<?php
									}
									?>
								</div>

								<!--
								<div class="appointment_wrapper">
									<input type="radio" name="appointments" id="appointment_1" value=""/>
									<label for="appointment_1">
										<div class="appointment" onclick="selectAppointment(this)">
											<p></p>
											<div>Choose</div>
										</div>
									</label>
									<div class="appointment_details hidden">
										<input type="time" name="time">
										<p> - 17:00</p>
										<p>ERROR</p>
									</div>
								</div>
							-->


							</div>
						<?php } ?>
			</table>
		</div>
	</main>
	<script src="javascript/cookie_monster.js"></script>
	<script src="javascript/main.js"></script>
	<script src="javascript/weapon_control_immediate.js"></script>
	<script src="javascript/list_2.js"></script>
	<script src="javascript/controls_2.js"></script>
	<script src="javascript/list_search_2.js"></script>
</body>
</html>