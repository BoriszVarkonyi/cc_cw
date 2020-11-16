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
                <div id="title_stripe">
                        <p class="page_title">Registration</p>
                        <button class="stripe_button orange" onclick="toggleAddFencerPanel()">
                            <p>Add Fencer</p>
                            <img src="../assets/icons/add-black-18dp.svg"></img>
                        </button>

                        <div id="add_fencer_panel" class="overlay_panel hidden">
                            <button class="panel_button" onclick="toggleAddFencerPanel()">
                                <img src="../assets/icons/close-black-18dp.svg" >
                            </button>
                            <!-- add fencers drop-down -->
                            <form action="ranking.php?comp_id=<?php echo $comp_id ?>&rankid=<?php echo $ranking_id ?>" method="post" id="new_fencer" autocomplete="off" class="overlay_panel_form">
                                <label for="fencers_name" >NAME</label>
                                <input type="text" placeholder="Type the fencers's name" class="username_input" name="fencer_name">

                                <label for="fencers_nationality">NATIONALITY / CLUB</label>
                                <input type="search" name="fencers_nationality" class="username_input" placeholder="Type the fencers's nationality">

                                <label for="fencers_points" >POSITION</label>
                                <input type="number" placeholder="##" id="ranking_points" class="number_input extra_small" name="fencer_position">

                                <label for="fencers_dob" >DATE OF BIRTH</label>
                                <input type="date" name="fencer_dob">
                                <button type="submit" name="submit" class="panel_submit">Save</button>
                            </form>
                        </div>
                </div>
                <div id="page_content_panel_main">

                    <div class="wrapper table_row_wrapper">
                    <!--
                            <div id="no_something_panel">
                                <p>You have no referees set up!</p>
                            </div>
               -->     
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">SEX</div>
                            <div class="table_header_text">NATIONALITY / CLUB</div>
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
<script src="../js/main.js"></script>
<script src="../js/registration.js"></script>
</body>
</html>