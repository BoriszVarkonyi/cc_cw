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
    <title>Announcements</title>
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
                <p class="page_title">Announcements</p>
                <button class="stripe_button orange" type="submit">
                    <p>New Announcement</p>
                    <img src="../assets/icons/add-black-18dp.svg"></img>
                </button>
            </div>
            <div id="page_content_panel_main">
                <div id="announcements_wrapper" class="wrapper entry_table_row_wrapper">
                    <div class="entry" id="">
                        <div class="table_row" onclick="toggleEntry(this)">
                            <div class="table_item">Hungarian Fencing Federation</div>
                            <form class="big_status_item">
                                <button class="">
                                    <img src="../assets/icons/delete-black-18dp.svg" alt="">
                                </button>
                            </form>
                        </div>
                        <div class="entry_panel collapsed">
                            <textarea name="" id=""></textarea>
                            <input type="text" class="hidden">
                            <button class="panel_submit">Save</button>
                        </div>
                    </div>

                    <form id="adding_entry table_row_wrapper">
                        <div class="table_row" onclick="">
                            <div class="table_item">
                                <input type="text" placeholder="Type in the title">
                                <button class="save_entry">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/announcements.js"></script>
</html>