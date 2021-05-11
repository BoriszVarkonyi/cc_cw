<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    $qry_create_table = "CREATE TABLE `ccdatabase`.`weapon_control` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL DEFAULT '[ ]' , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_table = mysqli_query($connection, $qry_create_table);

    $test_for_row_qry = "SELECT `data` FROM `weapon_control` WHERE `assoc_comp_id` = '$comp_id'";
    $do_test = mysqli_query($connection, $test_for_row_qry);



    if ($row = mysqli_fetch_assoc($do_test)) {
        $json_string = $row['data'];
        $json_table = json_decode($json_string);
    } else {
        $qry_insert_new_row = "INSERT INTO weapon_control (assoc_comp_id) VALUES ($comp_id);";
        $do_insert_new_row = mysqli_query($connection, $qry_insert_new_row);
        $json_table = [];
    }

    if (isset($_POST['add_wc'])) {
        $fencer_id = $_POST['fencer_id'];
        header("Location: ../php/fencers_weapon_control.php?comp_id=$comp_id&fencer_id=$fencer_id");
    }

   $qry_get_fencers = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_data = mysqli_query($connection, $qry_get_fencers);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
	    	$json_string = $row['data'];
		$json_table = json_decode($json_sring);
    } else {
	    echo mysqli_error($connection);


    }





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Immediate Weapon Control</title>
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
                <p class="page_title">Immediate Weapon Control</p>
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
                    <button name="add_wc" class="stripe_button primary" id="wcButton" type="submit">
                        <p>Add weapon control</p>
                        <img src="../assets/icons/add_black.svg"/> <!-- This should change to ../assets/icons/edit_black.svg if the fencer already has weapon control-->
                    </button>
                </div>
                <input type="text" class="hidden selected_list_item_input" name="fencer_id" id="fencer_id_input" value="">
                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
                    <div class="search_results">
                    <?php
                        foreach ($json_table as $obj) {
                $idke = $obj -> id;
                $nevecske = $obj -> prenom . " " . $obj -> nom;

                        ?>
                        <button id="<?php echo $idke ?>A" href="#<?php echo $idke ?>" onclick="selectSearch(this), autoFill(this)" type="button"><?php echo $nevecske ?></button>
                        <?php
                    }
                        ?>
                    </div>
                </div>
            </form>
            <div id="page_content_panel_main">
                <div class="wrapper table">
                    <div class="table_header">
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" placeholder="Search by Name" class="search page">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
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
                                    <input type="text" onkeyup="searchInLists()" placeholder="Search by Nationality" class="search page">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
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
                                    <button type="button" onclick="searchClear(this)"><img src="../assets/icons/clear_all_black.svg"></button>
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
                        <div class="big_status_header"></div>
                    </div>
                    <div class="table_row_wrapper">
                    <?php

                        foreach ($json_table as $obj) {
                    $fencer_name = $obj -> nom . " " . $obj -> prenom;
                    $fencer_nat = $obj -> nation;
                    $fencer_id = $obj -> id;

                    ?>
                    <!-- while -->
                    <div class="table_row" onclick="selectRow(this)" id="<?php echo $fencer_id ?>" tabindex="0">
                        <div class="table_item"><p><?php echo $fencer_name ?></p></div>
                        <div class="table_item"><p><?php echo $fencer_nat ?></p></div>
                        <div class="table_item"><p><?php echo "placeholder!" ?></p></div>
                        <div class="big_status_item <?php echo "red" ?>"></div> <!-- red or green style added to small_status item to inidcate status -->
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
    <script src="../js/weapon_control_immediate.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/list_search.js"></script>
</body>
</html>
