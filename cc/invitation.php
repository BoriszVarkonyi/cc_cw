<?php include "includes/header.php"; ?>
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
$array_getdata = array("comp_name", "comp_status","comp_sex", "comp_weapon", "comp_equipment", "comp_info", "comp_wc_type");

//connecting to database
$qry_getdata = "SELECT * FROM competitions WHERE comp_id = $comp_id";
$getdata_do = mysqli_query($connection, $qry_getdata);

if ($row = mysqli_fetch_assoc($getdata_do)) {

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

    $logo = "../assets/icons/no_image_black.svg";
    $delete_btn_class = "panel_button disabled";
}



//update plusinfo table with new title from form
if (isset($_POST['info_submit']) && 0 < strlen($_POST['info_title'])) {

    $check_d_table_qry = "SHOW TABLES LIKE 'info_$comp_id'";
    $check_d_table_do = mysqli_query($connection, $check_d_table_qry);
    $row = mysqli_num_rows($check_d_table_do);

    if ($row == 0) {

        $create_table_qry = "CREATE TABLE `info_$comp_id` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `info_title` VARCHAR(255) NOT NULL , `info_body` TEXT NOT NULL, PRIMARY KEY (id)) ENGINE = InnoDB";


        if (mysqli_query($connection, $create_table_qry)) {
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
    <title>Invitation</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/invitation_style.min.css">
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <main>

        <div id="title_stripe">
            <p class="page_title">Invitation & Plus Information</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button" type="button" onclick="printPage()" shortcut="SHIFT+P">
                    <p>Print Invitation</p>
                    <img src="../assets/icons/print_black.svg"/>
                </button>
                <button class="stripe_button primary" type="button" shortcut="SHIFT+S">
                    <p>Save Invitation</p>
                    <img src="../assets/icons/save_black.svg"/>
                </button>
            </div>
        </div>
        <p> <?php //print_r($feedback)
            ?> </p>
        <div id="page_content_panel_main">
            <div id="invitation_wrapper" class="wrapper">

                <div class="db_panel other">
                    <div class="db_panel_header">
                        <img src="../assets/icons/build_black.svg">
                        <p>Plus information</p>
                    </div>
                    <div class="db_panel_main table">
                        <div class="table t_c_0" id="plus_info_wrapper">
                            <div class="table t_c_0">
                                <div class="table_header">
                                    <div class="table_header_text">TITLE</div>
                                </div>
                                <div class="table_row_wrapper alt">
                                    <?php

                                    //displaying plsu infos from db in table rows
                                    $get_data_plusinfo_qry = "SELECT * FROM info_$comp_id";
                                    $get_data_plusinfo_do = mysqli_query($connection, $get_data_plusinfo_qry);
                                    if ($get_data_plusinfo_do !== FALSE) {
                                        while ($row = mysqli_fetch_assoc($get_data_plusinfo_do)) {

                                            $info_title = $row['info_title'];
                                            $info_body = $row['info_body'];
                                    ?>

                                            <div class="entry">
                                                <div class="table_row" onclick="toggleEntry(this)">
                                                    <div class="table_item invitation"><?php echo $info_title ?></div>
                                                </div>
                                                <form class="entry_panel collapsed" id="update" method="POST" action="../cc/invitation.php?comp_id=<?php echo $comp_id ?>">
                                                    <button class="panel_button" name="Close panel" type="submit" name="submit_delete" id="update">
                                                        <img src="../assets/icons/delete_black.svg">
                                                    </button>
                                                    <textarea id="update" name="text_body"><?php echo $info_body ?></textarea>
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
                                                <img src="../assets/icons/add_black.svg">
                                            </div>
                                        </div>
                                    </div>

                                    <form action="../cc/invitation.php?comp_id=<?php echo $comp_id ?>" id="adding_entry" class="hidden" method="POST">
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
                    </div>
                </div>
                <div class="db_panel other">
                    <div class="db_panel_header">
                        <img src="../assets/icons/build_black.svg">
                        <p>Add competition logo</p>
                    </div>
                    <div class="db_panel_main">
                        <form action="includes/delete_logo.php?comp_id=<?php echo $comp_id ?>" method="POST" id="delete_logo">
                            <button id="delete_logo" class="<?php echo $kuka_disable ?>">
                                <img src="../assets/icons/delete_black.svg">
                            </button>
                        </form>
                        <form action="../uploads/uploads.php?comp_id=<?php echo $comp_id ?>" method="POST" enctype="multipart/form-data" class="invitation_file_wrapper">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <label for="fileToUpload">Upload Image (max. 0.5MB)</label>
                                <p id="file_text"></p>
                            <input type="submit" value="Upload Image" name="submit" class="panel_submit" id="uploadButton" disabled>
                        </form>
                    </div>
                </div>

                <div id="cw_preview" class="paper_wrapper">
                    <div id="title_stripe_cw">
                        <img src="<?php echo $logo_path ?>" width="50" height="50" alt="<?php echo $comp_name ?>'s logo">

                        <h1><?php echo $comp_name ?></h1>
                        <button value="<?php echo $comp_id ?>" class="bookmark_button" onclick="favButton(this)">
                            <img src="../assets/icons/bookmark_border_black.svg" alt="Save Competition">
                        </button>
                        <p id="comp_status"><?php echo statusConverter($comp_status) ?></p>
                        <div>
                            <p><?php echo sexConverter($comp_sex) . "'s" ?></p>
                            <p><?php echo weaponConverter($comp_weapon) ?></p>
                            <p><?php echo $starting_date ?></p>
                            <p><?php echo "" ?></p>
                        </div>
                    </div>
                    <div id="invitation_wrapper">
                        <div class="column big">
                            <?php
                            $qry_get_announcements = "SELECT `data` FROM `announcements` WHERE `assoc_comp_id` = '$comp_id'";
                            $do_get_announcements = mysqli_query($connection, $qry_get_announcements);

                            if ($row = mysqli_fetch_assoc($do_get_announcements)) {
                                $string_json = $row['data'];

                                $json_table = json_decode($string_json);
                            } else {
                                $json_table = [];
                            }

                            if (count($json_table) != 0 ) {
                            ?>
                                <div id="announcements" class="column_panel">

                                    <?php
                                        foreach ($json_table as $ann_objects) {

                                        $title = $ann_objects -> title;
                                        $body = $ann_objects -> body;
                                    ?>
                                    <div class="breakpoint">
                                        <p><?php echo $title ?></p>
                                        <p><?php echo $body ?></p>
                                    </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                                <div id="basic_information_panel" class="column_panel breakpoint">
                                    <p class="column_panel_title">Basic Information:</p>
                                    <div>
                                        <div class="form_wrapper">
                                            <div>
                                                <div>
                                                    <label>HOST COUNTRY</label>
                                                    <p><?php echo $host_country ?></p>
                                                </div>
                                                <div>
                                                    <label>LOCATION AND ADDRESS</label>
                                                    <p><?php echo $city_street ?></p>
                                                    <p><?php echo $zip_code ?></p>
                                                </div>
                                                <div>
                                                    <label>ENTRY-FEE</label>
                                                    <p><?php echo $entry_fee ?></p>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label>STARTING DATE</label>
                                                    <p><?php echo $starting_date ?></p>
                                                </div>
                                                <div>
                                                    <label>ENDING DATE</label>
                                                    <p><?php echo $ending_date ?></p>
                                                </div>
                                                <div>
                                                    <label>END OF PRE-REGISTRTATION</label>
                                                    <p><?php echo $end_of_pre_reg ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- equipment panel -->
                                <div id="equipment_panel" class="column_panel breakpoint">
                                    <p class="column_panel_title">Equipment needed to be checked:</p>
                                    <!-- weapons check table rows -->
                                    <table class="fixed">
                                        <thead>
                                            <tr>
                                                <th><p>Equipment's name</p></th>
                                                <th><p>Needed Quantity</p></th>
                                            </tr>
                                        </thead>
                                        <tbody class="alt">
                                            <?php
                                                $equipment = array("Epee","Foil","Sabre","Electric Jacket","Plastron","Under-Plastron","Socks","Mask","Gloves","Bodywire","Maskwire","Chest protector","Metallic glove");

                                                $array_equipment = explode(",", $comp_equipment);

                                                for ($i = 0; $i < count($equipment); $i++) {

                                                    if ($array_equipment[$i] != 0) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $equipment[$i] ?></td>
                                                                <td><?php echo $array_equipment[$i] ?></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>

                                            <!-- ha üres

                                                            <tr>
                                                                <td colspan="1">No equipment</td>
                                                            </tr>
                                            -->
                                        </tbody>
                                    </table>
                                </div>

                                <!-- additional info panel -->
                                <div id="additional_panel" class="column_panel breakpoint">
                                    <p class="column_panel_title">Additional information for Fencers:</p>
                                    <div>
                                        <p><?php echo $comp_info ?></p>
                                    </div>
                                </div>

                                <!-- weapon control panel -->
                                <div id="weapon_control_panel" class="column_panel breakpoint">
                                    <p class="column_panel_title">Weapon Control appointments and bookings:</p>
                                    <div>
                                        <div class="weapon_control_day">
                                            <p>{Weapon Control Date}</p>
                                        </div>

                                        <div class="weapon_control_day">
                                            <p>{Weapon Control Date}</p>
                                        </div>
                                    </div>
                                </div>

                                <div id="plus_information_panel" class="column_panel breakpoint">
                                    <p class="column_panel_title">Plus Information:</p>
                                    <div>
                                        <?php

                                            //display plus info from DB

                                            $get_plsuinfo_qry = "SELECT * FROM info_$comp_id";
                                            if (!$get_plsuinfo_do = mysqli_query($connection, $get_plsuinfo_qry)) {
                                                $feedback = "ERROR: " . mysqli_error($connection);
                                            }

                                            if ($get_plsuinfo_do !== FALSE) {//checks whether table exists
                                                while ($row = mysqli_fetch_assoc($get_plsuinfo_do)) {

                                                    $info_title = $row['info_title'];
                                                    $info_body = $row['info_body'];
                                        ?>
                                                    <div class="breakpoint">
                                                        <p><?php echo $info_title ?></p>
                                                        <p><?php echo $info_body ?></p>
                                                    </div>
                                        <?php
                                                }
                                            } else  { // displayed when there are no plus infos for comp_id
                                        ?>

                                            <p>This competition has no plus information!</p>

                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="column small">
                                <div id="competition_controls" class="column_panel no_bottom">
                                    <p class="column_panel_title">Competition Controls:</p>
                                    <div class="competition_controls_wrapper">
                                        <button <?php echo $test = ($comp_status  != 2) ? "disabled" : "" ?> onclick="location.href='pre_registration.php?comp_id=<?php echo $comp_id ?>'">Pre-Register</button>
                                        <button <?php echo $test = ($comp_status  != 2) ? "disabled" : "" ?> onclick="location.href='book_appointment.php?comp_id=<?php echo $comp_id ?>'">Book Appointment</button>
                                        <button onclick="location.href='competitors.php?comp_id=<?php echo $comp_id ?>'">Competitors</button>
                                        <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='pools.php?comp_id=<?php echo $comp_id ?>'">Pools</button>
                                        <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='temporary_ranking.php?comp_id=<?php echo $comp_id ?>'">Temporary Ranking</button>
                                        <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='table.php?comp_id=<?php echo $comp_id ?>'">Table</button>
                                        <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='final_results.php?comp_id=<?php echo $comp_id ?>'">Final Results</button>
                                        <button onclick="printPage()">Print</a>
                                        <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href=''">Watch Video / Watch Live</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/invitation.js"></script>
    <script src="javascript/entry_controls.js"></script>
</body>
</html>