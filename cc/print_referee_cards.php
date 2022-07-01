<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
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
    <link rel="stylesheet" href="../css/print_paper_style.min.css">
    <link rel="stylesheet" href="../css/print_referee_cards_style.min.css">
</head>
<body>
    <?php include "includes/navigation.php"; ?>
    <main>
        <div id="title_stripe">
            <p class="page_title">Print Referee Cards</p>
            <div class="stripe_button_wrapper">
                <a class="stripe_button bold" href="referees.php?comp_id=<?php echo $comp_id ?>">
                    <p>Go back to Referees</p>
                    <img src="../assets/icons/arrow_back_ios_black.svg"/>
                </a>
                <button class="stripe_button primary" onclick="printPage()">
                    <p>Print Cards</p>
                    <img src="../assets/icons/print_black.svg" />
                </button>
            </div>
            <div class="view_button_wrapper first">
                <button onclick="zoomOut()" id="zoomOutButton">
                    <img src="../assets/icons/zoom_out_black.svg"/>
                </button>
                <button onclick="zoomIn()" id="zoomInButton">
                    <img src="../assets/icons/zoom_in_black.svg"/>
                </button>
            </div>
        </div>
        <div id="page_content_panel_main" class="loose">
            <div id="pool_print_wrapper" class="paper_wrapper">

                <div class="paper">
                    <div class="paper_content full">
                        <div class="referee_card_wrapper">
                            <div class="referee_card">
                                g
                            </div>
                        </div>
                    </div>
                </div>

                <div class="paper">
                    <div class="paper_content full">
                        <div class="referee_card_wrapper">
                            <div class="referee_card">
                                g
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/print.js"></script>
</body>
</html>