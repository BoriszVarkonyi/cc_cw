<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

if(isset($_POST["import_ref"])) {

    echo $comp_ref_from = $_COOKIE["selected"];
    
    $query_add_comp = "SELECT * FROM referees WHERE ass_comp_id regexp '(^|[[:space:]])$comp_ref_from([[:space:]]|$)' EXCEPT SELECT * FROM referees WHERE ass_comp_id regexp'(^|[[:space:]])$comp_id([[:space:]]|$)'";
    $query_add_comp_to_ref = mysqli_query($connection, $query_add_comp);
    
    $ref_id_array = [];
    
    while($row = mysqli_fetch_assoc($query_add_comp_to_ref)) {
    
        $ref_id_string = $row["id"];
        array_push($ref_id_array, $ref_id_string);
    }
    
    $ref_id_array_upload = implode(",",$ref_id_array);
    
    $query_select_to_add = "UPDATE referees SET ass_comp_id = CONCAT(ass_comp_id, ' $comp_id') WHERE id IN($ref_id_array_upload);";
    $do = mysqli_query($connection, $query_select_to_add);
    
    //header("Location: referees.php?comp_id=$comp_id");
    }
    //Import END

    //Adds the selected id to a variable
$ref_to_remove = $_COOKIE["reftoremove"];


//Removes referee from current competition
//Remove START
if(isset($_POST["remove_referee"])) {

    $query_select_ref_to_remove = "SELECT * FROM referees WHERE id = $ref_to_remove";
    $query_select_ref_to_remove_do = mysqli_query($connection, $query_select_ref_to_remove);

    if($row = mysqli_fetch_assoc($query_select_tech_to_remove_do)){

    $ass_comp_id_all_string = $row["ass_comp_id"];
    }

    $ass_comp_id_all_array = explode(" ",$ass_comp_id_all_string);

    if(count($ass_comp_id_all_array) == 1) {

    $if_only_one_comp_query = "DELETE FROM referees WHERE id = $ref_to_remove";
    $if_only_one_comp_query_do = mysqli_query($connection, $if_only_one_comp_query);

    }
    else{

        $key = array_search($comp_id,$ass_comp_id_all_array);
        unset($ass_comp_id_all_array[$key]);

        $ass_comp_id_all_array_upload = implode(" ",$ass_comp_id_all_array);

        $update_comps_query = "UPDATE referees SET ass_comp_id = '$ass_comp_id_all_array_upload' WHERE id = $ref_to_remove";
        $update_comps_query_do = mysqli_query($connection, $update_comps_query);

    }

    print_r($ass_comp_id_all_array);

}
//Remove END


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Referees</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="icon" href="../assets/icons/favicon.svg">
</head>

<?php



$query_ref = "SELECT * FROM referees WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)' ORDER BY online DESC,username";
$ref_list_query = mysqli_query($connection, $query_ref);



?>

