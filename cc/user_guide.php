<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>User Guide</title>
	<link rel="stylesheet" href="../css/basestyle.min.css">
	<link rel="stylesheet" href="../css/mainstyle.min.css">
	<link rel="stylesheet" href="../css/guide_style.min.css">
</head>
<body>
	<?php include "includes/navigation.php"; ?>
	<main>
		<div id="title_stripe">
			<p class="page_title">User Guide</p>
		</div>
		<div id="page_content_panel_main">
			<div id="guide_choose">
				<a class="guide_option" href="">
					<div>
						<img src="../assets/icons/menu_book_black.svg">
					</div>
					<div>
						<p>Documentation</p>
						<p>Everything you need to know in one place.</p>
					</div>
				</a>
				<a class="guide_option" href="">
					<div>
						<img src="../assets/icons/healing_black.svg">
					</div>
					<div>
						<p>Patch Notes</p>
						<p>See what updates we made!</p>
					</div>
				</a>
				<a class="guide_option" href="">
					<div>
						<img src="../assets/icons/people_black.svg">
					</div>
					<div>
						<p>About us</p>
						<p>Learn about the developers.</p>
					</div>
				</a>
			</div>
		</div>
	</main>
	<script src="javascript/cookie_monster.js"></script>
	<script src="javascript/main.js"></script>
</body>
</html>