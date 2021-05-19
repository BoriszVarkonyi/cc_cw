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
                    <button class="stripe_button disabled" type="button">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/message_black.svg"/>
                    </button>
                    <form action="" id="IDE KELL A FOR IDJE">
                        <input type="text" class="selected_list_item_input" readonly>
                    </form>
                    <button class="stripe_button red" type="submit" form="IDE KELL A FOR IDJE">
                        <p>Remove Fencer</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>
                    <button class="stripe_button primary" type="button" onclick="window.print()">
                        <p>Print Competitors</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                    <a class="stripe_button primary" href="import_competitors.php?comp_id=<?php echo $comp_id ?>">
                        <p>Import Competitors from XML</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                </div>
                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
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
                <div class="wrapper table xsmall w90">
                    <div class="table_header">
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" placeholder="Search by Competition Position" class="search page">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>C. POS</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" placeholder="Search by Classement Position" class="search page">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>R. POS</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
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
                            <p>NATION</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="table_header_text">
                            <div class="search_panel">
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" placeholder="Search by Club" class="search page">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                            </div>
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>CLUB</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="table_header_text">
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
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
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>REGISTRATION</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="small_status_header"></div>
                        <div class="table_header_text">
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
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
                            <button type="button" onclick="sortButton(this)">
                                <img src="../assets/icons/switch_full_black.svg">
                            </button>
                            <p>WEAPON CONTROL</p>
                            <button type="button" onclick="searchButton(this)">
                                <img src="../assets/icons/search_black.svg">
                            </button>
                        </div>
                        <div class="small_status_header"></div>
                    </div>
                    <div class="table_row_wrapper">
                        <?php
                        foreach ($json_table as $json_obj) {
                        ?>
                            <div class="table_row" onclick="selectRow(this)" loading="lazy">
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
                                    <p><?php

                                        if ($json_obj->reg == 0) {

                                            echo "Not ready";
                                        } else {

                                            echo "Ready";
                                        }
                                        ?></p>
                                </div>
                                <div class="small_status_item <?php
                                                    if ($json_obj->reg == 0) {

                                                        echo "red";
                                                    } else {

                                                        echo "green";
                                                    }
                                                    ?>">
                                </div>
                                <div class="table_item">
                                    <p><?php
                                        if ($json_obj->wc == 0) {

                                            echo "Not ready";
                                        } else {

                                            echo "Ready";
                                        }
                                        ?></p>
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
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/list_search.js"></script>
</body>
</html>