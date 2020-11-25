<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

//Import technicians from an other competition
//Import START
if(isset($_POST["import_tech"])) {

$comp_technicians_from = $_COOKIE["selected"];

$query_add_comp = "SELECT * FROM technicians WHERE ass_comp_id regexp '(^|[[:space:]])$comp_technicians_from([[:space:]]|$)' EXCEPT SELECT * FROM technicians WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)'";
$query_add_comp_to_tech = mysqli_query($connection, $query_add_comp);

$tech_id_array = [];

while($row = mysqli_fetch_assoc($query_add_comp_to_tech)) {

    $tech_id_string = $row["id"];
    array_push($tech_id_array, $tech_id_string);
}

$tech_id_array_upload = implode(",",$tech_id_array);

$query_select_to_add = "UPDATE technicians SET ass_comp_id = CONCAT(ass_comp_id, ' $comp_id') WHERE id IN($tech_id_array_upload);";
$do = mysqli_query($connection, $query_select_to_add);

header("Location: technicians.php?comp_id=$comp_id");
}
//Import END


//Checks if the comp_id matches the assigned id
//Check START
checkComp($connection);
//Check END


//Gets actual competition's id
$comp_id = $_GET["comp_id"];


//Adds technician to actual competition.
//Add START
if(isset($_POST["submit"])){

$username = $_POST["username"];
$password = $_POST["password"];
$role = $_POST["role"];

$query_check = "SELECT * FROM technicians WHERE username = '$username'";
$query_check_if_already_exists = mysqli_query($connection, $query_check);

    if(mysqli_num_rows($query_check_if_already_exists) == 0){

        $query_add_technicians = "INSERT INTO technicians VALUES (NULL,'$username','$password',$role,$comp_id,0)";
        $insert_technician_query = mysqli_query($connection, $query_add_technicians);
        
        if(!$insert_technician_query) {
        
            echo "HIBA" . mysqli_error($connection);
        }
    }
    else{

        echo "VAN MÁR ILYEN";
    }

    header("Location: technicians.php?comp_id=$comp_id");
}
//Add END


//Adds the selected id to a variable
$tech_to_remove = $_COOKIE["techtoremove"];


