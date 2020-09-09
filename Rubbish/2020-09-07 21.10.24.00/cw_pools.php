<?php include "cw_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp name}'s pools</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <button type="button" class="back_button" onclick="location.href='choose_competition.php'">
                <img class="stripe_button_icon" src="../assets/icons/arrow_back_ios-black-18dp.svg"></img>
            </button>
            <p>POOLS OF {COMP NAME}</p>
        </div>

        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="search" name="" id="" placeholder="Search for Fencer">
            <input type="submit" value="Search">
        </form>

        <div class="entry" id="entry_1">
                                <div class="table_row" onclick="toggleEntry(this)">
                                    <div class="table_item">Hungarian Fencing Federation</div>
                                    <div class="table_item">nemzetkozi.nevezes@hunfencing.hu</div>
                                    <div class="table_item">HUN</div>
                                    <div class="big_status_item gray"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <p>8 / 4</p>
                                    <form class="approve_fencers_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                            <div class="approved_status_header">
                                                <button type="button" class="approve_all_button">
                                                    <img src="../assets/icons/select_all-black-18dp.svg" alt="">
                                                    <p>Approve all</p>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="table_row">
                                            <div class="table_item">Neve</div>
                                            <div class="table_item">Náció</div>
                                            <div class="table_item">Drum</div>
                                            <div class="approved_status_item">
                                                <input type="checkbox" name="entry_1" id="e1_f1" value="1" class="small_option_label" />
                                                <label for="e1_f1">Not Approved</label>
                                            </div>
                                        </div>
                                        <input type="submit" value="Save">
                                    </form>
                                </div>
                            </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/competitions.js"></script>
</html>