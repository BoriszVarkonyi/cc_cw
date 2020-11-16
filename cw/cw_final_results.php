<?php include "cw_comp_getdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s final results</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <?php include "cw_backbtn_choosecomp.php" ?>
            <p>FINAL RESULTS OF <?php echo $comp_name ?></p>
        </div>

        <p>g</p>
        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="search" name=""  placeholder="Search by Fencer">

            <input type="submit" value="Search">
        </form>

        <div class="cw_table_wrapper final_results_wrapper table_row_wrapper">
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
                <div class="big_status_item gold">
                    <img src="../assets/icons/emoji_events-black-18dp.svg" alt="">
                </div>
            </div>
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
                <div class="big_status_item silver">
                </div>
            </div>
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
                <div class="big_status_item bronze">
                </div>
            </div>
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
                <div class="big_status_item bronze">
                </div>
            </div>
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
                <div class="big_status_item">
                </div>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/competitions.js"></script>
</html>