<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                        <p class="page_title">Referees<?php echo     $do; ?></p>
                        <form action="" method="POST" id="remove_technician">
                        </form>
                        <button class="stripe_button first_stripe_item disabled" onclick="" form="remove_technician" name="remove_referee" id="remove_technician_button">
                            <p class="stripe_button_text">Remove Referee</p>
                            <img class="stripe_button_icon" src="../assets/icons/delete-black-18dp.svg"></img>
                        </button>
                        <button class="stripe_button" onclick="toggle_import_technician()">
                            <p class="stripe_button_text">Import Referees</p>
                            <img class="stripe_button_icon" src="../assets/icons/save_alt-black-18dp.svg"></img>
                        </button>

                        <div id="import_technician_panel" class="thin_overlay_panel overlay_panel hidden">
                            <button id="close_button" class="round_button" onclick="toggle_import_technician()">
                                <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
                            </button>
                            <form action="" id="import_ref" method="POST">
                                <div id="select_competition_wrapper">
                                <?php
                            
                                $query_other = "SELECT * FROM competitions WHERE comp_organiser_id = $org_id EXCEPT SELECT * FROM competitions WHERE comp_id = $comp_id";
                                $query_other_competitions = mysqli_query($connection, $query_other);
                            

                                while($row = mysqli_fetch_assoc($query_other_competitions)) {

                                $select_comp_id = $row["comp_id"];
                                $select_comp_name = $row["comp_name"];
                            
                                ?>
                                
                                <div class="table_row" id="<?php echo $select_comp_id; ?>" onclick="importTechnicians(this)"><div class="table_item" id="<?php echo $select_comp_id; ?>"><?php echo $select_comp_name; ?></div></div>
                                     <?php
                                }
                                     ?>
                                </div>
                                <button type="submit" name="import_ref" class="submit_button">
                                <span class="submit_button_text">Import</span>
                            </button>
                            </form>
                            
                        </div>

                        <button class="stripe_button bold last_stripe_item" onclick="toggle_add_technician()">
                            <p class="stripe_button_text">Add Referees</p>
                            <img class="stripe_button_icon" src="../assets/icons/add-black-18dp.svg"></img>
                        </button>
                    <div id="add_technician_panel" class="big_overlay_panel overlay_panel hidden" >
                        <button id="close_button" class="round_button" onclick="toggle_add_technician()">
                            <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
                        </button>
                        <div class="form_wrapper_small">
                        <form action="technicians.php?comp_id=<?php echo $comp_id; ?>" method="POST" id="new_technician" autocomplete="off">
                            <label for="username" class="label_text">NAME</label></br>
                            <input type="text" placeholder="Type the referees's name" id="username_input" name="username"><br>
                            <label for="password"class="label_text">PASSWORD</label></br>
                            <input type="password" placeholder="Type the referees's password" id="password_input" name="password" class="no_margin_input">
                            <button type="button" id="random_password_button" onclick="randomPassword()" ><img src="../assets/icons/shuffle-black-18dp.svg"></button>

                            <button type="submit" name="submit" class="submit_button" form="new_technician">
                                <span class="submit_button_text">Save</span>
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
                <div id="page_content_panel_main">

                    <div id="referees_wrapper">

                    <?php 
                    
                    //Checks if there is any technician assigned to current competition
                    //IF there is any, displays it ELSE shows a panel which says no technician set up
                    //Check,read,display technicians START
                    if(mysqli_num_rows($ref_list_query) == 0){?>

                            <div id="no_something_panel">
                                <p>You have no referees set up!</p>
                            </div>
                    <?php
                    }
                    else{
                    ?>       
                    
                        <div class="table_header">
                            <div class="table_header_text">FULL NAME</div>
                            <div class="table_header_text">USERNAME</div>
                            <div class="table_header_text">PASSWORD
                                <button onclick="hidePasswords(this)" id="visibility_button">
                                    <img src="../assets/icons/visibility-black-18dp.svg" alt="">
                                </button>
                            </div>
                            <div class="table_header_text">STATUS</div>
                            <div class="small_status_header"><?php
                            
                            $query = "SELECT * FROM referees WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)' AND online = 1 ";
                            $query_do = mysqli_query($connection, $query);

                            echo mysqli_num_rows($query_do);
                            
                            ?></div>
                        </div>

                        <?php  
                        while($row = mysqli_fetch_assoc($ref_list_query)){ 
                            
                            $ref_id = $row["id"];
                            $ref_name = $row["username"];
                            $ref_pass = $row["password"];
                            $ref_online = $row["online"];
                            $ref_full_name = $row["full_name"];
                            
                            ?>

                        <div class="table_row" id="<?php echo $ref_id; ?>" onclick="selectTechnicians(this)">
                            <div class="table_item"><?php echo $ref_full_name; ?></div>
                            <div class="table_item"><?php echo $ref_name; ?></div>
                            <div class="table_item"><p class="password_table_item"><?php echo $ref_pass; ?></p></div>
                            <div class="table_item"><?php
                            
                            if($ref_online == 0){

                                echo "Offline";

                            }
                            else{
                                echo "Online";
                            }
                            
                            ?></div>
                            <div class="small_status_item <?php
                            
                            if($ref_online == 0){

                                echo "red";

                            }
                            else{
                                echo "green";
                            }
                            
                            ?>"></div> <!-- red or green style added to small_status item to inidcate status -->
                        </div>
                        <?php
                        }
                    }
                    //Check,read,display technicians END
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../js/main.js"></script>
<script src="../js/referees.js"></script>
</body>
</html>