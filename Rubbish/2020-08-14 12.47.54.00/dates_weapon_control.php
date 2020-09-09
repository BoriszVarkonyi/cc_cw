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
    <title>{Date}'s weapon control</title>
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
                    <p class="page_title">{Date}'s weapon control</p>
                </div>
                <div id="page_content_panel_main">
                    <div id="dates_weapon_control_wrapper">
                        <div class="period" id="period_1" onclick="togglePeriodPanel(this)">
                            <div>
                                <p>11:25 - 23:14</p>
                                <p>25 / 4</p>
                            </div>
                            <div class="gray">
                                <p>25 / 4</p>
                            </div>
                            <div>
                                <div>
                                    <div>
                                        <p>{ST} : 00 - {ST} : 10</p>
                                        <p>{ST} : 10 - {ST} : 20</p>
                                        <p>{ST} : 20 - {ST} : 30</p>
                                        <p>{ST} : 30 - {ST} : 40</p>
                                        <p>{ST} : 40 - {ST} : 50</p>
                                        <p>{ST} : 50 - {ST} : 59</p>
                                    </div>
                                    <div>
                                        <p>{SF} / {AF}</p>
                                        <p>{SF} / {AF}</p>
                                        <p>{SF} / {AF}</p>
                                        <p>{SF} / {AF}</p>
                                        <p>{SF} / {AF}</p>
                                        <p>{SF} / {AF}</p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button">
                                        <img src="../assets/icons/people_alt-black-18dp.svg" alt="">
                                    </button>
                                    <button type="button">
                                        <img src="../assets/icons/person_add_alt_1-black-18dp.svg" alt="">
                                    </button>
                                    <button type="button">
                                        <img src="../assets/icons/person_remove-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/dates_weapon_control.js"></script>
</html>