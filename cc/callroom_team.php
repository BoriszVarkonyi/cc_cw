<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
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
    <title>Callroom</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <main>
        <div id="title_stripe">
            <p class="page_title">Callroom</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button" type="submit">
                    <p>Message Fencer</p>
                    <img src="../assets/icons/message_black.svg"/>
                </button>
                <button class="stripe_button primary" type="submit">
                    <p>Pass Fencer</p>
                    <img src="../assets/icons/send_black.svg"/>
                </button>
            </div>
        </div>
        <div id="page_content_panel_main">

        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
</body>
</html>