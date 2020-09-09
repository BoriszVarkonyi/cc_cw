<?php include "cw_header.php"; ?>

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
        <p class="cw_panel_title">COMPETITORS OF {COMP NAME}</p>
        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="search" name="" id="" placeholder="Search by Fencer">

            <div class="select_input">
                <button type="button" onclick="toggleYearSelect()">
                    <p>-Date of Birth-</p>
                    <input type="text" value="">
                </button>
                <div id="year_select_dropdown" class="closed">
                    <input type="date">
                </div>
            </div>

            <input type="submit" value="Search">
        </form>

        <div class="cw_table_wrapper competitiors">
            <div class="table_row">
                <div class="table_item">
                    1
                </div>
                <div class="table_item">
                    Náv
                </div>
                <div class="table_item">
                    HUN
                </div>
                <div class="table_item">
                    04 / 12/ 2000
                </div>
            </div>
            
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/competitions.js"></script>
</html>