//Removes technician from current competition
//Remove START
if(isset($_POST["remove_technician"])) {

    $query_select_tech_to_remove = "SELECT * FROM technicians WHERE id = $tech_to_remove";
    $query_select_tech_to_remove_do = mysqli_query($connection, $query_select_tech_to_remove);

    if($row = mysqli_fetch_assoc($query_select_tech_to_remove_do)){

    $ass_comp_id_all_string = $row["ass_comp_id"];
    }

    $ass_comp_id_all_array = explode(" ",$ass_comp_id_all_string);

    if(count($ass_comp_id_all_array) == 1) {

    $if_only_one_comp_query = "DELETE FROM technicians WHERE id = $tech_to_remove";
    $if_only_one_comp_query_do = mysqli_query($connection, $if_only_one_comp_query);

    }
    else{

        $key = array_search($comp_id,$ass_comp_id_all_array);
        unset($ass_comp_id_all_array[$key]);

        $ass_comp_id_all_array_upload = implode(" ",$ass_comp_id_all_array);

        $update_comps_query = "UPDATE technicians SET ass_comp_id = '$ass_comp_id_all_array_upload' WHERE id = $tech_to_remove";
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
    <title>Technicians</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
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
            <div id="title_stripe">
                <p class="page_title">Technicians</p>
                <button class="stripe_button" onclick="toggle_import_technician()">
                    <p>Import Technicians</p>
                    <img src="../assets/icons/save_alt-black-18dp.svg"/>
                </button>

                <div id="import_technician_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggle_import_technician()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <form action="" id="import_technician" method="POST" class="overlay_panel_form">
                        <div class="select_competition_wrapper table_row_wrapper">
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
                    <button type="submit" name="import_tech" class="panel_submit" form="import_technician" value="Import">Import</button>
                </div>
                <form action="" method="POST" id="remove_technician"></form>
                <button class="stripe_button disabled red" form="remove_technician" name="remove_technician" id="remove_technician_button">
                    <p>Remove Technician</p>
                    <img src="../assets/icons/delete-black-18dp.svg"/>
                </button>
                <button class="stripe_button orange" onclick="toggle_add_technician()">
                    <p>Add Technicians</p>
                    <img src="../assets/icons/add-black-18dp.svg"/>
                </button>
                     
                    <form class="overlay_panel_form overlay_panel" action="technicians.php?comp_id=<?php echo $comp_id; ?>" method="POST" id="new_technician" autocomplete="off">
                        <button class="panel_button" onclick="toggle_add_technician()">
                            <img src="../assets/icons/close-black-18dp.svg" >
                        </button>
                        <label for="username" >NAME</label>
                        <input type="text" placeholder="Type the technician's name" class="username_input" name="username">
                        <label for="password">PASSWORD</label>
                        <div>
                            <input type="password" placeholder="Type the technician's password" class="password_input" id="password_input" name="password">
                            <button type="button" id="random_password_button" onclick="randomPassword()">
                                <img src="../assets/icons/shuffle-black-18dp.svg">
                            </button>
                        </div>
                        <label for="">ROLE</label>
                        <div class="option_container">
                            <input type="radio" class="option_button" name="role" id="a" value="1"/>
                            <label for="a" class="option_label">Semi</label>
                            <input type="radio" class="option_button" name="role" id="b" value="2"/>
                            <label for="b" class="option_label">DT</label>
                            <input type="radio" class="option_button" name="role" id="c" value="3"/>
                            <label for="c" class="option_label">Weapon Control</label>
                            <input type="radio" class="option_button" name="role" id="d" value="4"/>
                            <label for="d" class="option_label">Registration</label>
                        </div>
                        <button type="submit" name="submit" class="panel_submit" form="new_technician">Save</button>
                    </form>

                <div class="search_wrapper">
                    <button type="button" class="clear_search_button"><img src="../assets/icons/close-black-18dp.svg"></button>
                    <input type="text" name="" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search cc">
                    <div class="search_results">
                        <?php
                        $query = "SELECT * FROM technicians WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)'";
                        $query_do = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($query_do)){
                            $idke = $row["id"];
                            $nevecske = $row["username"];
                            ?>
                            <a id="<?php echo $idke ?>A" href="#<?php echo $idke ?>" onclick="selectTechniciansWithSearch(this)"><?php echo $nevecske ?></a>
                            <?php
                            }
                            ?>
                    </div>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="table wrapper">
                    <?php
                    //Checks if there is any technician assigned to current competition
                    //IF there is any, displays it ELSE shows a panel which says no technician set up
                    //Check,read,display technicians START
                    if(mysqli_num_rows($tech_list_query) == 0){?>
                        <div id="no_something_panel">
                            <p>You have no technicians set up!</p>
                        </div>
                    <?php
                    }
                    else{
                        ?>       
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <button class="resizer"></button>
                            <div class="table_header_text">PASSWORD
                                <button onclick="hidePasswords(this)" id="visibility_button">
                                    <img src="../assets/icons/visibility-black-18dp.svg" >
                                </button>
                            </div>
                            <button class="resizer"></button>
                            <div class="table_header_text">ROLE</div>
                            <button class="resizer"></button>
                            <div class="table_header_text">STATUS</div>
                            <div class="small_status_header">
                                <?php
                                $query = "SELECT * FROM technicians WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)' AND online = 1 ";
                                $query_do = mysqli_query($connection, $query);
                                echo mysqli_num_rows($query_do);?>
                            </div>
                        </div>
                        <div class="table_row_wrapper">
                            <?php  
                            while($row = mysqli_fetch_assoc($tech_list_query)){ 
                                $tech_id = $row["id"];
                                $tech_name = $row["username"];
                                $tech_pass = $row["password"];
                                $tech_role = $row["role"];
                                $tech_online = $row["online"];
                                ?>
                                <div class="table_row" id="<?php echo $tech_id; ?>" onclick="selectTechnicians(this)">
                                    <div class="table_item"><?php echo $tech_name; ?></div>
                                    <div class="table_item"><p class="password_table_item"><?php echo $tech_pass; ?></p></div>
                                    <div class="table_item"><?php echo roleConverter($tech_role); ?></div>
                                    <div class="table_item"><?php
                                        if($tech_online == 0){
                                            echo "Offline";
                                        }
                                        else{
                                            echo "Online";
                                        }
                                        ?>
                                    </div>
                                    <div class="small_status_item <?php
                                        if($tech_online == 0){
                                            echo "red";
                                        }
                                        else{
                                             echo "green";
                                        }
                                    ?>">
                                    </div> <!-- red or green style added to small_status item to inidcate status -->
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
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/technicians.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>