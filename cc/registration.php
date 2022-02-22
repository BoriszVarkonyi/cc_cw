<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>
<body>
    <?php include "includes/headerburger.php"; ?>
    <!-- header -->
        <div id="content_wrapper">
            <?php include "includes/navbar.php"; ?>
            <!-- navbar -->
            <main>
            <?php

                //get competitors
                $qry_get_data = "SELECT `data` FROM `competitors` WHERE `assoc_comp_id` = '$comp_id'";
                $do_get_data = mysqli_query($connection, $qry_get_data);

                if ($row = mysqli_fetch_assoc($do_get_data)) {
                    $json_string = $row['data'];
                    $json_table = json_decode($json_string);
                } else {
                    $json_table = [];
                }

                //barcode check in
                if(isset($_POST['barcode'])) {
                    $fencer_id = $_POST['barcode'];
                    $id_to_change = findObject($json_table, $fencer_id, "id");

                    if($id_to_change === false) {
                        header('refresh: 0');
                        die();
                    }

                    $json_table[$id_to_change] -> reg = 1;
                    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
                    $qry_update = "UPDATE `competitors` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
                    if (!$do_update = mysqli_query($connection, $qry_update)) {
                        echo mysqli_error($connection);
                    }
                    header('refresh: 0');
                }

                if(isset($_POST["reg_in"])){
                    $fencer_id = $_POST['fencer_ids'];
                    $id_to_change = findObject($json_table, $fencer_id, "id");

                    $json_table[$id_to_change] -> reg = 1;
                    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
                    $qry_update = "UPDATE `competitors` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
                    if (!$do_update = mysqli_query($connection, $qry_update)) {
                        echo mysqli_error($connection);
                    }
                }

                if(isset($_POST["reg_out"])){
                    $fencer_id = $_POST['fencer_ids'];
                    $id_to_change = findObject($json_table, $fencer_id, "id");

                    $json_table[$id_to_change] -> reg = false;

                    //update database
                    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
                    $qry_update = "UPDATE `competitors` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
                    if (!$do_update = mysqli_query($connection, $qry_update)) {
                        echo mysqli_error($connection);
                    }
                }

                class tireur {
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

                    function __construct($sexe, $id, $image, $points, $classement, $club, $lateralite, $date_naissance, $licence, $nation, $prenom, $nom, $reg, $wc, $comp_rank, $temp_rank, $final_rank) {
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
                    }
                }

                //remove fencer
                if (isset($_POST['remove_fencer'])) {
                    $selected_id = $_POST['fencer_ids'];
                    $key_to_remove = -1;
                    foreach($json_table as $key => $item) {
                        if($item->id == $selected_id) {
                            $key_to_remove = $key;
                            break;
                        }
                    }
                    if ($id_to_remove === -1) {
                        echo "ERROR during search for id to delete!";
                    } else {

                        unset($json_table[$key_to_remove]);
                        $json_table = array_values($json_table);

                        //update database
                        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
                        $qry_update = "UPDATE competitors SET data = '$json_string' WHERE assoc_comp_id = $comp_id";
                        if (!$do_update = mysqli_query($connection, $qry_update)) {
                            echo "ERROR during the updateing of database record(deleting)";
                        } else {
                            header("Refresh:0");
                        }
                    }
                }

                if (isset($_POST['add_fencer'])) {

                    var_dump($_POST);

                    $prenom = $_POST['prenom'];
                    $nom = $_POST['nom'];
                    $id = $_POST['id'];
                    $licence = $_POST['licence'];
                    $sexe = $_POST['sexe'];
                    $date_naissance = $_POST['date_naissance'];
                    $fencer_image = $_POST['fencer_image'];
                    $fencer_points = $_POST['fencer_points'];
                    $club = $_POST['club'];
                    $nation = $_POST['nation'];
                    $classement = $_POST['fencer_classement'];
                    $lateralite = $_POST['lateralite'];

                    $tiruer_obj = new tireur($sexe, $id, $fencer_image, $fencer_points, $classement, $club, $lateralite, $date_naissance, $licence, $nation, $prenom, $nom, false, false, NULL, NULL, NULL);

                    array_push($json_table, $tiruer_obj);

                    //update database
                    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

                    $qry_update = "UPDATE competitors SET data = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
                    $do_update = mysqli_query($connection, $qry_update);
                    echo mysqli_error($connection);

                    header("Refresh: 0");
                }
            ?>
                <div id="title_stripe">
                    <p class="page_title">Registration</p>
                    <div class="stripe_button_wrapper">
                        <a class="stripe_button blue" href="registration_statistics.php?comp_id=<?php echo $comp_id; ?>" shortcut="SHIFT+S" id="reg_stat">
                            <p>Registration Statistics</p>
                            <img src="../assets/icons/pie_chart_black.svg"/>
                        </a>
                        <a type="button" class="stripe_button" id="" shortcut="SHIFT+P" href="print_barcodes.php?comp_id=<?php echo $comp_id; ?>" target="_blank">
                            <p>Print Barcodes</p>
                            <img src="../assets/icons/barcode_black.svg"/>
                        </a>
                        <button type="button" class="stripe_button" onclick="window.print()" id="printRegistrationBt" shortcut="SHIFT+P">
                            <p>Print Registration</p>
                            <img src="../assets/icons/print_black.svg"/>
                        </button>
                        <form method="POST" action="">
                            <button type="submit" name="remove_fencer" class="stripe_button" shortcut="SHIFT+D" id="delete_fencer_button">
                                <p>Remove Fencer</p>
                                <img src="../assets/icons/person_remove_black.svg"/>
                            </button>
                            <button type="button" class="stripe_button" onclick="toggleAddFencerPanel()" shortcut="SHIFT+A" id="add_reg_button">
                                <p>Add Fencer</p>
                                <img src="../assets/icons/person_add_alt_black.svg"/>
                            </button>
                            <button type="submit" class="stripe_button red" name="reg_out" id="reg_out_button" shortcut="SHIFT+O">
                                <p>Register out</p>
                                <img src="../assets/icons/how_to_unreg_black.svg"/>
                            </button>
                            <button type="submit" class="stripe_button green" name="reg_in" id="reg_in_button"  shortcut="SHIFT+I">
                                <p>Register in</p>
                                <img src="../assets/icons/how_to_reg_black.svg"/>
                            </button>
                            <input type="text" class="hidden selected_list_item_input" name="fencer_ids" id="fencer_ids" readonly>
                        </form>

                        <form id="barcode_form" method="POST" action="" shortcut="SHIFT+B">
                            <button type="button" class="barcode_button">
                                <img src="../assets/icons/barcode_black.svg">
                            </button>
                            <input type="text" name="barcode" autocomplete="off" class="barcode_input" placeholder="Barcode" onfocus="toggleBarCodeInput(this)" onblur="toggleBarCodeInput(this)">
                            <button type="submit" form="barcode_form"></button>
                        </form>
                    </div>
                </div>
                <div id="add_fencer_panel" class="overlay_panel hidden">
                    <div class="overlay_panel_controls">
                        <button type="button" id="overlayPanelButtonLeft" onclick="leftButton()"><img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button"></button>
                        <p>Identification</p>
                        <button type="button" id="overlayPanelButtonRight" onclick="rightButton()"><img src="../assets/icons/arrow_forward_ios_black.svg"></button>
                        <p class="overlay_panel_controls_counter">3 / 3</p>
                    </div>
                    <button class="panel_button" onclick="toggleAddFencerPanel()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <!-- add fencers drop-down -->
                    <form action="" method="post" id="new_fencer" autocomplete="off" class="overlay_panel_form" autocomplete="off">
                        <div class="overlay_panel_division visible" overlay_division_title="Identification">
                            <label for="fencer_firsname">FIRST NAME</label>
                            <input form="new_fencer" type="text" placeholder="Type the fencer's first name" class="full_name_input" name="prenom" id="fencer_firsname" onfocus="setIndex(this)">
                            <label for="fencer_lastname">LAST NAME</label>
                            <input type="text" form="new_fencer" placeholder="Type the fencer's last name" class="full_name_input" name="nom" id="fencer_lastname" onfocus="setIndex(this)">
                            <label for="fencer_id">ID NUMBER</label>
                            <input type="number" form="new_fencer" placeholder="Type the fencer's ID" class="number_input username_input" name="id" id="fencer_id" onfocus="setIndex(this)">
                            <label for="fencer_licence">LICENSE</label>
                            <input type="text" form="new_fencer" placeholder="Type the fencer's license number" class="full_name_input" name="licence" id="fencer_licence" onfocus="setIndex(this)">
                        </div>
                        <div class="overlay_panel_division" overlay_division_title="Identification 2">
                            <label>SEX</label>
                            <div class="option_container row">
                                <input form="new_fencer" type="radio" name="sexe" id="male" value="m" />
                                <label for="male">Male</label>
                                <input form="new_fencer" type="radio" name="sexe" id="female" value="f" />
                                <label for="female">Female</label>
                            </div>
                            <label for="fencer_dob">DATE OF BIRTH</label>
                            <input form="new_fencer" type="date" class="date_input" name="date_naissance" id="fencer_dob">
                            <label for="fencer_image">IMAGE LINK</label>
                            <input  form="new_fencer" type="text" placeholder="Type in the link to the fencer's image" class="full_name_input" name="fencer_image" id="fencer_image" onfocus="setIndex(this)">
                            <label for="fencer_licence">POINTS</label>
                            <input form="new_fencer" type="text" placeholder="Type the fencer's points" class="full_name_input" name="fencer_points" id="fencer_points" onfocus="setIndex(this)">
                        </div>
                        <div class="overlay_panel_division" overlay_division_title="Categoriaztion">
                            <label for="set_club_input">CLUB</label>
                            <div class="search_wrapper wide higher">
                                <input form="new_fencer" type="text" name="club" onfocus="resultChecker(this), isOpen(this), setIndex(this), formvariableDeclaration()" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="set_club_input" placeholder="Search Club by Name" class="search input">
                                <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close_black.svg"></button>
                                <div class="search_results">
                                    <?php include "includes/getallclubs.php"; ?>
                                </div>
                            </div>
                            <label for="fencer_classement">CLASSEMENT</label>
                            <input form="new_fencer" type="text" placeholder="Type the fencer's classement" class="full_name_input" name="fencer_classement" id="fencer_classement" onfocus="setIndex(this)">
                            <label>LATERALITE</label>
                            <div class="option_container row">
                                <input form="new_fencer" type="radio" name="lateralite" id="g" value="g"/>
                                <label for="g">Left</label>
                                <input form="new_fencer" type="radio" name="lateralite" id="d" value="d"/>
                                <label for="d">Right</label>
                            </div>
                            <label for="set_nation_input">NATION</label>
                            <div class="search_wrapper wide">
                                <input form="new_fencer"  type="text" name="nation" onfocus="resultChecker(this), isOpen(this), setIndex(this), formvariableDeclaration()" onblur="isClosed(this)" onkeyup="searchEngine(this)" oninput="this.value = this.value.toUpperCase()" id="set_nation_input" placeholder="Search Country by Name" class="search input">
                                <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close_black.svg"></button>
                                <div class="search_results">
                                    <?php include "includes/nations.php"; ?>
                                </div>
                            </div>
                        </div>
                        <button form="new_fencer" type="submit" name="add_fencer" class="panel_submit">Save</button>
                    </form>
                </div>
                <div id="page_content_panel_main">

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
                                            <input type="radio" name="status" id="listsearch_reg_reg" value="Registered"/>
                                            <label for="listsearch_reg_reg">Registered</label>
                                            <input type="radio" name="status" id="listsearch_reg_not_reg" value="Not registered"/>
                                            <label for="listsearch_reg_not_reg">Not registered</label>
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

                        if (isset($json_table[0])) {

                            function cmp($a, $b) {
                                return strcmp($a->nation, $b->nation);
                            }

                            usort($json_table, "cmp");

                            foreach ($json_table as $json_object) {
                                $name = $json_object -> nom . " " . $json_object -> prenom;
                                $nat = $json_object -> nation;
                                $club = $json_object -> club;
                                $stat = $json_object -> reg;
                                $id = $json_object -> id;

                            ?>

                            <tr id="<?php echo $id ?>" onclick="selectRow(this)" tabindex="0">
                                <td><p><?php echo $name . "(" . $id . ")" ?></p></td>
                                <td><p><?php echo $nat ?></p></td>
                                <td><p><?php echo $club ?></p></td>
                                <td><p><?php if($stat == 0){echo "Not registered";}else{echo "Registered";} ?></p></td>
                                <td class="square <?php if($stat == 0){echo "red";}else{echo "green";} ?>"></td>
                            </tr>
                            <?php
                            }
                        } else {
                            ?><p>No fencers set-up yet!</p><?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_2.js"></script>
    <script src="javascript/overlay_panel.js"></script>
    <script src="javascript/registration.js"></script>
    <script src="javascript/controls_2.js"></script>
    <script src="javascript/list_search_2.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>