<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php

if(isset($_POST["submit"])){

$host_country = $_POST["host_country"];
$location = $_POST["location"];
$postal = $_POST["postal"];
$entry_fee = $_POST["entry_fee"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$end_pre_reg = $_POST["end_pre_reg"];

$query = "UPDATE competitions SET comp_host = '$host_country', comp_location = '$location', comp_postal = $postal, comp_entry = '$entry_fee', comp_start = '$start_date', comp_end = '$end_date', comp_pre_end = '$end_pre_reg' WHERE comp_id = $comp_id";
$query_do = mysqli_query($connection, $query);

//header("Location: basic_information.php?comp_id=$comp_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Information</title>
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
                <p class="page_title">Basic Information</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="submit" name="submit" form="basic_information_form">
                        <p id="save_text">Save Information</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>                    
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/build-black-18dp.svg" >
                        <p>Set basic information</p>
                    </div>
                    <form class="db_panel_main" action="" id="basic_information_form" method="POST">
                        <?php
                        
                        $query_get_data = "SELECT * FROM competitions WHERE comp_id = $comp_id";
                        $query_get_data_do = mysqli_query($connection, $query_get_data);

                        while($row = mysqli_fetch_assoc($query_get_data_do)){

                            $host_country_get = $row["comp_host"];
                            $location_get = $row["comp_location"];
                            $postal_get = $row["comp_postal"];
                            $entry_fee_get = $row["comp_entry"];
                            $start_date_get = $row["comp_start"];
                            $end_date_get = $row["comp_end"];
                            $end_pre_reg_get = $row["comp_pre_end"];

                        }
                        ?>
                        <div class="form_wrapper">
                            <div>
                                <div>
                                    <label for="host_country">HOST COUNTRY</label>
                                    <input type="text" placeholder="Type the name of the country" name="host_country" class="country_input" id="country_input" value="<?php
                                    
                                    if($host_country_get == ""){

                                        echo "";

                                    }
                                    else{

                                        echo $host_country_get;

                                    }
                                    
                                    ?>">                                
                                </div>
                                <div>
                                    <label for="location">LOCATION AND ADDRESS</label>
                                    <input type="text" placeholder="Street, District, City, Region" name="location" class="no_margin location_input" id="location_input" value="<?php
                                    
                                    if($location_get == ""){

                                        echo "";

                                    }
                                    else{

                                        echo $location_get;

                                    }
                                    
                                    ?>">
                                    <input type="number" placeholder="Zip Code" name="postal" class="number_input centered" id="postal_input" value="<?php
                                    
                                    if($postal_get == 0){

                                        echo "";

                                    }
                                    else{

                                        echo $postal_get;

                                    }
                                    
                                    ?>">                                
                                </div>
                                <div>
                                    <label for="entry_fee">ENTRY-FEE</label>
                                    <input type="text" placeholder="Type in the amount" name="entry_fee" class="number_input money_input" value="<?php
                                    
                                    if($entry_fee_get == ''){

                                        echo "";

                                    }
                                    else{

                                        echo $entry_fee_get;

                                    }
                                    
                                    ?>">                                
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="start_date">STARTING DATE</label>
                                    <input type="date" name="start_date" class="start_date_input" id="start_date_input" value="<?php
                                    
                                    if($start_date_get == ""){

                                        echo "";

                                    }
                                    else{

                                        echo $start_date_get;

                                    }
                                    
                                    ?>">                                
                                </div>
                                <div>
                                    <label for="end_date">ENDING DATE</label>
                                    <input type="date" name="end_date" class="end_date_input" value="<?php
                                    
                                    if($end_date_get == ""){

                                        echo "";

                                    }
                                    else{

                                        echo $end_date_get;

                                    }
                                    
                                    ?>">                                
                                </div>
                                <div>
                                    <label for="end_pre_reg">END OF PRE-REGISTRATION</label>
                                    <input type="date" name="end_pre_reg" class="end_date_pre_reg" value="<?php
                                    
                                    if($end_pre_reg_get == ""){

                                        echo "";

                                    }
                                    else{

                                        echo $end_pre_reg_get;

                                    }
                                    
                                    ?>">                                
                                </div>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="../js/main.js"></script>
<script src="../js/basic_information.js"></script>
</body>
</html>