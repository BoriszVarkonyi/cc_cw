<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php include "../includes/pool_orders.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php
	//get competitors data
	$qry_get_competitors = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
	$do_get_competitors = mysqli_query($connection, $qry_get_competitors);

	if ($row = mysqli_fetch_assoc($do_get_competitors)) {
		$compet_string = $row['data'];
		$compet_json = json_decode($compet_string);
	}


    //get competition data
    $qry_get_comp_data = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $do_get_comp_data = mysqli_query($connection, $qry_get_comp_data);

    if ($row = mysqli_fetch_assoc($do_get_comp_data)) {
        $comp_name = $row['comp_name'];
        $comp_type = weaponConverter($row['comp_weapon']);
        $comp_sex = strtoupper(sexConverter($row['comp_sex']));
        $comp_start = $row['comp_start'];
    }
	//get pool data from pools (fencers and matches)
	$qry_get_fencer_data = "SELECT `fencers`,`matches`,`pool_of` FROM `pools` WHERE `assoc_comp_id` = '$comp_id'";
	$do_get_fencer_data = mysqli_query($connection, $qry_get_fencer_data);

	if ($row = mysqli_fetch_assoc($do_get_fencer_data)){
		$fencer_string = $row['fencers'];
		$fencer_table = json_decode($fencer_string);
		$matches_string = $row['matches'];
		$matches_table = json_decode($matches_string);
		$pool_of = $row['pool_of'];
	}

    $pool_num = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Pool Matches</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_paper_style.min.css">
    <link rel="stylesheet" href="../css/print_pool_matches_style.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Print Pool Matches</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button bold" onclick="window.close()" shortcut="SHIFT+C">
                        <p>Close Page</p>
                        <img src="../assets/icons/close_black.svg"/>
                    </button>
                    <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                        <p>Print All Pools</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                </div>

                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg"/>
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main" class="loose">
                <div>
					<?php
						for($pool_num = 1; $pool_num < count($fencer_table);$pool_num++) {

								$current_pool = $fencer_table[$pool_num];
								$piste_name = $current_pool -> piste;
								$ref1_name = $current_pool -> ref1 -> prenom . " " . $current_pool -> ref1 -> nom;
								if ($current_pool -> ref2 != null) {
									$ref2_name = $current_pool -> ref2 -> prenom . " " . $current_pool -> ref2 -> nom;
								}
								$time = $current_pool -> time;

								//get fencers array abc
								$array_of_names = [];
								for ($i = 1; $i <= $pool_of; $i++) {
									$array_of_names[$i] = $current_pool -> {$i} -> prenom_nom;
								}

							?>
								<div id="pool_print_wrapper" class="paper_wrapper">

									<div class="pool_print" class="paper">
										<div class="title_container">
											<div><p class="title">Pool no.: <?php echo $pool_num ?></p></div>
											<div class="pool_info">
												<div>
													<p class="info_label">PISTE:</p>
													<p><?php echo $piste_name ?></p>
												</div>
												<div>
													<p class="info_label">REFEREES:</p>
													<p><?php echo $ref1_name ?></p>
													<?php if (isset($ref2_name)) {
														?><p><?php echo $ref2_name ?></p><?php
													} ?>
												</div>
												<div>
													<p class="info_label">TIME:</p>
													<p><?php echo $time ?></p>
												</div>
											</div>
											<div class="comp_info">
												<p class="info_label"><?php echo $comp_name ?></p>
												<div>
													<!-- sex -->
													<p><?php echo $comp_sex ?></p>
													<!-- wt -->
													<p><?php echo $comp_type ?></p>
												</div>
												<!-- starting year -->
												<p><?php echo substr($comp_start,0,4) ?></p>
											</div>
										</div>
										<div class="paper_content">
											<div class="pool_matches">
												<?php
													$poolOrder = poolOrder($pool_of);
													$counter = 1;
													foreach ($poolOrder as $match_order) {
														$order_array = explode('-', $match_order);
														$current_match = $matches_table[$pool_num] -> {$order_array[0]} -> {$order_array[1]};
														$f1_id = $current_match -> id;
														$f2_id = $current_match -> enemy;

														if (($id_to_find = findObject($compet_json, $f1_id, "id")) !== false) {
															$f1_name = $compet_json[$id_to_find] -> prenom . " " . $compet_json[$id_to_find] -> nom;
														}

														if (($id_to_find = findObject($compet_json, $f2_id, "id")) !== false) {
															$f2_name = $compet_json[$id_to_find] -> prenom . " " . $compet_json[$id_to_find] -> nom;
														}
												?>
														<div class="pool_match">
															<div class="number">
																<p><?php echo $counter . "." ?></p>
															</div>
															<div class="numbering">
																<p>1.</p>
																<p>2.</p>
															</div>
															<div class="names">
																<p><?php echo $f1_name ?></p>
																<p><?php echo $f2_name ?></p>
															</div>
															<div class="grid">
																<div></div>
																<div></div>
															</div>
														</div>
												<?php
														$counter++;
													}
												?>
											</div>
											<div class="signatures">
												<div class="grid_table fencers">
													<div class="grid_header">
														<div class="grid_header_text">FENCER'S NAME</div>
														<div class="grid_header_text square">No.</div>
														<?php
															for ($x = 1; $x <= $pool_of; $x++) {
																?><div class="grid_header_text square"><?php echo $x ?></div><?php
															}
														?>

														<div class="grid_header_text signature">SIGNATURE</div>
													</div>
													<div class="grid_row_wrapper">
														<?php
															for ($y = 1; $y <= $pool_of; $y++) {
														?>
														<div class="grid_row">
															<div class="grid_item"><?php echo $array_of_names[$y] ?></div>
															<div class="grid_item square header"><?php echo $y ?></div>
															<?php
																for ($x = 1; $x <= $pool_of; $x++) {
																	if ($x == $y) {
																		$echo = "filled";
																	} else {
																		$echo = "";
																	}
															?>
															<div class="grid_item square <?php echo $echo ?>"></div>
															<?php } ?>
															<div class="grid_item signature"></div>
														</div>
														<?php } ?>
													</div>
												</div>
												<div class="grid_table referees">
													<div class="grid_header">
														<div class="grid_header_text">REFEREE'S NAME</div>
														<div class="grid_header_text signature">SIGNATURE</div>
													</div>

													<!-- need ref name and only show ref2  -->
													<div class="grid_row_wrapper">
														<div class="grid_row">
															<div class="grid_item"><?php echo $ref1_name ?></div>
															<div class="grid_item signature"></div>
														</div>
														<?php
															if ($current_pool -> ref2 != null) {
														?>
														<div class="grid_row">
															<div class="grid_item"><?php echo $ref2_name ?></div>
															<div class="grid_item signature"></div>
														</div>
														<?php } ?>
													</div>


												</div>
											</div>
										</div>
									</div>
								</div>

							<?php
						}
					?>

                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/print_pools.js"></script>
    <script src="../js/print.js"></script>
</body>
</html>