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
    <title>User Guide</title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/guide_style.min.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">User Guide</p>
            </div>
            <div id="page_content_panel_main">
                <div id="guide_choose">
                    <div class="guide_option">
                        <div>
                            <img src="../assets/icons/directions-black.svg">
                        </div>
                        <div>
                            <p>Getting Started</p>
                            <p>Guide for new Organisers!</p>
                        </div>
                    </div>
                    <div class="guide_option">
                        <div>
                            <img src="../assets/icons/menu_book-black.svg">
                        </div>
                        <div>
                            <p>Everything explained</p>
                            <p>User Guide covering all.</p>
                        </div>
                    </div>
                    <div class="guide_option">
                        <div>
                            <img src="../assets/icons/healing-black.svg">
                        </div>
                        <div>
                            <p>Patch Notes</p>
                            <p>See what updates we made!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
</html>