<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php
    class equipes{

    }

    class equipe {
        public $id;
        public $nation = "";
        public $statut = "N";
        public $club = "";
        public $classement = "";
        public $points = "";
        public $leader = "";
        public $coach = "";
        public $tireurs = [];

        public function __construct($id, $nation, $club, $classement, $points, $statut) {
            $this -> nation = $nation;
            $this -> statut = $statut;
            $this -> club = $club;
            $this -> classement = $classement;
            $this -> points = $points;
            $this -> id = $id;
        }
    }

    //make new db table
    $qry_new_table = "CREATE TABLE `ccdatabase`.`teams` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL DEFAULT '{ }', PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_new_table = mysqli_query($connection, $qry_new_table);

    //get equipes table from database
    $qry_get_data = "SELECT `data` FROM `teams` WHERE `assoc_comp_id` = '$comp_id'";
    $do_get_data = mysqli_query($connection, $qry_get_data);
    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $json_string = $row['data'];
        $equipes_table = json_decode($json_string);
    } else {
        $equipes_table = new equipes;
        //make new row in database
        $qry_insert = "INSERT INTO teams (assoc_comp_id) VALUES ('$comp_id')";
        $do_insert = mysqli_query($connection, $qry_insert);
    }

    if (isset($_POST['submit_add_team'])) {
        $team_nation = $_POST['input_team_nation'];
        $team_club = $_POST['input_team_club'];
        $team_name = $_POST['input_team_name'];

        $new_equipe = new equipe($team_name, $team_nation, $team_club, "999", "0", "n");
        $equipes_table -> $team_name = $new_equipe;

        $json_string = json_encode($equipes_table, JSON_UNESCAPED_UNICODE);
        //update database with new data
        $qry_update = "UPDATE teams SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        if ($do_update = mysqli_query($connection, $qry_update)) {
            header("Refresh: 0");
        } else {
            echo "ERROR: " . mysqli_error($connection);
        }
    }

    if (isset($_POST['submit_coach_leader'])) {
        $coach_name = $_POST['coach_input'];
        $leader_name = $_POST['leader_input'];
        $team_name = $_POST['team_name'];

        $equipes_table -> {$team_name} -> coach = $coach_name;
        $equipes_table -> {$team_name} -> leader = $leader_name;

        $json_string = json_encode($equipes_table, JSON_UNESCAPED_UNICODE);
        $qry_update = "UPDATE teams SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        if ($do_update = mysqli_query($connection, $qry_update)) {
            header("Refresh: 0");
        } else {
            echo "ERROR: " . mysqli_error($connection);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teams</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Teams</p>
                <div class="stripe_button_wrapper">
                    <form action="" method="POST" id="remove_team_form">
                        <input type="text" class="selected_list_item_input hidden" name="selected_id" readonly>
                    </form>

                    <a class="stripe_button" href="import_teams.php?comp_id=<?php echo $comp_id ?>&type=team" shortcut="SHIFT+I" id="import_teams_XML_bt">
                        <p>Import Teams from XML</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                    <button class="stripe_button red" name="remove_team" type="submit" form="remove_team_form" shortcut="SHIFT+R" id="remove_team_bt">
                        <p>Remove Team</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>
                    <button class="stripe_button primary" type="button" onclick="toggleAddTeamPanel()" shortcut="SHIFT+A" id="add_team_bt">
                        <p>Add Team</p>
                        <img src="../assets/icons/add_black.svg"/>
                    </button>
                    <a class="stripe_button primary" href="team_order_reports.php?comp_id=<?php echo $comp_id ?>" shortcut="SHIFT+O" id="teams_order_reports_bt">
                        <p>Teams Order Reports</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                    <a class="stripe_button primary" href="assign_fencers_to_teams.php?comp_id=<?php echo $comp_id ?>" shortcut="SHIFT+T" id="assign_fencers_to_teams_bt">
                        <p>Assign Fencers to Teams</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                    <form id="barcode_form" method="POST" action="">
                        <button type="button" class="barcode_button" onclick="toggleBarCodeButton(this)">
                            <img src="../assets/icons/barcode_black.svg">
                        </button>
                        <input type="text" name="barcode" class="barcode_input" placeholder="Barcode" onfocus="toggleBarCodeInput(this)" onblur="toggleBarCodeInput(this)">
                        <button type="submit" form="barcode_form"></button>
                    </form>
                </div>

                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" placeholder="Search Team" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
                    <div class="search_results">
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button"></button>
                    </div>
                </div>

                <div id="add_team_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggleAddTeamPanel()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form action="" id="add_team" method="POST" class="overlay_panel_form" autocomplete="off">
                        <label for="name">TEAM NAME</label>
                        <input id="name" name="input_team_name" type="text" placeholder="Type in the Team's name">
                        <label for="nation">TEAM NATION</label>
                        <input id="nation" name="input_team_nation" type="text" placeholder="Type in the Team's nation">
                        <label for="club">TEAM CLUB</label>
                        <input id="club" name="input_team_club" type="text" placeholder="Type in the Team's club">

                        <button type="submit" name="submit_add_team" class="panel_submit" value="">Add</button>
                    </form>
                </div>
            </div>
            <div id="page_content_panel_main">

                <div class="wrapper list w90">

                    <?php
                        $empty = true;
                        foreach ($equipes_table as $equipe_obj) {
                            $name = $equipe_obj -> id;
                            $fencers_array = $equipe_obj -> tireurs;
                            $nationality = $equipe_obj -> nation;
                            $club = $equipe_obj -> club;
                            $leader = $equipe_obj -> leader;
                            $coach = $equipe_obj -> coach;

                            $empty = false;

                    ?>
                    <!-- EZT KELL LOOPOLNI -->
                    <div class="entry">
                        <div class="tr bold">
                            <p><?php echo $name ?></p>
                        </div>
                        <div class="entry_panel with_header">
                            <div class="entry_header">
                                <form method="POST" autocomplete="off">
                                    <div>
                                        <label for="">TEAM LEADER</label>
                                        <input type="text" name="leader_input" class="name_input alt no_bottom_margin" value="<?php echo $leader ?>" placeholder="Type in the team leader's name">
                                    </div>
                                    <div>
                                        <label for="">COACH</label>
                                        <input type="text" name="coach_input" class="name_input alt no_bottom_margin" value="<?php echo $coach ?>" placeholder="Type in the coach's name">
                                    </div>
                                    <input name="team_name" type="text" class="hidden" value="<?php echo $name ?>">
                                    <div class="">
                                        <button name="submit_coach_leader" type="submit">SAVE</button>
                                    </div>
                                </form>
                            </div>
                            <table class="small no_interaction">
                                <thead>
                                    <tr>
                                        <th>
                                            <p>NAME</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="alt">
                                    <?php
                                        if (count($fencers_array) === 0) {

                                            ?>
                                                <tr>
                                                    <td>
                                                        <p>No fencers added yet!</p>
                                                    </td>
                                                </tr>
                                            <?php
                                        } else {
                                            foreach ($fencers_array as $fencer_obj) {
                                                $fencers_name = $fencer_obj -> prenom . " " . $fencer_obj -> nom;


                                    ?>
                                    <tr>
                                        <td>
                                            <p><?php echo $fencers_name ?></p>
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
                    <!-- EDDIG -->

                    <?php }
                        if ($empty) {
                            echo "There are no teams set up yet!";
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/controls.js"></script>
    <script src="javascript/search.js"></script>
    <script src="javascript/teams.js"></script>
</body>
</html>