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
    <title>Invitation</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">Invitation</p>
                    <button class="stripe_button orange only_stripe_item" type="submit" form="needed_equimpment_wrapper">
                        <p class="stripe_button_text orange">Save Invitation</p>
                        <img class="stripe_button_icon" src="../assets/icons/save-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">
                    <div id="invitation_wrapper">
                        <div class="db_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Display basic information</p>
                            </div>
                            <div class="db_panel_main">
                                Helo
                            </div>
                        </div>
                        <div class="db_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Display information for fencers</p>
                            </div>
                            <div class="db_panel_main">
                                Helo
                            </div>
                        </div>
                        <div class="db_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Display Timetable</p>
                            </div>
                            <div class="db_panel_main">
                                Helo
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>