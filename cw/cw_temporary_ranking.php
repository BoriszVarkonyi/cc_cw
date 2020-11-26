<?php include "cw_comp_getdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s temporary ranking</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <?php include "cw_backbtn_choosecomp.php" ?>
            <p>TEMPORARY RANKING OF <?php echo $comp_name ?></p>
        </div>

        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="text" name="" placeholder="Search by Title" class="search">

            <input type="submit" value="Search">
        </form>

        <div id="competition_color_legend">
            <button id="fencing_lengend" value="Registration Finished"></button>
            <p>Still fencing</p>
            <button id="eliminated_lengend" value="Ongoing Pools"></button>
            <p>Eliminated</p>
            <button id="passed_lengend" value="Ongoing Table"></button>
            <p>Passed</p>
        </div>


        <div class="table">
            <div class="table_header">
                <div class="table_header_text">POSITION</div>
                <div class="table_header_text">NAME</div>
                <div class="table_header_text">NATION / CLUB</div>
                <div class="small_status_header"></div>
            </div>
            <div class="table_row_wrapper alt">
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
                    <div class="small_status_item red"></div>
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