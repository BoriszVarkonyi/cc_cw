<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

    // array of all issues
    $array_issues = array( 
        "FIE mark on blade",
        "arm gap and weight",
        "arm lenght",
        "blade lenght",
        "Grip lenght",
        "Form and depthof the guard",
        "Guard oxydation/ deformation",
        "excentricity of the blade",
        "blade flexibility",
        "curve on the blade",
        "Foucault current device",
        "point and arm size",
        "spring of the point",
        "total travel of the point",
        "residual travel of the point",
        "isolation of the point",
        "resistance of the arm",
        "length/ condition of body/ mask wire",
        "resistance of body/ mask wire",
        "mask: FIE mark",
        "mask: condition and insulation",
        "mask: resistance (sabre, foil)",
        "metallic jacket condition",
        "metallic jacket resistance",
        "sabre glove/ overlay condition",
        "sabre glove/ overlay resistance",
        "glove condition",
        "jacket condition",
        "breeches condition",
        "under-plastron condition",
        "foil chest protector",
        "socks",
        "incorrect name printing",
        "incorrect national logo",
        "commercial",
        "other items",
    );

    //feedback array
    $feedback = array(
        "fencer_data" => "no",
        "create_table" => "no",
        "ttest" => "no",
        "update" => "no",
        "rtest" => "no",
        "insert" => "no",
        "get_wc_data" => "no",
    );

    $table_name = "wc_$comp_id";
    $fencer_id = $_GET['fencer_id'];
    $ranking_id = $_GET['rankid'];
    $array_real_issues = array();
    $issue = "did not set yet";
    $old_notes = "";

    //get fencer data with fencer_id from $table_name
    $qry_get_wc_data = "SELECT * FROM $table_name WHERE id = '$fencer_id'";
    $do_qry_get_wc_data = mysqli_query($connection, $qry_get_wc_data);

    if ($row = mysqli_fetch_assoc($do_qry_get_wc_data)) {
        $string_weapon_errors = $row['weapon_errors'];
        $array_weapon_errors = explode(",", $string_weapon_errors);
        $old_notes = $row['notes'];
        $feedback['get_cw_data'] = "ok!";
    } else {
        $feedback['get_cw_data'] = "ERROR " . mysqli_error($connection);
    }


    //get fencer data from wc_comp_id
    $qry_get_fencer_data = "SELECT * FROM rk_$ranking_id WHERE id = $fencer_id";
    $qry_get_fencer_data_do = mysqli_query($connection, $qry_get_fencer_data);

    if ($row = mysqli_fetch_assoc($qry_get_fencer_data_do)) {
        $feedback['fencer_data'] = "ok!";
        $fencer_name = $row['name'];
        $fencer_nat = $row['nationality'];
    } else {
        $feedback['fencer_data'] = "ERROR " . mysqli_error($connection);
    }
    


    if (isset($_POST['submit_wc'])) {

        //checking for dupli tables
        $check_d_table_qry = "SELECT COUNT(*)
                                FROM information_schema.tables 
                                WHERE table_schema = 'ccdatabase' 
                                AND table_name = '$table_name';";

        if ($check_d_table_do = mysqli_query($connection, $check_d_table_qry)) {

            $feedback['ttest'] = "ok!";

            if ($check_d_table_do == 0) {
                //creating weapon control  table
                $qry_creating_wc_table = "CREATE TABLE `ccdatabase`.$table_name (`id` INT(11) NOT NULL , 
                                                                                `name` VARCHAR(255) NOT NULL , 
                                                                                `nat` VARCHAR(255) NOT NULL , 
                                                                                `weapon_errors` VARCHAR(255) NOT NULL , 
                                                                                `notes` TEXT NOT NULL ) 
                                                                                ENGINE = InnoDB;";

                if ($do_qry_creating_table = mysqli_query($connection, $qry_creating_wc_table)) {
                    $feedback['create_table'] = "ok!";
                } else {
                    $feedback['create_table'] = "ERROR " . mysqli_error($connection);
                }
              
            }

        } else {
            $feedback['ttest'] = "ERROR " . mysqli_error($connection);
        }

        //get issues into a string
        for ($i = 0; $i < count($array_issues); $i++) {

            if ($_POST["issue_n_$i"] == "") {
               $issue = "0";
            } else {
                $issue = $_POST["issue_n_$i"];
            }
            
            $array_real_issues[$i] = $issue;
            
        }

        $string_real_issues = implode(",", $array_real_issues);

        //get notes from post
        $notes = $_POST['wc_notes'];


        //test for existing row
        $qry_rtest = "SELECT * FROM $table_name WHERE id = $fencer_id";
        $do_qry_rtest = mysqli_query($connection, $qry_rtest);
        $row_cnt = mysqli_num_rows($do_qry_rtest);

        if ($row_cnt == 0) {
            //insert new row into table_name
            $qry_insert = "INSERT INTO $table_name (id, name, nat, weapon_errors, notes) VALUE ('$fencer_id', '$fencer_name', '$fencer_nat', '$string_real_issues', '$notes')";
            if ($do_qry_insert = mysqli_query($connection, $qry_insert)) {
                $feedback['insert'] = "ok!";
            } else {
                $feedback['insert'] = "ERROR " . mysqli_error($connection);
            }

        } else {
            //updateing weapon_errors from array_real_issues
            $qry_update = "UPDATE $table_name SET name = '$fencer_name', nat = '$fencer_nat', weapon_errors = '$string_real_issues', notes = '$notes' WHERE id = '$fencer_id'"; 

            if ($do_qry_update = mysqli_query($connection, $qry_update)) {
                $feedback['update'] = "ok!";
            } else {
                $feedback['update'] = "ERROR " . mysqli_error($connection);
            }
        }

        header("Location: ../php/weapon_control.php?comp_id=$comp_id");
    }


    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fencer_name ?>'s weapon control</title>
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
                    <p class="page_title"><?php echo $fencer_name ?>'s weapon control</p>

                    <button name="submit_cancel" id="buttonstop" class="stripe_button" type="submit" onclick="location.href='weapon_control.php?comp_id=<?php echo $comp_id ?>'">
                        <p>Cancel</p>
                        <img src="../assets/icons/close-black-18dp.svg"></img>
                    </button>

                    <button name="submit_wc" class="stripe_button orange" type="submit" form="fencers_weapon_control_wrapper">
                        <p>Save weapon control</p>
                        <img src="../assets/icons/save-black-18dp.svg"></img>
                    </button>

                </div>
                <p><?php print_r($array_real_issues); echo "<br>"; print_r($feedback) ?></p>
                <div id="page_content_panel_main">
                    <form action="" id="fencers_weapon_control_wrapper" class="wrapper" method="POST">
                        <div id="issues_panel" class="table_row_wrapper">
                            <div class="table_header">
                                <div class="table_header_text">ISSUE</div>
                                <div class="table_header_text">QUANTITY</div>
                                <div class="big_status_header"></div>
                            </div>

                            <?php 
                                foreach ($array_issues as $issue) {

                                $issue_id = array_search($issue, $array_issues);

                            ?>

                            <div class="table_row">
                                <div class="table_item"><?php echo $issue ?></div>
                                <div class="table_item"><input value="<?php echo $array_weapon_errors[$issue_id] ?>" name="issue_n_<?php echo $issue_id ?>" type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_<?php echo $issue_id ?>" id="<?php echo $issue_id ?>" value=""/>
                                    <label for="<?php echo $issue_id ?>"></label>
                                </div>
                            </div>

                            <?php 
                                }
                            ?>

                        </div>
                        <div id="notes_panel">
                            <div class="table_header">
                                <div class="table_header_text title">NOTES</div>
                            </div>
                            <textarea name="wc_notes" id="wc_notes" placeholder="Type the notes here"><?php echo $old_notes ?></textarea>
                        </div>
                    </form>
                </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>