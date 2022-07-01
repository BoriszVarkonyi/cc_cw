<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{MATCH NAME}</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<!DOCTYPE html>
<body>
    <?php include "includes/navigation.php"; ?>
    <main>
        <div id="title_stripe">
            <p class="page_title">{MATCH NAME}</p>
			<form action="" class="stripe_button_wrapper">
				<a class="stripe_button bold" href="teams.php?comp_id=<?php echo $comp_id ?>">
                    <p>Go back to Matches</p>
                    <img src="../assets/icons/arrow_back_ios_black.svg" />
                </a>
				<button type="submit" class="stripe_button primary" name="" id="start_match_button" shortcut="SHIFT+S">
					<p>Start Match</p>
					<img src="../assets/icons/start_black.svg"/>
				</button>
			</form>
        </div>
        <div id="page_content_panel_main">
            <table class="wrapper">
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
								<p>MATCH</p>
								<button type="button" onclick="searchButton(this)">
									<img src="../assets/icons/search_black.svg">
								</button>
							</div>
						</th>
						<th>
							<div class="search_panel">
								<div class="search_wrapper">
									<input type="text" onkeyup="searchInLists()" placeholder="Search by Nation" class="search page">
									<button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
								</div>
							</div>
							<div class="table_buttons_wrapper">
								<button type="button" onclick="sortButton(this)">
									<img src="../assets/icons/switch_full_black.svg">
								</button>
								<p>PISTE</p>
								<button type="button" onclick="searchButton(this)">
									<img src="../assets/icons/search_black.svg">
								</button>
							</div>
						</th>
						<th>
							<div class="search_panel">
								<div class="search_wrapper">
									<input type="text" onkeyup="searchInLists()" placeholder="Search by Club" class="search page">
									<button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
								</div>
							</div>
							<div class="table_buttons_wrapper">
								<button type="button" onclick="sortButton(this)">
									<img src="../assets/icons/switch_full_black.svg">
								</button>
								<p>TIME</p>
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
									<input type="radio" name="status" id="listsearch_reg_reg" value="Registered"/>
									<label for="listsearch_reg_reg">Finished</label>
									<input type="radio" name="status" id="listsearch_reg_not_reg" value="Not registered"/>
									<label for="listsearch_reg_not_reg">Upcoming</label>
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
						<th class="square"></th>
					</tr>
				</thead>
                <tbody>

                    <tr id="">
						<td><p>Pool 1</p></td>
						<td><p>Red</p></td>
						<td><p>11:30</p></td>
						<td><p>Finished</p></td>
						<td class="square gray"></td>
					</tr>

                    <tr id="">
						<td><p>Pool 2</p></td>
						<td><p>Green</p></td>
						<td><p>12:30</p></td>
						<td><p>Upcoming</p></td>
						<td class="square green"></td>
					</tr>

                    <tr id="">
						<td><p>Példa vs Példa</p></td>
						<td><p>Red</p></td>
						<td><p>11:30</p></td>
						<td><p>Upcoming</p></td>
						<td class="square green"></td>
					</tr>

                </tbody>
            </table>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_2.js"></script>
    <script src="javascript/controls_2.js"></script>
    <script src="javascript/list_search_2.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>