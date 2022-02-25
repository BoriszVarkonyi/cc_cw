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
    /*$qry_create_table = "CREATE TABLE `ccdatabase`.`weapon_control` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` VARCHAR(255) NOT NULL , `fencer_id` VARCHAR(255) NOT NULL , `issues_array` JSON NULL DEFAULT NULL , `weapons_turned_in` JSON NULL DEFAULT NULL , `notes` VARCHAR(255) NULL DEFAULT NULL , `check_in_date` TIMESTAMP NULL DEFAULT NULL , `check_out_date` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_table = mysqli_query($connection, $qry_create_table);*/

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
                <p class="page_title">Weapon Control</p>
                <div class="stripe_button_wrapper">
                    <?php
                        $qry_check_for_empty_wc = "SELECT issues_array FROM weapon_control WHERE assoc_comp_id = '$comp_id'";
                        $do_check_for_empty_wc = mysqli_query($connection, $qry_check_for_empty_wc);
                        $disabled = "disabled";
                        while ($row = mysqli_fetch_assoc($do_check_for_empty_wc)) {
                            if ($row['issues_array'] != null) {
                                $disabled = "";
                            }
                        }

                    ?>
                    <a class="stripe_button blue <?php echo $disabled ?>" href="/cc/weapon_control_statistics.php?comp_id=<?php echo $comp_id; ?>" target="_blank" id="weaponControlStatisticsBt" shortcut="SHIFT+W">
                        <p>Weapon Control Statistics</p>
                        <img src="../assets/icons/pie_chart_black.svg" />
                    </a>
                    <button class="stripe_button disabled" id="sendMessageButton" type="submit">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/chat_black.svg" />
                    </button>
                    <button class="stripe_button" type="button" onclick="window.print()" id="printWeaponControlBt" shortcut="SHIFT+P">
                        <p>Print Weapon Control</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                    <a class="stripe_button" shortcut="SHIFT+P" href="/cc/print_weapon_control.php?comp_id=<?php echo $comp_id; ?>">
                        <p>Print Weapon Control Reports</p>
                        <img src="../assets/icons/print_black.svg" />
                    </a>
                    <a class="stripe_button primary" shortcut="" href="/cc/weapon_control_bookings.php?comp_id=<?php echo $comp_id; ?>">
                        <p>Weapon Control Bookings</p>
                        <img src="../assets/icons/book_black.svg" />
                    </a>
                    <form id="add_weapon_control_form" method="POST" action="">
                        <button name="add_wc" class="stripe_button primary" id="wcButton" type="submit" shortcut="SHIFT+A">
                            <p>Add weapon control</p>
                            <img src="../assets/icons/add_black.svg" />
                        </button>
                        <input type="text" class="hidden selected_list_item_input" name="fencer_id" id="fencer_id_input" value="">
                    </form>
                    <form id="barcode_form" method="POST" action="" shortcut="SHIFT+B">
                        <button type="button" class="barcode_button" onclick="toggleBarCodeButton(this)">
                            <img src="../assets/icons/barcode_black.svg">
                        </button>
                        <input type="text" name="barcode" autocomplete="off" class="barcode_input" placeholder="Barcode" onfocus="toggleBarCodeInput(this)" onblur="toggleBarCodeInput(this)">
                        <button type="submit" form="barcode_form"></button>
                    </form>
                </div>
            </div>
            <div id="page_content_panel_main">
                <?php
                //set group by
                $qry_get_formula = "SELECT data FROM formulas WHERE assoc_comp_id = '$comp_id'";
                $do_get_formula = mysqli_query($connection, $qry_get_formula);
                if ($row = mysqli_fetch_assoc($do_get_formula)) {
                    $formula_string = $row['data'];
                    $formula_table = json_decode($formula_string);

                    $sort_by_num = $formula_table -> groupBy;
                    $nation = sortByConverter($sort_by_num);

                } else {
                    echo "error:    " . mysqli_error($connection);
                }
                ?>
                <table class="wrapper">
                    <thead>
                        <tr>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Name" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>NAME</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Nationality" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p><?php echo strtoupper($nation) ?></p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                            <th>
                                <div class="search_panel option">
                                    <div class="search_panel_buttons">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" class="search hidden">
                                    </div>
                                    <div class="option_container">
                                        <input type="radio" name="wc_status" id="listsearch_wc_ready" value="Ready" />
                                        <label for="listsearch_wc_ready">Ready</label>
                                        <input type="radio" name="wc_status" id="listsearch_wc_not_ready" value="Not ready" />
                                        <label for="listsearch_wc_not_ready">Not ready</label>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>STATUS</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                            <th class="square"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        for ($competitor_counter = 0; $competitor_counter < count($fencers_json_table); $competitor_counter++) {
                            $current_fencer = $fencers_json_table[$competitor_counter];
                            $fencer_name = $current_fencer -> prenom . " " . $current_fencer -> nom;
                            $fencer_nat = $current_fencer -> $nation;
                            $fencer_id = $current_fencer -> id;
                            //get statut
                            $qry_get_statut = "SELECT notes FROM weapon_control WHERE fencer_id = '$fencer_id' AND assoc_comp_id = '$comp_id' LIMIT 1";
                            $do_get_statut = mysqli_query($connection, $qry_get_statut);
                            if ($row = mysqli_fetch_assoc($do_get_statut)) {
                                if ($row['notes'] !== null) {
                                    $color = "green";
                                    $status = "Ready";
                                } else {
                                    $color = "red";
                                    $status = "Not Ready";
                                }
                            } else { //there are fencers in competition which are not in weapon contorl table
                                //resfresh
                                for ($i = 0; $i < count($fencer_ids_array); $i++) {
                                    $current_fencer_id = $fencer_ids_array[$i];
                                    //see if fencer is allready added in this comp
                                    $qry_check_fencer = "SELECT id FROM weapon_control WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$current_fencer_id'";
                                    $do_check_fencer = mysqli_query($connection, $qry_check_fencer);
                                    if (($num_rows = mysqli_num_rows($do_check_fencer)) === 0) {
                                        //add non existant fencer
                                        insertNewFencer($connection, $comp_id, $current_fencer_id);
                                        header("Refresh:0");
                                    } else if ($num_rows > 1) {
                                        echo "There are more than one: " . $current_fencer_id . " fencers with this id for this competition";
                                    }
                                }
                            }
                        ?>
                            <!-- while -->
                            <tr onclick="selectRow(this)" id="<?php echo $fencer_id ?>" tabindex="0">
                                <td>
                                    <p><?php echo $fencer_name ?></p>
                                </td>
                                <td>
                                    <p><?php echo $fencer_nat ?></p>
                                </td>
                                <td>
                                    <p><?php echo $status ?></p>
                                </td>
                                <td class="square <?php echo $color ?>"></td> <!-- red or green style added to small_status item to inidcate status -->
                            </tr>
                        <?php
                        }
                        ?>
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