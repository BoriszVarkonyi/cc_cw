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
    <title>{Comp name}'s Competitiors</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Competitors</p>
                <button class="stripe_button" type="button">
                    <p>Send message to Fencer</p>
                    <img src="../assets/icons/message-black-18dp.svg"></img>
                </button>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper table_row_wrapper">
                    <div class="table_header">
                        <div class="table_header_text">Name</div>
                        <div class="table_header_text">Nationality</div>
                        <div class="table_header_text">Weapon Control</div>
                    </div>
                    <div class="table_row">
                        <div class="table_item">A neve ez 152</div>
                        <div class="table_item">A neve ez 152</div>
                        <div class="table_item">
                            <div class="small_status_item green"></div>
                            <div class="table_item">A neve ez 152</div>
                            <div class="small_status_item red"></div>
                            <div class="table_item">A neve ez 152</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>