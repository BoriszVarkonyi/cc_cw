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

        $formula_table = new stdClass();

        $formula_table -> poolPoints = $pool_points;
        $formula_table -> tablePoints = $table_points;
        $formula_table -> qualifiers = $qualifiers;
        $formula_table -> isDirectElim = $is_direct_elim;
        $formula_table -> isOnePhase = $is_one_phase;
        $formula_table -> fencingThird = $fencing_for_third;

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
            header("Refresh: 0");
        }
    }

    //get data for display from db
    $qry_get_data = "SELECT * FROM formulas WHERE assoc_comp_id = '$comp_id'";
    $do_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $json_string = $row['data'];

        $json_table = json_decode($json_string);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formula of <?php echo $comp_name ?></title>
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
                <p class="page_title">Formula</p>
                <div class="stripe_button_wrapper">
                    <button name="submit_form" form="save_form" class="stripe_button orange" type="submit" shortcut="SHIFT+S">
                        <p>Save Formula</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/build-black-18dp.svg"  class="db_panel_stripe_icon">
                        <p>Set basic information</p>
                    </div>
                    <div class="db_panel_main">

                    <form id="save_form" action="" class="column_form_wrapper" method="POST">
                        <div class="form_column">
                            <label for="points_pools" >POINTS IN POOLS</label>
                            <input type="number" name="points_pools" placeholder="#" class="number_input centered" value="<?php echo $json_table -> poolPoints ?>">

                            <label for="points_table" >POINTS IN TABLE</label>
                            <input type="number" name="points_table" placeholder="#" class="number_input centered" value="<?php echo $json_table -> tablePoints ?>">
                        
                            <label for="nb_qualifier" >NUMBER OF QUALIFIERS AFTER POOLS</label>
                            <input type="number" name="nb_qualifier" placeholder="#" class="number_input centered" value="<?php echo $json_table -> qualifiers ?>">

                            <label for="elimnation_type" >ELIMINATION TYPE</label>
                            <div class="option_container">
                                <input type="radio" name="elimnation_type" id="direct_et" value="1" <?php echo $is_checked = ($json_table -> isDirectElim == 1) ? "checked" : "" ?> />
                                <label for="direct_et">Direct-Elimination Tournament</label>

                                <input type="radio" name="elimnation_type" id="double_et" value="0" <?php echo $is_checked = ($json_table -> isDirectElim == 0) ? "checked" : "" ?> />
                                <label for="double_et">Double-Elimination Tournament</label>
                            </div>

                        </div>
                        <div class="form_column">
                            <label for="type_of_elimination">TYPE OF DIRECT ELIMINTION</label>
                            <div class="option_container">
                                <input type="radio" name="type_of_elimination" id="one_phase_table" value="1" <?php echo $is_checked = ($json_table -> isOnePhase == 1) ? "checked" : "" ?> />
                                <label for="one_phase_table">One Phase Table</label>

                                <input type="radio" name="type_of_elimination" id="two_phase_table" value="0" <?php echo $is_checked = ($json_table -> isOnePhase == 0) ? "checked" : "" ?> />
                                <label for="two_phase_table">Two Phase Table</label>
                            </div>

                            <label for="third_place" >FENCING FOR 3RD PLACE</label>
                            <div class="option_container">
                                <input type="radio" name="third_place" id="third_place_yes" value="1" <?php echo $is_checked = ($json_table -> fencingThird == 1) ? "checked" : "" ?> />
                                <label for="third_place_no">Yes</label>

                                <input type="radio" name="third_place" id="third_place_no" value="0" <?php echo $is_checked = ($json_table -> fencingThird == 0) ? "checked" : "" ?> /> 
                                <label for="third_place_no">No</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/formula.js"></script>
</html>
