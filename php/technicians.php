<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

    //feedback array
    $feedback = array(
        "fencer_data" => "no",
        "create_table" => "no",
        "ttest" => "no",
        "update" => "no",
        "rtest" => "no",
        "insert" => "no",
        "delete" => "no",
        "get_wc_data" => "no",
        "misc" => "no"
    );

    //create table 
    $table_name = "tech_" . $comp_id;
    $qry_create_table = "CREATE TABLE `ccdatabase`.`$table_name` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `pass` VARCHAR(255) NOT NULL , `role` INT(1) NOT NULL , `online` INT(1) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_table_create = mysqli_query($connection, $qry_create_table);

    if ($do_table_create) {
        $feedback['create_table'] = "ok!";
    } else {
        $feedback['create_table'] = "ERROR " . mysqli_error($connection);
    }

    if (isset($_POST['submit_import'])) {
        $selected_comp_id = $_POST['selected_comp_id'];

        $qry_import = "SELECT * FROM `tech_$selected_comp_id`";
        $do_import = mysqli_query($connection, $qry_import);
        echo mysqli_error($connection);
        echo "<br>";
        echo "selected comp id: ";
        echo $selected_comp_id;
        echo ";";

        while ($row = mysqli_fetch_assoc($do_import)) {
            $name = $row['name'];
            $pass = $row['pass'];
            $role = $row['role'];
            $online = $row['online'];

            //test for existing techs
            $test_for_dupli = "SELECT * FROM $table_name WHERE name = '$name'";
            $do_test_for_dupli = mysqli_query($connection, $test_for_dupli);
            $test_num_rows = mysqli_num_rows($do_test_for_dupli);

            if ($test_num_rows == FALSE) {
                //update current comps tach table with imported tecch
                $qry_insert_import = "INSERT INTO $table_name (name, pass, role, online) VALUES ('$name', '$pass', '$role', '$online')";
                $do_insert_import = mysqli_query($connection, $qry_insert_import);
                echo mysqli_error($connection);
            }
        }
        
    }

    if(isset($_POST["remove_technician"])) {
        $id = $_POST['id'];

        $qry_delete = "DELETE FROM $table_name WHERE id = '$id'";
        if ($do_delete = mysqli_query($connection, $qry_delete)) {
            $feedback['delete'] = 'ok!';
        
        } else {
            $feedback['delete'] = 'ERROR ' . mysqli_error($connection);
        
        }

    }

        if (isset($_POST['submit_tech'])) {
            //get data from form
            $tech_name = $_POST['username'];

            $tech_role = $_POST['role'];

            if ($tech_name != "" && $tech_role != "") {
            
                $feedback['misc'] = "okokokok";
                $_POST['password'] = "";
                $qry_scheck_row = "SELECT * FROM $table_name WHERE name = '$tech_name'";
                $do_check_row = mysqli_query($connection, $qry_scheck_row);
                $row_num = mysqli_num_rows($do_check_row);

                if ($row_num == FALSE) {
                    $feedback['rtest'] = "ok!";
                    $qry_insert = "INSERT INTO $table_name (name, pass, role, online) VALUES ('$tech_name', '', '$tech_role', '0')";
                    if ($do_insert = mysqli_query($connection, $qry_insert)) {
                        $feedback['insert'] = "ok!";
                    } else {
                        $feedback['insert'] = "ERROR " . mysqli_error($connection);
                    }
                } else {
                    $feedback['rtest'] = "ERROR " . mysqli_error($connection);
                }
            }
        }
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
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Technicians</p>

                <input class="selected_list_item_input hidden" form="remove_technician" name='id' type="text" class="selected_list_item_input">

                    <button name="import_tech" form="import_tech_button" type="submit" class="stripe_button" onclick="toggle_import_technician()">
                        <p>Import Technicians</p>
                        <img src="../assets/icons/save_alt-black-18dp.svg"/>
                    </button>
                <div id="import_technician_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggle_import_technician()">
                        <img src="../assets/icons/close-black-18dp.svg">
                    </button>
                    <form action="" id="import_technician" method="POST" class="overlay_panel_form">
                        <div class="select_competition_wrapper table_row_wrapper">

                        <input type="text" name="selected_comp_id" id="selected_comp_input">
                        <?php
                            //get oragasniser id
                            $qry_get_org_id = "SELECT `id` FROM `organisers` WHERE `username` = '$username'";
                            $do_get_org_id = mysqli_query($connection, $qry_get_org_id);

                            if ($row = mysqli_fetch_assoc($do_get_org_id)) {
                                $org_id = $row['id'];
                            } else {
                                echo mysqli_error($connection);
                            }

                            $qry_get_comp_names = "SELECT `comp_name`, `comp_id` FROM `competitions` WHERE `comp_organiser_id` = '$org_id'";
                            $do_get_comp_names = mysqli_query($connection, $qry_get_comp_names);

                            while ($row = mysqli_fetch_assoc($do_get_comp_names)) {
                                $import_comp_name = $row['comp_name'];
                                $import_comp_id = $row['comp_id'];
                        ?>
                                        <div class="table_row" id="<?php echo $import_comp_id; ?>" onclick="importTechnicians(this)"><div class="table_item" id="in_<?php echo $import_comp_id; ?>"><?php echo $import_comp_name; ?></div></div>
                                    
                        <?php 
                            }
                        ?>
                        </div>
                        <button type="submit" name="submit_import" class="panel_submit" form="import_technician" value="Import">Import</button>
                    </form>
                </div>

                <form action="" method="POST" id="remove_technician"></form>
                <button class="stripe_button red" form="remove_technician" name="remove_technician" id="remove_technician_button">
                    <p>Remove Technician</p>
                    <img src="../assets/icons/delete-black-18dp.svg"/>
                </button>
                <button class="stripe_button orange" onclick="toggle_add_technician()">
                    <p>Add Technicians</p>
                    <img src="../assets/icons/add-black-18dp.svg"/>
                </button>
                     
                <div id="add_technician_panel" class="overlay_panel hidden" >
                    <button class="panel_button" onclick="toggle_add_technician()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <form class="overlay_panel_form" action="technicians.php?comp_id=<?php echo $comp_id; ?>" method="POST" id="new_technician" autocomplete="off">
                        <label for="username" >NAME</label>
                        <input type="text" placeholder="Type the technician's name" class="username_input" name="username">

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
                        <button type="submit" name="submit_tech" class="panel_submit" form="new_technician">Save</button>
                    </form>
                </div>

                <div class="search_wrapper">
                    <button type="button" class="clear_search_button"><img src="../assets/icons/close-black-18dp.svg"></button>
                    <input type="text" name="" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search cc">
                    <div class="search_results">
                        <?php
                        $query = "SELECT * FROM $table_name";
                        $query_do = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($query_do)){
                            $idke = $row["id"];
                            $nevecske = $row["name"];
                            ?>
                            <a id="<?php echo $idke ?>A" href="#<?php echo $idke ?>" onclick="selectSearch(this), autoFill(this)" tabindex="1"><?php echo $nevecske ?></a>
                            <?php
                        }
                            ?>
                    </div>
                </div>
            </div>
            <?php echo $selected_comp_id ?>
                        <div id="page_content_panel_main">
                <div class="table wrapper">
                    <?php

                        $query = "SELECT * FROM $table_name";
                        $query_do = mysqli_query($connection, $query);

                    if(mysqli_num_rows($query_do) == 0){
                    ?>
                        <div id="no_something_panel">
                            <p>You have no technicians set up!</p>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div class="table_header">
                            <div class="table_header_text" id="drag-left">NAME</div>
                                <button class="resizer" id="dragbar" mousedown="focus()"></button>
                                <div class="table_header_text" id="drag-right">ROLE</div>
                                <button class="resizer" ></button>
                                <div class="table_header_text">STATUS</div>
                                <div class="small_status_header">
                            </div>
                        </div>
                        <div class="table_row_wrapper" id="table">
                            <?php  
                                $qry = "SELECT * FROM $table_name";
                                $qry_do = mysqli_query($connection, $qry);
                                $feedback['misc'] = "ERROR " . mysqli_error($connection);

                            while($row = mysqli_fetch_assoc($query_do)){ 
                                $tech_id = $row["id"];
                                $tech_name = $row["name"];
                                $tech_pass = $row["pass"];
                                $tech_role = $row["role"];
                                $tech_online = $row["online"];

                                $tech_online = 0;
                                ?>
                                <div class="table_row" id="<?php echo $tech_id; ?>" onclick="selectRow(this)" tabindex="0">
                                    <div class="table_item"><p><?php echo $tech_name; ?></p></div>
                                    <!--<div class="table_item"><p class="password_table_item"><?php echo $tech_pass; ?></p></div>-->
                                    <div class="table_item"><p><?php echo roleConverter($tech_role); ?></p></div>
                                    <div class="table_item">
                                        <p>
                                        <?php
                                        if($tech_online == 0){
                                            echo "Offline";
                                        }
                                        else{
                                            echo "Online";
                                        }
                                        ?>
                                        </p>
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
    <script src="../js/controls.js"></script>
    <script src="../js/importoverlay.js"></script>
</body>
</html>