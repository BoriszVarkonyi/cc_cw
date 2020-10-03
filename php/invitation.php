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
    <title>Invitation</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">Invitation</p>
                    <button class="stripe_button orange only_stripe_item" type="submit" form="needed_equimpment_wrapper">
                        <p class="stripe_button_text orange">Download Invitation</p>
                        <img class="stripe_button_icon" src="../assets/icons/save-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">
                    <div id="invitation_wrapper">
                        <div class="inv_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Display basic information</p>
                            </div>
                            <div class="db_panel_main">
                                <div class="invitation_switch_wrapper">  
                                    <div> 
                                        <input type="checkbox" name="" id="host_country"> <!-- input's ID has to be indentical to label's for-->
                                        <label for="host_country">Host Country</label>
                                    </div>

                                    <div> 
                                        <input type="checkbox" name="" id="location"> 
                                        <label for="location">Location and Address</label>
                                    </div>

                                    <div> 
                                        <input type="checkbox" name="" id="entry_fee"> 
                                        <label for="entry_fee">Entry-Fee</label>
                                    </div>
                                    <div> 
                                        <input type="checkbox" name="" id="starting_date"> <!-- input's ID has to be indentical to label's for-->
                                        <label for="starting_date">Starting Date</label>
                                    </div>

                                    <div> 
                                        <input type="checkbox" name="" id="ending_date"> 
                                        <label for="ending_date">Ending Date</label>
                                    </div>

                                    <div> 
                                        <input type="checkbox" name="" id="pre_reg_date"> 
                                        <label for="pre_reg_date">End of Pre-Registration Date</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inv_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Display information for fencers</p>
                            </div>
                            <div class="db_panel_main">
                                <div class="invitation_switch_wrapper">  
                                    <div> 
                                        <input type="checkbox" name="" id="equipment_neeed"> <!-- input's ID has to be indentical to label's for-->
                                        <label for="equipment_neeed">Equipment needed to be checked</label>
                                    </div>

                                    <div> 
                                        <input type="checkbox" name="" id="additional_info"> 
                                        <label for="additional_info">Additional Information</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="inv_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Display Timetable</p>
                            </div>
                            <div class="db_panel_main">
                                <div class="invitation_switch_wrapper">  
                                    <div> 
                                        <input type="checkbox" name="" id="has_wc"> <!-- input's ID has to be indentical to label's for-->
                                        <label for="has_wc">Days with weapon control</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="plus_information">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Plus information</p>
                            </div>
                            <div class="db_panel_main">
                                <div id="plus_info_wrapper">

                                    <div class="entry" id="">
                                        <div class="table_row" onclick="toggleEntry(this)">
                                            <div class="table_item invitation">Hungarian Fencing Federation</div>
                                        </div>
                                        <div class="entry_panel collapsed">
                                            <textarea name="" id=""></textarea>
                                            <input type="text" class="hidden">
                                        </div>
                                    </div>

                                    <div id="add_entry">
                                        <div class="table_row" onclick="">
                                            <div class="table_item">
                                                Add information
                                                <img src="../assets/icons/add-black-18dp.svg" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <form id="adding_entry">
                                        <div class="table_row" onclick="">
                                            <div class="table_item">
                                                <input type="text">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="inv_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Add header picture</p>
                            </div>
                            <div class="db_panel_main">
                                <div class="invitation_file_wrapper">  
                                    <input type="file" id="header_img">
                                    <label for="header_img">Upload picture</label>
                                </div>
                            </div>
                        </div>
                        <div class="inv_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Add watermark</p>
                            </div>
                            <div class="db_panel_main">
                                <div class="invitation_file_wrapper">  
                                    <input type="file" id="watermark_img">
                                    <label for="watermark_img">Upload picture</label>
                                </div>
                            </div>
                        </div>
                        <div class="inv_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Add footer picture</p>
                            </div>
                            <div class="db_panel_main">
                                <div class="invitation_file_wrapper">  
                                    <input type="file" id="footer_img">
                                    <label for="footer_img">Upload picture</label>
                                </div>
                            </div>
                        </div>

                        <div id="invitational_preview">
                            <img src="../assets/img/fencers_bg.svg" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/invitation.js"></script>
</html>