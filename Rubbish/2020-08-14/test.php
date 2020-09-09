<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">template</p>
                    <button class="stripe_button orange only_stripe_item" type="submit" form="needed_equimpment_wrapper">
                        <p class="stripe_button_text">Template</p>
                        <img class="stripe_button_icon" src="../assets/icons/save-black-18dp.svg"></img>
                    </button>
                </div>

                <div id="page_content_panel_main">

                    <div id="set_wc_panel" class="overlay_panel big_overlay_panel">
                        <div class="form_wrapper">
                            <button id="close_button" class="round_button" onclick="toggle_profile_panel()">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>

                            <form action="" method="POST" id="new_wc_day" autocomplete="off">
                                <p class="panel_title">JULY 20 2020' WEAPON CONTROL</p></br>
                                <label for="wc_per_ten_min" class="label_text_small">Estimated number of weapon controls done in 10 minutes: controls done in 10 minutes:</label></br>
                                <input type="number" class="number_input small" placeholder="e.g. 8" id="wc_input" name="wc_per_ten_min">

                                <div class="table_header">
                                    <div class="table_header_text">STARTING TIME</div>
                                    <div class="table_header_text">ENDING TIME</div>
                                </div>
                                <div class="table_row">
                                    <div class="table_item"> <input type="number" class="number_input big" name="wc_period_start"> </div>
                                    <div class="table_item"> <input type="number" class="number_input big" name="wc_period_end"> </div>
                                </div>
                                    
                                <div class="add_peroid_container">
                                    <button class="round_button">
                                        <img src="../assets/icons/more_time-black-18dp.svg" alt="">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/main.js"></script>
</html>