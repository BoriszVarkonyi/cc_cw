<?php
    if(isset($_GET['type'])) {
        $type = filter_input(INPUT_GET, 'type');
    } else {
        $type = 0;
    }
    if(isset($_GET['q'])) {
        $q = filter_input(INPUT_GET, 'q');
    }
    if(isset($_GET['year'])) {
        $yearInput = filter_input(INPUT_GET, 'year');
    }
    if(isset($_GET['sex'])) {
        $sex = filter_input(INPUT_GET, 'sex');
    }
    if(isset($_GET['weapon'])) {
        $weapon = filter_input(INPUT_GET, 'weapon');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ongoing competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="ongoing_competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>Ongoing competitions</h1>
            </div>
            <div id="content_wrapper">
                <?php include "views/SearchForm.php" ?>
                <!-- buttons menu -->
                <div id="competition_color_legend">
                    <button id="registration_lengend" value="Registration Finished" aria-label="Select Registration Finished"></button>
                    <p>Registration Finished</p>
                    <button id="pools_lengend" value="Ongoing Pools" aria-label="Select Ongoing Pools"></button>
                    <p>Ongoing Pools</p>
                    <button id="table_lengend" value="Ongoing Table" aria-label="Select Ongoing Table"></button>
                    <p>Ongoing Table</p>
                </div>
                <?php include "views/CompDisplay.php" ?>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/ongoing_competitions.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>
