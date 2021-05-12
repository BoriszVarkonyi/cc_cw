<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    $comp_id = $_GET['comp_id'];

    //make formulas table
    $qry_create_table = "CREATE TABLE `ccdatabase`.`formulas` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_table = mysqli_query($connection, $qry_create_table);

    //get data from form
    if (isset($_POST['submit_form'])) {
        $pool_points = $_POST['points_pools'];
        $table_points = $_POST['points_table'];
        $qualifiers = $_POST['nb_qualifier'];
        if ($_POST['elimnation_type'] == 1) {
            $is_direct_elim = TRUE;
        } else if ($_POST['elimnation_type'] == 0) {
            $is_direct_elim = FALSE;
        }
        if ($_POST['type_of_elimination'] == 1) {
            $is_one_phase = TRUE;
        } else if ($_POST['type_of_elimination'] == 0) {
            $is_one_phase = FALSE;
        }

        if ($_POST['third_place'] == 1) {
            $fencing_for_third = TRUE;
        } else if ($_POST['third_place'] == 0) {
            $fencing_for_third = FALSE;
        }

        if ($_POST['call_room_usage']) {
            $call_room = $_POST['call_room'];
        } else {
            $call_room = NULL;
        }

        $formula_table = new stdClass();

        $formula_table -> poolPoints = $pool_points;
        $formula_table -> tablePoints = $table_points;
        $formula_table -> qualifiers = $qualifiers;
        $formula_table -> isDirectElim = $is_direct_elim;
        $formula_table -> isOnePhase = $is_one_phase;
        $formula_table -> fencingThird = $fencing_for_third;
        $formula_table -> callRoom = $call_room;

        $json_table = json_encode($formula_table);

        //test for existing row
        $qry_test_row = "SELECT COUNT(*) FROM formulas WHERE assoc_comp_id = '$comp_id'";
        $do_test_row = mysqli_query($connection, $qry_test_row);
        if (mysqli_fetch_assoc($do_test_row)['COUNT(*)'] != 1) {
            $qry_make_row = "INSERT INTO formulas (assoc_comp_id, data) VALUES ('$comp_id', '$json_table')";
        } else {
            $qry_make_row = "UPDATE formulas SET data = '$json_table' WHERE assoc_comp_id = '$comp_id'";
        }

        if ($do_mane_row = mysqli_query($connection, $qry_make_row)) {
            //header("Refresh: 0");
            var_dump($_POST);
        }
    }

    //get data for display from db
    $qry_get_data = "SELECT * FROM formulas WHERE assoc_comp_id = '$comp_id'";
    $do_get_data = mysqli_query($connection, $qry_get_data);
    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $json_string = $row['data'];
    } else {
        $json_string = '{"poolPoints":"","tablePoints":"","qualifiers":"","isDirectElim":true,"isOnePhase":true,"fencingThird":true}';
    }

    $json_table = json_decode($json_string);

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
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/build_black.svg">
                        <p>Set Formula of Pools and Table</p>
                    </div>
                    <div class="db_panel_main">

                    <form id="save_form" action="" class="form_wrapper" method="POST">
                        <div>
                            <div>
                                <label for="points_pools">POINTS IN POOLS</label>
                                <input type="number" name="points_pools" placeholder="#" class="number_input centered" value="<?php echo $json_table -> poolPoints ?>" id="pIP">
                            </div>
                            <div>
                                <label for="points_table">POINTS IN TABLE</label>
                                <input type="number" name="points_table" placeholder="#" class="number_input centered" value="<?php echo $json_table -> tablePoints ?>" id="pIT">
                            </div>
                            <div>
                                <label for="nb_qualifier">NUMBER OF QUALIFIERS AFTER POOLS</label>
                                <input type="number" name="nb_qualifier" placeholder="#" class="number_input centered" value="<?php echo $json_table -> qualifiers ?>" id="nOQAP">
                            </div>
                            <div>
                                <label for="elimnation_type">ELIMINATION TYPE</label>
                                <div class="option_container">
                                    <input type="radio" name="elimnation_type" id="direct_et" value="1" <?php echo $is_checked = ($json_table -> isDirectElim == 1) ? "checked" : "" ?> />
                                    <label for="direct_et">Direct-Elimination Tournament</label>
                                    <input type="radio" name="elimnation_type" id="double_et" value="0" <?php echo $is_checked = ($json_table -> isDirectElim == 0) ? "checked" : "" ?> />
                                    <label for="double_et">Double-Elimination Tournament</label>
                                </div>
                            </div>
                        </div>
                        <div>

                            <div>
                                <label for="type_of_elimination">TYPE OF DIRECT ELIMINTION</label>
                                <div class="option_container">
                                    <input type="radio" name="type_of_elimination" id="one_phase_table" value="1" <?php echo $is_checked = ($json_table -> isOnePhase == 1) ? "checked" : "" ?> />
                                    <label for="one_phase_table">One Phase Table</label>

                                    <input type="radio" name="type_of_elimination" id="two_phase_table" value="0" <?php echo $is_checked = ($json_table -> isOnePhase == 0) ? "checked" : "" ?> />
                                    <label for="two_phase_table">Two Phase Table</label>
                                </div>
                            </div>
                            <div>
                                <label for="third_place">FENCING FOR 3RD PLACE</label>
                                <div class="option_container">
                                    <input type="radio" name="third_place" id="third_place_yes" value="1" <?php echo $is_checked = ($json_table -> fencingThird == 1) ? "checked" : "" ?> />
                                    <label for="third_place_no">Yes</label>

                                    <input type="radio" name="third_place" id="third_place_no" value="0" <?php echo $is_checked = ($json_table -> fencingThird == 0) ? "checked" : "" ?> />
                                    <label for="third_place_no">No</label>
                                </div>
                            </div>
                            <div>
                                <?php
                                    if ($json_table -> callRoom == NULL) {
                                        $call_room_check = "";
                                        $call_room_n_check = "checked";
                                        $call_room_number=0;
                                    } else {
                                        $call_room_check = "checked";
                                        $call_room_n_check = "";

                                        $call_room_number = $json_table -> callRoom;

                                    }

                                ?>
                                <label for="third_place">USAGE OF CALL ROOM</label>
                                <div class="option_container row no_bottom">
                                    <input type="radio" name="call_room_usage" id="used" onclick="useOption()" value="true" <?php echo $call_room_check ?>/>
                                    <label for="used">Use</label>

                                    <input type="radio" name="call_room_usage" id="not_used" onclick="dontUseOption()" value="false" <?php echo $call_room_n_check ?>/>
                                    <label for="not_used">Don't use</label>
                                </div>
                                <div class="option_container" id="useOptionContainer">
                                    <?php
                                        foreach ($array_numbers as $numbers) {

                                            if ($call_room_number == $numbers) {
                                                $call_room_numbers_checked = "checked";
                                            } else {
                                                $call_room_numbers_checked = "";
                                            }
                                    ?>
                                    <input type="checkbox" name="call_room <?php echo $numbers ?>" id="<?php echo $numbers ?>" value="<?php echo $numbers ?>" <?php echo $call_room_numbers_checked ?>/>
                                    <label for="<?php echo $numbers ?>"><?php echo $numbers ?></label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/formula.js"></script>
</html>
