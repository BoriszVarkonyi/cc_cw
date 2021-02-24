<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
} else {
    echo mysqli_error($connection);
}

$fencers = count($json_table);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pools of <?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>

<body>
    <!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Pools</p>


                <?php



                if ($exist == 0) {

                ?>

                    STATE: 0
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button primary" onclick="generatePanel()" type="submit">
                            <p>Generate Pools</p>
                            <img src="../assets/icons/add_box-black-18dp.svg"/>
                        </button>
                    </div>

                    <div id="ref_pis_time_panel" class="overlay_panel">
                        <button class="panel_button" onclick="refPisTimePanel()">
                            <img src="../assets/icons/close-black-18dp.svg">
                        </button>
                        <p class="panel_title <?php if ($checkwc == 0 && $checkreg == 0) {
                                                    echo "green";
                                                } else {
                                                    echo "red";
                                                } ?>"><?php if ($checkwc == 0 && $checkreg == 0) {
                                                            echo "Everyone is ready to fence";
                                                        } else {
                                                            echo "Not everyone is ready to fence";
                                                        } ?></p>
                        <form action="" method="post" autocomplete="off" class="overlay_panel_form dense flex">
                            <label for="starting_time">STRIVE FOR</label>
                            <div class="option_container">
                                <input type="text" class="hidden" id="fencer_quantity" value="<?php echo $fencers ?>">
                                <input type="radio" class="option_button" name="pools_of" id="7" value="" onclick=""/>
                                <label for="7" class="option_label">Pools of 7</label>
                                <p id="p_7"></p>
                                <input type="radio" class="option_button" name="pools_of" id="6" value="" onclick=""/>
                                <label for="6" class="option_label">Pools of 6</label>
                                <p id="p_6"></p>
                                <input type="radio" class="option_button" name="pools_of" id="5" value="" onclick=""/>
                                <label for="5" class="option_label">Pools of 5</label>
                                <p id="p_5"></p>
                                <input type="radio" class="option_button" name="pools_of" id="4" value="" onclick=""/>
                                <label for="4" class="option_label">Pools of 4</label>
                                <p id="p_4"></p>
                            </div>

                            <label for="interval_of_match">NUMBER OF QUALIFIERS</label>
                            <input type="number" placeholder="#" class="number_input centered">

                            <label for="pistes_type">STATISTICS</label>

                            <table class="pools_stat_table">
                                <thead>
                                    <th>Percent</th>
                                    <th>Number of Fencers</th>
                                </thead>
                                <tr>
                                    <td>All</td>
                                    <td><?php echo $fencers ?></td>
                                <tr>
                                <tr>
                                    <td>80%</td>
                                    <td><?php echo round($fencers * 0.8) ?></td>
                                <tr>
                                <tr>
                                    <td>70%</td>
                                    <td><?php echo round($fencers * 0.7) ?></td>
                                <tr>
                            </table>
                            <button type="submit" name="create_pools" value="Save" class="panel_submit">Create</button>
                        </form>
                    </div>

                <?php
                } elseif ($exist != 0 && $exist2 == 0) {

                ?>

                    STATE: 1
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button disabled" type="button">
                            <p>Message Fencer</p>
                            <img src="../assets/icons/message-black-18dp.svg"/>
                        </button>

                        <button class="stripe_button bold" type="button" onclick="toggleRefPanel()">
                            <p>Referees</p>
                            <img src="../assets/icons/ballot-black-18dp.svg"/>
                        </button>

                        <button class="stripe_button bold" type="button" onclick="togglePistTimePanel()">
                            <p>Pistes & Time</p>
                            <img src="../assets/icons/ballot-black-18dp.svg"/>
                        </button>

                        <form action="" method="POST">
                            <button class="stripe_button primary" type="submit" name="start_pools">
                                <p>Start Pools</p>
                                <img src="../assets/icons/outlined_flag-black-18dp.svg"/>
                            </button>
                        </form>

                        <form class="title_stripe_form" method="POST" action="">
                            <input type="text" name="save_pools_hidden_input" id="savePoolsHiddenInput" class="hidden">
                            <button class="stripe_button primary" name="save_pools" onclick="savePools()" type="submit">
                                <p>Save Pools</p>
                                <img src="../assets/icons/save-black-18dp.svg"/>
                            </button>
                        </form>
                    </div>

                    <div id="ref_panel" class="overlay_panel hidden">
                        <button class="panel_button" onclick="toggleRefPanel()">
                            <img src="../assets/icons/close-black-18dp.svg">
                        </button>
                        <form action="" method="post" autocomplete="off" class="overlay_panel_form dense flex">
                            <label for="ref_type">REFEREES CAN MATCH WITH SAME NATIONALITY / CLUB FENCER</label>
                            <div class="option_container row">
                                <input type="checkbox" name="pistes_type" id="true" value=""/>
                                <label for="true">True</label>
                            </div>
                            <label for="all_ref">SELECT REFEREES</label>
                            <div class="option_container row">
                                <input type="radio" name="ref_select" checked id="all_ref" onclick="useAllReferees()" value="all_ref"/>
                                <label for="all_ref">Use all</label>

                                <input type="radio" name="ref_select" id="manual_select_ref" onclick="selectReferees()" value="manual_select_ref"/>
                                <label for="manual_select_ref">Select manually</label>
                            </div>

                            <div class="option_container grid piste_select disabled" id="select_referees_panel">

                                <?php

                                $ref_query = "SELECT * FROM ref_$comp_id WHERE online = 1";
                                $ref_query_do = mysqli_query($connection, $ref_query);

                                while ($row =  mysqli_fetch_assoc($ref_query_do)) {

                                    $refid = $row["id"];
                                    $fullname = $row["full_name"];


                                ?>

                                    <div class="piste_select">
                                        <input type="checkbox" name="ref_<?php echo $refid ?>" id="ref_<?php echo $refid ?>" value="value1"/>
                                        <label for="ref_<?php echo $refid ?>"><?php echo $fullname ?></label>
                                    </div>

                                <?php

                                }

                                ?>
                            </div>
                            <button type="submit" name="draw_ref" value="Save" class="panel_submit" id="rfrsSaveButton">Save</button>
                        </form>
                    </div>




                    <div id="pist_time_panel" class="overlay_panel hidden">
                        <button class="panel_button" onclick="togglePistTimePanel()">
                            <img src="../assets/icons/close-black-18dp.svg">
                        </button>
                        <form action="" method="post" autocomplete="off" class="overlay_panel_form dense flex">
                            <label for="starting_time">STARTING TIME</label>
                            <input type="time" id="startingTimeInput" name="starting_time">

                            <label for="interval_of_match">INTERVAL OF MATCH</label>
                            <div id="interval_of_match_wrapper">
                                <input type="number" class="number_input centered" name="interval_of_match" id="timeInput">
                                <p>Min.</p>
                            </div>

                            <label for="pistes_type">PISTES</label>
                            <div class="option_container row">
                                <input type="radio" name="pistes_usage_type" checked id="all" onclick="useAllPistes()" value="1"/>
                                <label for="all">Use all</label>

                                <input type="radio" name="pistes_usage_type" id="manual_select" onclick="selectPistes()" value="2"/>
                                <label for="manual_select">Select manually</label>
                            </div>

                            <div class="option_container grid piste_select disabled" id="select_pistes_panel">

                                <?php

                                $pistes_query = "SELECT * FROM pistes_$comp_id EXCEPT SELECT * FROM pistes_$comp_id WHERE piste_activity = 1";
                                $pistes_query_do = mysqli_query($connection, $pistes_query);

                                $r = 1;
                                while ($row =  mysqli_fetch_assoc($pistes_query_do)) {

                                    $pistenum = $row["piste_number"];
                                    $pistetype = $row["piste_type"];
                                    $pistecolor = $row["piste_color"];


                                ?>


                                    <div class="piste_select">
                                        <input type="checkbox" name="piste_<?php echo $r ?>" id="piste_<?php echo $r ?>" value="1"/>
                                        <label for="piste_<?php echo $r ?>">Piste <?php

                                                                                    if ($pistetype == 1) {

                                                                                        echo "main";
                                                                                    } elseif ($pistetype == 2) {

                                                                                        echo  $pistenum . " (" . pisteColor($pistecolor) . ")";
                                                                                    } else {
                                                                                        echo $pistenum;
                                                                                    }


                                                                                    ?></label>
                                    </div>

                                <?php
                                    $r++;
                                }
                                ?>


                            </div>

                            <button type="submit" name="piste_time" value="Save" class="panel_submit" id="pNtSaveButton">Save</button>
                        </form>
                    </div>






                <?php
                } else {

                    //determine if finsih pools is disabled
                    $qry_fin_pools = "SELECT * FROM `pool_matches_$comp_id` WHERE `f1_sc` = NULL OR `f2_sc` = NULL;";
                    $do_fin_pools = mysqli_query($connection, $qry_fin_pools);

                    if ($row = mysqli_fetch_assoc($do_fin_pools)) {
                        $is_disabled = "disabled";
                    } else {
                        $is_disabled = "";
                    }




                ?>
                    <div class="stripe_button_wrapper">
                        <a class="stripe_button primary" href="print_pools.php?comp_id=<?php echo $comp_id ?>" target="_blank" id="printButton">
                            <p>Print Pools</p>
                            <img src="../assets/icons/print-black-18dp.svg"/>
                        </a>
                        <a class="stripe_button primary <?php echo $is_disabled ?>" href="process_pools.php?comp_id=<?php echo $comp_id ?>" target="_blank">
                            <p>Finish Pools</p>
                            <img src="../assets/icons/save-black-18dp.svg"/><!-- ide kell majd egy másik icon pls krisz segits-->
                        </a>
                    </div>


                <?php
                }
                ?>

            </div>
            <div id="page_content_panel_main">

                <?php

                if ($exist == 0) {
                ?>

                    STATE: 0

                    <div id="no_something_panel">
                        <p>You have no pools generated!</p>
                    </div>
                <?php
                } elseif ($exist != 0 && $exist2 == 0) {
                ?>

                    <div id="pools_wrapper">

                        nem finális verzió anim á ci ó
                        <div id="pool_listing" class="with_drag">


                            <?php
                            $qry_get_pool_number = "SELECT MAX(`pool_number`) FROM `pools_$comp_id`";
                            $do_get_pool_number = mysqli_query($connection, $qry_get_pool_number);
                            if ($row = mysqli_fetch_assoc($do_get_pool_number)) {
                                $pool_of = $row['MAX(`pool_number`)'];
                            }

                            $f = [];
                            for ($i = 1; $i <= $pool_of; $i++) {

                                $inside_query = "SELECT * FROM pools_$comp_id WHERE pool_number = $i";
                                $inside_query_do = mysqli_query($connection, $inside_query);

                                if ($row = mysqli_fetch_assoc($inside_query_do)) {

                                    $pool_f_in = $row["pool_of"];
                                    $f[0] = $row['f1'];
                                    $f[1] = $row['f2'];
                                    $f[2] = $row['f3'];
                                    $f[3] = $row['f4'];
                                    $f[4] = $row['f5'];
                                    $f[5] = $row['f6'];
                                    $f[6] = $row['f7'];
                                    $ref = $row["ref"];
                                    $ref_2 = $row["ref2"];
                                    $piste = $row["piste"];
                                    $time = $row["time"];
                                }

                                $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = '$ref'";
                                $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                                if ($refrow = mysqli_fetch_assoc($get_ref_name_do)) {

                                    $refname = $refrow["full_name"];
                                    $refnat = $refrow["nat"];
                                }

                                $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = '$ref_2'";
                                $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                                $ref2name = "";
                                $ref2nat = "";

                                if ($refrow = mysqli_fetch_assoc($get_ref_name_do)) {

                                    $ref2name = $refrow["full_name"];
                                    $ref2nat = $refrow["nat"];
                                }

                            ?>

                                <div>
                                    <div class="entry">
                                        <div class="table_row">
                                            <div class="table_item bold">No.<?php echo $i ?></div>
                                            <div class="table_item">Piste <?php echo $piste ?></div>
                                            <div class="table_item">Ref 1: <?php
                                                                            if (isset($refname)) {

                                                                                echo $refname;
                                                                                echo "(" . $refnat . ")";
                                                                            } else {
                                                                                echo "No ref assigned!";
                                                                            }


                                                                            ?></div>

                                            <?php
                                            if ($ref2name != "") {
                                            ?>
                                                <div class="table_item">Ref 2: <?php echo $ref2name ?> (<?php echo $ref2nat ?>)</div>
                                            <?php
                                            }
                                            ?>
                                            <div class="table_item"><?php echo $time ?></div>
                                            <div class="big_status_item">
                                                <button type="button" onclick="" class="pool_config">
                                                    <img src="../assets/icons/settings-black-18dp.svg">
                                                </button>
                                            </div>
                                        </div>
                                        <div class="entry_panel">
                                            <div class="pool_table_wrapper table">
                                                <div class="table_header">
                                                    <div class="table_header_text">
                                                        name
                                                    </div>
                                                    <div class="table_header_text">
                                                        nation
                                                    </div>

                                                    <div class="table_header_text square">
                                                        Cp
                                                    </div>

                                                    <div class="table_header_text square">
                                                        rp
                                                    </div>

                                                </div>
                                                <div class="table_row_wrapper alt" ondragover="tableWrapperHoverOn(this)" ondragleave="tableWrapperHoverOff(this)">
                                                    <div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>
                                                    <?php

                                                    //for loop for fencers in pool (name id nation)
                                                    for ($n = 0; $n < $pool_f_in; $n++) {
                                                        $fx = $f[$n];
                                                        $get_fencer_data = "SELECT * FROM cptrs_$comp_id WHERE id = '$fx'";
                                                        $do_get_fencer_data = mysqli_query($connection, $get_fencer_data);

                                                        echo mysqli_error($connection);

                                                        if ($row = mysqli_fetch_assoc($do_get_fencer_data)) {
                                                            $fencer_nat = $row['nationality'];
                                                            $fencer_name = $row['name'];
                                                        }

                                                    ?>

                                                        <div class="table_row">
                                                            <div class="table_item">
                                                                <p class="drag_fencer" draggable="true" ondragstart="drag(event, this)" ondragend="dragEnd(this)" id="<?php echo $fx ?>"><?php echo $fencer_name ?></p>
                                                            </div>
                                                            <div class="table_item">
                                                                <p><?php echo $fencer_nat ?></p>
                                                            </div>
                                                            <div class="table_item square">
                                                                <p>1</p>
                                                            </div>
                                                            <div class="table_item square">
                                                                <p>1</p>
                                                            </div>
                                                        </div>
                                                        <div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php
                            }
                            ?>



                        </div>
                        <div id="pools_drag_panel">
                            <div ondrop="drop(event)" ondragover="allowDrop(event)" class="holder"></div>
                            <div ondrop="drop(event)" ondragover="allowDrop(event)" class="deleter"></div>
                        </div>

                    <?php } else { ?>
                        STATE: 2
                        <div id="pool_listing" class="state_2 wrapper">



                            <?php

                            $qry_get_pool_number = "SELECT MAX(`pool_number`) FROM `pools_$comp_id`";
                            $do_get_pool_number = mysqli_query($connection, $qry_get_pool_number);
                            if ($row = mysqli_fetch_assoc($do_get_pool_number)) {
                                $pool_of = $row['MAX(`pool_number`)'];
                            }

                            $f = [];
                            for ($i = 1; $i <= $pool_of; $i++) {

                                $inside_query = "SELECT * FROM pools_$comp_id WHERE pool_number = $i";
                                $inside_query_do = mysqli_query($connection, $inside_query);

                                if ($row = mysqli_fetch_assoc($inside_query_do)) {

                                    $pool_f_in = $row["pool_of"];
                                    $f[0] = $row['f1'];
                                    $f[1] = $row['f2'];
                                    $f[2] = $row['f3'];
                                    $f[3] = $row['f4'];
                                    $f[4] = $row['f5'];
                                    $f[5] = $row['f6'];
                                    $f[6] = $row['f7'];
                                    $ref = $row["ref"];
                                    $ref_2 = $row["ref2"];
                                    $piste = $row["piste"];
                                    $time = $row["time"];


                                    $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = '$ref'";
                                    $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                                    if ($refrow = mysqli_fetch_assoc($get_ref_name_do)) {

                                        $refname = $refrow["full_name"];
                                        $refnat = $refrow["nat"];
                                    }

                                    $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = '$ref_2'";
                                    $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                                    $ref2name = "";
                                    $ref2nat = "";

                                    if ($refrow = mysqli_fetch_assoc($get_ref_name_do)) {

                                        $ref2name = $refrow["full_name"];
                                        $ref2nat = $refrow["nat"];
                                    }
                                } ?>
                                <div>
                                    <div class="entry">
                                        <div class="table_row start">
                                            <div class="table_item bold">No. <?php echo $i ?></div>
                                            <div class="table_item">Piste <?php echo $piste ?></div>
                                            <div class="table_item">Ref: <?php echo $refname ?></div>
                                            <div class="table_item"><?php echo $time ?></div>
                                            <button type="button" onclick="window.location.href='pool_results.php?comp_id=<?php echo $comp_id ?>&poolid=<?php echo $i ?>'" class="pool_config">
                                                <img src="../assets/icons/settings-black-18dp.svg">
                                            </button>
                                        </div>
                                        <div class="entry_panel">
                                            <div class="pool_table_wrapper table">
                                                <div class="table_header">
                                                    <div class="table_header_text">
                                                        Fencers name
                                                    </div>
                                                    <div class="table_header_text">
                                                        Fencers nationality
                                                    </div>
                                                    <div class="table_header_text square">
                                                        No.
                                                    </div>
                                                    <?php
                                                    for ($k = 0; $k < $pool_f_in; $k++) { ?>
                                                        <div class="table_header_text square">
                                                            <?php echo $k + 1; ?>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                                <div class="table_row_wrapper alt">
                                                    <?php
                                                    for ($n = 0; $n < $pool_f_in; $n++) {
                                                        $fx = $f[$n];
                                                        $get_fencer_data = "SELECT * FROM cptrs_$comp_id WHERE id = '$fx'";
                                                        $do_get_fencer_data = mysqli_query($connection, $get_fencer_data);

                                                        if ($row = mysqli_fetch_assoc($do_get_fencer_data)) {
                                                            $fencer_nat = $row['nationality'];
                                                            $fencer_name = $row['name'];
                                                        } ?>


                                                        <div class="table_row">
                                                            <div class="table_item"><?php echo $fencer_name ?></div>
                                                            <div class="table_item"><?php echo $fencer_nat ?></div>
                                                            <div class="table_item square row_title"><?php echo $n + 1 ?></div>
                                                            <?php
                                                            $filled = "";
                                                            for ($l = 0; $l < $pool_f_in; $l++) {

                                                                if ($l == $n) {

                                                                    $filled = "filled";
                                                                } ?>

                                                                <div class="table_item square <?php echo $filled ?>">

                                                                    <?php
                                                                    $front = 0;
                                                                    $back = 0;
                                                                    if ($l > $n) {

                                                                        $front = $n + 1;
                                                                        $back = $l + 1;
                                                                    } else {

                                                                        $front = $l + 1;
                                                                        $back = $n + 1;
                                                                    }
                                                                    if ($l != $n) {
                                                                        $scorenow = 0;
                                                                        $m_id = $front . "-" . $back;

                                                                        if ($l > $n) {
                                                                            $ret = $i + 1;
                                                                            $query_get_scores = "SELECT * FROM pool_matches_$comp_id WHERE m_id = '$m_id' AND p_in = $i";
                                                                            $query_get_scores_do = mysqli_query($connection, $query_get_scores);

                                                                            while ($row4 = mysqli_fetch_assoc($query_get_scores_do)) {

                                                                                $scorenow = $row4["f1_sc"];
                                                                            }
                                                                            echo $scorenow;
                                                                        } elseif ($n > $l) {
                                                                            $ret = $i + 1;
                                                                            $query_get_scores = "SELECT * FROM pool_matches_$comp_id WHERE m_id = '$m_id' AND p_in = $i";
                                                                            $query_get_scores_do = mysqli_query($connection, $query_get_scores);

                                                                            while ($row4 = mysqli_fetch_assoc($query_get_scores_do)) {

                                                                                $scorenow = $row4["f2_sc"];
                                                                            }
                                                                            echo $scorenow;
                                                                        }
                                                                    }

                                                                    ?>

                                                                </div>

                                                            <?php
                                                                $filled = "";
                                                            }

                                                            ?>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>


                            <!-- <div class="entry">
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg">
                                </button>
                            </div>
                            <div class="entry_panel">
                                <div class="pool_table_wrapper">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nationality
                                        </div>
                                        <div class="table_header_text square">
                                            No.
                                        </div>
                                        <div class="table_header_text square">
                                            1
                                        </div>
                                        <div class="table_header_text square">
                                            2
                                        </div>
                                        <div class="table_header_text square">
                                            3
                                        </div>
                                        <div class="table_header_text square">
                                            4
                                        </div>
                                        <div class="table_header_text square">
                                            5
                                        </div>
                                        <div class="table_header_text square">
                                            6
                                        </div>
                                        <div class="table_header_text square">
                                            W
                                        </div>
                                        <div class="table_header_text square">
                                            L
                                        </div>
                                        <div class="table_header_text square">
                                            TR
                                        </div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">1</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">2</div>
                                        <div class="table_item square">a</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">3</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">as</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">5</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">6</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">ge</div>
                                        <div class="table_item square  filled"></div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry">
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg">
                                </button>
                            </div>
                            <div class="entry_panel">
                                <div class="pool_table_wrapper">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nationality
                                        </div>
                                        <div class="table_header_text square">
                                            No.
                                        </div>
                                        <div class="table_header_text square">
                                            1
                                        </div>
                                        <div class="table_header_text square">
                                            2
                                        </div>
                                        <div class="table_header_text square">
                                            3
                                        </div>
                                        <div class="table_header_text square">
                                            4
                                        </div>
                                        <div class="table_header_text square">
                                            5
                                        </div>
                                        <div class="table_header_text square">
                                            6
                                        </div>
                                        <div class="table_header_text square">
                                            W
                                        </div>
                                        <div class="table_header_text square">
                                            L
                                        </div>
                                        <div class="table_header_text square">
                                            TR
                                        </div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">1</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">2</div>
                                        <div class="table_item square">a</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">3</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">as</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">5</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">6</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">ge</div>
                                        <div class="table_item square  filled"></div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry">
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg">
                                </button>
                            </div>
                            <div class="entry_panel">
                                <div class="pool_table_wrapper">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nationality
                                        </div>
                                        <div class="table_header_text square">
                                            No.
                                        </div>
                                        <div class="table_header_text square">
                                            1
                                        </div>
                                        <div class="table_header_text square">
                                            2
                                        </div>
                                        <div class="table_header_text square">
                                            3
                                        </div>
                                        <div class="table_header_text square">
                                            4
                                        </div>
                                        <div class="table_header_text square">
                                            5
                                        </div>
                                        <div class="table_header_text square">
                                            6
                                        </div>
                                        <div class="table_header_text square">
                                            W
                                        </div>
                                        <div class="table_header_text square">
                                            L
                                        </div>
                                        <div class="table_header_text square">
                                            TR
                                        </div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">1</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">2</div>
                                        <div class="table_item square">a</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">3</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">as</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">5</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">6</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">ge</div>
                                        <div class="table_item square  filled"></div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                </div>
                            </div> -->
                        <?php
                    }
                        ?>
                        </div>
                    </div>


            </div>

        </div>
    </div>
</body>

<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/pools.js"></script>
<script src="../js/overlay_panel.js"></script>
</html>