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

    function __construct($sexe, $id, $image, $points, $classement, $club, $lateralite, $date_naissance, $licence, $nation, $prenom, $nom, $reg, $wc, $comp_rank, $temp_rank, $final_rank)
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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Competitiors</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>

<body>
    <!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Competitors</p>
                <input type="text" class="selected_list_item_input">
                <div class="stripe_button_wrapper">
                    <button class="stripe_button disabled" type="button">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/message-black.svg"/>
                    </button>
                    <a class="stripe_button primary" href="import_competitors.php?comp_id=<?php echo $comp_id ?>">
                        <p>Import Competitors from XML</p>
                        <img src="../assets/icons/get_app-black.svg"/>
                    </a>
                </div>
                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search page">
                    <button type="button"><img src="../assets/icons/close-black.svg"></button>
                    <div class="search_results">
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button"></button>
                    </div>
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
                <div class="wrapper table w90 first_column_centered">
                    <div class="table_header">
                        <div class="table_header_text">C. POS</div>
                        <div class="table_header_text">R. POS</div>
                        <div class="table_header_text">NAME</div>
                        <div class="table_header_text">NATION</div>
                        <div class="table_header_text">CLUB</div>
                        <div class="table_header_text">REGISTRATION</div>
                        <div class="small_status_header"></div>
                        <div class="table_header_text">WEAPON CONTROL</div>
                        <div class="small_status_header"></div>
                    </div>
                    <div class="table_row_wrapper">
                        <?php
                        foreach ($json_table as $json_obj) {
                        ?>
                            <div class="table_row" onclick="selectRow(this)" tabindex="0" loading="lazy">
                                <div class="table_item">
                                    <p><?php echo $json_obj->comp_rank ?></p>
                                </div>
                                <div class="table_item">
                                    <p><?php echo $json_obj->classement ?></p>
                                </div>
                                <div class="table_item">
                                    <p><?php echo $json_obj->prenom . " " . $json_obj->nom ?></p>
                                </div>
                                <div class="table_item">
                                    <p><?php echo $json_obj->nation ?></p>
                                </div>
                                <div class="table_item">
                                    <p><?php echo $json_obj->club ?></p>
                                </div>
                                <div class="table_item">
                                    <p>
                                        <?php

                                        if ($json_obj->wc == 0) {

                                            echo "Not ready";
                                        } else {

                                            echo "Ready";
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="small_status_item <?php
                                                                if ($json_obj->reg == 0) {

                                                                    echo "red";
                                                                } else {

                                                                    echo "green";
                                                                }
                                                                ?>">
                                </div>
                                <div class="table_item"><?php
                                                        if ($json_obj->wc == 0) {

                                                            echo "Not ready";
                                                        } else {

                                                            echo "Ready";
                                                        }
                                                        ?>
                                </div>
                                <div class="small_status_item <?php
                                                                if ($json_obj->wc == 0) {

                                                                    echo "red";
                                                                } else {

                                                                    echo "green";
                                                                }
                                                                ?>">
                                </div>
                            </div>

                    <?php
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/controls.js"></script>
<script src="../js/search.js"></script>
</html>