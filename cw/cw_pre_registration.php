<?php include "cw_comp_getdata.php"; ?>

<?php

if(isset($_POST["send_pre"])){

$f_name = $_POST["f_name"];
$f_country = $_POST["f_country"];
$f_email = $_POST["f_email"];
$f_phone = $_POST["f_phone"];

$c_name = $_POST["c_name"];
$c_email = $_POST["c_email"];
$c_phone = $_POST["c_phone"];



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
<body>
    <div id="cw_confirmation">
        <div>
            <button class="panel_button" onclick="toggle_add_technician()">
                <img src="../assets/icons/close-black-18dp.svg" alt="">
            </button>
            <p>Are you sure you want to send this Pre-Registration with these informations?</p>
            <button type="submit" name="submit" class="panel_submit" form="new_technician" value="Send">Send</button>
        </div>
    </div>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <?php include "cw_backbtn_choosecomp.php"; ?>
            <p>PRE-REGISTER FENCERS FOR <?php echo $comp_name ?></p>
        </div>

        <form id="competition_wrapper" method="POST">
            <div>
                <div id="basic_information_panel">
                    <div>
                        <p class="data_label">FEDERATION'S NAME:</p>
                        <input type="text" name="f_name" id="">
                        <p class="data_label">COUNTRY / FENCING CLUB:</p>
                        <input type="text" name="f_country" id="">
                        <p class="data_label">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                        <input type="email" name="f_email" id="">
                        <p class="data_label">FEDERATION'S PHONE NUMBER:</p>
                        <input type="number" name="f_phone" id="" class="number_input no_web">
                    </div>
                    <div>
                        <p class="data_label">CONTACT KEEPER'S FULL NAME:</p>
                        <input type="text" name="c_name" id="">
                        <p class="data_label">CONTACT KEEPER'S EMAIL ADDRESS:</p>
                        <input type="email" name="c_email" id="">
                        <p class="data_label">CONTACT KEEPER'S PHONE NUMBER:</p>
                        <input type="number" name="c_phone" id="" class="number_input no_web">
                    </div>
                </div>

                <div id="select_fencers_panel">
                    <p class="data_label panel_title">SELECT FENCERS FROM THE COMPEITION'S RANKING</p>
                    

                    <div id="selected_fencers_wrapper">
                        <p>Selected fencers:</p>

                       <!-- <div>
                            <input type="number" name="" id="" class="hidden">
                            <p>Fencer's Name</p>
                            <button onclick="" type="button">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>
                        </div> -->

                    </div>

                    <input type="search" name="" id="">

                    <div id="select_fencers_wrapper">
                        <div class="table_header">
                            <div class="table_header_text">POSITION</div>
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">DATE OF BIRTH</div>
                        </div>

                        <?php
                        
                        $query_actual_ranking = "SELECT * FROM ranking WHERE ass_comp_id = $comp_id";
                        $query_actual_ranking_do = mysqli_query($connection, $query_actual_ranking);

                        if($row = mysqli_fetch_assoc($query_actual_ranking_do)){

                            $rk_id = $row["id"];

                        }

                        $query_ranking = "SELECT * FROM rk_$rk_id ORDER BY position";
                        $query_ranking_do = mysqli_query($connection, $query_ranking);

                        while($row = mysqli_fetch_assoc($query_ranking_do)){

                            $fencer_position = $row["position"];
                            $fencer_name = $row["name"];
                            $fencer_dob = $row["dob"];
                            $fencer_id = $row["id"];
                            ?>

                            <div class="table_row" id="r_<?php echo $fencer_id ?>" onclick="selectFencer(this)">
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
        
            <div>
                <input type="submit" name="send_pre" value="Send Pre-Registration">
            </div>
        </form>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/pre_registration.js"></script>
</html>