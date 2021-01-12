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
<?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content" class="list">
            <div id="title_stripe">
                <p class="stripe_title">
                    <button type="button" class="back_button" onclick="window.history.back();">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                    </button>
                    PRE-REGISTER FENCERS FOR <?php echo $comp_name ?>
                </p>
            </div>
            <div id="cw_confirmation" class="disabled">
                <div>
                
                    <button class="panel_button" onclick="toggle_add_technician()">
                        <img src="../assets/icons/close-black-18dp.svg"  onclick="closeConf()">
                    </button>
                    <p>Are you sure you want to send this Pre-Registration with these informations?</p>
                    <button type="submit" name="send_pre" class="panel_submit" form="competition_wrapper" value="Send">Send</button>
                </div>
            </div>

        <form id="competition_wrapper" method="POST" action="process_pre.php">
                <p class="column_title centered">Needed Information: (STEP 1 / 2)</p>
                <div id="needed_information_panel">
                    <div>
                        <p class="data_label">FEDERATION'S NAME:</p>
                        <input type="text" name="f_name" placeholder="Type in the federation's name" class="name_input">
                        <p class="data_label">COUNTRY / FENCING CLUB:</p>
                        <input type="text" name="f_country" placeholder="Type in the country's name" class="country_input">
                        <p class="data_label">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                        <input type="email" name="f_email" placeholder="Type in the email address" class="email_input">
                        <p class="data_label">FEDERATION'S PHONE NUMBER:</p>
                        <input type="number" name="f_phone" class="number_input phone_number_input" placeholder="Type in the phone number">
                    </div>
                    <div>
                        <p class="data_label">CONTACT KEEPER'S FULL NAME:</p>
                        <input type="text" name="c_name" placeholder="Type in the full name" class="full_name_input">
                        <p class="data_label">CONTACT KEEPER'S EMAIL ADDRESS:</p>
                        <input type="email" name="c_email" placeholder="Type in the email address" class="email_contact_input">
                        <p class="data_label">CONTACT KEEPER'S PHONE NUMBER:</p>
                        <input type="number" name="c_phone"  class="number_input phone_number_contact_input" placeholder="Type in the phone number">

                        <input type="text" name="fencer_ids" class="disabled" id="fencer_ids">
                        <input type="text" name="compet_id" class="disabled" id="compet_id" value="<?php echo $_GET["comp_id"] ?>">
                    </div>
                </div>
                <p class="column_title centered">SELECT FENCERS FROM THE COMPEITION'S RANKING: (STEP 2 / 2)</p>
                <div id="select_fencers_panel">
                    <div id="selected_fencers_wrapper">
                        <p>Selected fencers:</p>
                       <!-- <div>
                            <input type="number" name=""  class="hidden">
                            <p>Fencer's Name</p>
                            <button onclick="" type="button">
                                <img src="../assets/icons/close-black-18dp.svg" >
                            </button>
                        </div> -->
                    </div>
                    <input type="text" name="" placeholder="Search by Name" class="search">
                    <div id="select_fencers_list_wrapper" class="table">
                        <div class="table_header">
                            <div class="table_header_text">POSITION</div>
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">DATE OF BIRTH</div>
                        </div>
                        <div class="table_row_wrapper">
                        <?php
                        
                        $query_actual_ranking = "SELECT * FROM ranking WHERE ass_comp_id = $comp_id";
                        $query_actual_ranking_do = mysqli_query($connection, $query_actual_ranking);

                        if($row = mysqli_fetch_assoc($query_actual_ranking_do)){

                            $rk_id = $row["id"];

                        }

                        $query_ranking = "SELECT * FROM rk_$rk_id";
                        $query_ranking_do = mysqli_query($connection, $query_ranking);

                        while($row = mysqli_fetch_assoc($query_ranking_do)){

                            $fencer_position = $row["position"];
                            $fencer_name = $row["name"];
                            $fencer_dob = $row["dob"];
                            $fencer_id = $row["id"];
                            ?>

                            <div class="table_row" id="<?php echo $fencer_id ?>" onclick="selectFencer(this)">
                                <div class="table_item"><?php echo $fencer_position ?></div>
                                <div class="table_item" id="fencername"><?php echo $fencer_name ?></div>
                                <div class="table_item"><?php echo $fencer_dob ?></div>
                            </div>

                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="send_pre_reg_panel">
                    <input type="button" onclick="openConf()" value="Send Pre-Registartion" class="send_pre_reg_button">
                </div>
        </form>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/pre_registration.js"></script>
</html>