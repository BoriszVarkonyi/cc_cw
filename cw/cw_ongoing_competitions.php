<?php include "cw_header.php"; ?>
<?php $statusofpage = 3; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ongoing Competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <p class="cw_panel_title">ONGOING COMPETITIONS</p>
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
        <div class="table">
            <div class="table_header">
                <div class="table_header_text">COMPETITION'S NAME</div>
                <div class="table_header_text">STARTING AND ENDING DATE</div>
                <div class="table_header_text">HOSTING COUNTRY</div>
                <div class="big_status_header"></div>
            </div>
            <div class="table_row_wrapper">
                <!-- comps display scheduled -->
                <?php include "../cw/comps_display.php" ?>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/list.js"></script>
</html>
