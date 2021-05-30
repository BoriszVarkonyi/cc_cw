<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

    class tech {
        public $username;
        public $name;
        public $role;
        public $pass;
        public $online;

        function __construct($name, $role, $username) {
            $this -> role = $role;
            $this -> name = $name;
            $this -> username = $username;
            $this -> pass = NULL;
            $this -> online = 0;
        }
    }

    //create table
    $qry_create_table = "CREATE TABLE `ccdatabase`.`technicians` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL DEFAULT '[ ]' , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_table = mysqli_query($connection, $qry_create_table);
    echo mysqli_error($connection);

    //get technicians
    $qry_get_techs = "SELECT data FROM technicians WHERE assoc_comp_id = '$comp_id'";
    $do_get_techs = mysqli_query($connection, $qry_get_techs);

    if ($num_rows = mysqli_num_rows($do_get_techs) == 1) {
        if ($row = mysqli_fetch_assoc($do_get_techs)) {
            $json_string = $row['data'];
            $json_table = json_decode($json_string);
        }
    } else {
        $qry_new_row = "INSERT INTO technicians (assoc_comp_id) VALUES ('$comp_id');";
        $do_new_row = mysqli_query($connection, $qry_new_row);

        $json_table = [];
    }


    //set up new technician
    if (isset($_POST['submit_tech'])) {
        $role = $_POST["role"];
        $username = $_POST["username"];
        $name = $_POST['name'];


        $find = findObject($json_table, $username, "username");
        if ($find === FALSE){
            $new_tech = new tech($name, $role, $username);
            array_push($json_table, $new_tech);

            $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);


            $qry_update_data = "UPDATE `technicians` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
            $do_update_data = mysqli_query($connection, $qry_update_data);
            header("Refresh: 0");
        } else {
            //add error 1 to get, when duplicant usernames
            $_GET['set_up_error'] = 1;
            header("Location: ../php/technicians.php?comp_id=$comp_id&set_up_error=1");
        }
    }

    //delete technicians
    if (isset($_POST['remove_technician'])){
        $username_to_remove = $_POST['id'];

        $tech_to_delete = findObject($json_table, $username_to_remove, "username");
        unset($json_table[$tech_to_delete]);
        $json_table = array_values($json_table);

        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        $qry_update_data = "UPDATE `technicians` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
        $do_update_data = mysqli_query($connection, $qry_update_data);
        //header("Refresh: 0");

    }

    //import technicians
    if (isset($_POST['submit_import'])) {
        $id_to_import = $_POST['id'];

        $qry_select_ipmorted_techs = "SELECT `data` FROM `technicians` WHERE `assoc_comp_id` = '$id_to_import'";
        $do_get_imported_techs = mysqli_query($connection, $qry_select_ipmorted_techs);

        if ($row = mysqli_fetch_assoc($do_get_imported_techs)) {
            $json_string_import = $row['data'];
        }
        $json_table_import = json_decode($json_string_import);

        foreach ($json_table_import as $json_object_import)  {
            $to_import = TRUE;
            foreach ($json_table as $json_object) {
                if ($json_object -> username == $json_object_import -> username) {
                    $to_import = FALSE;
                }
            }
            if ($to_import) {
                array_push($json_table, $json_object_import);
            }

        }


        $json_table = array_values($json_table);
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        $qry_update_data = "UPDATE `technicians` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
        $do_update_data = mysqli_query($connection, $qry_update_data);

        header("Refresh: 0");
    }
    header('charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technicians</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>
<body class="preload">
<!-- header -->
    <script>console.log("body")</script>
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Technicians</p>
                <div class="stripe_button_wrapper">
                    <button name="import_tech" form="import_tech_button" type="submit" class="stripe_button" onclick="toggle_import_technician()" shortcut="SHIFT+I">
                        <p>Import Technicians from Your Competitions</p>
                        <img src="../assets/icons/save_alt_black.svg"/>
                    </button>
                    <button class="stripe_button primary" type="button" onclick="window.print()">
                        <p>Print Technicians</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                    <button class="stripe_button red" form="remove_technician" name="remove_technician" id="remove_technician_button" shortcut="SHIFT+R">
                        <p>Remove Technician</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>
                    <button class="stripe_button primary" onclick="toggle_add_technician()" shortcut="SHIFT+A">
                        <p>Add Technician</p>
                        <img src="../assets/icons/add_black.svg"/>
                    </button>
                </div>

                <div id="import_technician_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggle_import_technician()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form action="" id="import_technician" method="POST" class="overlay_panel_form" autocomplete="off">
                        <div class="table t_c_0">
                            <div class="table_header">
                                <div class="table_header_text"><p>NAME</p></div>
                            </div>
                            <div class="select_competition_wrapper table_row_wrapper alt">
                                <input type="text" name="id" form="remove_technician" class="selected_list_item_input hidden" id="selected_row_input">
                                <input type="text" name="id" form="import_technician" class="selected_list_item_input hidden" id="selected_row_input_import">
                                <?php
                                    //qry
                                    $qry_get_tables = "SELECT assoc_comp_id FROM technicians;";
                                    $do_get_tables = mysqli_query($connection, $qry_get_tables);

                                    while ($row = mysqli_fetch_assoc($do_get_tables)) {
                                        $id_to_get = $row['assoc_comp_id'];

                                        if ($id_to_get != $comp_id) {
                                            $get_comp_data = "SELECT comp_name FROM competitions WHERE comp_id = '$id_to_get';";
                                            $do_get_comp_data = mysqli_query($connection, $get_comp_data);

                                            if ($row = mysqli_fetch_assoc($do_get_comp_data)) {
                                                $comp_name = $row['comp_name'];
                                            }
                                    ?>
                                        <div class="table_row" id="<?php echo $id_to_get; ?>" onclick="importTechnicians(this)"><div class="table_item" id="in_<?php echo $id_to_get; ?>"><p><?php echo $comp_name; ?></p></div></div>

                                    <?php
                                        }
                                    }

                                ?>
                            </div>
                        </div>
                        <button type="submit" name="submit_import" class="panel_submit" form="import_technician" value="Import">Import</button>
                    </form>
                </div>

                <form action="" method="POST" id="remove_technician"></form>

                <div id="add_technician_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggle_add_technician()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form class="overlay_panel_form" autocomplete="off" action="technicians.php?comp_id=<?php echo $comp_id; ?>" method="POST" id="new_technician" autocomplete="off">
                        <label for="name">NAME</label>
                        <input type="text" placeholder="Type the technician's name" class="username_input" name="name">

                        <label for="username">USERNAME</label>
                        <input type="text" placeholder="Type the technician's username" class="username_input error username" name="username">

                        <label for="">ROLE</label>
                        <div class="option_container">
                            <input type="radio" class="option_button" name="role" id="a" value="1"/>
                            <label for="a">Semi</label>
                            <input type="radio" class="option_button" name="role" id="b" value="2"/>
                            <label for="b">DT</label>
                            <input type="radio" class="option_button" name="role" id="c" value="3"/>
                            <label for="c">Weapon Control</label>
                            <input type="radio" class="option_button" name="role" id="d" value="4"/>
                            <label for="d">Registration</label>
                        </div>
                        <button type="submit" name="submit_tech" class="panel_submit" form="new_technician">Save</button>
                    </form>
                </div>

                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
                    <div class="search_results">
                        <?php
                        foreach ($json_table as $json_object) {
                            $username = $json_object -> username;
                            $name = $json_object -> name;

                            ?>
                            <a id="<?php echo $username ?>A" href="#<?php echo $username ?>" onclick="selectSearch(this), autoFill(this)" tabindex="1"><?php echo $name ?></a>
                            <?php
                        }
                            ?>
                    </div>
                </div>
            </div>
            <div id="page_content_panel_main">
                <table class="wrapper">

                    <?php if(count($json_table) == 0){ ?>

                        <div id="no_something_panel">
                            <p>You have no technicians set up!</p>
                        </div>

                    <?php } else { ?>

                        <thead>
                            <tr>
                                <th>
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
                                </th>
                                <th>
                                    <div class="search_panel">
                                        <div class="search_wrapper">
                                            <input type="text" onkeyup="searchInLists()" placeholder="Search by Username" class="search page">
                                            <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                        </div>
                                    </div>
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>USERNAME</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </th>
                                <th>
                                    <div class="search_panel option">
                                        <div class="search_panel_buttons">
                                            <button type="button" onclick="searchClear(this)"><img src="../assets/icons/clear_all_black.svg"></button>
                                            <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                        </div>
                                        <div class="search_wrapper">
                                            <input type="text" onkeyup="searchInLists()" class="hidden">
                                        </div>
                                        <div class="option_container">
                                            <input type="radio" name="status" id="listsearch_semi" value="Semi"/>
                                            <label for="listsearch_semi">Semi</label>
                                            <input type="radio" name="status" id="listsearch_dt" value="DT"/>
                                            <label for="listsearch_dt">DT</label>
                                            <input type="radio" name="status" id="listsearch_wc" value="Weapon Control"/>
                                            <label for="listsearch_wc">Weapon Control</label>
                                            <input type="radio" name="status" id="listsearch_reg" value="Registration"/>
                                            <label for="listsearch_reg">Registration</label>
                                        </div>
                                    </div>
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>ROLE</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </th>
                                <th>
                                    <div class="search_panel option">
                                        <div class="search_panel_buttons">
                                            <button type="button" onclick="searchClear(this)"><img src="../assets/icons/clear_all_black.svg"></button>
                                            <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                        </div>
                                        <div class="search_wrapper">
                                            <input type="text" onkeyup="searchInLists()" class="hidden">
                                        </div>
                                        <div class="option_container">
                                            <input type="radio" name="status" id="listsearch_online" value="Online"/>
                                            <label for="listsearch_online">Online</label>
                                            <input type="radio" name="status" id="listsearch_offline" value="Offline"/>
                                            <label for="listsearch_offline">Offline</label>
                                        </div>
                                    </div>
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>STATUS</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </th>
                                <th class="small">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    foreach ($json_table as $json_object) {

                                    $username = $json_object -> username;
                                    $name = $json_object -> name;
                                    $role = $json_object -> role;
                                    $online  = $json_object -> online;


                                ?>
                                <tr id="<?php echo $username; ?>" onclick="selectRow(this)">
                                    <td><p><?php echo $name; ?></p></td>
                                    <td><p><?php echo $username; ?></p></td>
                                    <td><p><?php echo roleConverter($role); ?></p></td>
                                    <td>
                                        <p>
                                        <?php
                                        if($online == 0){
                                            echo "Offline";
                                        }
                                        else{
                                            echo "Online";
                                        }
                                        ?>
                                        </p>
                                    </td>
                                    <td class="small <?php
                                        if($online == 0){
                                            echo "red";
                                        }
                                        else{
                                             echo "green";
                                        }
                                    ?>">
                                    </td> <!-- red or green style added to small_status item to inidcate status -->
                                </tr>
                                <?php
                                }
                            }
                            //Check,read,display technicians END
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/technicians.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/importoverlay.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/overlay_panel.js"></script>
    <script src="../js/list_search.js"></script>
</body>
</html>