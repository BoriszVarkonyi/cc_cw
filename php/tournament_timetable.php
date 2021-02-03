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
                <button type="submit" name="create_tournament" form="panel_main" class="stripe_button primary">
                    <p>Create</p>
                    <img src="../assets/icons/add-black-18dp.svg"/>
                </button>
            </div>
        </div>
        <form id="panel_main">
            <div id="tournament_timetable" class="column_form_wrapper" action="" method="POST">
                <div class="form_column">
                    <label for="comp_name">STARTING DATE</label>
                    <input type="date" placeholder="Type in the title" class="start_date_input" name="tournament_name" class="name_input">
                    <label for="comp_name">ENDING DATE</label>
                    <input type="date" placeholder="Type in the title" class="end_date_input" name="tournament_name" class="name_input">
                </div>
                <div class="form_column">
                    <label for="comp_name">STARTING DATE</label>
                    <input type="date" placeholder="Type in the title" class="title_input" name="tournament_name" class="name_input">
                </div>
            </div>
            <div id="tournament_timetable" class="column_form_wrapper top_border" action="" method="POST">
                <div class="form_column">
                    <label for="comp_name">STARTING DATE</label>
                    <input type="date" placeholder="Type in the title" class="start_date_input" name="tournament_name" class="name_input">
                    <label for="comp_name">ENDING DATE</label>
                    <input type="date" placeholder="Type in the title" class="end_date_input" name="tournament_name" class="name_input">
                </div>
                <div class="form_column">
                    <label for="comp_name">STARTING DATE</label>
                    <input type="date" placeholder="Type in the title" class="title_input" name="tournament_name" class="name_input">
                </div>
            </div>
        </form>
    </div>
    <script src="../js/main.js"></script>
</body>

</html>