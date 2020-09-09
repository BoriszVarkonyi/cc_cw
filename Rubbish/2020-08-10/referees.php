<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

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



$query_tech = "SELECT * FROM technicians WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)' ORDER BY online DESC,role,username";
$tech_list_query = mysqli_query($connection, $query_tech);



?>

<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                        <p class="page_title">Referees</p>
                        <form action="" method="POST" id="remove_technician">
                        </form>
                        <button class="stripe_button first_stripe_item disabled" onclick="" form="remove_technician" name="remove_technician" id="remove_technician_button">
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
                            <form action="" id="import_technician" method="POST">
                                <div id="select_competition_wrapper">
                                <?php
                            
                                $query_other = "SELECT * FROM competitions WHERE comp_organiser_id = $org_id EXCEPT SELECT * FROM competitions WHERE comp_id = $comp_id";
                                $query_other_competitions = mysqli_query($connection, $query_other);
                            

                                while($row = mysqli_fetch_assoc($query_other_competitions)) {

                                $select_comp_id = $row["comp_id"];
                                $select_comp_name = $row["comp_name"];
                            
                                ?>
                                
                                <div class="table_row" id="<?php echo $select_comp_id; ?>" onclick="importTechnicians(this)"><div class="table_item" id="in_<?php echo $select_comp_id; ?>"><?php echo $select_comp_name; ?></div></div>
                                     <?php
                                }
                                     ?>
                                </div>
                            </form>
                            <button type="submit" name="import_tech" class="submit_button" form="import_technician">
                                <span class="submit_button_text">Import</span>
                            </button>
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
                            <input type="password" placeholder="Type the referees's password" id="password_input" name="password">
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
                    if(mysqli_num_rows($tech_list_query) == 0){?>

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
                            
                            $query = "SELECT * FROM technicians WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)' AND online = 1 ";
                            $query_do = mysqli_query($connection, $query);

                            echo mysqli_num_rows($query_do);
                            
                            ?></div>
                        </div>

                        <?php  
                        while($row = mysqli_fetch_assoc($tech_list_query)){ 
                            
                            $tech_id = $row["id"];
                            $tech_name = $row["username"];
                            $tech_pass = $row["password"];
                            $tech_online = $row["online"];
                            
                            ?>

                        <div class="table_row" id="<?php echo $tech_id; ?>" onclick="selectTechnicians(this)">
                            <div class="table_item">Szia</div>
                            <div class="table_item"><?php echo $tech_name; ?></div>
                            <div class="table_item"><p class="password_table_item"><?php echo $tech_pass; ?></p></div>
                            <div class="table_item"><?php
                            
                            if($tech_online == 0){

                                echo "Offline";

                            }
                            else{
                                echo "Online";
                            }
                            
                            ?></div>
                            <div class="small_status_item <?php
                            
                            if($tech_online == 0){

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
<script src="../js/technicians.js"></script>
</body>
</html>