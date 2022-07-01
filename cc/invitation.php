<?php include "includes/header.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    $qry_make_table = "CREATE TABLE `ccdatabase`.`plus_info` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `title` VARCHAR(255) NOT NULL , `body` TEXT NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $make_table = mysqli_query($connection, $qry_make_table);


$kuka_disable = "panel_button";

//connecting to database
$qry_getdata = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
$getdata_do = mysqli_query($connection, $qry_getdata);

if ($row = mysqli_fetch_assoc($getdata_do)) {

    $comp_name = $row['comp_name'];
    $comp_status = $row['comp_status'];
    $comp_sex = $row['comp_sex'];
    $comp_weapon = $row['comp_weapon'];
    $comp_equipment = $row['comp_equipment'];
    $comp_info = $row['comp_info'];
    $comp_wc_type = $row['comp_wc_type'];
}

//get basic_info
$qry_get_info = "SELECT data FROM basic_info WHERE assoc_comp_id = '$comp_id'";
$do_get_info = mysqli_query($connection, $qry_get_info);
if ($row = mysqli_fetch_assoc($do_get_info)) {
    $string = $row['data'];

} else {
    $string = '{"host_country":"&#8709","city_street":"&#8709","zip_code":"&#8709","entry_fee":"&#8709","starting_date":"&#8709","ending_date":"&#8709","end_of_pre_reg":"&#8709"}';
}
$basic_info = json_decode($string);
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
    $qry_make_table = "CREATE TABLE `ccdatabase`.`plus_info` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `title` VARCHAR(255) NOT NULL , `body` TEXT NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $make_table = mysqli_query($connection, $qry_make_table);

    $title = mysqli_real_escape_string($connection, $_POST['info_title']);

    //insert row
    $qry_insert_new_row = "INSERT INTO plus_info (assoc_comp_id, title) VALUES ('$comp_id', '$title')";
    if ($do_insert_new_row = mysqli_query($connection, $qry_insert_new_row)) {
        header("Refresh: 0");
    } else {
        echo mysqli_error($connection);
    }
}


//updateing info_body from text areas
if (isset($_POST['submit_body'])) {
    $body = mysqli_escape_string($connection, $_POST['text_body']);
    $id = $_POST['entry_id'];
    $title = "";

    $qry_update_with_body = "UPDATE plus_info SET body = '$body' WHERE id = '$id'";
    if ($do_update_with_body = mysqli_query($connection, $qry_update_with_body)) {
        header("Refresh: 0");
    } else {
        echo mysqli_error($connection);
    }

}

//deleteing info_$comp_id row
if (isset($_POST['submit_delete'])) {

    $id_to_del = $_POST['entry_id'];

    //drop row
    $qry_delete = "DELETE FROM plus_info WHERE id='$id_to_del'";
    if ($do_del = mysqli_query($connection, $qry_delete)) {
        header("Refresh: 0");
    } else {
        echo mysqli_error($connection);
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
    <?php include "includes/navigation.php"; ?>
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

                                        $qry_display = "SELECT id, title, body FROM plus_info WHERE assoc_comp_id = '$comp_id'";
                                        $do_display = mysqli_query($connection, $qry_display);

                                        while ($row = mysqli_fetch_assoc($do_display)) {
                                    ?>

                                            <div class="entry">
                                                <div class="table_row" onclick="toggleEntry(this)">
                                                    <!-- ezt át lehetne pakolni egy inputra es akkor tudna megvaltoztatni mostmar a titlet is az nber ##KRIS -->
                                                    <div class="table_item invitation"><?php echo $row['title'] ?></div>
                                                </div>
                                                <form class="entry_panel collapsed" id="update" method="POST" action="../cc/invitation.php?comp_id=<?php echo $comp_id ?>">
                                                    <input id='plus_info_id' name='entry_id' type='text' value='<?php echo $row['id'] ?>' class='hidden' >
                                                    <button class="panel_button" type="submit" name="submit_delete" id="update">
                                                        <img src="../assets/icons/delete_black.svg">
                                                    </button>
                                                    <textarea placeholder='Type your information here...' id="update" name="text_body"><?php echo $row['body'] ?></textarea>
                                                    <input id="update" name="text_title_to_change" type="text" value="<?php echo $row['body'] ?>" class="hidden">
                                                    <input id="update" name="submit_body" type="submit" value="Save" class="panel_submit">
                                                </form>
                                            </div>
                                    <?php
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
                        <img src="<?php echo $logo ?>" width="50" height="50" alt="<?php echo $comp_name ?>'s logo">

                        <h1><?php echo $comp_name ?></h1>
                        <button value="<?php echo $comp_id ?>" class="bookmark_button" onclick="favButton(this)">
                            <img src="../assets/icons/bookmark_border_black.svg" alt="Save Competition">
                        </button>
                        <p id="comp_status"><?php echo statusConverter($comp_status) ?></p>
                        <div>
                            <p><?php echo sexConverter($comp_sex) . "'s" ?></p>&#8239
                            <p><?php echo weaponConverter($comp_weapon) ?></p>&#8239
                            <p><?php echo $basic_info -> starting_date ?></p>&#8239
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
                                                    <p><?php echo $basic_info -> host_country ?></p>
                                                </div>
                                                <div>
                                                    <label>LOCATION AND ADDRESS</label>
                                                    <p><?php echo $basic_info -> city_street ?></p>
                                                    <p><?php echo $basic_info -> zip_code ?></p>
                                                </div>
                                                <div>
                                                    <label>ENTRY-FEE</label>
                                                    <p><?php echo $basic_info -> entry_fee ?></p>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label>STARTING DATE</label>
                                                    <p><?php echo $basic_info -> starting_date ?></p>
                                                </div>
                                                <div>
                                                    <label>ENDING DATE</label>
                                                    <p><?php echo $basic_info -> ending_date ?></p>
                                                </div>
                                                <div>
                                                    <label>END OF PRE-REGISTRTATION</label>
                                                    <p><?php echo $basic_info -> end_of_pre_reg ?></p>
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
                                        <?php
                                            $qry_get_t_id = "SELECT ass_tournament_id FROM competitions WHERE comp_id = '$comp_id'";
                                            $do_get_t_id = mysqli_query($connection, $qry_get_t_id);
                                            $t_id = mysqli_fetch_assoc($do_get_t_id)['ass_tournament_id'];
                                        $qry = "SELECT appointments FROM tournaments WHERE id = '$t_id'";
                                        $do = mysqli_query($connection, $qry);
                                        $string = mysqli_fetch_assoc($do)['appointments'];
                                        $table = json_decode($string);
                                            foreach ($table as $day => $foo) {
                                        ?>
                                        <div class="weapon_control_day">
                                            <p><?php echo $day ?></p>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div id="plus_information_panel" class="column_panel breakpoint">
                                    <p class="column_panel_title">Plus Information:</p>
                                    <div>


                                    <?php
                                        $empty = true;
                                        $qry = "SELECT title, body FROM plus_info WHERE assoc_comp_id = '$comp_id'";
                                        $do = mysqli_query($connection, $qry);
                                        while ($row = mysqli_fetch_assoc($do)) {
                                            $empty = false;
                                    ?>
                                                    <div class="breakpoint">
                                                        <p><?php echo $row['title'] ?></p>
                                                        <p><?php echo $row['body'] ?></p>
                                                    </div>

                                    <?php
                                        }
                                        if ($empty) {
                                    ?>

                                            <p>This competition has no plus information!</p>
                                        <?php } ?>

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