<?php include "../includes/headerburger.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 
$feedback = array(
"delete" => "",
"update" => "",
"getnumrows" => "",
"getdata" => "",
"insert_info" => "",
"ttest" => "",
"create" => ""
);

$kuka_disable = "panel_button";

//array of colums I need from database
$array_getdata = array ("comp_name", "comp_sex", "comp_weapon", "comp_equipment", "comp_info", "comp_host", "comp_location", "comp_postal", "comp_start", "comp_end", "comp_pre_end", "comp_wc_info", "comp_entry");

//connecting to database
    $qry_getdata = "SELECT * FROM competitions WHERE comp_id = $comp_id";
    $getdata_do = mysqli_query($connection, $qry_getdata);

    if($row = mysqli_fetch_assoc($getdata_do)) {

        //Putting the data from database into an assoc array with $array_getdata[] indexes
        for ($i = 0; $i <  count($array_getdata); ++$i) {

            if ($i == 0) {
                $assoc_array_data = [$array_getdata[$i] => $row[$array_getdata[$i]]];
            } else {
                $assoc_array_data[$array_getdata[$i]] = $row[$array_getdata[$i]];
                
            }
        }

    } else { //error branch
       $feedback['getdata'] = "ERROR: " . mysqli_error($connection); 
    }

    //get logo image
    if (file_exists("../uploads/" . $comp_id . ".png")) {

        $logo = "../uploads/" . $comp_id . ".png";
        $delete_btn_class = "panel_button";

    } else {

        $logo = "../assets/icons/delete-black-18dp.svg";
        $delete_btn_class = "panel_button disabled";
    }
    



    //update plusinfo table with new title from form
    if (isset($_POST['info_submit']) && 0 < strlen($_POST['info_title'])) {

        $check_d_table_qry = "SHOW TABLES LIKE 'info_$comp_id'";
        $check_d_table_do = mysqli_query($connection, $check_d_table_qry);
        $row = mysqli_num_rows($check_d_table_do);

        if ($row == 0) {

            $create_table_qry = "CREATE TABLE `info_$comp_id` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `info_title` VARCHAR(255) NOT NULL , `info_body` TEXT NOT NULL, PRIMARY KEY (id)) ENGINE = InnoDB";

            
            if (mysqli_query($connection, $create_table_qry)){
                $feedback['create'] = "Minden fasza!";
            } else {
                $feedback['create'] = "ERROR " . mysqli_error($connection);
            }

        } else;

        $text_title = $_POST['info_title'];

        //test for duplicate rows
        $dupli_rows_qry = "SELECT * FROM info_$comp_id WHERE info_title = '$text_title'";
        if ($dupli_rows_do = mysqli_query($connection, $dupli_rows_qry)) {

            $numrows = mysqli_num_rows($dupli_rows_do);

        } else {
            $feedback['getnumrows'] = "ERROR: " . mysqli_error($connection);
        }

        if ($numrows == 0) {

            $insert_info_qry = "INSERT INTO info_$comp_id (info_title) VALUE ('$text_title')";
            $inser_indo_do = mysqli_query($connection, $insert_info_qry);

            if ($inser_indo_do) {
                $feedback['insert_info'] = "minden OK!";
            } else { //error branch
                $feedback['insert_info'] =  "ERROR:" . mysqli_error($connection);
            }

        } else {
            $feedback['insert_info'] = "You already have info with the same title!";
        }
    }
    

    //updateing info_body from text areas
    if (isset($_POST['submit_body'])) {

        $new_info_body = $_POST['text_body'];
        $change_title = $_POST['text_title_to_change'];

        $update_qry = "UPDATE info_$comp_id SET info_body = '$new_info_body' WHERE info_title = '$change_title'";
        if (mysqli_query($connection, $update_qry)) {
            $feedback['update'] = "Minden ok!";
        } else {
            $feedback['update'] = "ERROR:" . mysqli_error($connection);
        }
    }

    //deleteing info_$comp_id row
    if (isset($_POST['submit_delete'])) {

        $change_title = $_POST['text_title_to_change'];

        $delete_qry = "DELETE FROM info_$comp_id WHERE info_title = '$change_title'";
        if (mysqli_query($connection, $delete_qry)) {
            $feedback['delete'] = "Minden ok delete!";
        } else {
            $feedback['delete'] = "ERROR:" . mysqli_error($connection);
        }
    }





    //does the logo exist needed for the delete button
    if (file_exists("../uploads/$comp_id.png")) {
        $kuka_disable = "panel_button"; //ide ird be a classt ha fel van toltve logo
    } else {
        $kuka_disable = "panel_button hidden"; //ide ird be a classt ha NINCS fel toltve logo
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $assoc_array_data['comp_name'] ?></title>
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
                <p class="page_title">Plus Information</p>
                <button class="stripe_button" type="button" onclick="printPage()">
                    <p>Print Invitation</p>
                    <img src="../assets/icons/print-black-18dp.svg"></img>
                </button>
                <button class="stripe_button orange" type="button">
                    <p>Save Invitation</p>
                    <img src="../assets/icons/save-black-18dp.svg"></img>
                </button>
            </div>

            <p> <?php //print_r($feedback) ?> </p>
            <div id="page_content_panel_main">
                <div id="invitation_wrapper" class="wrapper">

                    <div id="plus_information">

                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/build-black-18dp.svg"  class="db_panel_stripe_icon">
                            <p>Plus information</p>
                        </div>

                        <div class="db_panel_main">
                            <div id="plus_info_wrapper" class="entry_table_row_wrapper">
                                <?php

                                    //displaying plsu infos from db in table rows
                                    $get_data_plusinfo_qry = "SELECT * FROM info_$comp_id";
                                    $get_data_plusinfo_do = mysqli_query($connection, $get_data_plusinfo_qry);
                                    if ($get_data_plusinfo_do !== FALSE) {
                                        while ($row = mysqli_fetch_assoc($get_data_plusinfo_do)) {

                                            $info_title = $row['info_title'];
                                            $info_body = $row['info_body'];
                                ?>

                                        <!-- while ozd majd ki csoro  -->
                                        <div class="entry" >
                                            <div class="table_row" onclick="toggleEntry(this)">
                                                <div class="table_item invitation"><?php echo $info_title ?></div>
                                            </div>
                                                <form class="entry_panel collapsed" id="update" method="POST" action="../php/invitation.php?comp_id=<?php echo $comp_id ?>">
                                                    <button class="panel_button" type="submit" name="submit_delete" id="update" >
                                                        <img src="../assets/icons/delete-black-18dp.svg">
                                                    </button>
                                                    <textarea id="update" name="text_body" ><?php echo $info_body ?></textarea>
                                                    <input id="update" name="text_title_to_change" type="text" value="<?php echo $info_title ?>" class="hidden">
                                                    <input id="update" name="submit_body" type="submit" value="Save" class="panel_submit">
                                                </form>
                                        </div>

                                <?php        
                                        } 
                                    }
                                ?>

                                <div id="add_entry" onclick="hideNshow()">
                                    <div class="table_row" onclick="">
                                        <div class="table_item">
                                            Add information
                                            <img src="../assets/icons/add-black-18dp.svg" >
                                        </div>
                                    </div>
                                </div>

                                <form action="../php/invitation.php?comp_id=<?php echo $comp_id ?>" id="adding_entry" class="hidden" method="POST">
                                    <div class="table_row">
                                        <div class="table_item">
                                            <input name="info_title" type="text" class="title_input" placeholder="Type in the title">
                                            <input name="info_submit" type="submit" class="save_entry" value="Create">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="inv_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/build-black-18dp.svg"  class="db_panel_stripe_icon">
                            <p>Add competition logo</p>
                        </div>
                        <div class="db_panel_main">
                            <form action="../includes/delete_logo.php?comp_id=<?php echo $comp_id ?>" method="POST" id="delete_logo">
                                <button id="delete_logo" class="<?php echo $kuka_disable ?>">
                                    <img src="../assets/icons/delete-black-18dp.svg" >
                                </button>
                            </form>
                            <form action="../uploads/uploads.php?comp_id=<?php echo $comp_id ?>" method="POST" enctype="multipart/form-data" class="invitation_file_wrapper">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <label for="fileToUpload">Upload Image</label>
                                <p id="fileText">Fájl neve ide</p>
                                <input type="submit" value="Upload Image" name="submit" class="panel_submit" id="uploadButton" disabled>
                            </form>
                        </div>
                    </div>

                    <div id="cw_preview">

                        <div id="comp_data">
                            <img src=<?php echo $logo ?> >

                            <p class="cw_panel_title"><?php echo $comp_name ?></p>
                            <p id="comp_status">Ongoing</p>

                            <div>
                                <p><?php echo sexConverter($assoc_array_data['comp_name']) . "'s" ?></p>
                                <p><?php echo weaponConverter($assoc_array_data['comp_weapon']) ?></p>
                                <p><?php echo date('Y', strtotime($assoc_array_data['comp_start'])) ?></p>
                            </div>
                        </div>

                            <!-- basic info panel -->
                        <div id="basic_information_panel">
                            <div>
                                <p class="data_label">HOST COUNTRY:</p>
                                <p><?php echo $assoc_array_data['comp_host'] ?></p>
                                <p class="data_label">LOCATION AND ADDRESS:</p>
                                <p><?php echo $assoc_array_data['comp_location'] ?></p>
                                <p class="data_label">ENTRY-FEE:</p>
                                <p><?php echo $assoc_array_data['comp_entry'] . " Ft"; ?></p>
                            </div>
                            <div>
                                <p class="data_label">STARTING DATE:</p>
                                <p><?php echo $assoc_array_data['comp_start'] ?></p>
                                <p class="data_label">ENDING DATE:</p>
                                <p><?php echo $assoc_array_data['comp_end'] ?></p>
                                <p class="data_label pre_reg">END OF PRE-REGISTRTATION:</p>
                                <p><?php echo $assoc_array_data['comp_pre_end'] ?></p>
                            </div>
                        </div>

                        <!-- equipment panel -->
                        <div id="equipment_panel">
                            <p class="data_label panel_title">EQUIPMENT NEEDED TO BE CHECKED</p>

                            <!-- weapons check table rows -->
                            <div>
                                <?php 
                                    $equipment = array("Epee","Foil","Sabre","Electric Jacket","Plastron","Under-Plastron","Socks","Mask","Gloves","Bodywire","Maskwire","Chest protector","Metallic glove");

                                    $array_equipment = explode(",", $assoc_array_data['comp_equipment']);

                                    for ($i = 0; $i < count($equipment); $i++) {

                                     if ($array_equipment[$i] != 0) {
                                        ?>
                                            <div class="table_row">
                                                <div class="table_item"><?php echo $equipment[$i] ?></div>
                                                <div class="table_item"><?php echo $array_equipment[$i] ?></div>
                                            </div>
                                        <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- additional info panel -->
                            <div id="additional_panel">
                                <p class="data_label panel_title">ADDITIONAL INFORMATION FOR FENCERS</p>
                                <div>
                                    <p><?php echo $assoc_array_data['comp_info'] ?></p>
                                </div>
                            </div>

                            <!-- weapon control panel -->
                            <div id="weapon_control_panel">
                                <p class="data_label panel_title">WEAPON CONTROL</p>
                                <div>
                                    <div class="weapon_control_day">
                                        <p>{Weapon Control Date}</p>
                                        <a>Book appointment</a>
                                    </div>
                                </div>
                            </div>

                            <div id="plus_information_panel">
                                <p class="data_label panel_title">PLUS INFORMATION</p>
                                <div>
                                    <?php
                                    
                                        //display plus info from DB
                                        $get_plsuinfo_qry = "SELECT * FROM info_$comp_id";
                                        $get_plsuinfo_do = mysqli_query($connection, $get_plsuinfo_qry);

                                        while ($row = mysqli_fetch_assoc($get_plsuinfo_do)) {

                                            $info_title = $row['info_title'];
                                            $info_body = $row['info_body'];
                                    ?>

                                        <p><?php echo $info_title ?></p>
                                        <p><?php echo $info_body ?></p>

                                    <?php
                                        }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/invitation.js"></script>
</html>