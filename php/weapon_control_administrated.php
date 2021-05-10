<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    $table_name = "wc_$comp_id";
    //feedback
    $feedback = array(
        "getrankid" => "no",
        "getfencers" => "no",
        "getcompdata" => "no"
    );


    //get ranking id by comp_id
    $qry_getrankid = "SELECT * FROM ranking WHERE ass_comp_id = $comp_id";

    $qry_getrankid_do = mysqli_query($connection, $qry_getrankid);
    if ($row = mysqli_fetch_assoc($qry_getrankid_do)) {
        $feedback['getrankid'] = "ok!";
        $ranking_id = $row['id'];
    } else {
        $feedback['getrankid'] = "ERROR " . mysqli_error($connection);
    }

    if (isset($_POST['add_wc'])) {
        $fencer_id = $_POST['fencer_id'];
        header("Location: ../php/fencers_weapon_control.php?comp_id=$comp_id&fencer_id=$fencer_id&rankid=$ranking_id");
    }

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
            $qry_creating_wc_table = "CREATE TABLE `ccdatabase`. $table_name (`id` VARCHAR(11) NOT NULL ,
                                                                `name` VARCHAR(255) NOT NULL ,
                                                                `nat` VARCHAR(255) NOT NULL ,
                                                                `weapon_errors` VARCHAR(255) NOT NULL ,
                                                                `notes` TEXT NOT NULL )
                                                                ENGINE = InnoDB;";

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrated Weapon Control</title>
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
                <p class="page_title">Administrated Weapon Control</p>
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
                    <a class="stripe_button primary" id="checkInButton" href="check_in_fencer.php?comp_id=<?php echo $comp_id ?>">
                        <p>Check In</p>
                        <img src="../assets/icons/check_circle_outline_black.svg"/>
                    </a>
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
                                    <input type="text" onkeyup="searchInLists()" placeholder="Search by Nation" class="search page">
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
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="search page hidden">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="wc_status" id="listsearch_ci_not_ready" value="Not ready"/>
                                    <label for="listsearch_ci_not_ready">Not ready</label>
                                    <input type="radio" name="wc_status" id="listsearch_ci_ready" value="Ready"/>
                                    <label for="listsearch_ci_ready">Ready</label>
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
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
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="search page hidden">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="wc_status" id="listsearch_wc_not_ready" value="Not ready"/>
                                    <label for="listsearch_wc_not_ready">Not ready</label>
                                    <input type="radio" name="wc_status" id="listsearch_wc_ready" value="Ready"/>
                                    <label for="listsearch_wc_ready">Ready</label>
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
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
                        <div class="table_row cheked_out" onclick="selectRow(this), buttonShower(this)" id="" tabindex="0">
                            <div class="table_item"><p>NAME</p></div>
                            <div class="table_item"><p>NATION / CLUB</p></div>
                            <div class="table_item"><p>Checked In</p></div>
                            <div class="small_status_item green"></div>
                            <div class="table_item"><p>Checked Out</p></div>
                            <div class="small_status_item green"></div>
                        </div>
                        <div class="table_row not_cheked_out" onclick="selectRow(this), buttonShower(this)" id="" tabindex="0">
                            <div class="table_item"><p>NAME</p></div>
                            <div class="table_item"><p>NATION / CLUB</p></div>
                            <div class="table_item"><p>Checked In</p></div>
                            <div class="small_status_item green"></div>
                            <div class="table_item"><p>Ready</p></div>
                            <div class="small_status_item green"></div>
                        </div>
                        <div class="table_row not_ready" onclick="selectRow(this), buttonShower(this)" id="" tabindex="0">
                            <div class="table_item"><p>NAME</p></div>
                            <div class="table_item"><p>NATION / CLUB</p></div>
                            <div class="table_item"><p>Checked In</p></div>
                            <div class="small_status_item green"></div>
                            <div class="table_item"><p>Not ready</p></div>
                            <div class="small_status_item red"></div>
                        </div>
                        <div class="table_row red" onclick="selectRow(this), buttonShower(this)" id="" tabindex="0">
                            <div class="table_item"><p>NAME</p></div>
                            <div class="table_item"><p>NATION / CLUB</p></div>
                            <div class="table_item"><p>Not checked In</p></div>
                            <div class="small_status_item red"></div>
                            <div class="table_item"><p>Not ready</p></div>
                            <div class="small_status_item red"></div>
                        </div>
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