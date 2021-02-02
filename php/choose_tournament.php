<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Tournaments</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="bg_fencers">
    <?php include "../includes/headerburger.php" ?>
    <div id="your_competitions_panel" class="panel">
        <div id="title_stripe">
            <p class="page_title">Your Tournaments</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button primary" onclick="location.href='create_tournament.php'">
                    <p>Create Tournament</p>
                    <img src="../assets/icons/add-black-18dp.svg"/>
                </button>
            </div>
        </div>
        <div id="panel_main">
            <div class="table wrapper t_c_2">
                <div class="table_header">
                    <div class="table_header_text">NAME</div>
                    <div class="table_header_text">STATUS</div>
                </div>
                <div class="table_row_wrapper">
                
                


                <div class="table_row" onclick="location.href='choose_comeptition.php">
                    <div class="table_item"><p>NAme</div>
                    <div class="table_item"><p>Status</p></div>
                </div>
                <!--
                <div id="no_something_panel">
                    <p>You have no competitions yet!</p>
                </div>
                -->
                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>