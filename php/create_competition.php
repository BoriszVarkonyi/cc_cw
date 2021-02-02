<?php include "../includes/db.php" ?>
<?php ob_start(); ?>

<?php

if(isset($_POST["submit"])) {

$ass_tourn_id = $_GET["t_id"];

$comp_name = $_POST["comp_name"];
//$comp_wc_type = $_POST["wc_type"];
//$comp_sex = $_POST["sex"];
//$comp_w_type = $_POST["w_type"];
$org_id = $_COOKIE["org_id"];
$minimum = 3;
$maximum = 255;


        $query = "INSERT INTO competitions (comp_name, comp_status, comp_organiser_id, ass_tournament_id) VALUES ('$comp_name', 1, $org_id, '$ass_tourn_id')";
        $query_create = mysqli_query($connection, $query);
        
        if (!$query_create) {
        
            die("ERROR" . mysqli_error($connection));
        }
    
        header("Location: choose_competition.php?t_id=$ass_tourn_id");

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC Create Competition</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="bg_fencers">
<?php include "../includes/headerburger.php";?>
<!-- header -->
    <div id="create_competition_panel" class="panel">
        <div id="title_stripe">
            <p class="page_title">Create new Competition</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button" onclick="location.href='choose_competition.php'">
                    <p>Cancel</p>
                    <img src="../assets/icons/close-black-18dp.svg"/>
                </button>
                <button type="submit" name="submit" form="create_new_comp" class="stripe_button primary">
                    <p>Create</p>
                    <img src="../assets/icons/add-black-18dp.svg"/>
                </button>
            </div>
        </div>
        <div id="panel_main">
            <form id="create_new_comp" class="column_form_wrapper" action="" method="POST">
                <div class="form_column">

                    <label for="comp_name" >NAME</label>
                    <input type="text" placeholder="Type in the title" class="title_input" name="comp_name" class="name_input" onblur="errorChecker(this)">
                        <?php

                            if(in_array(1, $_GET)) {

                                echo '<p class="error_text_option">Missing competition name.</p>';
                                    }
                            ?>


                        <label for="wc_type" >TYPE OF WEAPON CONTROL</label>
                        <div class="option_container">
                            <input type="radio" name="wc_type" id="imm" value="1"/>
                            <label for="imm">Immediate</label>

                            <input type="radio" name="wc_type" id="adm" value="2"/>
                            <label for="adm">Administrated</label>
                        </div>
                        
                        <label for="competition_type" >TYPE OF COMPETITIORS</label>
                        <div class="option_container">
                            <input type="radio" name="comp_type" id="individual" value="" checked/>
                            <label for="individual">Individual</label>
                            <input type="radio" name="comp_type" id="team" value="" disabled/>
                            <label for="team">Team</label>
                        </div>
                        <?php

                            if(in_array(4, $_GET)) {

                                echo '<p class="error_text_option">Missing type of weapon control.</p>';
                                }
                        ?>

                            </div>

                    <div class="form_column">
                        <label for="sex" >SEX</label>

                        <div class="option_container">
                            <input type="radio" name="sex" id="mal" value="1"/>
                            <label for="mal">Male</label>
                            <input type="radio" name="sex" id="fem" value="2"/>
                            <label for="fem">Female</label>
                        </div>
                            <?php
                            if(in_array(2, $_GET)) {

                                echo '<p class="error_text_option">Missing competition sex.</p>';
                                
                                }
                            ?>

                        <label for="w_type" >WEAPON TYPE</label>

                        <div class="option_container">
                            <input type="radio" class="option_button" name="w_type" id="epee" value="1"/>
                            <label for="epee" class="option_label">Epee</label>
                            <input type="radio" class="option_button" name="w_type" id="foil" value="2"/>
                            <label for="foil" class="option_label">Foil</label>
                            <input type="radio" class="option_button" name="w_type" id="sabre" value="3"/>
                            <label for="sabre" class="option_label">Sabre</label>
                        </div>
                        <?php
                        if(in_array(3, $_GET)) {

                            echo '<p class="error_text_option">Missing competition weapon type.</p>';
                            
                            }
                        ?>

                </div>
            </form>
        </div>
    </div>
<script src="../js/main.js"></script>
<script src="../js/create_competition.js"></script>
</body>
</html>

