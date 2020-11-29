<?php include "cw_header.php"; ?>
<?php $statusofpage = 2; ?>

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
            <input type="text" name="" placeholder="Search by Name" class="search">

            <!-- year drop-down -->
            <div class="select_input">
                <button type="button" onclick="toggleYearSelect()">
                    <p>-Year-</p>
                    <input type="text" value="">
                </button>
                <div id="year_select_dropdown" class="closed">
                    <button type="button" onclick="selectSystem(this)">2020</button>
                    <button type="button" onclick="selectSystem(this)">2019</button>
                    <button type="button" onclick="selectSystem(this)">2018</button>
                    <button type="button" onclick="selectSystem(this)">2017</button>
                    <button type="button" onclick="selectSystem(this)">2016</button>
                    <button type="button" onclick="selectSystem(this)">2015</button>
                </div>
            </div>

            <!-- sex drop-down -->
            <div class="select_input">
                <button type="button" onclick="toggleSexSelect()">
                    <p>-Sex-</p>
                    <input type="text" value="">
                </button>
                <div id="sex_select_dropdown" class="closed">
                    <button type="button" onclick="selectSystem(this)">Male</button>
                    <button type="button" onclick="selectSystem(this)">Female</button>
                </div>
            </div>

            
            <!-- weapon type drop-down -->
            <div class="select_input">
                <button type="button" onclick="toggleWTSelect()">
                    <p>-Weapon Type-</p>
                    <input type="text" value="">
                </button>
                <div id="wt_select_dropdown" class="closed">
                    <button type="button" onclick="selectSystem(this)">Epee</button>
                    <button type="button" onclick="selectSystem(this)">Foil</button>
                    <button type="button" onclick="selectSystem(this)">Sabre</button>
                </div>
            </div>

            <input type="submit" value="Search">
        </form>
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
<script src="../js/competitions.js"></script>
</html>