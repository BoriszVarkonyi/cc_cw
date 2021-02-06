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
    <title>Call Room</title>
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
                    <p class="page_title">Call Room</p>
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button" type="submit">
                            <p>Message Fencer</p>
                            <img src="../assets/icons/message-black-18dp.svg"/>
                        </button>
                        <button class="stripe_button primary" type="submit">
                            <p>Pass Fencer</p>
                            <img src="../assets/icons/send-black-18dp.svg"/>
                        </button>
                    </div>
                </div>
                <div id="page_content_panel_main">

                </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>