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
<body class="competitions">
<div id="wrapper">
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">
                    <button type="button" class="back_button" onclick="window.history.back();">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                    </button>
                    Final Results of <?php echo $comp_name ?>
                </p>
            </div>
            <form id="browsing_bar">
                <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
                <div>
                    <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                    <input type="text" name="" placeholder="Search by Name" class="search">
                </div>
                <input type="button" value="Search" onclick="cwSearchEngine()">
            </form>
            <div class="table cw">
                <div class="table_header">
                    <div class="table_header_text">POSITION</div>
                    <div class="table_header_text">NAME</div>
                    <div class="table_header_text">NATION / CLUB</div>
                    <div class="big_status_header"></div>
                </div>
                <div class="table_row_wrapper alt">
                    <div class="table_row">
                        <div class="table_item">
                            <p>
                                1.
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                Néve
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                HUN
                            </p>
                        </div>
                        <div class="big_status_item gold">
                            <img src="../assets/icons/emoji_events-black-18dp.svg">
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="table_item">
                            <p>
                                1.
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                Néve
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                HUN
                            </p>
                        </div>
                        <div class="big_status_item silver">
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="table_item">
                            <p>
                                1.
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                Néve
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                HUN
                            </p>
                        </div>
                        <div class="big_status_item bronze">
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="table_item">
                            <p>
                                1.
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                Néve
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                HUN
                            </p>
                        </div>
                        <div class="big_status_item bronze">
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="table_item">
                            <p>
                                1.
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                Néve
                            </p>
                        </div>
                        <div class="table_item">
                            <p>
                                HUN
                            </p>
                        </div>
                        <div class="big_status_item">
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
<script src="../js/competitions.js"></script>
<script src="../js/cw_temporary_ranking.js"></script>
</body>
</html>