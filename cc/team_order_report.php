<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$qry_check_row = "SELECT * FROM tables WHERE ass_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
	$json_string = $row['data'];
	$numofteams = $row['fencer_num'];
	$json_team_table = json_decode($json_string);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{Team name} Team Order Report</title>
	<link rel="stylesheet" href="../css/basestyle.min.css">
	<link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
	<?php include "includes/navigation.php"; ?>
	<main>
		<div id="title_stripe">
			<p class="page_title">{Team name} Team Order Report</p>
			<div class="stripe_button_wrapper">
				<form action="" method="POST" id="IDE KELL A FORM IDJE">
					<input type="text" class="selected_list_item_input hidden" name="selected_id" readonly>
				</form>

				<a class="stripe_button bold" href="team_order_reports.php?comp_id=<?php echo $comp_id ?>">
					<p>Go back to Team Order Reports</p>
					<img src="../assets/icons/arrow_back_ios_black.svg"/>
				</a>
				<button class="stripe_button primary" type="submit" form="team_order_report_wrapper">
					<p>Save</p>
					<img src="../assets/icons/save_black.svg"/>
				</button>
			</div>

		</div>
		<div id="page_content_panel_main">

			<div class="wrapper" id="team_order_report_panel">
				<div id="team_order_report_header">

				<?php

				// foreach($json_team_table as $key => $round){

				//	 if ($key == "r1" || $key == "r2" || $key == "r3") {
				//		 continue;
				//	 }



				// }

				//Átgondolni mert nem jó a szisztéma :C

				?>

					<a class="team_order_report_select green" href="">
						<p>T64</p>
					</a>
					<a class="team_order_report_select green" href="">
						<p>T32</p>
					</a>
					<a class="team_order_report_select current" href="">
						<p>T16</p>
					</a>
					<a class="team_order_report_select gray" href="">
						<p>T8</p>
					</a>
					<a class="team_order_report_select gray" href="">
						<p>T4</p>
					</a>
					<a class="team_order_report_select gray" href="">
						<p>T2</p>
					</a>
				</div>
				<form action="" id="team_order_report_wrapper">
					<div id="team_report_t64">
						<p>Use number between 1 - 3</p>
						<table class="fixed">
							<thead>
								<tr>
									<th>
										<p>NAME</p>
									</th>
									<th>
										<p>ORDER</p>
									</th>
									<th>
										<p>REPLACEMENT</p>
									</th>
								</tr>
							</thead>
							<tbody class="alt">
								<tr>
									<td>
										<p>NEVE</p>
									</td>
									<td>
										<input type="number" name="" placeholder="#">
									</td>
									<td>
										<input type="radio" name="replacement" id="fencer1">
										<label for="fencer1"></label>
									</td>
								</tr>
								<tr>
									<td>
										<p>NEVE</p>
									</td>
									<td>
										<input type="number" name="" placeholder="#">
									</td>
									<td>
										<input type="radio" name="replacement" id="fencer2">
										<label for="fencer2"></label>
									</td>
								</tr>
								<tr>
									<td>
										<p>NEVE</p>
									</td>
									<td>
										<input type="number" name="" placeholder="#">
									</td>
									<td>
										<input type="radio" name="replacement" id="fencer3">
										<label for="fencer3"></label>
									</td>
								</tr>
								<tr>
									<td>
										<p>NEVE</p>
									</td>
									<td>
										<input type="number" name="" placeholder="#">
									</td>
									<td>
										<input type="radio" name="replacement" id="fencer4">
										<label for="fencer4"></label>
									</td>
								</tr>
							</tbody>

						</table>
					</div>
				</form>
			</div>

		</div>
	</main>
	<script src="javascript/cookie_monster.js"></script>
	<script src="javascript/main.js"></script>
	<script src="javascript/list.js"></script>
	<script src="javascript/controls.js"></script>
	<script src="javascript/search.js"></script>
</body>
</html>