<?php include "cw_header.php"; ?>
<?php $statusofpage = 2; ?>

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

        <div class="cw_table_wrapper competitions">
            <!-- comps display scheduled -->
            <?php include "../cw/comps_display.php" ?>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>
