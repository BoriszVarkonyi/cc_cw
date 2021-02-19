<?php include "../includes/db.php" ?>
<?php session_start();?>
<?php ob_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC Create Competition</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>

<body class="bg_fencers">
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
    <div id="create_competition_panel" class="panel">
        <div id="title_stripe">
            <p class="page_title">Manage Weapon Control Bookings</p>
            <form class="stripe_button_wrapper">
                <button class="stripe_button" onclick="location.href='choose_tournament.php'">
                    <p>Cancel</p>
                    <img src="../assets/icons/close-black-18dp.svg" />
                </button>
                <button class="stripe_button red" onclick="" name="" id="" type="submit" shortcut="SHIFT+D">
                    <p>Disapprove</p>
                    <img src="../assets/icons/how_to_unreg-black-18dp.svg"/>
                </button>
                <button class="stripe_button green" onclick="" name="" id="" type="submit" shortcut="SHIFT+A">
                    <p>Approve</p>
                    <img src="../assets/icons/how_to_reg-black-18dp.svg"/>
                </button>
                <button class="stripe_button green" onclick="" name="" id="" type="submit" shortcut="SHIFT+A">
                    <p>Approve All</p>
                    <img src="../assets/icons/how_to_reg-black-18dp.svg"/>
                </button>
                <input type="text" class="selected_list_item_input" name="" id="" value="">
            </form>
        </div>
        <div id="panel_main">
            <div class="table full">
                <div class="table_header">
                    <div class="table_header_text">NATION / FENCING CLUB</div>
                    <div class="table_header_text">FEDERATION'S EMAIL ADDRESS</div>
                    <div class="table_header_text">NUMBER OF FENCERS</div>
                    <div class="table_header_text">TIME BOOKED</div>
                    <div class="big_status_header"></div>
                </div>
                <div class="table_row_wrapper">


                    <div class="table_row" onclick="selectRow(this)" id="">
                        <div class="table_item">Hungary</div>
                        <div class="table_item">hunfencing@hfenc.hu</div>
                        <div class="table_item">12</div>
                        <div class="table_item">10:00-10:30</div>
                        <div class="big_status_item gray"></div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/manage_entries.js"></script>
</body>
</html>