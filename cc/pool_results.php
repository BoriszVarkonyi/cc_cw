<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php //include "includes/functions.php"; ?>
<?php include "includes/pool_orders.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
    $qry_get_data = "SELECT fencers, matches FROM pools WHERE assoc_comp_id = '$comp_id'";
    $do_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $fencers_string = $row['fencers'];
        $matches_string = $row['matches'];

        $fencers_table = json_decode($fencers_string);
        $matches_table = json_decode($matches_string);
    }

    $pool_num = $_GET['poolid'];
    $current_f_pool = $fencers_table[$pool_num];
    $current_m_pool = $matches_table[$pool_num - 1];

    //get number of fencers in pools
    $pool_f_in = getFencersInPool($current_f_pool);

    //get number of mathces in round robin
    $number_of_matches = $pool_f_in * ($pool_f_in - 1) / 2;

    //get order of matches
    $order_array = poolOrder($pool_f_in);

    //get fencers names and ids
    $qry_get_names = "SELECT `data` FROM `competitors` WHERE `assoc_comp_id` = '$comp_id'";
    $do_get_names = mysqli_query($connection, $qry_get_names);
    if ($row = mysqli_fetch_assoc($do_get_names)) {
        $name_string = $row['data'];
        $name_json = json_decode($name_string);

        $name_array = [];
        //make name assoc array
        foreach ($name_json as $name_obj) {
            $name = $name_obj -> prenom . " " . $name_obj -> nom;
            $id = $name_obj -> id;

            $name_array[$id] = $name;
        }
    }

    if (isset($_POST['submit_savepool'])) {
        var_dump($_POST);
        $match_counter = 0;
        foreach ($order_array as $match_string) {
            $match_id_array = explode('-',$match_string);
            $match_string_rev = strrev($match_string);

            //get points and match obj
            $given = $_POST[$match_string];
            $gotten = $_POST[$match_string_rev];
            $match_obj = $matches_table[$pool_num-1] -> {$match_id_array[0]} -> {$match_id_array[1]};

            if ($given == "") {
                $given = 0;
            }

            if ($gotten == "") {
                $gotten = 0;
            }
            //get winner
            if ($given > $gotten) {
                $winner = $match_obj -> id;
            } else if ($gotten > $given) {
                $winner = $match_obj -> enemy;
            } else { //draw radio button decides
                if (isset($_POST[$match_counter])) {
                    $winner_id_draw = $_POST[$match_counter];

                    //if might not be needed, too afraid to delete
                    if ($winner_id_draw === null) {
                        continue;
                    }
                    $winner = $match_obj -> $winner_id_draw;
                }
            }

            //set data
            $matches_table[$pool_num-1] -> {$match_id_array[0]} -> {$match_id_array[1]} -> given  = $given;
            $matches_table[$pool_num-1] -> {$match_id_array[0]} -> {$match_id_array[1]} -> gotten = $gotten;

            $matches_table[$pool_num-1] -> {$match_id_array[0]} -> {$match_id_array[1]} -> w_id = $winner;

            //reset winner
            $winner = null;

            //update database
            $matches_string = json_encode($matches_table);
            $qry_update = "UPDATE pools SET matches = '$matches_string' WHERE assoc_comp_id = '$comp_id'";
            if ($do_update = mysqli_query($connection, $qry_update)) {
                header("Location: ../cc/pools_view.php?comp_id=$comp_id");
            }
            $match_counter++;
        }
    }
    if (isset($_POST['submit_disq'])) {
        //get reason
        $reason = $_POST['disqualification_reason_2'];
        $fencer_id = $_POST['id_of_fencer'];

        //set all points given and gotten by fencer to disq code
        //go through matches
        for ($fencer_number = 1; $fencer_number <= $pool_f_in; $fencer_number++) {
            for ($opponent_number = $fencer_number + 1; $opponent_number <= $pool_f_in; $opponent_number++) {
                if ($fencer_id == $current_m_pool -> $fencer_number -> $opponent_number -> enemy) {
                    $matches_table[$pool_num-1] -> $fencer_number -> $opponent_number -> gotten = $reason;
                }
                if ($fencer_id == $current_m_pool -> $fencer_number -> $opponent_number -> id) {
                    $matches_table[$pool_num - 1] -> $fencer_number -> $opponent_number -> given = $reason;
                }
            }
        }

        $matches_string = json_encode($matches_table);
        $qry_update = "UPDATE `pools` SET `matches` = '$matches_string' WHERE `assoc_comp_id` = '$comp_id'";
        if ($do_update = mysqli_query($connection, $qry_update)) {
            header("Refresh:0");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pool No. <?php echo $pool_num ?>'s results</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/pool_results_style.min.css">
</head>
<body>
    <div class="modal_wrapper hidden" id="modal_1">
        <div class="modal">
            <div class="modal_header red">
                <p class="modal_title">Do you want to disqualify for the following reason: ?</p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This action cannot be revoked.</p>
                <form id="form_disq" method="POST" action="" name="form_disq" class="modal_footer_content">

                    <div class="hidden_input_wrapper">
                        <input type="radio" name="disqualification_reason_2" id="medical" value="MED"/>
                        <label for="medical">Medical</label>

                        <input type="radio" name="disqualification_reason_2" id="surrender" value="ABD"/>
                        <label for="surrender">Surrender</label>

                        <input type="radio" name="disqualification_reason_2" id="exclusion" value="EXC"/>
                        <label for="exclusion">Exclusion</label>

                        <input type="text" placeholder="fencer id">
                    </div>

                    <button type="button" class="modal_decline_button" onclick="toggleModal(1)">Cancel</button>
                    <button name="submit_disq" type="submit" class="modal_confirmation_button">Disqualify</button>
                </form>
            </div>
        </div>
    </div>
    <?php include "includes/navigation.php"; ?>
    <main>
        <div id="title_stripe">
            <p class="page_title">Pool No. <?php echo $pool_num ?>'s results</p>
            <input form="form_disq" type="text" name="id_of_fencer" id="" class="selected_list_item_input hidden" readonly>
            <div class="stripe_button_wrapper">
                <button class="stripe_button disabled" type="button" id="msg_fencer">
                    <p>Message Fencer</p>
                    <img src="../assets/icons/message_black.svg"/>
                </button>
                <button class="stripe_button red disabled" type="button" onclick="toggleDisqualifyPanel()" id="disqualifyButton">
                    <p>Disqualify</p>
                    <img src="../assets/icons/highlight_off_black.svg"/>
                </button>
                <form id="savepool" action="" method="POST"></form>
                <button value="1" form="savepool" name="submit_savepool" class="stripe_button primary" type="submit">
                    <p>Save Pool</p>
                    <img src="../assets/icons/save_black.svg"/>
                </button>
            </div>
            <div id="disqualify_panel" class="overlay_panel hidden">
                <div class="overlay_panel_controls">
                    <p>Disqualify</p>
                </div>
                <button class="panel_button" name="Close panel" onclick="toggleDisqualifyPanel()">
                    <img src="../assets/icons/close_black.svg">
                </button>
                <div class="overlay_panel_form">
                    <div class="overlay_panel_division visible">
                        <label>REASON OF DISQUALIFICATION</label>
                        <div class="option_container">
                            <input type="radio" name="disqualification_reason" id="med" value="MED"/>
                            <label for="med">Medical</label>

                            <input type="radio" name="disqualification_reason" id="sur" value="ABD"/>
                            <label for="sur">Surrender</label>

                            <input type="radio" name="disqualification_reason" id="exc" value="EXC"/>
                            <label for="exc">Exclusion</label>
                        </div>
                    </div>
                    <button class="panel_submit red" onclick="toggleModal(1)">Disqualify</button>
                </div>
            </div>
        </div>
        <div id="page_content_panel_main">
            <div class="wrapper full" id="pool_results">
                <div>


                    <?php

                    //get pools data
                    $piste = $current_f_pool -> piste;
                    $time =  $current_f_pool -> time;
                    $ref1name = "";
                    $ref1nat = "";

                    if ($current_f_pool -> ref1 !== NULL) {
                        $ref1name = $current_f_pool -> ref1 -> prenom . $current_f_pool -> ref1 -> nom;
                        $ref1nat = $current_f_pool -> ref1 -> nation;
                    }

                    if ($current_f_pool -> ref2 != NULL) {
                        $ref2nat = $current_f_pool -> ref2 -> nation;
                        $ref2name = $current_f_pool -> ref2 -> prenom . $current_f_pool -> ref2 -> nom;
                    }
                    ?>
                    <div id="pool_matches_brief" class="pool_results_column">
                        <div class="entry">
                            <div class="tr">
                                <div class="td bold">No. <?php echo $pool_num ?></div>
                                <div class="td">Piste <?php echo $piste ?></div>
                                <div class="td">Ref:
                                <?php
                                //echo out ref(s)
                                echo $ref1name . " (" . $ref1nat . ")";
                                if ($current_f_pool -> ref2 != NULL) {
                                    echo "Ref 2: " . $ref2name . " (" . $ref2nat . ") ";
                                }
                                ?></div>
                                <div class="td"><?php echo $time ?></div>
                            </div>
                            <div class="entry_panel">
                                <table class="pool_table_wrapper small">
                                    <thead>
                                        <tr>
                                        <th>
                                                <p>Fencer's name</p>
                                            </th>
                                            <th class="square">
                                                <p>No.</p>
                                            </th>
                                            <?php
                                                //echo out fencer number top(horizontal)
                                                for ($i = 1; $i <= $pool_f_in; $i++ ) {
                                            ?>
                                            <th class="square"><p><?php echo $i ?></p></th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>

                                    <tbody class="alt">
                                        <?php
                                            //echo the fencers vertical
                                            for ($f_num = 1; $f_num <= $pool_f_in; $f_num++) {
                                                //get fencers data
                                                $fencer_name = $current_f_pool -> $f_num -> prenom_nom;
                                                $fencer_nat = $current_f_pool -> {$f_num} -> nation;
                                                $fencer_id = $current_f_pool -> {$f_num} -> id;

                                                if ($f_num < 4) {
                                                    $points = $matches_table[$pool_num-1] -> {$f_num} -> {$pool_f_in} -> given;
                                                } else {
                                                    $points = $matches_table[$pool_num-1] -> {1} -> {$pool_f_in} -> gotten;
                                                }

                                                $disq_class = "";
                                                if (isDisqualified($points)) {
                                                    $disq_class = "disqualified";
                                                }

                                        ?>

                                        <tr id="<?php echo $current_f_pool -> $f_num -> id ?>" class="<?php echo $disq_class ?>" onclick="selectRow(this)">
                                            <td><p><?php echo $fencer_name ?></p></td>
                                            <td class="square row_title"><p><?php echo $f_num ?></p></td>
                                            <?php
                                                for ($i = 1; $i <= $pool_f_in; $i++) {

                                                    $color_class = "";

                                                    if ($i == $f_num) {//middle strip

                                                        $color_class = " filled";

                                                    } else if ($i > $f_num) { //right upper

                                                        //get points
                                                        $gotten = $matches_table[$pool_num-1] -> {$f_num} -> {$i} -> gotten;
                                                        $given = $matches_table[$pool_num-1] -> {$f_num} -> {$i} -> given;
                                                        $win_id = $matches_table[$pool_num-1] -> {$f_num} -> {$i} -> w_id;

                                                        if (isDisqualified($given) || isDisqualified($gotten)) {
                                                            $color_class = " disqualified";
                                                        } else if ($win_id == $fencer_id) {
                                                            $color_class = " green";
                                                        } else {
                                                            $color_class = " red";
                                                        }

                                                    } else { //left downer

                                                        //get points rev
                                                        $gotten = $matches_table[$pool_num-1] -> {$i} -> {$f_num} -> gotten;
                                                        $given = $matches_table[$pool_num-1] -> {$i} -> {$f_num} -> given;
                                                        $win_id = $matches_table[$pool_num-1] -> {$i} -> {$f_num} -> w_id;

                                                        if (isDisqualified($given) || isDisqualified($gotten)) {
                                                            $color_class = " disqualified";
                                                        } else if ($win_id == $fencer_id) {
                                                            $color_class = " green";
                                                        } else {
                                                            $color_class = " red";
                                                        }
                                                    }


                                                    if ($i < $f_num) {
                                                        $points = $current_m_pool -> {$i} -> {$f_num} -> gotten;
                                                    } else if ($i > $f_num) {
                                                        $points = $current_m_pool -> {$f_num} -> {$i} -> given;
                                                    }
                                                    //get scores from matches_table!

                                                    if ($i == $f_num) {
                                                        ?><td class="square <?php echo $color_class ?>"><p>X</p></td><?php
                                                    } else {
                                                        ?><td class="square <?php echo $color_class ?>"><p><?php echo $points ?></p></td><?php
                                                    }

                                                }
                                            ?>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="column_view_controls">
                        <button onclick="viewAllButton()">
                            <img src="../assets/icons/vertical_split_black.svg">
                        </button>
                        <button onclick="viewEntryButton()">
                            <img src="../assets/icons/switch_right_black.svg">
                        </button>
                        <button onclick="viewMatchesButton()">
                            <img src="../assets/icons/switch_left_black.svg">
                        </button>
                    </div>
                    <div id="pool_matches" class="pool_results_column">
                        <?php
                            //get max points from formula
                            $qry_get_point = "SELECT `data` FROM `formulas` WHERE `assoc_comp_id` = '$comp_id'";
                            $do_get_point = mysqli_query($connection, $qry_get_point);
                            if ($row = mysqli_fetch_assoc($do_get_point)) {
                                $formula_string = $row['data'];
                                $formula_table = json_decode($formula_string);

                                $max_points = $formula_table -> poolPoints;
                            }
                        ?>
                        <input type="number" class="number_input hidden" placeholder="points in pools" value="<?php echo $max_points ?>" readonly id="maxValueInput">
                        <?php

                            $match_number = 1;
                            foreach ($order_array as $match_string) {

                                $array_match_ids = explode('-', $match_string);

                                $f1_id = $current_m_pool -> {$array_match_ids[0]} -> {$array_match_ids[1]} -> id;
                                $f2_id = $current_m_pool -> {$array_match_ids[0]} -> {$array_match_ids[1]} -> enemy;

                                $f1_score = $current_m_pool -> {$array_match_ids[0]} -> {$array_match_ids[1]} -> given;
                                $f2_score = $current_m_pool -> {$array_match_ids[0]} -> {$array_match_ids[1]} -> gotten;

                                //get fencer names from array
                                $f1_name = $name_array[$f1_id];
                                $f2_name = $name_array[$f2_id];

                                //changable class name
                                $class_cancel = "";
                                $disq_atr = "";
                                if (isDisqualified($f1_score) || isDisqualified($f2_score)) {
                                    $class_cancel = " canceled"; //not her majesty's english |:(
                                    $disq_atr = "readonly tabindex='-1'";
                                }

                                //determine winner radio button
                                $winner_id = $current_m_pool -> {$array_match_ids[0]} -> {$array_match_ids[1]} -> w_id;

                                $f1_w_radio = "";
                                $f2_w_radio = "";
                                if ($winner_id == $f1_id) {
                                    $f1_w_radio = "checked";
                                } elseif ($winner_id == $f2_id) {
                                    $f2_w_radio = "checked";
                                }
                        ?>
                        <div class="match small_scroll <?php echo $szin = ($f1_score == 0 ? "red" : "green"); echo $class_cancel?>">
                            <div class="match_number">
                                <p><?php echo $match_number ?></p>
                            </div>
                            <div>
                                <p><?php echo $f1_name ?></p>
                                <div>
                                    <input <?php echo $disq_atr ?> type="text" form="savepool" placeholder="#" name="<?php echo $array_match_ids[0] . "-" . $array_match_ids[1] ?>" id="f1_sc" class="number_input" value="<?php echo $f1_score ?>">
                                    <input type="radio" form="savepool" name="<?php echo $match_number - 1 ?>" id="<?php echo "1," . $match_number ?>" value="id" disabled <?php echo $f1_w_radio ?>/>
                                    <label for="<?php echo "1," . $match_number ?>" class="collapsed">Winner</label>
                                </div>
                            </div>
                            <div class="vs">
                                <p>VS.</p>
                            </div>
                            <div>
                                <div>
                                    <input <?php echo $disq_atr ?> type="text" form="savepool" placeholder="#" name="<?php echo $array_match_ids[1] . "-" . $array_match_ids[0] ?>" id="f2_sc" class="number_input" value="<?php echo $f2_score ?>">
                                    <input type="radio" form="savepool" name="<?php echo $match_number - 1 ?>" id="<?php echo "2," . $match_number ?>" value="enemy" disabled <?php echo $f2_w_radio ?>/>
                                    <label for="<?php echo "2," . $match_number ?>" class="collapsed">Winner</label>
                                </div>
                                <p><?php echo $f2_name ?></p>
                            </div>
                        </div>
                        <?php
                                $match_number++;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_2.js"></script>
    <script src="javascript/pool_results.js"></script>
    <script src="javascript/overlay_panel.js"></script>
    <script src="javascript/modal.js"></script>
</body>
</html>
