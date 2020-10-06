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
                <div id="title_stripe">
                    <p class="page_title">Plus Information</p>
                    <button class="stripe_button" type="button" onclick="printPage()" form="needed_equimpment_wrapper">
                        <p>Print Invitation</p>
                        <img src="../assets/icons/print-black-18dp.svg"></img>
                    </button>
                    <button class="stripe_button orange" type="button"  form="">
                        <p>Save Invitation</p>
                        <img src="../assets/icons/save-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">
                    <div id="invitation_wrapper">

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
                                                <input type="text" placeholder="Type in the title">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="inv_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Add competition logo</p>
                            </div>
                            <div class="db_panel_main">
                                <!--Only visible when file is uploaded-->
                                <button class="round_button close_button">
                                    <img src="../assets/icons/delete-black-18dp.svg" alt="">
                                </button>
                                <div class="invitation_file_wrapper">  
                                    <input type="file" id="header_img">
                                    <label for="header_img">Upload picture</label> <!--Has to rewritten to file's name after uploading-->
                                </div>
                            </div>
                        </div>

                        <div id="cw_preview">
                            <div id="comp_data">
                                <img src="../assets/icons/delete-black-18dp.svg" alt="">

                                <p class="cw_panel_title">2020 Absolute Fencing Gear FIE WC par equipe</p>
                                <p id="comp_status">Ongoing</p>

                                <div>
                                    <p>EPEE</p>
                                    <p>YOLO</p>
                                    <p>HTH></p>
                                </div>
                            </div>

                            <!-- basic info panel -->
                            <div id="basic_information_panel">
                                <div>
                                    <p class="data_label">HOST COUNTRY:</p>
                                    <p>Hunagry</p>
                                    <p class="data_label">LOCATION AND ADDRESS:</p>
                                    <p>Address</p>
                                    <p>Address</p>
                                    <p class="data_label">ENTRY-FEE:</p>
                                    <p>Address</p>
                                </div>
                                <div>
                                    <p class="data_label">STARTING DATE:</p>
                                    <p>Address</p>
                                    <p class="data_label">ENDING DATE:</p>
                                    <p>Address</p>
                                    <p class="data_label pre_reg">END OF PRE-REGISTRTATION:</p>
                                    <p>Address</p>
                                </div>
                            </div>

                            <!-- equipment panel -->
                            <div id="equipment_panel">
                                <p class="data_label panel_title">EQUIPMENT NEEDED TO BE CHECKED</p>

                                <!-- weapons check table rows -->
                                <div>
                                    <div class="table_row">
                                        <div class="table_item">Epee</div>
                                        <div class="table_item">max. 5.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- additional info panel -->
                            <div id="additional_panel">
                                <p class="data_label panel_title">ADDITIONAL INFORMATION FOR FENCERS</p>
                                <div>
                                    <p>Adidtion info heree :)</p>
                                </div>
                            </div>

                            <!-- weapon control panel -->
                            <div id="weapon_control_panel">
                                <p class="data_label panel_title">WEAPON CONTROL</p>
                                <div>
                                    <div class="weapon_control_day">
                                        <p>{Weapon Control Date}</p>
                                    </div>

                                    <div class="weapon_control_day">
                                        <p>{Weapon Control Date}</p>
                                    </div>
                                </div>
                            </div>

                            <div id="plus_information_panel">
                                <p class="data_label panel_title">PLUS INFORMATION</p>
                                <div>
                                    <p>pluss info heree :)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/invitation.js"></script>
</html>