<?php include "../includes/db.php" ?>
<?php ob_start(); ?>

<?php

if(isset($_POST["submit"])) {

$comp_name = $_POST["comp_name"];
//$comp_wc_type = $_POST["wc_type"];
//$comp_sex = $_POST["sex"];
//$comp_w_type = $_POST["w_type"];
$org_id = $_COOKIE["org_id"];
$minimum = 3;
$maximum = 255;

  
    if(!$comp_name){

        $comp_name_error = "compnameerror=1&";
        
    }
    else{
        $comp_name_error = "";
    }
    if(!isset($_POST['sex'])){

        $comp_sex_error = "compsexerror=2&";

    }
    else{

        $comp_sex_error = "";
        $comp_sex = $_POST["sex"];
    }
    if(!isset($_POST['w_type'])){

        $comp_w_type_error = "compwtypeerror=3&";

    }
    else{

        $comp_w_type_error = "";
        $comp_w_type = $_POST["w_type"];
    }
    if(!isset($_POST['wc_type'])){

        $comp_wc_type_error = "compwctyperror=4&";

    }
    else{

        $comp_wc_type_error = "";
        $comp_wc_type = $_POST["wc_type"];
    }
    $errors = $comp_name_error . $comp_sex_error . $comp_w_type_error . $comp_wc_type_error ;
    header("Location: create_competition.php?$errors");

    if(!in_array(1,$_GET) && !in_array(2,$_GET) && !in_array(3,$_GET) && !in_array(4,$_GET)){

        $query = "INSERT INTO competitions (comp_name, comp_wc_type, comp_sex, comp_status, comp_weapon, comp_organiser_id) VALUES ('$comp_name',$comp_wc_type,$comp_sex,1,$comp_w_type, $org_id)";
        $query_create = mysqli_query($connection, $query);
        
        if (!$query_create) {
        
            die("ERROR" . mysqli_error($connection));
        }
    
        header("Location: choose_competition.php");

    }




}

$query = "";


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
<body id="illustration_bg">
<?php include "../includes/headernoburger.php";?>
<!-- header -->
    <div id="create_competition" class="panel small_panel">
        <div id="title_stripe">
            <p class="page_title">Create new competition</p>
            <button type="submit" name="submit" form="create_new_comp" class="stripe_button">
                <p class="stripe_button_text">Create</p>
                <img  class="stripe_button_icon" src="../assets/icons/add-black-18dp.svg"></img>
            </button>
        </div>
        <div id="panel_main">
            <form id="create_new_comp" action="" method="POST">
                <div class="form_column">

                    <label for="comp_name" class="label_text">NAME</label><br>
                    <input type="text" name="comp_name" id="name_input"><br>
                        <?php

                            if(in_array(1, $_GET)) {

                                echo '<p class="error_text_option">Missing competition name.</p>';
                                    }
                            ?>


                        <label for="wc_type" class="label_text" placeholder="Type in the name of the competition" >TYPE OF WEAPON CONTROL</label><br>
                        <div class="option_container">
                            <input type="radio" name="wc_type" id="imm" value="1"/>
                            <label for="imm">Immidiate</label>

                            <input type="radio" name="wc_type" id="adm" value="2"/>
                            <label for="adm">Administrated</label>
                        </div>
                        <?php

                            if(in_array(4, $_GET)) {

                                echo '<p class="error_text_option">Missing type of weapon control.</p>';
                                }
                        ?>

                            </div>

                    <div class="form_column">
                        <label for="sex" class="label_text">SEX</label><br>

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

                        <label for="w_type" class="label_text">WEAPON TYPE</label><br>

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
        <div id="panel_footer"></div>
    </div>
<script src="../js/main.js"></script>
</body>
</html>

