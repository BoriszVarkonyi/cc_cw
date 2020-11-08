<?php include "cw_header.php"; ?>
<?php $statusofpage = 4; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saved Competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <p class="cw_panel_title">SAVED COMPETITIONS</p>
        <form id="browsing_bar">
            <input type="submit" value="Search">
        </form>

        <div class="cw_table_wrapper competitions table_row_wrapper">
                <!-- outputting the table -->    
            <div class="table_row">
                <div class="table_item">
                    <p>Név</p>
                </div>
                <div class="table_item">
                    <p>Státusz</p>
                </div>
                <div class="big_status_item">
                    <button class="favourite_button">
                        <img src="../assets/icons/star_border-black-18dp.svg" >
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>