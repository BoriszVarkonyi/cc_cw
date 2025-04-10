<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    //create table
    $qry_make_table = "CREATE TABLE `ccdatabase`.`call_room_wc` ( `fencer_id` VARCHAR(11) NOT NULL , `assoc_comp_id` INT(11) NOT NULL , `last_table` VARCHAR(3) NOT NULL DEFAULT 0 , `issues_array` VARCHAR(255) NULL DEFAULT NULL , `notes` TEXT NOT NULL, PRIMARY KEY (`fencer_id`, `assoc_comp_id`)) ENGINE = InnoDB;";
    $do_make_table = mysqli_query($connection, $qry_make_table);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Callroom</title>
	<link rel="stylesheet" href="../css/basestyle.min.css">
	<link rel="stylesheet" href="../css/mainstyle.min.css">
	<link rel="stylesheet" href="../css/table_style.min.css">
	<link rel="stylesheet" href="../css/print_style.min.css" media="print">
	<link rel="stylesheet" href="../css/print_table_style.min.css" media="print">
</head>
<body>
	<?php include "includes/navigation.php"; ?>
	<main>
		<div id="title_stripe">
			<p class="page_title">Callroom</p>
			<div class="stripe_button_wrapper">
				<a class="stripe_button blue " href="/cc/callroom_statistics.php?comp_id=<?php echo $comp_id; ?>" target="_blank" id="callroom_statistics_button" shortcut="SHIFT+W">
					<p>Callroom Statistics</p>
					<img src="../assets/icons/pie_chart_black.svg" />
				</a>
			</div>
		</div>
		<div id="page_content_panel_main">
			<div id="call_room" class="cc">
				<div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
					<img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
				</div>
				<div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
					<img src="../assets/icons/arrow_forward_ios_black.svg">
				</div>

				<?php

				$qry_get_table = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
				$qry_get_table_do = mysqli_query($connection, $qry_get_table);

				if ($row = mysqli_fetch_assoc($qry_get_table_do)) {

					$out_table = json_decode($row["data"]);
				}
				$r_counter = 1;

				foreach ($out_table as $key => $tablerounds) {

					if ($key == "t_1") {
						break;
					}

				?>
						<div id="e_<?php echo $r_counter ?>" class="elimination">
							<div class="elimination_label">Table of <?php echo ltrim($key, "t_") ?></div>
							<?php

							$check = ltrim($key, "t_");

							if ($check >= 8) {

								$change_every = $check / 8;
							} else {
								$change_every = 0;
							}
							$innercounter = 0;
							$changecounter = 1;
							foreach ($tablerounds as $keyofmatch => $tablematches) {

								if ($innercounter == $change_every) {

									$changecounter++;
									$innercounter = 0;
								}
								if ($check >= 8) {

									$writecolor = tablecolor($changecounter);
								} else {

									$writecolor = "Purple";
								}
							?>

								<div class="table_round_wrapper finished <?php echo $writecolor ?>" id="<?php echo $key . "_" . $keyofmatch ?>" tabindex="1">
									<div class="table_round">

										<?php
										$firstrun = 0;
										foreach ($tablematches as $fencerkey => $tablefencer) {
											if ($fencerkey == "referees" || $fencerkey == "pistetime") {
												continue;
											}


											//check for callroom  in this table
											$checked = false;
											if (isset($tablefencer -> id)) {
												$set = true;
												if ($tablefencer -> isWinner) {

													$fencer_id = $tablefencer -> id;
													$qry_select_last_table = "SELECT last_table, issues_array FROM call_room_wc WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id'";
													$do_select_last_table = mysqli_query($connection, $qry_select_last_table);
													if (mysqli_num_rows($do_select_last_table)) {
														$checked = mysqli_fetch_assoc($do_select_last_table)['last_table'] <= substr($key,2);
													}
												}
											} else {
												$set = false;
											}

											$foo = substr($key,2);
										?>
											<a class="table_fencer" <?php if ($set) { if ($tablefencer -> isWinner) { ?>href='<?php echo "/cc/fencers_callroom.php?comp_id=$comp_id&fencer_id=$fencer_id&t=$foo" ?>'<?php }} ?>>
												<div class="table_fencer_number">
													<p><?php echo $fencerkey ?></p>
												</div>

												<div class="table_fencer_name">
													<p><?php echo isset($tablefencer->name) ? $tablefencer->name : "" ?></p>
												</div>
												<div class="table_fencer_nat">
													<p><?php echo isset($tablefencer->nation) ? $tablefencer->nation : "" ?></p>
												</div>
													<?php if ($set) {
														if ($checked && $tablefencer -> isWinner) {
													?>
														<div class="table_callroom green">
															<img src="../assets/icons/check_circle_black.svg">
														</div>
														<?php } elseif ($tablefencer -> isWinner) { ?>

														<div class="table_callroom red">
															<img src="../assets/icons/cancel_black.svg">
														</div>
													<?php }} ?>
											</a>
											<?php
											if ($firstrun == 0) { ?>
												<div class="table_round_info">
													<div>
														<p>Ref: <?php echo $tablematches->referees->ref->name ?> (<?php echo $tablematches->referees->ref->nation ?>)</p>
														<p><?php echo $tablematches->pistetime->time ?></p>
													</div>
													<div>
														<p>VRef: <?php echo $tablematches->referees->vref->name ?> (<?php echo $tablematches->referees->vref->nation ?>)</p>
														<p>Piste: <?php echo $tablematches->pistetime->pistename ?></p>
													</div>
												</div>
										<?php }
											$firstrun++;
										} ?>
									</div>

								</div>
							<?php $innercounter++;
							} ?>
						</div>

					<?php
						$r_counter++;
					}
					?>

				<div id="winner" class="elimination">
					<div class="elimination_label">Table of __</div>
					<div class="table_round_wrapper finished purple">
						<div class="table_round" onclick="tableRoundConfig(this)">
							<div class="table_fencer">
								<div class="table_fencer_number">
									<p>1</p>
								</div>
								<div class="table_fencer_name">
									<p><?php
										$firstplace = "1";
										echo isset($out_table->t_1->m_1->$firstplace->name) ? $out_table->t_1->m_1->$firstplace->name : "" ?></p>
								</div>
								<div class="table_fencer_nat">
									<p><?php echo isset($out_table->t_1->m_1->$firstplace->nation) ? $out_table->t_1->m_1->$firstplace->nation : "" ?></p>
								</div>
							</div>
						</div>
					</div>

			</div>

		</div>
	</main>
	<script src="javascript/cookie_monster.js"></script>
	<script src="javascript/main.js"></script>
	<script src="javascript/overlay_panel.js"></script>
	<script src="javascript/table_individual.js"></script>
	<script src="javascript/search.js"></script>
	<script src="javascript/print.js"></script>
</body>
</html>