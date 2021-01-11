<!--<?php include "cw_comp_getdata.php"; ?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rankings</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">Rankings</p>
                </div>
                <form id="browsing_bar">
                    <div>
                        <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" placeholder="Search by Fencer" class="search">
                    </div>
                </form>
                <div class="table cw">
                    <div class="table_header">
                        <div class="table_header_text">RANKINGS NAME</div>
                        <div class="table_header_text">PLACEHOLDER</div>
                    </div>
                    <div class="table_row_wrapper">
                        <div class="table_row">
                            <div class="table_item"><p>Szia</p></div>
                            <div class="table_item"><p>Plészholder vagyok</p></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item"><p>Szia</p></div>
                            <div class="table_item"><p>Plészholder vagyok</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php include "cw_footer.php"; ?>
        </div>
    </div>
<script src="../js/cw_main.js"></script>
<script src="../js/list.js"></script>
</body>
</html>