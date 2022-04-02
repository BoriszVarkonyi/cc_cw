<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php require_once "models/TechnicianFactory.php"; ?>
<?php ob_start(); ?>
<?php

//create table
$qry_create_table = "CREATE TABLE `ccdatabase`.`technicians` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL DEFAULT '[ ]' , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$do_create_table = mysqli_query($connection, $qry_create_table);
echo mysqli_error($connection);

//get technicians
$technicianFactory = new TechnicianFactory($connection);

//set up new technician
if (isset($_POST['submit_tech'])) {
	$username = $_POST["username"];
	$name = $_POST['name'];
	$role = $_POST["role"];

	$technicianFactory->addNewTechnician($comp_id, $username, $name, $role);
}

//delete technicians
if (isset($_POST['remove_technician'])) {
	$username = filter_input(INPUT_POST, "id");
	$technicianFactory->deleteTechnician($username, $comp_id);
}

//import technicians
if (isset($_POST['submit_import'])) {
	$id = $_POST['selected_comp_id'];

	$query_select_imported = "SELECT * FROM technicians WHERE assoc_comp_id = '$id'";
	$do_get_imported_techs = mysqli_query($connection, $query_select_imported);

	while($row = mysqli_fetch_assoc($do_get_imported_techs)) {
		$username = $row['username'];
		$name = $row['name'];
		$role = $row['role'];
		$pass = $row['pass'];
		echo "PERSON: $username, $name, $role, $pass";
		$insert_query = "INSERT INTO technicians (assoc_comp_id, username, name, role, pass, online) VALUES ($comp_id, '$username', '$name', $role, '$pass', 0)";
		mysqli_query($connection, $insert_query);
	}

	//header("Refresh: 0");
}
header('charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Technicians</title>
	<link rel="stylesheet" href="../css/basestyle.min.css">
	<link rel="stylesheet" href="../css/mainstyle.min.css">
	<link rel="stylesheet" href="../css/print_style.min.css" media="print">
	<link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>
<body>
	<?php include "includes/navbar.php"; ?>
	<main>
		<div id="title_stripe">
			<p class="page_title">Technicians</p>
			<div class="stripe_button_wrapper">
				<button name="import_tech" form="import_tech_button" type="submit" class="stripe_button" onclick="toggleImportPanel()" shortcut="SHIFT+I" id="importTechBt">
					<p>Import Technicians from Your Competitions</p>
					<img src="../assets/icons/save_alt_black.svg" />
				</button>
				<button class="stripe_button primary" type="button" onclick="window.print()" id="printTechBt" shortcut="SHIFT+P">
					<p>Print Technicians</p>
					<img src="../assets/icons/print_black.svg" />
				</button>
				<button class="stripe_button red" form="remove_technician" name="remove_technician" id="remove_technician_button" shortcut="SHIFT+R">
					<p>Remove Technician</p>
					<img src="../assets/icons/delete_black.svg" />
				</button>
				<button class="stripe_button primary" onclick="toggleAddPanel()" id="addTechBt" shortcut="SHIFT+A">
					<p>Add Technician</p>
					<img src="../assets/icons/add_black.svg" />
				</button>
			</div>

			<div id="import_technician_panel" class="overlay_panel hidden">
				<button class="panel_button" name="Close panel" onclick="toggleImportPanel()">
					<img src="../assets/icons/close_black.svg">
				</button>
				<form action="" id="import_technician" method="POST" class="overlay_panel_form" autocomplete="off">
					<input type="text" name="selected_comp_id" id="selected_comp_input" class="hidden" readonly>
					<table class="small">
						<thead>
							<tr>
								<th>
									<p>NAME</p>
								</th>
							</tr>
						</thead>
						<tbody class="alt">
							<?php
							//qry
							$qry_get_tables = "SELECT DISTINCT assoc_comp_id FROM technicians;";
							$do_get_tables = mysqli_query($connection, $qry_get_tables);

							while ($row = mysqli_fetch_assoc($do_get_tables)) :
								$id_to_get = $row['assoc_comp_id'];

								if ($id_to_get != $comp_id) :
									$get_comp_data = "SELECT comp_name FROM competitions WHERE comp_id = '$id_to_get';";
									$do_get_comp_data = mysqli_query($connection, $get_comp_data);

									if ($row = mysqli_fetch_assoc($do_get_comp_data)) {
										$comp_name = $row['comp_name'];
									}
							?>
									<tr id="<?php echo $id_to_get; ?>" onclick="selectForImport(this)">
										<td id="in_<?php echo $id_to_get; ?>">
											<p><?php echo $comp_name; ?></p>
										</td>
									</tr>

							<?php endif ?>
							<?php endwhile ?>
						</tbody>
					</table>
					<button type="submit" name="submit_import" class="panel_submit" form="import_technician" value="Import">Import</button>
				</form>
			</div>

			<form action="" method="POST" id="remove_technician">
				<input type="text" name="id" class="selected_list_item_input hidden" id="selected_row_input" readonly>
			</form>

			<div id="add_technician_panel" class="overlay_panel hidden">
				<button class="panel_button" name="Close panel" onclick="toggleAddPanel()">
					<img src="../assets/icons/close_black.svg">
				</button>
				<form class="overlay_panel_form" autocomplete="off" action="technicians.php?comp_id=<?php echo $comp_id; ?>" method="POST" id="new_technician" autocomplete="off">
					<label for="name">NAME</label>
					<input type="text" placeholder="Type the technician's name" class="username_input" name="name">

					<label for="username">USERNAME</label>
					<input type="text" placeholder="Type the technician's username" class="username_input error username" name="username">

					<label for="">ROLE</label>
					<div class="option_container">
						<input type="radio" class="option_button" name="role" id="a" value="1" />
						<label for="a">Semi</label>
						<input type="radio" class="option_button" name="role" id="b" value="2" />
						<label for="b">DT</label>
						<input type="radio" class="option_button" name="role" id="c" value="3" />
						<label for="c">Weapon Control</label>
						<input type="radio" class="option_button" name="role" id="d" value="4" />
						<label for="d">Registration</label>
					</div>
					<button type="submit" name="submit_tech" class="panel_submit" form="new_technician">Save</button>
				</form>
			</div>
		</div>
		<div id="page_content_panel_main">
			<table class="wrapper">

				<?php
				$technicians = $technicianFactory->allFromCompetition($comp_id);
				if (count($technicians) == 0) :
				?>
					<div id="empty_content_notice">
						<p>You have no technicians set up!</p>
					</div>
				<?php else : ?>

					<thead>
						<tr>
							<th>
								<div class="search_panel">
									<div class="search_wrapper">
										<input type="text" onkeyup="searchInLists()" placeholder="Search by Name" class="search page">
										<button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
									</div>
								</div>
								<div class="table_buttons_wrapper">
									<button type="button" onclick="sortButton(this)">
										<img src="../assets/icons/switch_full_black.svg">
									</button>
									<p>NAME</p>
									<button type="button" onclick="searchButton(this)">
										<img src="../assets/icons/search_black.svg">
									</button>
								</div>
							</th>
							<th>
								<div class="search_panel">
									<div class="search_wrapper">
										<input type="text" onkeyup="searchInLists()" placeholder="Search by Username" class="search page">
										<button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
									</div>
								</div>
								<div class="table_buttons_wrapper">
									<button type="button" onclick="sortButton(this)">
										<img src="../assets/icons/switch_full_black.svg">
									</button>
									<p>USERNAME</p>
									<button type="button" onclick="searchButton(this)">
										<img src="../assets/icons/search_black.svg">
									</button>
								</div>
							</th>
							<th>
								<div class="search_panel option">
									<div class="search_panel_buttons">
										<button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
									</div>
									<div class="search_wrapper">
										<input type="text" onkeyup="searchInLists()" class="search hidden">
									</div>
									<div class="option_container">
										<input type="radio" name="status" id="listsearch_semi" value="Semi" />
										<label for="listsearch_semi">Semi</label>
										<input type="radio" name="status" id="listsearch_dt" value="DT" />
										<label for="listsearch_dt">DT</label>
										<input type="radio" name="status" id="listsearch_wc" value="Weapon Control" />
										<label for="listsearch_wc">Weapon Control</label>
										<input type="radio" name="status" id="listsearch_reg" value="Registration" />
										<label for="listsearch_reg">Registration</label>
									</div>
								</div>
								<div class="table_buttons_wrapper">
									<button type="button" onclick="sortButton(this)">
										<img src="../assets/icons/switch_full_black.svg">
									</button>
									<p>ROLE</p>
									<button type="button" onclick="searchButton(this)">
										<img src="../assets/icons/search_black.svg">
									</button>
								</div>
							</th>
							<th>
								<div class="search_panel option">
									<div class="search_panel_buttons">
										<button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
									</div>
									<div class="search_wrapper">
										<input type="text" onkeyup="searchInLists()" class="search hidden">
									</div>
									<div class="option_container">
										<input type="radio" name="status" id="listsearch_online" value="Online" />
										<label for="listsearch_online">Online</label>
										<input type="radio" name="status" id="listsearch_offline" value="Offline" />
										<label for="listsearch_offline">Offline</label>
									</div>
								</div>
								<div class="table_buttons_wrapper">
									<button type="button" onclick="sortButton(this)">
										<img src="../assets/icons/switch_full_black.svg">
									</button>
									<p>STATUS</p>
									<button type="button" onclick="searchButton(this)">
										<img src="../assets/icons/search_black.svg">
									</button>
								</div>
							</th>
							<th class="small">
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($technicians as $technician) :

							$username = $technician->username;
							$name = $technician->name;
							$role = $technician->role;
							$online  = $technician->online;
						?>
							<tr id="<?php echo $username; ?>" onclick="selectRow(this)" tabindex="0">
								<td>
									<p><?php echo $name; ?></p>
								</td>
								<td>
									<p><?php echo $username; ?></p>
								</td>
								<td>
									<p><?php echo roleConverter($role); ?></p>
								</td>
								<td>
									<p>
										<?php
										if ($online == 0)
											echo "Offline";
										else
											echo "Online";
										?>
									</p>
								</td>
								<td class="small <?php if ($online == 0) echo "red"; else echo "green"; ?>">
								</td> <!-- red or green style added to small_status item to inidcate status -->
							</tr>
						<?php endforeach ?>
					<?php endif ?>
					</tbody>
			</table>
		</div>
	</main>
	<script src="javascript/cookie_monster.js"></script>
	<script src="javascript/main.js"></script>
	<script src="javascript/technicans_referees.js"></script>
	<script src="javascript/list_2.js"></script>
	<script src="javascript/controls_2.js"></script>
	<script src="javascript/importoverlay.js"></script>
	<script src="javascript/overlay_panel.js"></script>
	<script src="javascript/list_search_2.js"></script>
	<script src="javascript/technicians.js"></script>
</body>
</html>