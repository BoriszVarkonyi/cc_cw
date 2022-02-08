<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    class formula {
        public $team_rank_by = "classement";
        public $callRoom = false;
        public $type_call_room = "Single";
        public $max_points = 5;
        public $ranking = "normal";

        function setByPOST() {
            $this -> team_rank_by = $_POST['team_ranking'];
            $usage_call_room = $_POST['call_room_usage'];
            $when_call_room = $_POST['call_room_number'];
            if ($usage_call_room) {
                $call_room = "";
                for ($i = $when_call_room; $i > 1; $i = $i / 2) {
                    $call_room .= $i . ",";
                }
                $call_room = substr($call_room, 0, -1);
                $this -> callRoom = $call_room;
            } else {
                $this -> callRoom = false;
            }
            $this -> type_call_room = $_POST['callroom_type'];
            $this -> max_points = $_POST['max_points_input'];
            $this -> ranking = $_POST['ranking'];
        }

        function makeString() {
            $return = json_encode($this, JSON_UNESCAPED_UNICODE);
            return $return;
        }
    }



    //make formulas table
    $qry_create_table = "CREATE TABLE `ccdatabase`.`formulas` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_table = mysqli_query($connection, $qry_create_table);

    //search for existing row
    $qry_get_data = "SELECT `data` FROM `formulas` WHERE `assoc_comp_id` = '$comp_id'";
    if ($do_get_data = mysqli_query($connection, $qry_get_data)) {
        if ($row = mysqli_fetch_assoc($do_get_data)) {
            $formula_string = $row['data'];
            $formula = json_decode($formula_string);
            echo 1;
        } else {
            $formula = new formula;
            $formula_string = $formula -> makeString();

            $qry_add_new_row = "INSERT INTO `formulas` (`assoc_comp_id`, `data`) VALUES ('$comp_id', '$formula_string')";
            $do_add_new_row = mysqli_query($connection, $qry_add_new_row);
            echo 2;
        }
    } else {
        $formula = new formula;
        $formula_string = $formula -> makeString();

        $qry_add_new_row = "INSERT INTO `formulas` (`assoc_comp_id`, `data`) VALUES ('$comp_id', '$formula_string')";
        $do_add_new_row = mysqli_query($connection, $qry_add_new_row);
        echo 3;
    }

    if (isset($_POST['submit_form'])) {

        //rank team by
        $formula = new formula;

        $formula -> setByPOST();

        $string_formula = $formula -> makeString();

        //update_db
        $qry_update = "UPDATE formulas SET data = '$string_formula' WHERE assoc_comp_id = '$comp_id'";
        if ($do_update = mysqli_query($connection, $qry_update)) {
            header("Refresh: 0");
        } else {
            echo mysqli_error($connection);
            echo $string_formula;
        }
    }


//get existing data from database or default values//

    //'rank teams by' input
    $rank_by_classement = $formula -> team_rank_by == "classement";

    //'usage of call room' input
    if ($formula -> callRoom != false) {
        $call_room_max = explode(',', $formula -> callRoom)[0];
        $call_room_usage = true;
    } else {
        $call_room_max = 0;
        $call_room_usage = false;
    }

    //'callroom type' input
    $single_elim_type = $formula -> type_call_room == "Single";

    //'max. points in bouts' input
    $max_points = $formula -> max_points;

    //'ranking' input
    $normal_ranking = $formula -> ranking == "normal";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formula</title>
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
                <p class="page_title">Formula</p>
                <div class="stripe_button_wrapper">
                    <button name="submit_form" form="save_form" class="stripe_button primary" type="submit" shortcut="SHIFT+S">
                        <p>Save Formula</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_header">
                        <img src="../assets/icons/build_black.svg">
                        <p>Set Formula of Table</p>
                    </div>
                    <div class="db_panel_main">
                    <form id="save_form" action="" class="form_wrapper" method="POST">
                        <div>

                            <div>
                                <label for="team_ranking">RANK TEAMS BY</label>
                                <div class="option_container">
                                    <input type="radio" name="team_ranking" id="team_ranking_class" value="classement" <?php echo $foo = ($rank_by_classement) ? "checked" : "" ?>/>
                                    <label for="team_ranking_class">Classesment</label>

                                    <input type="radio" name="team_ranking" id="team_ranking_fencer_perf" value="fencers_performance" <?php echo $foo = (!$rank_by_classement) ? "checked" : "" ?>/>
                                    <label for="team_ranking_fencer_perf">Fencers' Performance</label>
                                </div>
                            </div>

                            <div>
                                <label for="third_place">USAGE OF CALL ROOM</label>
                                <div class="option_container row no_bottom">
                                    <input type="radio" name="call_room_usage" id="used" onclick="useOption()" value="true" <?php echo $foo = ($call_room_usage) ? "checked" : "" ?>/>
                                    <label for="used">Use</label>

                                    <input type="radio" name="call_room_usage" id="not_used" onclick="dontUseOption()" value="false" <?php echo $foo = (!$call_room_usage) ? "checked" : "" ?>/>
                                    <label for="not_used">Don't use</label>
                                </div>
                                <div class="option_container" id="useOptionContainer">

                                    <?php
                                        for ($i = 64; $i > 1; $i = $i / 2) {
                                    ?>
                                    <input type="radio" name="call_room_number" id="T<?php echo $i ?>" value="<?php echo $i ?>" <?php echo $foo = ($call_room_max >= $i) ? "checked" : "" ?> />
                                    <label for="T<?php echo $i ?>">T<?php echo $i ?></label>
                                    <?php
                                        }
                                    ?>

                                </div>
                            </div>

                            <div>
                                <label for="callroom_type">CALLROOM TYPE</label>
                                <div class="option_container">
                                    <input type="radio" name="callroom_type" id="callroom_type_single" value="Single" <?php echo $foo = ($single_elim_type) ? "checked" : "" ?>/>
                                    <label for="callroom_type_single">Single-Elimination Like</label>

                                    <input type="radio" name="callroom_type" id="callroom_type_complex" value="Complex" <?php echo $foo = (!$single_elim_type) ? "checked" : "" ?>/>
                                    <label for="callroom_type_complex">Complex Callroom</label>
                                </div>
                            </div>


                        </div>
                        <div>
                            <div>
                                <label for="team_ranking">MAX. POINTS IN BOUTS</label>
                                <!-- ALAP ÉRTÉK 5 -->
                                <input type="number" name="max_points_input" id="max_points_input" class="number_input centered" placeholder="exp. 5" value="<?php echo $max_points ?>">
                            </div>


                            <div>
                                <label for="ranking">RANKING</label>
                                <div class="option_container">
                                    <input type="radio" name="ranking" id="ranking-normal" value="normal" <?php echo $foo = ($normal_ranking) ? "checked" : "" ?>/>
                                    <label for="ranking-normal">Normal order</label>

                                    <input type="radio" name="ranking" id="ranking-draw" value="draw" <?php echo $foo = (!$normal_ranking) ? "checked" : "" ?>/>
                                    <label for="ranking-draw">Draw 1-2, 3-4</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
<script src="javascript/cookie_monster.js"></script>
<script src="javascript/main.js"></script>
<script src="javascript/formula.js"></script>
</html>
