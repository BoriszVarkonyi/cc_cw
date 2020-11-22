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
    <title>Overview of {comp name}</title>
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
                <p class="page_title">Overview</p>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper table" id="overview_wrapper">
                    <div class="table_header">
                        <div class="table_header_text">POSITION</div>
                        <button class="resizer"></button>
                        <div class="table_header_text">NAME</div>
                        <button class="resizer"></button>
                        <div class="table_header_text">NATION / CLUB</div>
                        <div class="big_status_header"></div>
                    </div>
                    <div class="table_row_wrapper">
                        <div class="table_row">
                            <div class="table_item">1.</div>
                            <div class="table_item">Néve</div>
                            <div class="table_item">Náte</div>
                            <div class="big_status_item gold"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">2.</div>
                            <div class="table_item">Néve</div>
                            <div class="table_item">Náte</div>
                            <div class="big_status_item silver"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">3.</div>
                            <div class="table_item">Néve</div>
                            <div class="table_item">Náte</div>
                            <div class="big_status_item bronze"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">4.</div>
                            <div class="table_item">Néve</div>
                            <div class="table_item">Náte</div>
                            <div class="big_status_item"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">5.</div>
                            <div class="table_item">Néve</div>
                            <div class="table_item">Náte</div>
                            <div class="big_status_item"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
</html>