<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

    function updateData($data, $comp_id, $conn) {
        $json_string = json_encode($data, JSON_UNESCAPED_UNICODE);

        $qry_update_data = "UPDATE `referees` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
        if ($do_update_row = mysqli_query($conn, $qry_update_data)) {
            return TRUE;
        } else {
            echo mysqli_error($conn);
            return FALSE;
        }
    }

    class referee {
        public string $sexe;
        public int $id;
        public string $categorie;
        public string $image;
        public string $club;
        public string $lateralite;
        public string $dateNaissance;
        public int $licence;
        public string $nation;
        public string $prenom;
        public string $nom;
        public $password = NULL;
        public bool $isOnline;

        function __construct($sexe, $id, $categorie, $image, $club, $lateralite, $dateNaissance, $licence, $nation, $prenom, $nom) {
        $this -> sexe = $sexe;
        $this -> id = $id;
        $this -> categorie = $categorie;
        $this -> image = $image;
        $this -> club = $club;
        $this -> lateralite = $lateralite;
        $this -> dateNaissance = $dateNaissance;
        $this -> licence = $licence;
        $this -> nation = $nation;
        $this -> prenom = $prenom;
        $this -> nom = $nom;
        $this -> isOnline = false;
        }
    }

    //make table
    $qry_make_table = "CREATE TABLE `ccdatabase`.`referees` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    if (!$do_make_table = mysqli_query($connection, $qry_make_table)) {
        echo mysqli_error($connection);
    }

    //get data / make new row
    $qry_get_data = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
    $do_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $data = $row['data'];

        $json_table = json_decode($data);
    } else {
        $json_table = [];

        $qry_new_row = "INSERT INTO referees (assoc_comp_id, data) VALUES ('$comp_id', '[ ]')";
        if (!$do_new_row = mysqli_query($connection, $qry_new_row)) {
            echo mysqli_error($connection);
        }
    }

    //set up new ref with button
    if (isset($_POST['new_technician'])) {
        $id = $_POST['id'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $sexe = $_POST['sexe'];
        $categorie = $_POST['categorie'];
        $image = $_POST['image'];
        $club = $_POST['club'];
        $lateralite = $_POST['lateralite'];
        $date_naissance = $_POST['date_naissance'];
        $licence = $_POST['licence'];
        $nation = $_POST['nation'];

        $referee_object = new referee($sexe, $id,$categorie, $image, $club, $lateralite, $date_naissance, $licence, $nation, $prenom, $nom);

        //find ref with same id then delete
        $id_to_delete = findObject($json_table, $id, "id"); //findObject() is on line 146 includes/functions.php
        if ($id_to_delete !== false) {
            unset($json_table[$id_to_delete]);
            $json_table = array_values($json_table);
        }

        //update db with new referee object
        array_push($json_table, $referee_object);

        if (updateData($json_table, $comp_id, $connection)) {
            header("Refresh: 0");
        }
    }

    //remove referee by button
    if (isset($_POST['remove_referee'])) {
        $id = $_POST['id'];

        $id_to_delete = findObject($json_table, $id, "id"); //findObject() is on line 146 includes/functions.php
        if ($id_to_delete !== false) {
            unset($json_table[$id_to_delete]);
            $json_table = array_values($json_table);
        }

        //update_db with new data
        if (updateData($json_table, $comp_id, $connection)) {
            header("Refresh: 0");
        }
    }

    if (isset($_POST['submit_import'])) {
        $import_comp = $_POST['selected_comp_id'];

        //get referees from selected comp
        $qry_get_refs = "SELECT data FROM referees WHERE assoc_comp_id = '$import_comp'";
        $do_get_refs = mysqli_query($connection, $qry_get_refs);

        if ($row = mysqli_fetch_assoc($do_get_refs)) {
            $import_json_string = $row['data'];
            $import_json_table = json_decode($import_json_string);

            foreach ($import_json_table as $import_object) {
                $id = $import_object -> id;
                if (FALSE === findObject($json_table, $id, "id")) {
                    array_push($json_table, $import_object);
                }
            }
            $json_table = array_values($json_table);

            //update db with nre data
            if (updateData($json_table, $comp_id, $connection)) {
                header("Refresh: 0");
            }

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
    <title>Referees</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                        <p class="page_title">Referees</p>
                        <div class="stripe_button_wrapper">
                            <button class="stripe_button" onclick="toggle_import_technician()">
                                <p>Import Referees</p>
                                <img src="../assets/icons/save_alt-black-18dp.svg"/>
                            </button>
                            <button type="submit" class="stripe_button red" onclick="" form="remove_technician" name="remove_referee" id="remove_technician_button">
                                <p>Remove Referee</p>
                                <img src="../assets/icons/delete-black-18dp.svg"/>
                            </button>
                            <button class="stripe_button primary" onclick="toggle_add_technician()">
                                <p>Add Referees</p>
                                <img src="../assets/icons/add-black-18dp.svg"/>
                            </button>
                        </div>

                        <div id="import_technician_panel" class="overlay_panel hidden">
                            <button class="panel_button" onclick="toggle_import_technician()">
                                <img src="../assets/icons/close-black-18dp.svg" >
                            </button>
                            <form action="" id="import_ref" method="POST" class="overlay_panel_form" autocomplete="off">
                                <div class="table t_c_0">
                                    <div class="table_header">
                                        <div class="table_header_text"><p>NAME</p></div>
                                    </div>
                                    <div class="select_competition_wrapper table_row_wrapper">
                                    <input type="text" name="selected_comp_id" id="selected_comp_input">
                                        <?php
                                        //get oragasniser id
                                        $qry_get_org_id = "SELECT `id` FROM `organisers` WHERE `username` = '$username'";
                                        $do_get_org_id = mysqli_query($connection, $qry_get_org_id);

                                        if ($row = mysqli_fetch_assoc($do_get_org_id)) {
                                            $org_id = $row['id'];
                                        } else {
                                            echo mysqli_error($connection);
                                        }

                                        $qry_get_comp_names = "SELECT `comp_name`, `comp_id` FROM `competitions` WHERE `comp_organiser_id` = '$org_id' AND comp_id != '$comp_id'";
                                        $do_get_comp_names = mysqli_query($connection, $qry_get_comp_names);

                                        while ($row = mysqli_fetch_assoc($do_get_comp_names)) {
                                            $import_comp_name = $row['comp_name'];
                                            $import_comp_id = $row['comp_id'];
                                        ?>

                                    <div class="table_row" id="<?php echo $import_comp_id; ?>" onclick="importTechnicians(this)"><div class="table_item" id="<?php echo $import_comp_id; ?>"><p><?php echo $import_comp_name; ?></p></div></div>

                                    <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                                <button type="submit" name="submit_import" class="panel_submit" value="Import">Import</span></button>
                            </form>
                        </div>
                        <input type="text" name='id' form="remove_technician" class="selected_list_item_input hidden">
                        <form action="" method="POST" id="remove_technician" class="hidden"></form>

                    <div id="add_technician_panel" class="overlay_panel hidden">
                        <div class="overlay_panel_controls">
                            <button type="button" id="overlayPanelButtonLeft" onclick="leftButton()"><img src="../assets/icons/arrow_back_ios-black-18dp.svg"></button>
                            <p>Identification</p>
                            <button type="button" id="overlayPanelButtonRight" onclick="rightButton()"><img src="../assets/icons/arrow_forward_ios-black-18dp.svg"></button>
                            <p class="overlay_panel_controls_counter">3 / 3</p>
                        </div>
                        <button class="panel_button" onclick="toggle_add_technician()">
                            <img src="../assets/icons/close-black-18dp.svg" >
                        </button>
                        <form class="overlay_panel_form" autocomplete="off" action="referees.php?comp_id=<?php echo $comp_id; ?>" method="POST" id="new_technician">
                            <div class="overlay_panel_division visible" overlay_division_title="Identification">
                                <label for="id">USERNAME</label>
                                <input type="text" placeholder="Type the referees's id" class="username_input" name="id">
                                <label for="prenom">First name</label>
                                <input type="text" placeholder="Type the referees's first name" class="full_name_input" name="prenom">
                                <label for="nom">Surname</label>
                                <input type="text" placeholder="Type the referees's surname" class="full_name_input" name="nom">
                            </div>
                            <div class="overlay_panel_division" overlay_division_title="Identification 2">
                                <label>SEX</label>
                                <div class="option_container row">
                                    <input type="radio" name="sexe" id="male" value="m"/>
                                    <label for="male">Male</label>
                                    <input type="radio" name="sexe" id="female" value="f"/>
                                    <label for="female">Female</label>
                                </div>
                                <label for="date_naissance">Date of Birth</label>
                                <input type="date" class="date_input" name="date_naissance">
                                <label for="licence">License</label>
                                <input type="text" placeholder="Type the referees's license number" class="full_name_input" name="licence">
                                <label for="image">Image link</label>
                                <input type="text" placeholder="Type in the link to the referee's image" class="full_name_input" name="image">
                            </div>
                            <div class="overlay_panel_division" overlay_division_title="Categoriaztion">
                                <label for="club">Club</label>
                                <div class="search_wrapper wide">
                                    <input type="text" name="nation" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="set_club_input" placeholder="Search Club by Name" class="search input">
                                    <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close-black-18dp.svg"></button>
                                    <div class="search_results">
                                    <?php include "../includes/nations.php"; ?>
                                    </div>
                                </div>
                                <label for="categorie">Categorie</label>
                                <input type="text" placeholder="Type the referees's categorie" class="full_name_input" name="categorie">
                                <label>Lateralite</label>
                                <div class="option_container row">
                                    <input type="radio" name="lateralite" id="g" value="g" />
                                    <label for="g">Left</label>
                                    <input type="radio" name="lateralite" id="d" value="d" />
                                    <label for="d">Right</label>
                                </div>
                                <label>NATION</label>
                                <div class="search_wrapper wide">
                                    <input type="text" name="nation" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="set_nation_input" placeholder="Search Country by Name" class="search input">
                                    <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                                    <div class="search_results">
                                    <?php include "../includes/nations.php"; ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="new_technician" class="panel_submit" form="new_technician" value="Save">Save</button>
                        </form>
                    </div>
                    <div class="search_wrapper">
                        <input type="text" name="" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search page">
                        <button type="button"><img src="../assets/icons/close-black-18dp.svg"></button>
                        <div class="search_results">
                            <?php
                                $ref_list_query = "SELECT * FROM $table_name";
                                $ref_list_query_do = mysqli_query($connection, $ref_list_query);
                                while($row = mysqli_fetch_assoc($ref_list_query_do)){

                                    $ref_id = $row['id'];
                                    $ref_name = $row['name'];




                            ?>

                            <a id="<?php echo $ref_id ?>" href="#"  onclick="selectSearch(this), autoFill(this)"><?php echo $ref_name ?></a>

                            <?php

                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="page_content_panel_main">
                    <div class="wrapper table">

                    <?php

                    if (!isset($json_table[0])) {

                   ?>
                            <div id="no_something_panel">
                                <p>You have no referees set up!</p>
                            </div>
                    <?php
                    } else {
                    ?>

                        <div class="table_header">
                            <div class="table_header_text">FULL NAME</div>
                            <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp()"></button>
                            <div class="table_header_text">NATION</div>
                            <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp()"></button>
                            <div class="table_header_text">CLUB</div>
                            <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp()"></button>
                            <div class="table_header_text">STATUS</div>
                            <div class="small_status_header"></div>
                        </div>
                        <div class="table_row_wrapper">
                        <?php

                                foreach ($json_table as $json_object) {

                            ?>

                            <div class="table_row" id="<?php echo $json_object -> id; ?>" onclick="selectRow(this)">
                                <div class="table_item"><p><?php echo $json_object -> prenom . " " . $json_object -> nom; ?></p></div>
                                <div class="table_item"><p><?php echo $json_object -> nation ?></p></div>
                                <div class="table_item"><p><?php echo $json_object -> club; ?></p></div>
                                <div class="table_item"><p><?php

                                if($json_object -> isOnline == false){

                                    echo "Offline";

                                }
                                else{
                                    echo "Online";
                                }

                                ?>
                                </p>
                            </div>
                            <div class="small_status_item <?php

                            if($json_object -> isOnline == false){

                                echo "red";

                            }
                            else{
                                echo "green";
                            }

                            ?>"></div> <!-- red or green style added to small_status item to inidcate status -->
                        </div>
                        <?php
                        }
                    }
                    //Check,read,display technicians END
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/referees.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/importoverlay.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>