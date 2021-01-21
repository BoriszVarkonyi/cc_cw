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
    <title>Weapon Control</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <form id="title_stripe" method="POST" action="" >
                    <p class="page_title">Administrated Weapon Control</p>
                    <div class="stripe_button_wrapper">
                        <a class="stripe_button blue" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id; ?>">
                            <p>Weapon Control Statistics</p>
                            <img src="../assets/icons/pie_chart-black-18dp.svg"/>
                        </a>
                        <button class="stripe_button disabled" id="sendMessageButton" type="submit">
                            <p>Message Fencer</p>
                            <img src="../assets/icons/chat-black-18dp.svg"/>
                        </button>
                        <button name="add_wc" class="stripe_button orange" id="wcButton" type="submit">
                            <p>Add weapon control</p>
                            <img src="../assets/icons/add-black-18dp.svg"/> <!-- This should change to ../assets/icons/edit-black-18dp.svg if the fencer already has weapon control-->
                        </button>
                    </div>
                    <input type="text" class="hidden selected_list_item_input" name="fencer_id" id="fencer_id_input" value="">
                    <div class="search_wrapper">
                        <button type="button" class="clear_search_button"><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search cc">
                        <div class="search_results">
                        <?php
                        $query = "SELECT * FROM cptrs_$comp_id";
                        $query_do = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($query_do)){
                            $idke = $row["id"];
                            $nevecske = $row["name"];
                            ?>
                            <a id="<?php echo $idke ?>A" href="#<?php echo $idke ?>" onclick="selectSearch(this), autoFill(this)" tabindex="1"><?php echo $nevecske ?></a>
                            <?php
                        }
                            ?>
                        </div>
                    </div>
                </form>
                <div id="page_content_panel_main">
                    <div class="wrapper table">
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <button class="resizer"></button>
                            <div class="table_header_text">NATION / CLUB</div>
                            <button class="resizer"></button>
                            <div class="table_header_text">STATUS</div>
                            <div class="big_status_header"></div>
                        </div>
                        <div class="table_row_wrapper">
                        <?php

                            //get weapon type, comp sex from competitions
                            $qry_get_comp_data = "SELECT * FROM competitions WHERE comp_id = $comp_id";

                            $qry_get_comp_data_do = mysqli_query($connection, $qry_get_comp_data);

                            if ($row = mysqli_fetch_assoc($qry_get_comp_data_do)) {
                                $comp_sex = sexConverter($row['comp_sex']);
                                $comp_weapon = weaponConverter($row['comp_weapon']);
                                $feedback['getcompdata'] = "ok!";
                            } else {
                                $feedback['getcompdata'] = "ERROR " . mysqli_error($connection);
                            }
                            
                            //get fencers from competitors by comp id :D
                            $qry_get_fencers = "SELECT * FROM cptrs_$comp_id";

                            $qry_get_fencers_do = mysqli_query($connection, $qry_get_fencers);

                            while ($row = mysqli_fetch_assoc($qry_get_fencers_do)) {
                                $feedback['getfencers'] = "ok!";

                                $fencer_name = $row['name'];
                                $fencer_id = $row['id'];
                                $fencer_nat = $row['nationality'];

                                //test for wc
                                $qry_get_wc_data = "SELECT * FROM `wc_$comp_id` WHERE id = '$fencer_id'";
                                $do_get_wc_data = mysqli_query($connection, $qry_get_wc_data);
                                $num_rows = mysqli_num_rows($do_get_wc_data);

                                if ($num_rows == 1) {
                                    $wc_test_style = "green";
                                    $wc_test = "Ready";
                                } else {
                                    $wc_test_style = "red";
                                    $wc_test = "Not ready";
                                }
                        ?>
                        <!-- while -->
                        <div class="table_row" onclick="selectRow(this)" id="<?php echo $fencer_id ?>" tabindex="0">
                            <div class="table_item"><p><?php echo $fencer_name ?></p></div>
                            <div class="table_item"><p><?php echo $fencer_nat ?></p></div>
                            <div class="table_item"><p><?php echo $wc_test ?></p></div>
                            <div class="big_status_item <?php echo $wc_test_style ?>"></div> <!-- red or green style added to small_status item to inidcate status -->
                        </div>
                        <?php
                            }
                        ?>
                        </div>
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