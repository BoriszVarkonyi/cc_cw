<?php include "cw_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp name}'s final results</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <button type="button" class="back_button" onclick="location.href='choose_competition.php'">
                <img class="stripe_button_icon" src="../assets/icons/arrow_back_ios-black-18dp.svg"></img>
            </button>
            <p>TEMPORARY RANKING OF {COMP NAME}</p>
        </div>


        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="search" name="" id="" placeholder="Search by Fencer">

            <input type="submit" value="Search">
        </form>

        <div class="cw_table_wrapper competitiors">
            <div class="table_row">
                <div class="table_item">
                    1.
                </div>
                <div class="table_item">
                    Náv
                </div>
                <div class="table_item">
                    HUN
                </div>
                <div class="table_item">
                    04 / 12 / 2000
                </div>
            </div>
            
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/competitions.js"></script>
</html>