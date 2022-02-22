<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

error_reporting(E_ERROR | E_PARSE);
//barcode scan
if (isset($_POST["barcode"])) {
    $fencer_id = $_POST["barcode"];
    header("location:fencers_weapon_control.php?comp_id=$comp_id&fencer_id=$fencer_id&type=immediate");
}

    //create table
    $qry_create_table = "CREATE TABLE `ccdatabase`.`weapon_control` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` VARCHAR(255) NOT NULL , `fencer_id` VARCHAR(255) NOT NULL , `issues_array` JSON NULL DEFAULT NULL , `weapons_turned_in` JSON NULL DEFAULT NULL , `notes` VARCHAR(255) NULL DEFAULT NULL , `check_in_date` TIMESTAMP NULL DEFAULT NULL , `check_out_date` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_table = mysqli_query($connection, $qry_create_table);

    //test for fencers from this comp in the database
    $qry_test = "SELECT `assoc_comp_id` FROM `weapon_control` WHERE `assoc_comp_id` LIKE '$comp_id,' LIMIT 1;";
    $do_test = mysqli_query($connection, $qry_test);
    if (mysqli_num_rows($do_test) === 0) {
        $fencers_set = false; //yes
    } else {
        $fencers_set = true; //no
    }

    //update database with the fencers of the competition
    if (!$fencers_set) {
        //get fencers from competitors table
        $qry_get_fencers = "SELECT `data` FROM `competitors` WHERE `assoc_comp_id` = '$comp_id'";
        $do_get_fencers = mysqli_query($connection, $qry_get_fencers);
        if ($row = mysqli_fetch_assoc($do_get_fencers)) {
            //get string
            $string = $row['data'];
            //make json
            $fencers_json_table = json_decode($string);
            if (count($fencers_json_table) < 1) {
                $full_competitors = false;
            } else {
                $full_competitors = true;
            }
        } else {
            echo "Couldn't get competitiors: " . mysqli_error($connection);
        }

        //get array of fencer ids
        $fencer_ids_array = [];
        for ($i = 0; $i < count($fencers_json_table); $i++) {
            $fencer_ids_array[] = $fencers_json_table[$i] -> id;
        }

        //function to insert new fencers into weapon control table with assoc_comp_id and fencer_id custom
        function insertNewFencer($connection, $comp_id, $current_fencer_id) {
            $qry_insert_new_fencers = "INSERT INTO weapon_control (`assoc_comp_id`,`fencer_id`) VALUES ('$comp_id', '$current_fencer_id')";
            if (!mysqli_query($connection, $qry_insert_new_fencers)) {
                echo "Could NOT insert fencer: " . $current_fencer_id . " into database e: " . mysqli_error($connection) . "<br>";
            }
        }
        if ($full_competitors) {
            //check for first loading
            $qry_check = "SELECT `id` FROM weapon_control WHERE assoc_comp_id = '$comp_id' LIMIT 1";
            $do_check = mysqli_query($connection, $qry_check);
            if (mysqli_num_rows($do_check) === 0) {
                for ($i = 0; $i < count($fencer_ids_array); $i++) {
                    $current_fencer_id = $fencer_ids_array[$i];
                    insertNewFencer($connection, $comp_id, $current_fencer_id);
                }
            }
        }
    }

    if (isset($_POST['add_wc'])) {
        $fencer_id = $_POST['fencer_id'];
        header("Location: fencers_weapon_control.php?comp_id=$comp_id&fencer_id=$fencer_id");
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weapon Control</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Weapon Control Bookings</p>
            </div>
            <div id="page_content_panel_main">
                <table class="wrapper">
                    <thead>
                        <tr>
                            <th>
                                <p>NATION</p>
                            </th>
                            <th>
                                <p>STARTING TIME</p>
                            </th>
                            <th>
                                <p>ESTIMATED FINISH TIME</p>
                            </th>
                            <th>
                                <p>NUMBER OF FENCERS</p>
                            </th>
                            <th class="square"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="" tabindex="0">
                            <td>
                                <p>-</p>
                            </td>
                            <td>
                                <p>-</p>
                            </td>
                            <td>
                                <p>-</p>
                            </td>
                            <td>
                                <p>-</p>
                            </td>
                            <td class="square <?php echo $color ?>"></td> <!-- red or green style added to small_status item to inidcate status -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/weapon_control_immediate.js"></script>
    <script src="javascript/list_2.js"></script>
    <script src="javascript/controls_2.js"></script>
    <script src="javascript/list_search_2.js"></script>
</body>

</html>