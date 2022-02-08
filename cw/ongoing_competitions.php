<?php $statusofpage = 3; ?>

<?php
    if(isset($_GET['q'])) {
        $q = filter_input(INPUT_GET, 'q');
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
                <form id="browsing_bar">
                    <!-- search by name box -->
                    <div class="search_wrapper wide">
                        <input type="text" name="q" placeholder="Search by Title" class="search page alt" value="<?php if(isset($_GET['q'])) echo $q ?>">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                    <input type="button" value="Search" onclick="cwSearchEngine()">
                </form>
                <!-- buttons menu -->
                <div id="competition_color_legend">
                    <button id="registration_lengend" value="Registration Finished" aria-label="Select Registration Finished"></button>
                    <p>Registration Finished</p>
                    <button id="pools_lengend" value="Ongoing Pools" aria-label="Select Ongoing Pools"></button>
                    <p>Ongoing Pools</p>
                    <button id="table_lengend" value="Ongoing Table" aria-label="Select Ongoing Table"></button>
                    <p>Ongoing Table</p>
                </div>
                <?php include "../cw/comps_display.php" ?>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="javascript/ongoing_competitions.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>
