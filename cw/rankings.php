<!--<?php include "cw_comp_getdata.php"; ?>-->

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
<body>
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">Ongoing competitions</p>
                </div>
                <form id="browsing_bar">
                    <div>
                        <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" placeholder="Search by Fencer" class="search">
                    </div>
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