<!--<?php include "cw_comp_getdata.php"; ?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Ranking's name}</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">{Ranking's name}</p>
                </div>
                <form id="browsing_bar">
                    <div>
                        <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" placeholder="Search by Fencer's name" class="search">
                    </div>
                </form>
                <div class="table cw">
                    <div class="table_header">
                        <div class="table_header_text">POSITION</div>
                        <div class="table_header_text">FENCER'S NAME</div>
                        <div class="table_header_text">NATION / CLUB</div>
                        <div class="table_header_text">DATE OF BIRTH</div>
                        <div class="table_header_text">POINTS</div>
                    </div>
                    <div class="table_row_wrapper">
                        <div class="table_row">
                            <div class="table_item"><p>Pos</p></div>
                            <div class="table_item"><p>Name</p></div>
                            <div class="table_item"><p>Nat</p></div>
                            <div class="table_item"><p>Dob</p></div>
                            <div class="table_item"><p>Points</p></div>
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