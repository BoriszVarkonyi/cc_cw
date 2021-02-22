<?php include "cw_comp_getdata.php"; ?>

<?php

$comp_id = $_GET["comp_id"];

if(isset($_POST["send_pre"])){





}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pre-Register for <?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="competitions">
            <div class="modal_wrapper hidden" id="confirmation">
                <div class="modal">
                    <div>
                        <button class="panel_button" onclick="toggle_add_technician()">
                            <img src="../assets/icons/close-black-18dp.svg"  onclick="closeConf()">
                        </button>
                        <p class="title">Are you sure you want to send this Pre-Registration with the following informations?</p>
                        <label>FEDERATION'S NAME:</label>
                        <p>FED NAME</p>
                        <label>COUNTRY / FENCING CLUB:</label>
                        <P>GER</P>
                        <label>FEDERATION'S OFFICAL EMAIL ADDRESS:</label>
                        <p>g</p>
                        <label>FEDERATION'S PHONE NUMBER:</label>
                        <p>grg</p>
                        <label>CONTACT KEEPER'S FULL NAME:</label>
                        <p>grg</p>
                        <label>CONTACT KEEPER'S EMAIL ADDRESS:</label>
                        <p>grg</p>
                        <label>CONTACT KEEPER'S PHONE NUMBER:</label>
                        <p>grg</p>
                        <button type="submit" name="send_pre" class="send_button" form="content_wrapper" value="Send">Send</button>
                    </div>
                </div>
            </div>

    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">
                    <button type="button" class="back_button" onclick="window.history.back();">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                    </button>
                    PRE-REGISTER FENCERS FOR <?php echo $comp_name ?>
                </p>
            </div>
            <form id="content_wrapper" method="POST" action="process_pre.php">
                <p class="column_title centered">Needed Information: (STEP 1 / 2)</p>
                <div id="step1" class="column_panel no_top">
                    <div>
                        <div class="form_wrapper">
                            <div>
                                <div>
                                    <label>FEDERATION'S NAME:</label>
                                    <input type="text" name="f_name" placeholder="Type in the federation's name" class="name_input alt">
                                </div>
                                <div>
                                    <label>COUNTRY / FENCING CLUB:</label>
                                    <input type="text" name="f_country" placeholder="Type in the country's name" class="country_input alt">
                                </div>
                                <div>
                                    <label>FEDERATION'S OFFICAL EMAIL ADDRESS:</label>
                                    <input type="email" name="f_email" placeholder="Type in the email address" class="email_input alt">
                                </div>
                                <div>
                                    <label>FEDERATION'S PHONE NUMBER:</label>
                                    <input type="number" name="f_phone" class="number_input phone_number_input alt" placeholder="Type in the phone number">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label>CONTACT KEEPER'S FULL NAME:</label>
                                    <input type="text" name="c_name" placeholder="Type in the full name" class="full_name_input alt">
                                </div>
                                <div>
                                    <label>CONTACT KEEPER'S EMAIL ADDRESS:</label>
                                    <input type="email" name="c_email" placeholder="Type in the email address" class="email_contact_input alt">
                                </div>
                                <div>
                                    <label>CONTACT KEEPER'S PHONE NUMBER:</label>
                                    <input type="number" name="c_phone"  class="number_input phone_number_contact_input alt" placeholder="Type in the phone number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="column_title centered">SELECT FENCERS FROM THE COMPEITION'S RANKING: (STEP 2 / 2)</p>
                <div id="step2" class="column_panel no_top collapsed">
                    <div class="column">
                        <b>Selected fencers:</b>
                        <div id="selected_fencers_wrapper">
                            <input type="text" placeholder="selected fencer ids">
                        </div>
                        <div id="browsing_bar" class="single">
                            <input type="text" name="" placeholder="Search by Name" class="search alt" onkeyup="">
                        </div>
                        <div class="table full">
                            <div class="table_header">
                                <div class="table_header_text">POSITION</div>
                                <div class="table_header_text">NAME</div>
                                <div class="table_header_text">DATE OF BIRTH</div>
                            </div>
                            <div class="table_row_wrapper">
                                <div class="table_row" id="" onclick="selectFencer(this)">
                                    <div class="table_item">pos</div>
                                    <div class="table_item" id="">name</div>
                                    <div class="table_item">dob</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="send_panel">
                    <button type="button" onclick="openConf()" class="send_button">Send Pre-Registartion</button>
                </div>
            </form>
        </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/cw_pre_registration.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>