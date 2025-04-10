<?php include "includes/db.php" ?>
<?php ob_start(); ?>

<?php

if (isset($_POST["create_tournament"])) {

	$org_id = $_COOKIE["org_id"];
	$t_name = $_POST["tournament_name"];

	$qry_create_tournament = "INSERT INTO `tournaments`(`tournament_name`, `organiser_id`) VALUES ('$t_name',$org_id)";
	$qry_create_tournament_do = mysqli_query($connection, $qry_create_tournament);

	if (!$qry_create_tournament_do) {
		echo mysqli_error($connection);
	}

	header("Location: select_tournament.php");

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
	<div class="panel">
		<div id="title_stripe">
			<p class="page_title">Create new Tournament</p>
			<div class="stripe_button_wrapper">
				<button class="stripe_button" onclick="location.href='select_tournament.php'">
					<p>Cancel</p>
					<img src="../assets/icons/close_black.svg"/>
				</button>
				<button type="submit" name="create_tournament" form="create_tournament" class="stripe_button primary">
					<p>Create</p>
					<img src="../assets/icons/add_black.svg"/>
				</button>
			</div>
		</div>
		<div id="panel_main">
			<form id="create_tournament" class="form_wrapper" action="" method="POST">
				<div>
					<div>
						<label for="comp_name">NAME</label>
						<input type="text" placeholder="Type in the title" class="title_input" name="tournament_name" class="name_input" onblur="errorChecker(this)">
					</div>
					<div>
						<label for="">STARTING DATE</label>
						<input type="date" class="start_date_input" name="start_date_input" value="<?php echo $dates->start_date; ?>">
					</div>
					<div>
						<label for="">ENDING DATE</label>
						<input type="date" class="end_date_input" name="end_date_input" value="<?php echo $dates->end_date; ?>">
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="javascript/cookie_monster.js"></script>
	<script src="javascript/main.js"></script>
	<script src="javascript/create_tournament.js"></script>
</body>
</html>