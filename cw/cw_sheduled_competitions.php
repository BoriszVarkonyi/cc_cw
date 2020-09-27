<?php include "cw_header.php"; ?>
<?php $statusofpage = 1; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sheduled Competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <p class="cw_panel_title">SHEDULED COMPETITIONS</p>
        <form id="browsing_bar">

            <!-- search by name box -->
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="search" name="" id="" placeholder="Search by name">

            <!-- year drop-down -->
            <div class="select_input">
                <button type="button" onclick="toggleYearSelect()">
                    <p>-Year-</p>
                    <input type="text" value="">
                </button>
                <div id="year_select_dropdown" class="closed">
                    <button type="button">2020</button>
                    <button type="button">2019</button>
                    <button type="button">2018</button>
                    <button type="button">2017</button>
                    <button type="button">2016</button>
                    <button type="button">2015</button>
                </div>
            </div>

            <!-- sex drop-down -->
            <div class="select_input">
                <button type="button" onclick="toggleSexSelect()">
                    <p>-Sex-</p>
                    <input type="text" value="">
                </button>
                <div id="sex_select_dropdown" class="closed">
                    <button type="button">Male</button>
                    <button type="button">Female</button>
                </div>
            </div>

            
            <!-- weapon type drop-down -->
            <div class="select_input">
                <button type="button" onclick="toggleWTSelect()">
                    <p>-Weapon Type-</p>
                    <input type="text" value="">
                </button>
                <div id="wt_select_dropdown" class="closed">
                    <button type="button">Epee</button>
                    <button type="button">Foil</button>
                    <button type="button">Sabre</button>
                </div>
            </div>

            <input type="submit" value="Search">
        </form>

        <div class="cw_table_wrapper competitions">

            <!-- comps display scheduled -->
            <?php include "../cw/comps_display.php" ?>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/competitions.js"></script>
</html>