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
    $table_name = "ref_" . $comp_id;

    //checking for dupli tables
    $check_d_table_qry = "SELECT COUNT(*)
    FROM information_schema.tables 
    WHERE table_schema = 'ccdatabase' 
    AND table_name = '$table_name';";

    if ($check_d_table_do = mysqli_query($connection, $check_d_table_qry)) {
        $num_rows = mysqli_num_rows($check_d_table_do);
        $feedback['ttest'] = "ok!";

        if ($num_rows != 0) {
            //creating weapon control  table
            $qry_creating_wc_table = "CREATE TABLE `ccdatabase`.`$table_name` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `pass` VARCHAR(255) NOT NULL , `full_name` VARCHAR(255) NOT NULL , `nat` VARCHAR(255) NOT NULL , `online` INT(11) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB DEFAULT CHARSET=utf8;";

            if ($do_qry_creating_table = mysqli_query($connection, $qry_creating_wc_table)) {
                $feedback['create_table'] = "ok!";
            } else {
                $feedback['create_table'] = "ERROR " . mysqli_error($connection);
            }

        } else {
            $feedback['misc'] = "ERROR valami szar van a palacsintaban" . $num_rows;
        }

    } else {
        $feedback['ttest'] = "ERROR " . mysqli_error($connection);
    }



    if (isset($_POST['submit_import'])) {
        $selected_comp_id = $_POST['selected_comp_id'];

        $qry_import = "SELECT * FROM `ref_$selected_comp_id`";
        $do_import = mysqli_query($connection, $qry_import);

        while ($row = mysqli_fetch_assoc($do_import)) {
            $name = $row['name'];
            $pass = $row['pass'];
            $full_name = $row['full_name'];
            $nat = $row['nat'];
            $online = $row['online'];

            //test for existing techs
            $test_for_dupli = "SELECT * FROM $table_name WHERE name = '$name'";
            $do_test_for_dupli = mysqli_query($connection, $test_for_dupli);
            $test_num_rows = mysqli_num_rows($do_test_for_dupli);

            if ($test_num_rows == FALSE) {
                //update current comps tach table with imported tecch
                $qry_insert_import = "INSERT INTO $table_name (name, pass, full_name, nat, online) VALUES ('$name', '$pass', '$full_name', '$nat', '$online')";
                $do_insert_import = mysqli_query($connection, $qry_insert_import);
                echo mysqli_error($connection);
            }
        }
    }

    if(isset($_POST["remove_referee"])) {
        $id = $_POST['id'];
        echo "áááááááááááááááá";
        echo $id ;
        echo "asd";

        $qry_delete = "DELETE FROM ref_$comp_id WHERE id = '$id'";
        $do_delete = mysqli_query($connection, $qry_delete);
        echo mysqli_error($connection);
        //header("Refresh:0");
    }

    if(isset($_POST["new_technician"])){

        //get data from form
        $ref_name = $_POST['username'];
        $ref_full_name = $_POST['full_name'];


        

        $ref_nat = $_POST['f_nat'];

        if ($ref_name != "" && $ref_full_name != "" && $ref_nat != "") {
            
            //test for existing row
            $qry_row_test = "SELECT * FROM $table_name WHERE name = '$ref_name'";
            $do_row_test = mysqli_query($connection, $qry_row_test);

            $row_num = mysqli_num_rows($do_row_test);
            $feedback['rtest'] = "ok!";

            if ($row_num == FALSE) {
                $qry_insert = "INSERT INTO $table_name (name, full_name, pass, nat) VALUES ('$ref_name', '$ref_full_name', '', '$ref_nat')";
                if (mysqli_query($connection, $qry_insert)) {
                    $feedback['insert'] = "ok!";
                } else {
                    $feedback['insert'] = "ERROR " . mysqli_error($connection);
                }

            } else {
                $feedback['rtest'] = "aaaa" . mysqli_error($connection);
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
    <title>Referees</title>
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
                        <p class="page_title">Referees</p>
                        <button class="stripe_button" onclick="toggle_import_technician()">
                            <p>Import Referees</p>
                            <img src="../assets/icons/save_alt-black-18dp.svg"/>
                        </button>
                        <div id="import_technician_panel" class="overlay_panel hidden">
                            <button class="panel_button" onclick="toggle_import_technician()">
                                <img src="../assets/icons/close-black-18dp.svg" >
                            </button>
                            <form action="" id="import_ref" method="POST" class="overlay_panel_form">
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
                                
                                <div class="table_row" id="<?php echo $import_comp_id; ?>" onclick="importTechnicians(this)"><div class="table_item" id="<?php echo $import_comp_id; ?>"><?php echo $import_comp_name; ?></div></div>

                                <?php
                                    }
                                ?>
                                </div>
                                <button type="submit" name="submit_import" class="panel_submit" value="Import">Import</span></button>
                            </form>
                        </div>
                        <input type="text" name='id' form="remove_technician" class="selected_list_item_input hidden">
                        <form action="" method="POST" id="remove_technician" class="hidden"></form>
                        <button type="submit" class="stripe_button red" onclick="" form="remove_technician" name="remove_referee" id="remove_technician_button">
                            <p>Remove Referee</p>
                            <img src="../assets/icons/delete-black-18dp.svg"/>
                        </button>
                        <button class="stripe_button orange" onclick="toggle_add_technician()">
                            <p>Add Referees</p>
                            <img src="../assets/icons/add-black-18dp.svg"/>
                        </button>
                    <div id="add_technician_panel" class="overlay_panel hidden">
                        <button class="panel_button" onclick="toggle_add_technician()">
                            <img src="../assets/icons/close-black-18dp.svg" >
                        </button>
                            <form class="overlay_panel_form" action="referees.php?comp_id=<?php echo $comp_id; ?>" method="POST" id="new_technician">
                                <label for="username" >NAME</label>
                                <input type="text" placeholder="Type the referees's name" class="username_input" name="username">
                                
                                <label for="full_name" >FULL NAME</label>
                                <input type="text" placeholder="Type the referees's full name" id="full_name_input" class="full_name_input" name="full_name">
                                <label>NATION / CLUB</label>
                                <div class="search_wrapper">
                                    <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                                    <input type="text" name="f_nat" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="set_nation_input" placeholder="Search Country by Name" class="search cc">
                                    <div class="search_results">
                                    <?php include "../includes/nations.php"; ?>
                                    </div>
                                </div>
                            <button type="submit" name="new_technician" class="panel_submit" form="new_technician" value="Save">Save</button>
                        </form>
                    </div>
                    <div class="search_wrapper">
                        <button type="button" class="clear_search_button"><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search cc">
                        <div class="search_results">
                            <?php
                                $ref_list_query = "SELECT * FROM $table_name";
                                $ref_list_query_do = mysqli_query($connection, $ref_list_query);
                                while($row = mysqli_fetch_assoc($ref_list_query_do)){ 

                                    $ref_id = $row['id'];
                                    $ref_name = $row['name'];
                                
                                
        
                            
                            ?>

                            <a id="<?php echo $ref_id ?>" href="#"  onclick="selectSearch(this), autoFill(this)"><?php echo $ref_name ?></a>

                            <?php 
                            
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="page_content_panel_main">
                    <div class="wrapper table">

                    <?php 
                    
                    $ref_list_query = "SELECT * FROM $table_name";
                    $ref_list_query_do = mysqli_query($connection, $ref_list_query);

                    if ($ref_list_query_do) {
                        $feedback['fencer_data'] = 'ok!';
                    } else {
                        $feedback['fencer_data'] = 'ERROR ' . mysqli_error($connection);
                    }

                    if(0 == mysqli_num_rows($ref_list_query_do)){?>
                            <div id="no_something_panel">
                                <p>You have no referees set up!</p>
                            </div>
                    <?php
                    } else {
                    ?>       
                    
                        <div class="table_header">
                            <div class="table_header_text">FULL NAME</div>
                            <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp()"></button>
                            <div class="table_header_text">NATION / CLUB</div>
                            <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp()"></button>
                            <div class="table_header_text">USERNAME</div>
                            <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp()"></button>
                            <div class="table_header_text">STATUS</div>
                            <div class="small_status_header"></div>
                        </div>
                        <div class="table_row_wrapper">
                        <?php  
                        while($row = mysqli_fetch_assoc($ref_list_query_do)){ 
                            
                            $ref_id = $row["id"];
                            $ref_name = $row["name"];
                            $ref_online = $row["online"];
                            $ref_full_name = $row["full_name"];
                            $ref_nat = $row['nat'];
                            
                            ?>

                            <div class="table_row" id="<?php echo $ref_id; ?>" onclick="selectRow(this)">
                                <div class="table_item"><p><?php echo $ref_full_name; ?></p></div>
                                <div class="table_item"><p><?php echo $ref_nat ?></p></div>
                                <div class="table_item"><p><?php echo $ref_name; ?></p></div>
                                <div class="table_item"><p><?php
                                
                                if($ref_online == 0){

                                    echo "Offline";

                                }
                                else{
                                    echo "Online";
                                }
                                
                                ?>
                                </p>
                            </div>
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
<script src="../js/list.js"></script>
<script src="../js/referees.js"></script>
<script src="../js/controls.js"></script>
<script src="../js/importoverlay.js"></script>
</body>
</html>