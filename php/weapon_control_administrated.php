<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    //create table
    $qry_create_table = "CREATE TABLE `ccdatabase`.`weapon_control` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL DEFAULT '[ ]' , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_table = mysqli_query($connection, $qry_create_table);

    //get json from wc table
    $test_for_row_qry = "SELECT `data` FROM `weapon_control` WHERE `assoc_comp_id` = '$comp_id'";
    $do_test = mysqli_query($connection, $test_for_row_qry);
    if ($row = mysqli_fetch_assoc($do_test)) {
        $json_string = $row['data'];
        $wc_table = json_decode($json_string);
    } else {
        $qry_insert_new_row = "INSERT INTO `weapon_control` (`assoc_comp_id`) VALUES ($comp_id);";
        $do_insert_new_row = mysqli_query($connection, $qry_insert_new_row);
        $wc_table = [];
    }

    //get competitors table
    $qry_get_compet = "SELECT `data` FROM `competitors` WHERE `assoc_comp_id` = '$comp_id'";
    $do_get_compet = mysqli_query($connection, $qry_get_compet);

    if ($row = mysqli_fetch_assoc($do_get_compet)) {
        $compet_string = $row['data'];
        $compet_table = json_decode($compet_string);
    }

    //check in button (make wc for fencers onto db)
    if (isset($_POST['check_in_submit'])) {
        $fencer_id = $_POST['fencer_id'];

        header("Location: ../php/check_in_fencer.php?comp_id=$comp_id&fencer_id=$fencer_id");

    }
?>

<!DOCTYPE html>
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
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <form id="title_stripe" method="POST" action="">
                <p class="page_title">Weapon Control</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button blue" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id; ?>" target="_blank">
                        <p>Weapon Control Statistics</p>
                        <img src="../assets/icons/pie_chart_black.svg"/>
                    </a>
                    <button class="stripe_button disabled" id="sendMessageButton" type="submit">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/chat_black.svg"/>
                    </button>
                    <button class="stripe_button" type="button" onclick="window.print()">
                        <p>Print Weapon Control</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                    <button class="stripe_button primary" id="checkInButton" name="check_in_submit" type="submit" >
                        <p>Check In</p>
                        <img src="../assets/icons/check_circle_outline_black.svg"/>
                    </button>
                    <a class="stripe_button primary" id="addWcButton" href="fencers_weapon_control.php?comp_id=<?php echo $comp_id ?>">
                        <p>Add Weapon Control</p>
                        <img src="../assets/icons/add_black.svg"/>
                    </a>
                    <a class="stripe_button" id="editWcButton" type="submit" href="fencers_weapon_control.php?comp_id=<?php echo $comp_id ?>">
                        <p>Edit Weapon Control</p>
                        <img src="../assets/icons/edit_black.svg"/>
                    </a>
                    <a class="stripe_button primary" id="checkOutButton" href="check_out_fencer.php?comp_id=<?php echo $comp_id ?>">
                        <p>Check Out</p>
                        <img src="../assets/icons/check_circle_black.svg"/>
                    </a>
                </div>
                <input type="text" class="hidden selected_list_item_input" name="fencer_id" id="fencer_id_input" value="">
            </form>
            <div id="page_content_panel_main">
                <div class="wrapper table">
                    <div class="table_header">
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" placeholder="Search by Name" class="search page">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>NAME</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" placeholder="Search by Nation" class="search page">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>NATION / CLUB</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="table_header_text">
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="hidden">
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="wc_status" id="listsearch_ci_ready" value="Ready"/>
                                    <label for="listsearch_ci_ready">Ready</label>
                                    <input type="radio" name="wc_status" id="listsearch_ci_not_ready" value="Not ready"/>
                                    <label for="listsearch_ci_not_ready">Not ready</label>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>STATUS</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="small_status_header"></div>
                        <div class="table_header_text">
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="hidden">
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="wc_status" id="listsearch_wc_ready" value="Ready"/>
                                    <label for="listsearch_wc_ready">Ready</label>
                                    <input type="radio" name="wc_status" id="listsearch_wc_not_ready" value="Not ready"/>
                                    <label for="listsearch_wc_not_ready">Not ready</label>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>STATUS</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="small_status_header"></div>
                    </div>
                    <div class="table_row_wrapper">
                        <?php
                            $qry_get_nat_club = "SELECT sort_by_club FROM pools WHERE assoc_comp_id = '$comp_id'";
                            $do_get_nat_club = mysqli_query($connection, $qry_get_nat_club);

                            if ($row = mysqli_fetch_assoc($do_get_nat_club)) {
                                $sort_by_club = $row['sort_by_club'];
                            } else {
                                $sort_by_club = false;
                            }

                            if ($sort_by_club) {
                                $c_or_n = "club";
                            } else {
                                $c_or_n = "nation";
                            }

                            foreach ($compet_table as $fencer_obj) {

                                $name = $fencer_obj -> prenom . " " . $fencer_obj -> nom;
                                $nat = $fencer_obj -> $c_or_n;

                                //get wc data
                                $checked_in = false;
                                $checked_out = false;
                                $ready_wc = false;
                                $class = "red";
                                if ($id_to_find = findObject($wc_table, $fencer_obj->id, "id") !== false) {
                                    //this shouldnt be needed but the function returns 1 when there is only one element in the table instaed of 0
                                    if (count($wc_table) == 1) {
                                        $id_to_find = 0;
                                    }

                                    if ($wc_table[$id_to_find] -> equipment != null) {
                                        $checked_in = true;
                                    }

                                    if ($wc_table[$id_to_find] -> array_of_issues != null) {
                                        $ready_wc = true;
                                    }

                                    $checked_out = $wc_table[$id_to_find] -> checked_out;

                                    //determine class
                                    if ($checked_out == true) {
                                        $class = "cheked_out";
                                    } else if($ready_wc == true) {
                                        $class = "not_cheked_out";
                                    } else if ($checked_in == true) {
                                        $class = "not_ready";
                                    }


                                }
                        ?>
                                    <div class="table_row <?php echo $class ?>" onclick="selectRow(this), buttonShower(this)" id="<?php echo $fencer_obj->id ?>" tabindex="0">
                                        <div class="table_item"><p><?php echo $name ?></p></div>
                                        <div class="table_item"><p><?php echo $nat ?></p></div>
                                        <div class="table_item"><p><?php echo $is_checked_in = ($checked_in) ? "Checked in" : "Not checked in" ?></p></div>
                                        <div class="small_status_item <?php echo $is_checked_in_c = ($checked_in) ? "green" : "red" ?>"></div>
                                        <div class="table_item"><p><?php echo $is_ready = ($checked_out) ? "Ready" : "Not ready" ?></p></div>
                                        <div class="small_status_item <?php echo $is_ready = ($checked_out) ? "green" : "red" ?>"></div>
                                    </div>

                        <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/weapon_control_administrated.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/list_search.js"></script>
</body>
</html>