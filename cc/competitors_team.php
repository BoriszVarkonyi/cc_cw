<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php
    class tireur
    {
        public $sexe;
        public $id;
        public $image;
        public $points;
        public $classement;
        public $club;
        public $lateralite;
        public $date_naissance;
        public $licence;
        public $nation;
        public $prenom;
        public $nom;
        public $reg;
        public $wc;
        public $comp_rank;
        public $temp_rank;
        public $final_rank;
        public $team;

        function __construct($sexe, $id, $image, $points, $classement, $club, $lateralite, $date_naissance, $licence, $nation, $prenom, $nom, $reg, $wc, $comp_rank, $temp_rank, $final_rank, $team)
        {
            $this->sexe = $sexe;
            $this->id = $id;
            $this->image = $image;
            $this->points = $points;
            $this->classement = $classement;
            $this->club = $club;
            $this->lateralite = $lateralite;
            $this->date_naissance = $date_naissance;
            $this->licence = $licence;
            $this->nation = $nation;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->reg = $reg;
            $this->wc = $wc;
            $this->comp_rank = $comp_rank;
            $this->temp_rank = $temp_rank;
            $this->final_rank = $final_rank;
            $this->team = $team;
        }
    }

    $qry_create_table = "CREATE TABLE `ccdatabase`.`competitors` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    if (!$do_create_table = mysqli_query($connection, $qry_create_table)) {
        echo mysqli_error($connection);
    }

    //check for existing row
    $qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_check_row = mysqli_query($connection, $qry_check_row);
    if ($row = mysqli_fetch_assoc($do_check_row)) {
        $json_string = $row['data'];
        $json_table = json_decode($json_string);
    } else {
        $json_table = [];

        //make new row
        $qry_new_row = "INSERT INTO competitors (assoc_comp_id, data) VALUES ('$comp_id', '[ ]')";
        if (!$do_new_row = mysqli_query($connection, $qry_new_row)) {
            echo mysqli_error($connection);
        }
    }

    if (isset($_POST['remove_fencer'])) {
        $selected_id = $_POST['selected_id'];

        if ($id_to_remove = findObject($json_table, $selected_id, "id") === false) {
            echo "ERROR during search for id to delete!";
        } else {



            unset($json_table[$id_to_remove]);
            $json_table = array_values($json_table);

            //update database
            $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
            $qry_update = "UPDATE `competitors` SET `data` = '$json_string'";
            if (!$do_update = mysqli_query($connection, $qry_update)) {
                echo "ERROR during the updateing of database record(deleting)";
            } else {
                header("Refresh:0");
            }
        }
    }

    if (isset($_POST['submit_import'])) {
        $import_comp_id = $_POST['selected_comp_id'];

        //get selected competitors array
        $qry_get_comp_to_import = "SELECT data FROM competitors WHERE assoc_comp_id = '$import_comp_id'";
        $do_get_comp_to_import = mysqli_query($connection, $qry_get_comp_to_import);

        if ($row = mysqli_fetch_assoc($do_get_comp_to_import)) {
            $competitor_ids = [];
            $import_array = json_decode($row['data']);
            for ($i = 0; $i < count($json_table); $i++) {
                $competitor_ids[$i] = $json_table[$i] -> id;
            }

            for ($i = 0; $i < count($import_array); $i++) {
                if (array_search($import_competitor -> id, $competitor_ids) !== false) {
                    unset($import_array[$i]);
                }
            }
            $json_table += $import_array;
        }

        //update database
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
        $qry_update = "UPDATE `competitors` SET `data` = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        if ($do_update = mysqli_query($connection, $qry_update)) {
            header("Refresh: 0");
        } else {
            echo mysqli_error($connection);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Competitors</title>
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
            <div id="title_stripe">
                <p class="page_title">Competitors</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button disabled" type="button" shortcut="SHIFT+M" id="mssgFencerBt">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/message_black.svg"/>
                    </button>
                    <form action="" method="POST" id="IDE KELL A FORM IDJE">
                        <input type="text" class="selected_list_item_input hidden" name="selected_id" readonly>
                    </form>
                    <button class="stripe_button red" name="remove_fencer" type="submit" form="IDE KELL A FORM IDJE" shortcut="SHIFT+R" id="removeFencerBt">
                        <p>Remove Fencer</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>
                    <button class="stripe_button primary" type="button" onclick="window.print()" shortcut="SHIFT+P" id="printCompBt">
                        <p>Print Competitors</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                    <a class="stripe_button primary" href="import_competitors.php?comp_id=<?php echo $comp_id ?>&type=team"  shortcut="SHIFT+X" id="importCompXMLBt">
                        <p>Import Competitors from XML</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                    <button class="stripe_button primary" type="button" onclick="toggleImportPanel()"  shortcut="SHIFT+I" id="importCompBt">
                        <p>Import Competitors from Competition</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                </div>


                <div id="import_competitors_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggleImportPanel()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form action="" id="import_competitors" method="POST" class="overlay_panel_form" autocomplete="off">
                        <input type="text" name="selected_comp_id" id="selected_comp_input" class="" readonly>
                        <table class="small">
                            <thead>
                                <tr>
                                    <th>
                                        <p>NAME</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="alt">
                            <?php
                                $qry_get_import = "SELECT `assoc_comp_id`,`data` FROM `competitors` WHERE `assoc_comp_id` <> '$comp_id'";
                                $do_get_import = mysqli_query($connection, $qry_get_import);

                                while ($row = mysqli_fetch_assoc($do_get_import)) {

                                    $import_comp_id = $row['assoc_comp_id'];
                                    //get comp_name
                                    $qry_get_comp_name = "SELECT `comp_name` FROM competitions WHERE comp_id = '$import_comp_id'";
                                    $do_get_comp_name = mysqli_query($connection, $qry_get_comp_name);
                                    if ($row = mysqli_fetch_assoc($do_get_comp_name)) {
                                        $comp_name = $row['comp_name'];
                                    } else {
                                        $comp_name = mysqli_error($connection);
                                    }
                            ?>
                                <tr id="<?php echo $import_comp_id ?>" onclick="selectForImport(this)">
                                    <td>
                                        <p><?php echo $comp_name ?></p>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <button type="submit" name="submit_import" class="panel_submit" value="Import">Import</span></button>
                    </form>
                </div>
            </div>
            <div id="page_content_panel_main">

                <?php if (isset($json_table[0])) {

                    function cmp($a, $b)
                    {
                        return strcmp($a->nation, $b->nation);
                    }

                    usort($json_table, "cmp");

                ?>
                <table class="wrapper small w90">
                    <thead>
                        <tr>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Competition Position" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>C. POS</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Classement Position" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>R. POS</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
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
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Nation" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>NATION</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Club" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>CLUB</p>
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
                                        <input type="radio" name="reg_status" id="listsearch_reg_ready" value="Ready"/>
                                        <label for="listsearch_reg_ready">Ready</label>
                                        <input type="radio" name="reg_status" id="listsearch_reg_not_ready" value="Not ready"/>
                                        <label for="listsearch_reg_not_ready">Not ready</label>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>REGISTARTION</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                            <th class="square"></th>
                            <th>
                                <div class="search_panel option">
                                    <div class="search_panel_buttons">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>

                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" class="search hidden">
                                    </div>
                                    <div class="option_container">
                                        <input type="radio" name="wc_status" id="listsearch_wc_ready" value="Ready"/>
                                        <label for="listsearch_wc_ready">Ready</label>
                                        <input type="radio" name="wc_status" id="listsearch_wc_not_ready" value="Not ready"/>
                                        <label for="listsearch_wc_not_ready">Not ready</label>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>WEAPON CONTROL</p>
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
                        foreach ($json_table as $json_obj) {
                        ?>
                            <tr id="<?php echo $json_obj -> id ?>" onclick="selectRow(this)" loading="lazy">
                                <td>
                                    <p><?php echo $json_obj->comp_rank ?></p>
                                </td>
                                <td>
                                    <p><?php echo $json_obj->classement ?></p>
                                </td>
                                <td>
                                    <p><?php echo $json_obj->prenom . " " . $json_obj->nom ?></p>
                                </td>
                                <td>
                                    <p><?php echo $json_obj->nation ?></p>
                                </td>
                                <td>
                                    <p><?php echo $json_obj->club ?></p>
                                </td>
                                <td>
                                    <p><?php

                                        if ($json_obj->reg == 0) {

                                            echo "Not ready";
                                        } else {

                                            echo "Ready";
                                        }
                                        ?></p>
                                </td>
                                <td class="square <?php
                                                    if ($json_obj->reg == 0) {

                                                        echo "red";
                                                    } else {

                                                        echo "green";
                                                    }
                                                    ?>">
                                </td>
                                <td>
                                    <p><?php
                                        if ($json_obj->wc == 0) {

                                            echo "Not ready";
                                        } else {

                                            echo "Ready";
                                        }
                                        ?></p>
                                </td>
                                <td class="square <?php
                                                                if ($json_obj->wc == 0) {

                                                                    echo "red";
                                                                } else {

                                                                    echo "green";
                                                                }
                                                                ?>">
                                </td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_2.js"></script>
    <script src="javascript/controls_2.js"></script>
    <script src="javascript/list_search_2.js"></script>
    <script src="javascript/competitors_team.js"></script>
</body>
</html>