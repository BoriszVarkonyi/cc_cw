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
                        <div class="period">
                            <div>
                                <p>11:25 - 23:14</p>
                                <p>25 / 4</p>
                            </div>
                            <div class="gray">
                                <p>25 / 4</p>
                            </div>
                        </div>
                        <div class="period"></div>
                        <div class="period"></div>
                        <div class="period"></div>
                        <div class="period"></div>
                        <div class="period"></div>
                        <div class="period"></div>
                        <div class="period"></div>
                        <div class="period"></div>
                        <div class="period"></div>
                        <div class="period"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>