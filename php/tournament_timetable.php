<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
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
            <p class="page_title">Tournament's Timetable</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button" onclick="location.href='choose_tournament.php'">
                    <p>Cancel</p>
                    <img src="../assets/icons/close-black-18dp.svg" />
                </button>
                <button type="submit" name="" form="tournament_timetable" class="stripe_button primary">
                    <p>Save</p>
                    <img src="../assets/icons/save-black-18dp.svg"/>
                </button>
            </div>
        </div>
        <div id="panel_main">
            <form id="tournament_timetable" class="form_wrapper" action="" method="POST">
                <div>
                    <label for="">STARTING DATE</label>
                    <input type="date" class="start_date_input" name="">
                    <label for="">ENDING DATE</label>
                    <input type="date" class="end_date_input" name="">
                </div>
            </form>
            <form id="tournament_weapon control" class="form_wrapper" action="" method="POST">
                <button>Add New Weapon Control</button>
                <div>
                    <label for="">DATE</label>
                    <input type="date" class="start_date_input" name="">
                    <label for="">STARTING TIME</label>
                    <input type="time" class="" name="" step="3600000">
                    <label for="">ENDING TIME</label>
                    <input type="time" class="" name="" step="3600000">
                    <label for="">MINUTE / FENCER</label>
                    <input type="number" class="number_input centered" placeholder="#" name="" step="3600000">
                    <input type="button" value="Add" class="panel_submit">
                    <div class="table">
                        <div class="table_header">
                            <div class="table_header_text">DATE</div>
                            <div class="table_header_text">STARTING TIME</div>
                            <div class="table_header_text">ENDING TIME</div>
                            <div class="table_header_text">MIN. / FENCER</div>
                        </div>
                        <div class="table_row_wrapper">
                            <div class="table_row">
                                <div class="table_item">2050 04 25</div>
                                <div class="table_item">16:30</div>
                                <div class="table_item">18:00</div>
                                <div class="table_item">5</div>
                            </div>
                            <div class="table_row">
                                <div class="table_item">2050 04 25</div>
                                <div class="table_item">16:30</div>
                                <div class="table_item">18:00</div>
                                <div class="table_item">5</div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>