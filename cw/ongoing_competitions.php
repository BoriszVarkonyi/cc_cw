<?php $statusofpage = 3; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ongoing competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="ongoing_competitions">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">Ongoing competitions</p>
                </div>
                <form id="browsing_bar">
                    <!-- search by name box -->
                    <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
                    <input type="text" name="" placeholder="Search by Name" class="search">
                    <input type="submit" value="Search">
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
        </div>
        <?php include "cw_footer.php"; ?>
        </div>
    </div>
<script src="../js/cw_main.js"></script>
<script src="../js/list.js"></script>
</body>
</html>
