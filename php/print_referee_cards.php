<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

function updateData($data, $comp_id, $conn)
{
    $json_string = json_encode($data, JSON_UNESCAPED_UNICODE);

    $qry_update_data = "UPDATE `referees` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
    if ($do_update_row = mysqli_query($conn, $qry_update_data)) {
        return TRUE;
    } else {
        echo mysqli_error($conn);
        return FALSE;
    }
}

function generatePassword()
{

    $string_chars = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

    $password = "";
    for ($i = 0; $i < 8; $i++) { //change lenght of password and random characters;
        $random_number = rand(0, strlen($string_chars) - 1);
        $password[$i] = $string_chars[$random_number];
    }

    return $password;
}

function generateUsername($fn, $ln)
{

    $usn = strtolower($fn) . "_" . strtolower($ln);

    return $usn;

}

class referee
{
    public $sexe;
    public $id;
    public $categorie;
    public $image;
    public $club;
    public $lateralite;
    public $dateNaissance;
    public $licence;
    public $nation;
    public $prenom;
    public $nom;
    public $password;
    public $isOnline;
    public $username;

    function __construct($sexe, $id, $categorie, $image, $club, $lateralite, $dateNaissance, $licence, $nation, $prenom, $nom)
    {
        $this->sexe = $sexe;
        $this->id = $id;
        $this->categorie = $categorie;
        $this->image = $image;
        $this->club = $club;
        $this->lateralite = $lateralite;
        $this->dateNaissance = $dateNaissance;
        $this->licence = $licence;
        $this->nation = $nation;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->isOnline = true;
        $this->password = generatePassword();
        $this->username = generateUsername($prenom, $nom);
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

    $referee_object = new referee($sexe, $id, $categorie, $image, $club, $lateralite, $date_naissance, $licence, $nation, $prenom, $nom);

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
            $id = $import_object->id;
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
    <title>Print Referee Cards</title>
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
                <p class="page_title">Print Referee Cards</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button bold" href="referees.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Referees</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <button class="stripe_button primary" onclick="window.print()">
                        <p>Print Cards</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <table class="wrapper">

                    <?php

                    if (!isset($json_table[0])) {

                    ?>
                        <div id="no_something_panel">
                            <p>You have no referees set up!</p>
                        </div>
                    <?php
                    } else {
                    ?>

                    <thead>
                        <tr>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Full name" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>FULL NAME</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Nation" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>NATION</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Club" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>CLUB</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                            <th>
                                <p>PASSWORD</p>
                                <button type="button" onclick="hidePasswordButton(this)" id="visibility_button">
                                    <img src="../assets/icons/visibility_off_black.svg">
                                </button>
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
                                        <input type="radio" name="status" id="listsearch_available" value="Available" />
                                        <label for="listsearch_available">Available</label>
                                        <input type="radio" name="status" id="listsearch_not_available" value="Not available" />
                                        <label for="listsearch_not_available">Not available</label>
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
                            <th class="small"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($json_table as $json_object) {

                        ?>

                            <tr id="<?php echo $json_object->id; ?>" onclick="selectRow(this)" tabindex="0">
                                <td>
                                    <p><?php echo $json_object->prenom . " " . $json_object->nom; ?></p>
                                </td>
                                <td>
                                    <p><?php echo $json_object->nation ?></p>
                                </td>
                                <td>
                                    <p><?php echo $json_object->club; ?></p>
                                </td>
                                <td class="password">
                                    <p> <?php echo $json_object->password ?> </p>
                                </td>
                                <td>
                                    <p><?php

                                        if ($json_object->isOnline == false) {

                                            echo "Not available";
                                        } else {
                                            echo "Available";
                                        }

                                        ?>
                                    </p>
                                </td>
                                <td class="small <?php

                                                                if ($json_object->isOnline == false) {

                                                                    echo "red";
                                                                } else {
                                                                    echo "green";
                                                                }

                                                                ?>"></td> <!-- red or green style added to small_status item to inidcate status -->
                            </tr>
                        <?php
                            }
                        }
                        //Check,read,display technicians END
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list_2.js"></script>
    <script src="../js/referees.js"></script>
    <script src="../js/technicans_referees.js"></script>
    <script src="../js/controls_2.js"></script>
    <script src="../js/importoverlay.js"></script>
    <script src="../js/list_search_2.js"></script>
    <script src="../js/overlay_panel.js"></script>
</body>

</html>