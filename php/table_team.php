<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php include '../includes/sortfunction.php' ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
//error_reporting(E_ERROR | E_PARSE);

if (isset($_POST["generate_table"])) {

    $qry_check_row = "SELECT data FROM teams WHERE assoc_comp_id = '$comp_id'";
    $do_check_row = mysqli_query($connection, $qry_check_row);
    if ($row = mysqli_fetch_assoc($do_check_row)) {
        $json_string = $row['data'];
        $json_teams = json_decode($json_string);
    }

    $teams_array = [];

    foreach ($json_teams as $value) {
        array_push($teams_array, $value);
    }

    //If sorted by classement in formula

    $objects = new ObjSorter($teams_array, 'classement');

    $objects_array  = $objects->sorted;

    //print_r($objects_array);

    //---------------------------------------------------
    //Else other sort fuction by fencer performance

    $r1 = ["1-8", "9-16"];
    $r2 = ["1-4", "5-8", "9-12", "13-16"];
    $r3 = ["1-2", "3-4", "5-6", "7-8", "9-10", "11-12", "13-14", "15-16"];

    $teamnum = count($objects_array);

    echo $teamnum;

    $team_table = new stdClass;

    $tables = [1, 2, 4, 8, 16, 32, 64, 128, 256, 512, 1024];

    foreach ($tables as $x) {

        if ($x >= $teamnum) {
            $tablesize = $x;
            break;
        }
    }

    echo "NEEDED TABLE: " . $tablesize;

    if ($teamnum <= 2) {

        for ($i = 0; $i < $teamnum; $i++) {

            $numarray = tableArrays(2);

            $instring = $r3[0];
            $numinstr = $numarray[$i];

            $team_table->r3->$instring->m_1->$numinstr = $objects_array[$numinstr];
            $team_table->r3->$instring->m_1->referees->ref1 = new stdClass;
            $team_table->r3->$instring->m_1->referees->ref2 = new stdClass;
            $team_table->r3->$instring->m_1->pistetime->pistename = "";
            $team_table->r3->$instring->m_1->pistetime->time = "";
        }
    } elseif ($teamnum <= 4) {

        $changer = 0;

        $revi = 0;

        for ($i = 0; $i < 4; $i++) {

            $numarray = tableArrays(2);

            if ($i == 2 || $i == 4) {
                $changer++;
            }
            if ($i == 2) {
                $revi = 0;
            }

            $instring = $r3[$changer];
            $numinstr = $numarray[$revi];

            $team_table->r3->$instring->m_1->$numinstr = new stdClass;
            $team_table->r3->$instring->m_1->referees->ref1 = new stdClass;
            $team_table->r3->$instring->m_1->referees->ref2 = new stdClass;
            $team_table->r3->$instring->m_1->pistetime->pistename = "";
            $team_table->r3->$instring->m_1->pistetime->time = "";

            echo $revi += 1;
        }
        $changer = 1;
        for ($i = 0; $i < 4; $i++) {

            $numarray = tableArrays(4);

            if ($i == 2) {
                $changer++;
            }

            $instring = $r2[0];
            $numinstr = $numarray[$i];
            $matchstring = "m_" . $changer;

            if (isset($objects_array[$numinstr - 1])) {
                $team_table->r2->$instring->$matchstring->$numinstr = $objects_array[$numinstr - 1];
            } else {
                $team_table->r2->$instring->$matchstring->$numinstr = new stdClass;
            }
            $team_table->r2->$instring->$matchstring->referees->ref1 = new stdClass;
            $team_table->r2->$instring->$matchstring->referees->ref2 = new stdClass;
            $team_table->r2->$instring->$matchstring->pistetime->pistename = "";
            $team_table->r2->$instring->$matchstring->pistetime->time = "";
        }
    } elseif ($teamnum <= 8) {

        $changer = 0;

        $revi = 0;

        for ($i = 0; $i < 8; $i++) {

            $numarray = tableArrays(2);

            if ($i == 2 || $i == 4 || $i == 6 || $i == 8) {
                $changer++;
                $revi = 0;
            }

            $instring = $r3[$changer];
            $numinstr = $numarray[$revi];

            $team_table->r3->$instring->m_1->$numinstr = new stdClass;
            $team_table->r3->$instring->m_1->referees->ref1 = new stdClass;
            $team_table->r3->$instring->m_1->referees->ref2 = new stdClass;
            $team_table->r3->$instring->m_1->pistetime->pistename = "";
            $team_table->r3->$instring->m_1->pistetime->time = "";

            echo $revi += 1;
        }
        $changer = 1;
        $revi = 0;
        $phase = 0;
        for ($i = 0; $i < 8; $i++) {

            $numarray = tableArrays(4);

            if ($i == 2 || $i == 4 || $i == 6 || $i == 8) {
                $changer++;
            }
            if ($i == 4) {
                $revi = 0;
                $phase++;
                $changer = 1;
            }

            $instring = $r2[$phase];
            $numinstr = $numarray[$revi];
            $matchstring = "m_" . $changer;

            $team_table->r2->$instring->$matchstring->$numinstr = new stdClass;
            $team_table->r2->$instring->$matchstring->referees->ref1 = new stdClass;
            $team_table->r2->$instring->$matchstring->referees->ref2 = new stdClass;
            $team_table->r2->$instring->$matchstring->pistetime->pistename = "";
            $team_table->r2->$instring->$matchstring->pistetime->time = "";

            $revi++;
        }
        $changer = 1;
        for ($i = 0; $i < 8; $i++) {

            $numarray = tableArrays(8);

            if ($i == 2 || $i == 4 || $i == 6 || $i == 8) {
                $changer++;
            }

            $instring = $r1[0];
            $numinstr = $numarray[$i];
            $matchstring = "m_" . $changer;

            if (isset($objects_array[$numinstr - 1])) {
                $team_table->r1->$instring->$matchstring->$numinstr = $objects_array[$numinstr - 1];
            } else {
                $team_table->r1->$instring->$matchstring->$numinstr = new stdClass;
            }
            $team_table->r1->$instring->$matchstring->referees->ref1 = new stdClass;
            $team_table->r1->$instring->$matchstring->referees->ref2 = new stdClass;
            $team_table->r1->$instring->$matchstring->pistetime->pistename = "";
            $team_table->r1->$instring->$matchstring->pistetime->time = "";
        }
    } else {

        $changer = 0;
        $revi = 0;

        for ($i = 0; $i < 16; $i++) {

            $numarray = tableArrays(2);

            if ($i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10 || $i == 12 || $i == 14 || $i == 16) {
                $changer++;
                $revi = 0;
            }

            $instring = $r3[$changer];
            $numinstr = $numarray[$revi];

            $team_table->r3->$instring->m_1->$numinstr = new stdClass;
            $team_table->r3->$instring->m_1->referees->ref1 = new stdClass;
            $team_table->r3->$instring->m_1->referees->ref2 = new stdClass;
            $team_table->r3->$instring->m_1->pistetime->pistename = "";
            $team_table->r3->$instring->m_1->pistetime->time = "";

            echo $revi += 1;
        }
        $changer = 1;
        $revi = 0;
        $phase = 0;
        for ($i = 0; $i < 16; $i++) {

            $numarray = tableArrays(4);

            if ($i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10 || $i == 12 || $i == 14 || $i == 16) {
                $changer++;
            }
            if ($i == 4 || $i == 8 || $i == 12 || $i == 16) {
                $revi = 0;
                $phase++;
                $changer = 1;
            }

            $instring = $r2[$phase];
            $numinstr = $numarray[$revi];
            $matchstring = "m_" . $changer;

            $team_table->r2->$instring->$matchstring->$numinstr = new stdClass;
            $team_table->r2->$instring->$matchstring->referees->ref1 = new stdClass;
            $team_table->r2->$instring->$matchstring->referees->ref2 = new stdClass;
            $team_table->r2->$instring->$matchstring->pistetime->pistename = "";
            $team_table->r2->$instring->$matchstring->pistetime->time = "";

            $revi++;
        }
        $changer = 1;
        $revi = 0;
        $phase = 0;
        for ($i = 0; $i < 16; $i++) {

            $numarray = tableArrays(8);

            if ($i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10 || $i == 12 || $i == 14 || $i == 16) {
                $changer++;
            }
            if ($i == 8 || $i == 16) {
                $revi = 0;
                $phase++;
                $changer = 1;
            }

            $instring = $r1[$phase];
            $numinstr = $numarray[$revi];
            $matchstring = "m_" . $changer;

            $team_table->r1->$instring->$matchstring->$numinstr = new stdClass;
            $team_table->r1->$instring->$matchstring->referees->ref1 = new stdClass;
            $team_table->r1->$instring->$matchstring->referees->ref2 = new stdClass;
            $team_table->r1->$instring->$matchstring->pistetime->pistename = "";
            $team_table->r1->$instring->$matchstring->pistetime->time = "";

            $revi++;
        }
        $original_tablesize = $tablesize;
        while ($tablesize >= 16) {

            $tablename = "t_" . $tablesize;
            $numarray = tableArrays($tablesize);
            $matchcounter = 1;
            for ($i = 0; $i < $tablesize; $i++) {
                $numinstr = $numarray[$i];
                $ch = $i % 2;
                if ($i != 0 && $ch == 0) {
                    $matchcounter++;
                }
                $matchstring = "m_" . $matchcounter;

                if ($tablesize == $original_tablesize) {
                    $team_table->$tablename->$matchstring->$numinstr = $objects_array[$numinstr - 1];
                } else {
                    $team_table->$tablename->$matchstring->$numinstr = new stdClass;
                }

                $team_table->$tablename->$matchstring->referees->ref1 = new stdClass;
                $team_table->$tablename->$matchstring->referees->ref2 = new stdClass;
                $team_table->$tablename->$matchstring->pistetime->pistename = "";
                $team_table->$tablename->$matchstring->pistetime->time = "";
            }

            $tablesize /= 2;
        }
    }

    $toupload = json_encode($team_table, JSON_UNESCAPED_UNICODE);

    $insert_table_query = "INSERT INTO tables(`ass_comp_id`, `fencer_num`, `type`, `data`) VALUES ($comp_id,$teamnum,1,'$toupload')";
    $insert_table_query_do = mysqli_query($connection, $insert_table_query);

    $myfile = fopen("testfile.txt", "w");
    fwrite($myfile, $toupload);
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/table_style.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_table_style.min.css" media="print">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Team Table</p>

                <!-- HA NINCS MÉG TÁBLA -->
                <form class="stripe_button_wrapper" id="generate_table" method="POST" action="">
                    <button class="stripe_button primary" type="submit" name="generate_table" form="generate_table" onclick="document.cookie = 'index1=0'; document.cookie = 'index2=0'; document.cookie = 'index3=0'">
                        <p>Generate Table</p>
                        <img src="../assets/icons/add_box_black.svg" />
                    </button>
                </form>

                <!--HA VAN -->
                <div class="stripe_button_wrapper">
                    <button class="stripe_button bold" type="button" onclick="printTable()">
                        <p>Print Table</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                    <a class="stripe_button bold" href="print_match_reports.php?comp_id=<?php echo $comp_id ?>" target="_blank">
                        <p>Print Match Reports</p>
                        <img src="../assets/icons/print_black.svg" />
                    </a>
                    <button class="stripe_button bold" type="button" onclick="toggleResetTable()">
                        <p>Reset Table</p>
                        <img src="../assets/icons/restart_alt_black.svg" />
                    </button>
                    <a class="stripe_button primary" type="button" href="table_pistes_and_time_team.php?comp_id=<?php echo $comp_id ?>">
                        <p>Pistes & Time</p>
                        <img src="../assets/icons/ballot_black.svg" />
                    </a>
                    <a class="stripe_button primary" type="button" href="table_referees_team.php?comp_id=<?php echo $comp_id ?>">
                        <p>Referees</p>
                        <img src="../assets/icons/ballot_black.svg" />
                    </a>
                    <a class="stripe_button primary" type="button" href="draw_positions.php?comp_id=<?php echo $comp_id ?>">
                        <p>Draw Positions</p>
                        <img src="../assets/icons/ballot_black.svg" />
                    </a>
                    <form id="barcode_form" method="POST" action="">
                        <button type="button" class="barcode_button" onclick="toggleBarCodeButton(this)">
                            <img src="../assets/icons/barcode_black.svg">
                        </button>
                        <input type="text" name="barcode" class="barcode_input" placeholder="Barcode" onfocus="toggleBarCodeInput(this)" onblur="toggleBarCodeInput(this)">
                        <button type="submit" form="barcode_form"></button>
                    </form>
                </div>

                <div class="view_button_wrapper first">
                    <button onclick="tableZoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg" />
                    </button>
                    <button onclick="tableZoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg" />
                    </button>
                </div>

                <div class="view_button_wrapper second">
                    <button onclick="toggleThisPanel(this)" id="">
                        <img src="../assets/icons/list_alt_black.svg" />
                    </button>
                </div>

                <div class="view_panel second hidden" id="view_panel_1">
                    <div class="color_legend">
                        <div class="green">Finished</div>
                        <div class="yellow">Ongoing</div>
                        <div class="red">Haven't started</div>
                    </div>
                </div>

                <div class="view_button_wrapper third">
                    <button onclick="toggleThisPanel(this)" id="">
                        <img src="../assets/icons/settings_black.svg" />
                    </button>
                </div>

                <div class="view_panel third hidden" id="view_panel_2">
                    <label for="">DISPLAY FENCERS'</label>
                    <div class="option_container">
                        <input type="checkbox" name="fencer_type" id="club" value="1" />
                        <label for="club">Club</label>
                    </div>
                </div>

                <div id="reset_table_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggleResetTable()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form class="overlay_panel_form" autocomplete="off" action="" method="POST" id="" autocomplete="off">
                        <label for="name">SELECT TABLE</label>
                        <div id="table_select_wrapper">
                            <div class="search_wrapper wide">
                                <button type="button" class="search select altalt" onfocus="isOpen(this)" onblur="isClosed(this)">
                                    <!-- Ebbe az inputba rakódik a kiválasztott tábla -->
                                    <input type="text" readonly z-index="-1" name="" placeholder="Select a Table" value="" onchange="test()">
                                </button>
                                <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                                <div class="search_results">
                                    <button type="button" onclick="selectSystem(this), formvariableDeclaration()">Table of 32</button>
                                    <button type="button" onclick="selectSystem(this), formvariableDeclaration()">Table of 16</button>
                                    <button type="button" onclick="selectSystem(this), formvariableDeclaration()">Table of 8</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="" class="panel_submit">Reset</button>
                    </form>
                </div>
            </div>
            <div id="page_content_panel_main">

                <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                    <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                </div>
                <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                    <img src="../assets/icons/arrow_forward_ios_black.svg">
                </div>


                <!-- HA NINCS
                    <div id="empty_content_notice">
                        <p>You have no table generated!</p>
                    </div>
                    -->
                <!-- HA van -->

                <?php

                $qry_check_row = "SELECT * FROM tables WHERE ass_comp_id = '$comp_id'";
                $do_check_row = mysqli_query($connection, $qry_check_row);
                if ($row = mysqli_fetch_assoc($do_check_row)) {
                    $json_string = $row['data'];
                    $numofteams = $row['fencer_num'];
                    $json_team_table = json_decode($json_string);
                }

                if (mysqli_num_rows($do_check_row) != 0) {


                    echo "ANYÁD: " . $numofteams;

                    $tabletypes = ["r3", "r2", "r1", "t_16", "t_32", "t_64", "t_128"];

                    $headerexistance = false;

                ?>

                    <div id="32_16" class="call_room cc">

                        <?php

                        for ($i = teamTableSelector($numofteams); $i >= 0; $i--) {

                            if ($tabletypes[$i] == "t_16" || $tabletypes[$i] == "t_32" || $tabletypes[$i] == "t_64" || $tabletypes[$i] == "t_128") {

                        ?>
                                <div id="e_" class="elimination">
                                    <div class="elimination_label"><?php echo $tabletypes[$i] ?></div>
                                    <?php

                                    $tablepartstring = $tabletypes[$i];

                                    foreach ($json_team_table->$tablepartstring as $matchkey => $matchvalue) {
                                    ?>
                                        <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                            <div class="table_round">

                                                <?php
                                                $firstrun = true;
                                                foreach ($matchvalue as $teamkey => $teamvalues) {
                                                    if ($teamkey == "referees" || $teamkey == "pistetime") {
                                                        continue;
                                                    }

                                                ?>

                                                    <div class="table_fencer">
                                                        <div class="table_fencer_number">
                                                            <p><?php echo $teamkey ?></p>
                                                        </div>

                                                        <div class="table_fencer_name">
                                                            <p><?php echo $teamname = (isset($teamvalues->id)) ? $teamvalues->id : "" ?></p>
                                                        </div>

                                                        <div class="table_fencer_nat">
                                                            <p><?php echo $teamnat = (isset($teamvalues->nation)) ? $teamvalues->nation : "" ?></p>
                                                        </div>
                                                    </div>
                                                    <?php

                                                    if ($firstrun == true) {
                                                    ?>

                                                        <div class="table_round_info">
                                                            <div>
                                                                <p>Referee 1: <?php echo $matchref = (isset($matchvalue->referees->name)) ? $matchvalue->referees->ref1->name : "" ?></p>
                                                                <p>Time: <?php echo $matchtime = (isset($matchvalue->pistetime)) ? $matchvalue->pistetime->time : "" ?></p>
                                                            </div>
                                                            <div>
                                                                <p>Referee 2: <?php echo $matchref2 = (isset($matchvalue->referees->name)) ? $matchvalue->referees->ref2->name : "" ?></p>
                                                                <p>Piste: <?php echo $matchpiste = (isset($matchvalue->pistetime)) ? $matchvalue->pistetime->pistename : "" ?></p>
                                                            </div>
                                                        </div>
                                                <?php

                                                    }

                                                    $firstrun = false;
                                                }
                                                ?>



                                            </div>
                                        </div>
                                    <?php

                                    }
                                    ?>
                                    <!-- ELIM LEZÁRÓ -->
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <!-- CALLROOM LEZÁRÓ -->
                    </div>
                    <?php

                    if (isset($json_team_table->t_16)) {

                    ?>

                        <!-- STEP 2 -->
                        <div id="1_16" class="call_room cc">

                            <div id="e_9-16" class="elimination">
                                <div class="elimination_label">9-16</div>
                                <?php

                                foreach ($json_team_table->r1->{"9-16"} as $key => $value) {
                                ?>

                                    <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                        <div class="table_round">

                                            <div class="table_fencer">
                                                <div class="table_fencer_number">
                                                    <p>NUM</p>
                                                </div>

                                                <div class="table_fencer_name">
                                                    <p>NAME</p>
                                                </div>

                                                <div class="table_fencer_nat">
                                                    <p>NAT</p>
                                                </div>
                                            </div>

                                            <div class="table_round_info">
                                                <div>
                                                    <p>Ref: </p>
                                                    <p>TIME</p>
                                                </div>
                                                <div>
                                                    <p>VRef:</p>
                                                    <p>Piste:</p>
                                                </div>
                                            </div>

                                            <div class="table_fencer">
                                                <div class="table_fencer_number">
                                                    <p>NUM</p>
                                                </div>

                                                <div class="table_fencer_name">
                                                    <p>NAME</p>
                                                </div>

                                                <div class="table_fencer_nat">
                                                    <p>NAT</p>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>

                            <div id="e_16" class="elimination">
                                <div class="elimination_label">1-16</div>

                                <?php

                                foreach ($json_team_table->t_16 as $key => $value) {
                                ?>

                                    <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                        <div class="table_round">

                                            <div class="table_fencer">
                                                <div class="table_fencer_number">
                                                    <p>NUM</p>
                                                </div>

                                                <div class="table_fencer_name">
                                                    <p>NAME</p>
                                                </div>

                                                <div class="table_fencer_nat">
                                                    <p>NAT</p>
                                                </div>
                                            </div>

                                            <div class="table_round_info">
                                                <div>
                                                    <p>Ref: </p>
                                                    <p>TIME</p>
                                                </div>
                                                <div>
                                                    <p>VRef:</p>
                                                    <p>Piste:</p>
                                                </div>
                                            </div>

                                            <div class="table_fencer">
                                                <div class="table_fencer_number">
                                                    <p>NUM</p>
                                                </div>

                                                <div class="table_fencer_name">
                                                    <p>NAME</p>
                                                </div>

                                                <div class="table_fencer_nat">
                                                    <p>NAT</p>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                            <div id="e_1-8" class="elimination">
                                <div class="elimination_label">1-8</div>

                                <?php

                                foreach ($json_team_table->r1->{"1-8"} as $key => $value) {
                                ?>

                                    <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                        <div class="table_round">

                                            <div class="table_fencer">
                                                <div class="table_fencer_number">
                                                    <p>NUM</p>
                                                </div>

                                                <div class="table_fencer_name">
                                                    <p>NAME</p>
                                                </div>

                                                <div class="table_fencer_nat">
                                                    <p>NAT</p>
                                                </div>
                                            </div>

                                            <div class="table_round_info">
                                                <div>
                                                    <p>Ref: </p>
                                                    <p>TIME</p>
                                                </div>
                                                <div>
                                                    <p>VRef:</p>
                                                    <p>Piste:</p>
                                                </div>
                                            </div>

                                            <div class="table_fencer">
                                                <div class="table_fencer_number">
                                                    <p>NUM</p>
                                                </div>

                                                <div class="table_fencer_name">
                                                    <p>NAME</p>
                                                </div>

                                                <div class="table_fencer_nat">
                                                    <p>NAT</p>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>

                    <?php
                    }
                    ?>


                    <?php

                    $order = ["r1", "r2", "r3"];

                    for ($i = 0; $i < 3; $i++) {
                        $tablestring = $order[$i];
                        if (isset($json_team_table->$tablestring)) {


                            foreach ($json_team_table->$tablestring as $tablecall => $table) {
                                $final = false;
                                if ($i == 0) {
                                    $step = 3;
                                } elseif ($i == 1) {
                                    $step = 1;
                                } else {
                                    $step = 0;
                                }

                    ?>

                                <div id="<?php echo $order[$i]?>" class="call_room cc">
                                    <!-- BEFORE -->
                                    <div id="e_" class="elimination">
                                        <div class="elimination_label"><?php

                                                                        $tableranks = explode("-", $tablecall);
                                                                        if ($tableranks[1] - $step == $tableranks[1]) {
                                                                            echo $tableranks[1];
                                                                            $final = true;
                                                                        } else {
                                                                            echo $backtable = $tableranks[1] - $step . "-" . $tableranks[1];
                                                                        }


                                                                        ?></div>


                                        <?php
                                        if (!$final == true) {
                                            $newtstring = "r" . (ltrim($tablestring, "r") + 1);
                                        }


                                        foreach ($json_team_table->$newtstring->$backtable as $matchkey => $matchvalue) {
                                        ?>

                                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                                <div class="table_round">


                                                    <?php
                                                    $firstrun = true;
                                                    foreach ($matchvalue as $teamkey => $teamvalues) {
                                                        if ($teamkey == "referees" || $teamkey == "pistetime") {
                                                            continue;
                                                        }

                                                    ?>

                                                        <div class="table_fencer">
                                                            <div class="table_fencer_number">
                                                                <p><?php echo $teamkey ?></p>
                                                            </div>

                                                            <div class="table_fencer_name">
                                                                <p><?php echo $teamname = (isset($teamvalues->id)) ? $teamvalues->id : "" ?></p>
                                                            </div>

                                                            <div class="table_fencer_nat">
                                                                <p><?php echo $teamnat = (isset($teamvalues->nation)) ? $teamvalues->nation : "" ?></p>
                                                            </div>
                                                        </div>
                                                        <?php

                                                        if ($firstrun == true) {
                                                        ?>

                                                            <div class="table_round_info">
                                                                <div>
                                                                    <p>Referee 1: <?php echo $matchref = (isset($matchvalue->referees->name)) ? $matchvalue->referees->ref1->name : "" ?></p>
                                                                    <p>Time: <?php echo $matchtime = (isset($matchvalue->pistetime)) ? $matchvalue->pistetime->time : "" ?></p>
                                                                </div>
                                                                <div>
                                                                    <p>Referee 2: <?php echo $matchref2 = (isset($matchvalue->referees->name)) ? $matchvalue->referees->ref2->name : "" ?></p>
                                                                    <p>Piste: <?php echo $matchpiste = (isset($matchvalue->pistetime)) ? $matchvalue->pistetime->pistename : "" ?></p>
                                                                </div>
                                                            </div>
                                                    <?php

                                                        }

                                                        $firstrun = false;
                                                    }
                                                    ?>

                                                </div>
                                            </div>

                                        <?php } ?>

                                    </div>
                                    <!-- MAIN -->
                                    <div id="e_" class="elimination">
                                        <div class="elimination_label"><?php echo $tablecall ?></div>

                                        <?php foreach ($json_team_table->$tablestring->$tablecall as $matchkey => $matchvalue) {
                                        ?>

                                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                                <div class="table_round">


                                                    <?php
                                                    $firstrun = true;
                                                    foreach ($matchvalue as $teamkey => $teamvalues) {
                                                        if ($teamkey == "referees" || $teamkey == "pistetime") {
                                                            continue;
                                                        }

                                                    ?>

                                                        <div class="table_fencer">
                                                            <div class="table_fencer_number">
                                                                <p><?php echo $teamkey ?></p>
                                                            </div>

                                                            <div class="table_fencer_name">
                                                                <p><?php echo $teamname = (isset($teamvalues->id)) ? $teamvalues->id : "" ?></p>
                                                            </div>

                                                            <div class="table_fencer_nat">
                                                                <p><?php echo $teamnat = (isset($teamvalues->nation)) ? $teamvalues->nation : "" ?></p>
                                                            </div>
                                                        </div>
                                                        <?php

                                                        if ($firstrun == true) {
                                                        ?>

                                                            <div class="table_round_info">
                                                                <div>
                                                                    <p>Referee 1: <?php echo $matchref = (isset($matchvalue->referees->name)) ? $matchvalue->referees->ref1->name : "" ?></p>
                                                                    <p>Time: <?php echo $matchtime = (isset($matchvalue->pistetime)) ? $matchvalue->pistetime->time : "" ?></p>
                                                                </div>
                                                                <div>
                                                                    <p>Referee 2: <?php echo $matchref2 = (isset($matchvalue->referees->name)) ? $matchvalue->referees->ref2->name : "" ?></p>
                                                                    <p>Piste: <?php echo $matchpiste = (isset($matchvalue->pistetime)) ? $matchvalue->pistetime->pistename : "" ?></p>
                                                                </div>
                                                            </div>
                                                    <?php

                                                        }

                                                        $firstrun = false;
                                                    }
                                                    ?>




                                                </div>
                                            </div>

                                        <?php

                                        }

                                        ?>

                                    </div>
                                    <!-- AFTER-->
                                    <div id="e_" class="elimination">
                                        <div class="elimination_label"><?php

                                                                        $tableranks = explode("-", $tablecall);
                                                                        if ($tableranks[0] == $tableranks[1] - ($step + 1)) {
                                                                            echo $tableranks[0];
                                                                        } else {
                                                                            echo $backtable = $tableranks[0] . "-" . ($tableranks[1] - ($step + 1));
                                                                        }


                                                                        ?></div>

                                        <?php
                                        if (!$final == true) {
                                            $newtstring = "r" . (ltrim($tablestring, "r") + 1);
                                        }


                                        foreach ($json_team_table->$newtstring->$backtable as $matchkey => $matchvalue) {
                                        ?>
                                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                                <div class="table_round">

                                                    <?php
                                                    $firstrun = true;
                                                    foreach ($matchvalue as $teamkey => $teamvalues) {
                                                        if ($teamkey == "referees" || $teamkey == "pistetime") {
                                                            continue;
                                                        }

                                                    ?>

                                                        <div class="table_fencer">
                                                            <div class="table_fencer_number">
                                                                <p><?php echo $teamkey ?></p>
                                                            </div>

                                                            <div class="table_fencer_name">
                                                                <p><?php echo $teamname = (isset($teamvalues->id)) ? $teamvalues->id : "" ?></p>
                                                            </div>

                                                            <div class="table_fencer_nat">
                                                                <p><?php echo $teamnat = (isset($teamvalues->nation)) ? $teamvalues->nation : "" ?></p>
                                                            </div>
                                                        </div>
                                                        <?php

                                                        if ($firstrun == true) {
                                                        ?>

                                                            <div class="table_round_info">
                                                                <div>
                                                                    <p>Referee 1: <?php echo $matchref = (isset($matchvalue->referees->name)) ? $matchvalue->referees->ref1->name : "" ?></p>
                                                                    <p>Time: <?php echo $matchtime = (isset($matchvalue->pistetime)) ? $matchvalue->pistetime->time : "" ?></p>
                                                                </div>
                                                                <div>
                                                                    <p>Referee 2: <?php echo $matchref2 = (isset($matchvalue->referees->name)) ? $matchvalue->referees->ref2->name : "" ?></p>
                                                                    <p>Piste: <?php echo $matchpiste = (isset($matchvalue->pistetime)) ? $matchvalue->pistetime->pistename : "" ?></p>
                                                                </div>
                                                            </div>
                                                    <?php

                                                        }

                                                        $firstrun = false;
                                                    }
                                                    ?>


                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>

                <?php
                            }
                        }
                    }
                }
                ?>


            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/overlay_panel.js"></script>
    <script src="../js/table_team.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/print.js"></script>
</body>

</html>