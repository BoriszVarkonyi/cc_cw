<?php $statusofpage = 3; ?>

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
    <?php include "cw_header.php"; ?>
    <main role="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">Ongoing competitions</p>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <!-- search by name box -->
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg"></button>
                    </div>
                    <input type="button" value="Search" onclick="cwSearchEngine()">
                </form>
                <!-- buttons menu -->
                <div id="competition_color_legend">
                    <button id="registration_lengend" value="Registration Finished"></button>
                    <p>Registration Finished</p>
                    <button id="pools_lengend" value="Ongoing Pools"></button>
                    <p>Ongoing Pools</p>
                    <button id="table_lengend" value="Ongoing Table"></button>
                    <p>Ongoing Table</p>
                </div>
                <?php include "../cw/comps_display.php" ?>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/cw_ongoing_competitions.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>
