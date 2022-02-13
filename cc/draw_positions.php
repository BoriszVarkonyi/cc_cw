<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

if (isset($_POST["save_draw"])) {

    $rawdata = $_POST["data"];
    $dataobj = json_decode($rawdata);
    $table = $_GET["draw_table"];

    //print_r($dataobj);

    $qry_check_row = "SELECT * FROM tables WHERE ass_comp_id = '$comp_id'";
    $do_check_row = mysqli_query($connection, $qry_check_row);
    if ($row = mysqli_fetch_assoc($do_check_row)) {
        $json_string = $row['data'];
        $numofteams = $row['fencer_num'];
        $json_team_table = json_decode($json_string);
    }

    if ($table == "r1" || $table == "r2" || $table == "r3") {

        //Only rounds r1, r2, and r3 are supported

        foreach ($json_team_table->$table as $tables) {
            foreach ($tables as $key => $matches) {
                foreach ($matches as $dkey => $dunno) {

                    if ($dkey == "referees" || $dkey == "pistetime") {
                        continue;
                    }

                    //Inner search start
                    foreach ($dataobj as $key => $val) {
                        foreach ($val as $row) {
                            foreach ($row as $seckey => $secval) {
                                //print_r($seckey . "-->" . $secval);

                                if ($secval != "" && $dunno->id == $seckey) {

                                    $dunno->draws->$table = $secval;
                                }
                            }
                        }
                    }
                    //Inner search end

                }
            }
        }
        //Check if prog works without uploading to db
        //print_r(json_encode($json_team_table, JSON_UNESCAPED_UNICODE));
    } else {

        //16 or bigger tables

        foreach ($json_team_table->$table as $mkey => $matches) {
            foreach ($matches as $dkey => $dunno) {

                if ($dkey == "referees" || $dkey == "pistetime") {
                    continue;
                }

                //Inner search start
                foreach ($dataobj as $key => $val) {
                    foreach ($val as $row) {
                        foreach ($row as $seckey => $secval) {
                            //print_r($seckey . "-->" . $secval);

                            if ($dunno !== null && $secval !== "" && $dunno->id == $seckey) {

                                $dunno->draws->$table = $secval;
                                //Checks how many times it ran down
                                //echo "CHECK";
                            }
                        }
                    }
                }
                //Inner search end

            }
        }

        //Check if prog works without uploading to db
        //print_r(json_encode($json_team_table, JSON_UNESCAPED_UNICODE));
    }


    //Upload modified table file to database
    //Encode to json
    $table_upload = json_encode($json_team_table, JSON_UNESCAPED_UNICODE);

    //upload query to database
    $qry_upload_table = "UPDATE tables SET data = '$table_upload' WHERE ass_comp_id = $comp_id";
    $qry_upload_table_do = mysqli_query($connection, $qry_upload_table);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Draw Positions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Draw Positions</p>
                <div class="stripe_button_wrapper">
                    <form action="" method="POST" id="IDE KELL A FORM IDJE">
                        <input type="text" class="selected_list_item_input hidden" name="selected_id" readonly>
                    </form>

                    <a class="stripe_button bold" href="team_order_reports.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Team Order Reports</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg" />
                    </a>
                </div>

            </div>
            <div id="page_content_panel_main">

                <div class="wrapper" id="team_order_report_panel">
                    <div id="team_order_report_header">

                        <?php

                        $qry_check_row = "SELECT * FROM tables WHERE ass_comp_id = '$comp_id'";
                        $do_check_row = mysqli_query($connection, $qry_check_row);
                        if ($row = mysqli_fetch_assoc($do_check_row)) {
                            $json_string = $row['data'];
                            $numofteams = $row['fencer_num'];
                            $json_team_table = json_decode($json_string);
                        }

                        foreach ($json_team_table as $key => $round) {

                            if ($key == "r1" || $key == "r2" || $key == "r3") {
                                continue;
                            }

                        ?>

                            <a class="team_order_report_select green" href="draw_positions.php?comp_id=<?php echo $comp_id ?>&draw_table=<?php echo $key ?>">
                                <p><?php echo $key ?></p>
                            </a>

                            <?php
                        }

                        $rightorder = ["r1", "r2", "r3"];

                        foreach ($rightorder as $key => $round) {

                            if (isset($json_team_table->$round)) {

                            ?>

                                <a class="team_order_report_select current" href="draw_positions.php?comp_id=<?php echo $comp_id ?>&draw_table=<?php echo $round ?>">
                                    <p><?php echo $round; ?></p>
                                </a>

                        <?php
                            }
                        }
                        ?>

                    </div>
                    <form action="" method="post" id="team_positions_wrapper">

                        <?php

                        if (!isset($_GET['draw_table'])) {

                            //DISPLAY EMPTY SPACE

                        } else {

                            $draw_table_id = $_GET['draw_table'];



                        ?>



                            <div id="t32" class="team_positions">
                                <div class="rounds_container">
                                    <p class="round_text"><span><?php echo $draw_table_id; ?></span></p>
                                </div>

                                <div class="positions_button_wrapper">
                                    <button class="draw_button" type="button" id="draw_positions_button" onclick="drawPositions()">Draw</button>
                                    <button class="save_draw_positions hidden" name="save_draw" id="save_positions_button" type="submit">Save</button>
                                </div>
                                <div class="positions_wrapper">

                                    <?php

                                    $teamsInDraw = [];

                                    if ($draw_table_id == "r1" || $draw_table_id == "r2" || $draw_table_id == "r3") {

                                        foreach ($json_team_table->$draw_table_id as $tables) {
                                            foreach ($tables as $numkey => $matches) {
                                                $matchbox[$numkey] = [];

                                    ?>
                                                <div class="positions_grid">

                                                    <?php

                                                    foreach ($matches as $mkey => $teamvalue) {

                                                        if ($mkey == "referees" || $mkey == "pistetime") {
                                                            continue;
                                                        }
                                                        if (!isset($teamvalue->id)) {
                                                            $teamvalue->id = "";
                                                        }

                                                        $matchbox[$numkey][$teamvalue->id] = "";

                                                    ?>
                                                        <div><?php print_r($teamvalue->id) ?></div>
                                                        <div>?</div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            <?php

                                            }
                                            array_push($teamsInDraw, $matchbox);
                                        }
                                    } else {

                                        foreach ($json_team_table->$draw_table_id as $tkey => $tables) {
                                            $matchbox[$tkey] = [];
                                            ?>
                                            <div class="positions_grid">

                                                <?php
                                                foreach ($tables as $mkey => $matchvalue) {

                                                    if ($mkey == "referees" || $mkey == "pistetime") {
                                                        continue;
                                                    }
                                                    if (!isset($matchvalue->id)) {
                                                        $matchbox[$tkey][""] = "";
                                                    } else {
                                                        $matchbox[$tkey][$matchvalue->id] = "";
                                                    }



                                                ?>

                                                    <div><?php print_r($print = (isset($matchvalue->id)) ? $matchvalue->id : "") ?></div>
                                                    <div>?</div>

                                                <?php
                                                }

                                                ?>
                                            </div>
                                    <?php

                                        }
                                        array_push($teamsInDraw, $matchbox);
                                    }


                                    ?>

                                    <input type="text" name="data" value='<?php print_r(json_encode($teamsInDraw, JSON_UNESCAPED_UNICODE)) ?>'>

                                </div>

                            </div>

                        <?php

                        }
                        //close check if else statement

                        ?>

                    </form>
                </div>

            </div>
    </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/controls.js"></script>
    <script src="javascript/draw_positions.js"></script>
</body>

</html>