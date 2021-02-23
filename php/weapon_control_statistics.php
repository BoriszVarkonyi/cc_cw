<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    $table_name = "wc_$comp_id";
    //feedback
    $feedback = array(
        "getrankid" => "no",
        "getfencers" => "no",
        "getcompdata" => "no"
    );


    //get ranking id by comp_id
    $qry_getrankid = "SELECT * FROM ranking WHERE ass_comp_id = $comp_id";

    $qry_getrankid_do = mysqli_query($connection, $qry_getrankid);
    if ($row = mysqli_fetch_assoc($qry_getrankid_do)) {
        $feedback['getrankid'] = "ok!";
        $ranking_id = $row['id'];
    } else {
        $feedback['getrankid'] = "ERROR " . mysqli_error($connection);
    }

    if (isset($_POST['add_wc'])) {
        $fencer_id = $_POST['fencer_id'];
        header("Location: ../php/fencers_weapon_control.php?comp_id=$comp_id&fencer_id=$fencer_id&rankid=$ranking_id");
    }

    //checking for dupli tables
    $check_d_table_qry = "SELECT COUNT(*)
    FROM information_schema.tables
    WHERE table_schema = 'ccdatabase'
    AND table_name = '$table_name';";

    if ($check_d_table_do = mysqli_query($connection, $check_d_table_qry)) {
        $num_rows = mysqli_num_rows($check_d_table_do);
        $feedback['ttest'] = "ok!";

        if ($num_rows != 0) {
            //creating weapon control  table
            $qry_creating_wc_table = "CREATE TABLE `ccdatabase`. $table_name (`id` VARCHAR(11) NOT NULL ,
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

        } else {
            $feedback['misc'] = "ERROR valami szar van a palacsintaban" . $num_rows;
        }

    } else {
        $feedback['ttest'] = "ERROR " . mysqli_error($connection);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weapon Control Statistics</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <form id="title_stripe" method="POST" action="">
                    <p class="page_title">Weapon Control Statistics</p>
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button primary" type="button">
                            <p>Print Statistics</p>
                            <img src="../assets/icons/print-black-18dp.svg"/>
                        </button>
                    </div>
                </form>
                <div id="page_content_panel_main">
                    <div class="wrapper">
                    </div>
                </div>
            </div>
        </div>
    <script src="../js/main.js"></script>
    <script src="../js/weapon_control.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    </body>
</html>