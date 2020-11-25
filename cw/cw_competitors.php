<?php include "cw_comp_getdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s competitors</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <?php include "cw_backbtn_choosecomp.php" ?>
            <p>COMPETITORS OF <?php echo $comp_name ?></p>
        </div>


        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <div>
                <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                <input type="text" name="" placeholder="Search by Fencer" class="search">
            </div>

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

        <div class="cw_table_wrapper table">
            <div class="table_header">
                <div class="table_header_text">POSITION</div>
                <div class="table_header_text">NAME</div>
                <div class="table_header_text">NATION / CLUB</div>
                <div class="table_header_text">DATE OF BIRTH</div>
            </div>
            <div class="table_row_wrapper alt">
                <div class="table_row">
                    <div class="table_item bold">
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
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/competitions.js"></script>
</html>