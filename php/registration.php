<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
        <div id="flexbox_container">
            <?php include "../includes/navbar.php"; ?>
            <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                        <p class="page_title">Registration</p>
                        <button class="stripe_button orange">
                            <p>Add Fencer</p>
                            <img src="../assets/icons/add-black-18dp.svg"></img>
                        </button>
                </div>
                <div id="page_content_panel_main">

                    <div id="technicians_wrapper">
                    <!--
                            <div id="no_technicians_panel">
                                <p id="no_technicians_text">You have no technicians set up!</p>
                            </div>
               -->     
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">SEX</div>
                            <div class="table_header_text">NATIONALITY</div>
                            <div class="table_header_text">WEAPON TYPE</div>
                            <div class="table_header_text">STATUS</div>
                            <div class="big_status_header"></div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Hello</div>
                            <div class="table_item">jelszo</div>
                            <div class="table_item">róló</div>
                            <div class="table_item">onlino</div>
                            <div class="table_item">onlino</div>
                            <div class="big_status_item green"></div> <!-- red or green style added to small_status item to inidcate status -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../js/main.js"></script>
</body>
</html>