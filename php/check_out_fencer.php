<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php

    $fencer_id = $_GET['fencer_id'];

    //get name of fencer
    $qry_get_name = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_name = mysqli_query($connection, $qry_get_name);
    if ($row = mysqli_fetch_assoc($do_get_name)) {
        $compet_string = $row['data'];
        $compet_table = json_decode($compet_string);

        if ($id_to_find = findObject($compet_table, $fencer_id, "id") !== false) {
            $name = $compet_table[$id_to_find] -> prenom . " " . $compet_table[$id_to_find] -> nom;
        } else {
            $name = $id_to_find;
        }
    } else {
        $name = mysqli_error($connection);
    }

    //get weapon control from db
    $qry_get_wc = "SELECT data FROM weapon_control WHERE assoc_comp_id = '$comp_id'";
    $do_get_wc = mysqli_query($connection, $qry_get_wc);

    if ($row = mysqli_fetch_assoc($do_get_wc)) {
        $wc_string = $row['data'];
        $wc_table = json_decode($wc_string);

        //get data from db
        $array_of_issues = $wc_table -> $fencer_id -> array_of_issues;
        $issue_names = array(
            "FIE mark on blade",
            "Arm gap and weight",
            "Arm lenght",
            "Blade lenght",
            "Grip lenght",
            "Form and depth of the guard",
            "Guard oxydation/ deformation",
            "Excentricity of the blade",
            "Blade flexibility",
            "Curve on the blade",
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
        $equipment_sent_in = $wc_table -> $fencer_id -> equipment;
        $equipment_name = ["Epee","Foil","Sabre","Electric Jacket","Plastron","Under-Plastron","Socks","Mask","Gloves","Bodywire","Maskwire","Chest protector","Metallic glove"];
        $note = $wc_table -> $fencer_id -> notes;
    } else {
        echo mysqli_error($connection);
    }

    if (isset($_POST['submit_check_out'])) {
        //change db
        $wc_table -> $fencer_id -> checked_out = true;
        $wc_string = json_encode($wc_table, JSON_UNESCAPED_UNICODE);

        $qry_update = "UPDATE weapon_control SET data = '$wc_string' WHERE assoc_comp_id = '$comp_id'";
        $do_update = mysqli_query($connection, $qry_update);

        header("Location: ../php/weapon_control_administrated.php?comp_id=$comp_id");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check out <?php echo $name ?></title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_check_out_fencer_style.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Check out <?php echo $name ?></p>
                <form method="POST" action="" id="check_out" class="stripe_button_wrapper">
                    <button name="" id="" class="stripe_button" shortcut="SHIFT+P" onclick="printPage()">
                        <p>Print Check Out</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                    <button name="submit_check_out" id="asd" class="stripe_button primary" type="submit" shortcut="SHIFT+S">
                        <p>Check Out Fencer</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </form>
                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg"/>
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg"/>
                    </button>
                </div>
                <div class="view_button_wrapper fourth">
                    <button onclick="viewButton(this)" id="panelViewButton">
                        <img src="../assets/icons/view_grid_black.svg"/>
                    </button>
                    <button onclick="viewButton(this)" id="printViewButton">
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main" class="scroll">
                <div class="wrapper">
                    <div class="db_panel other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/backpack_black.svg"/>
                            Contents of Fencer's bag
                        </div>
                        <div class="db_panel_main">
                            <div class="table no_interaction">
                                <div class="table_header">
                                    <div class="table_header_text">ISSUE</div>
                                    <div class="table_header_text">QUANTITY</div>
                                </div>
                                <div class="table_row_wrapper alt">
                                    <?php
                                        foreach($equipment_sent_in as $key => $value) {

                                            if ($value != 0) {

                                                $eq_name = $equipment_name[$key];
                                    ?>
                                                <div class="table_row">
                                                    <div class="table_item"><p><?php echo $eq_name ?></p></div>
                                                    <div class="table_item"><p><?php echo $value ?></p></div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="db_panel other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/report_problem_black.svg"/>
                            Issues of Fencers's equipment
                        </div>
                        <div class="db_panel_main">
                            <div class="table no_interaction">
                                <div class="table_header">
                                    <div class="table_header_text">ISSUE</div>
                                    <div class="table_header_text">QUANTITY</div>
                                </div>
                                <div class="table_row_wrapper alt">
                                    <?php
                                        foreach ($array_of_issues as $key => $issue_count) {
                                            if ($issue_count != 0) {

                                                $issue_name = $issue_names[$key];

                                    ?>
                                    <div class="table_row">
                                        <div class="table_item"><p><?php echo $issue_name ?></p></div>
                                        <div class="table_item"><p><?php echo $issue_count ?></p></div>
                                    </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="db_panel other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/notes_black.svg"/>
                            Notes of Fencers's equipment
                        </div>
                        <div class="db_panel_main">
                            <div class="notes_wrapper">
                                <p><?php echo $note ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                //get comp_data for printing
                $qry_get_comp_data = "SELECT * FROM `competitions` WHERE `comp_id` = '$comp_id'";
                $do_get_comp_data = mysqli_query($connection, $qry_get_comp_data);

                if ($row = mysqli_fetch_assoc($do_get_comp_data)) {
                    $sex = $row['comp_sex'];
                    $w_type = $row['comp_weapon'];
                }

                //from basic info
                $qry_get_bi = "SELECT data FROM basic_info WHERE assoc_comp_id = '$comp_id'";
                $do_get_bi = mysqli_query($connection, $qry_get_bi);

                if ($row = mysqli_fetch_assoc($do_get_bi)) {
                    $json_string = $row['data'];
                    $json_table = json_decode($json_string);
                    $start_time = $json_table -> starting_date;
                } else {
                    $start_time = "start time: Not defined!";
                }
                ?>
                <div class="paper_wrapper hidden">
                    <div class="paper">
                        <div class="title_container">
                            <div><p class="title"><?php echo $name ?>'S CHECKING OUT CERTIFICATE</p></div>
                            <div class="comp_info small">
                                <p class="info_label"><?php echo $comp_name ?></p>
                                <div>
                                    <p><?php echo sexConverter($sex) ?></p>
                                    <p><?php echo weaponConverter($w_type) ?></p>
                                </div>
                                <p><?php echo $start_time ?></p>
                            </div>
                        </div>
                        <div class="paper_content">
                            <div class="bag_content">
                                <p class="label">BAG CONTENT</p>
                                <div class="grid_table">
                                    <div class="grid_header">
                                        <div class="grid_header_text">EQIPMENT</div>
                                        <div class="grid_header_text">QUANTITY</div>
                                    </div>
                                    <div class="grid_row_wrapper">

                                        <?php

                                            foreach($equipment_sent_in as $key => $value) {

                                                if ($value != 0) {

                                                    $eq_name = $equipment_name[$key];
                                        ?>

                                        <div class="grid_row">
                                            <div class="grid_item"><?php echo $eq_name ?></div>
                                            <div class="grid_item"><?php echo $value ?></div>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="issues">
                                <p class="label">REPORTED ISSUES</p>
                                <div class="grid_table">
                                    <div class="grid_header">
                                        <div class="grid_header_text">ISSUE</div>
                                        <div class="grid_header_text">QUANTITY</div>
                                    </div>
                                    <div class="grid_row_wrapper">
                                        <?php
                                            foreach ($array_of_issues as $key => $issue_count) {
                                                if ($issue_count != 0) {

                                                    $issue_name = $issue_names[$key];
                                        ?>
                                        <div class="grid_row">
                                            <div class="grid_item"><?php echo $issue_name ?></div>
                                            <div class="grid_item"><?php echo $issue_count ?></div>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="notes">
                                <p class="label">NOTES</p>
                                <div>
                                    <p><?php echo $note ?></p>
                                </div>
                            </div>
                            <div class="signatures">
                                <p class="label">SIGNATURES</p>
                                <div class="grid_table">
                                        <div class="grid_header">
                                            <div class="grid_header_text">NAME</div>
                                            <div class="grid_header_text signature">SIGNATURE</div>
                                        </div>
                                        <div class="grid_row_wrapper">
                                            <div class="grid_row">
                                                <div class="grid_item"><?php echo $name ?></div>
                                                <div class="grid_item signature"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/print.js"></script>
<script src="../js/check_fencer.js"></script>
</body>
</html>