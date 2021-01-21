<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

    $comp_id = $_GET['comp_id'];

    //feedback array
    $feedback = array(
        "fencer_data" => "no",
        "create_table" => "no",
        "ttest" => "no",
        "update" => "no",
        "rtest" => "no",
        "insert" => "no",
        "get_comp_data" => "no",
        "row_num" => "no",
        "get_data" => "no",
    );
    $table_name = "formula_" . $comp_id;

    //get comp_name from id
    $qry_get_comp_data = "SELECT * FROM `competitions` WHERE comp_id = '$comp_id'";
    $do_qry_get_comp_data = mysqli_query($connection, $qry_get_comp_data);

    if ($row = mysqli_fetch_assoc($do_qry_get_comp_data)) {
        $feedback['get_comp_data'] = "ok!";
        $comp_name = $row['comp_name'];
    } else {
        $feedback['get_comp_data'] = "ERROR " . mysqli_error($connection);
    }


    //if there is an existing row get all data from table
    $qry_get_data = "SELECT * FROM `$table_name`;";
    $do_qry_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_qry_get_data)) {

        $feedback['get_data'] = "ok!";
        $p_pools = $row['p_pools'];
        $p_table = $row['p_table'];
        $nb_o_rounds = $row['nb_exemp_pool'];
        $nb_qualifiers = $row['nb_qualifiers'];
        $nb_o_exemp_pool = $row['nb_exemp_pool'];
        $nb_o_exemp_table = $row['nb_exemp_table'];

    } else {
        $feedback['get_data'] = "ERROR " . mysqli_error($connection);
    }



    if (isset($_POST['submit_form'])) {

        //checking for dupli tables
        $check_d_table_qry = "SELECT *
        FROM information_schema.tables 
        WHERE table_schema = 'ccdatabase' 
        AND table_name = '$table_name';";

        if ($check_d_table_do = mysqli_query($connection, $check_d_table_qry)) {

            $feedback['ttest'] = "ok!";
            $row_num = mysqli_num_rows($check_d_table_do);
            if ($row_num == 0) {
                    //creating formula  table
                    $qry_creating_wc_table = "CREATE TABLE `ccdatabase`.`$table_name` (
                                                                                        `p_pools` INT(11) NOT NULL ,
                                                                                        `p_table` INT(11) NOT NULL , 
                                                                                        `nb_qualifiers` INT(11) NOT NULL , 
                                                                                        `nb_exemp_pool` INT(11) NOT NULL , 
                                                                                        `nb_exemp_table` INT(11) NOT NULL ,
                                                                                        `elim_type` VARCHAR(11) NOT NULL ,  
                                                                                        `fencing_f_3rd` VARCHAR(11) NOT NULL ,
                                                                                        )
                                                                                        ENGINE = InnoDB;";

                if ($do_qry_creating_table = mysqli_query($connection, $qry_creating_wc_table)) {
                    $feedback['create_table'] = "ok!";
                } else {
                    $feedback['create_table'] = "ERROR " . mysqli_error($connection);
                }

                //insert new row into table_name
                $qry_insert = "INSERT INTO `$table_name` (`p_pools`, `p_table`, `nb_qualifiers`, `nb_exemp_pool`, `nb_exemp_table`) VALUE ('','','','','')";
                if ($do_qry_insert = mysqli_query($connection, $qry_insert)) {
                    $feedback['insert'] = "ok!";
                } else {
                    $feedback['insert'] = "ERROR " . mysqli_error($connection);
                }
            }
        } else {
            $feedback['ttest'] = "ERROR " . mysqli_error($connection);
        }
        
        //get data from form into variables

        $p_pools = $_POST['points_pools'];
        $p_table = $_POST['points_table'];
        $nb_qualifiers = $_POST['nb_qualifier'];
        $nb_o_exemp_pool = $_POST['exempted_fencers_pools'];
        $nb_o_exemp_table = $_POST['exempted_fencers_table'];

        //not used yet!
        $fencing_3rd = $_POST['third_place'];
        $elim_type = $_POST['elimnation_type'];

        //updateing weapon_errors from array_real_issues
        $qry_update = "UPDATE $table_name SET p_pools = '$p_pools', p_table = '$p_table', nb_qualifiers = '$nb_qualifiers',nb_exemp_pool = '$nb_o_exemp_pool', nb_exemp_table = '$nb_o_exemp_table' "; 

        if ($do_qry_update = mysqli_query($connection, $qry_update)) {
            $feedback['update'] = "ok!";
        } else {
            $feedback['update'] = "ERROR " . mysqli_error($connection);
        }
        
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
                    <button name="submit_form" form="save_form" class="stripe_button orange" type="submit">
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
                            <input type="number" name="points_pools" placeholder="#" class="number_input centered" value="<?php echo $p_pools ?>">

                            <label for="points_table" >POINTS IN TABLE</label>
                            <input type="number" name="points_table" placeholder="#" class="number_input centered" value="<?php echo $p_table ?>">
                        
                            <label for="nb_qualifier" >NUMBER OF QUALIFIERS AFTER POOLS</label>
                            <input type="number" name="nb_qualifier" placeholder="#" class="number_input centered" value="<?php echo $nb_qualifiers ?>">

                            <label for="elimnation_type" >ELIMINATION TYPE</label>
                            <div class="option_container">
                                <input type="radio" name="elimnation_type" id="direct_et" value="1" checked/>
                                <label for="direct_et">Direct-Elimination Tournament</label>

                                <input type="radio" name="elimnation_type" id="double_et" value="" disabled/>
                                <label for="double_et">Double-Elimination Tournament</label>
                            </div>

                        </div>
                        <div class="form_column">
                            <label for="type_of_elimination">TYPE OF ELIMINTION</label>
                            <div class="option_container">
                                <input type="radio" name="type_of_elimination" id="one_phase_table" value=""/>
                                <label for="one_phase_table">One Phase Table</label>

                                <input type="radio" name="type_of_elimination" id="two_phase_table" value=""/>
                                <label for="two_phase_table">Two Phase Table</label>
                            </div>

                            <label for="third_place" >FENCING FOR 3RD PLACE</label>
                            <div class="option_container">
                                <input type="radio" name="third_place" id="third_place_yes" value="" disabled/>
                                <label for="third_place_no">Yes</label>

                                <input type="radio" name="third_place" id="third_place_no" value="" checked/>
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
