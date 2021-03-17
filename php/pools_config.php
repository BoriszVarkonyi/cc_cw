<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    $qry_check_row = "SELECT * FROM pools WHERE assoc_comp_id = '$comp_id'";
    $do_check_row = mysqli_query($connection, $qry_check_row);
    if ($row = mysqli_fetch_assoc($do_check_row)) {
        $json_string = $row['data'];
        $json_table = json_decode($json_string);
        $pool_of = $row['pool_of'];
    } else {
        echo mysqli_error($connection);
    }
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
                <p class="page_title">Configure Pools</p>
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
                            <input type="radio" name="ref_can" id="false" value="0" checked/>
                            <label for="false">False</label>
                            <input type="radio" name="ref_can" id="true" value="1"/>
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

                            $ref_query = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
                            $ref_query_do = mysqli_query($connection, $ref_query);
                            if ($row = mysqli_fetch_assoc($ref_query_do)) {
                                $ref_string = $row['data'];
                                $ref_table = json_decode($ref_string);
                            }


                            foreach ($ref_table as $ref_obj) {
                                $refid = $ref_obj -> id;
                                $prenom_nom = $ref_obj -> prenom . $ref_obj -> nom;
                                $ref_nat = $ref_obj -> nation;

                            ?>

                                <div class="piste_select">
                                    <input type="checkbox" name="ref_<?php echo $refid ?>" id="ref_<?php echo $refid ?>" value="value1"/>
                                    <label for="ref_<?php echo $refid ?>"><?php echo $prenom_nom ?></label>
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
                            <input type="number" class="number_input centered" name="interval_of_match" id="timeInput" placeholder="#">
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
                                    <label for="piste_<?php echo $r ?>">Piste
                                    <?php

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
            </div>



            <div id="page_content_panel_main">
                <div id="pools_wrapper" class="wrapper">
                    <div id="pool_listing" class="with_drag">

                        <?php
                            $number_of_pools = count($json_table);

                            for ($pool_num = 1; $pool_num < $number_of_pools; $pool_num++) {

                                $ref2name = "";
                                $ref2nat = "";
                                if ($json_table[$pool_num] -> ref1 !==  NULL) {
                                    $refname = $json_table[$pool_num] -> ref1 -> name;
                                    $refnat = $json_table[$pool_num] -> ref1 -> nation;

                                    if ($json_table[$pool_num] -> ref2 !==  NULL) {
                                        $ref2name = $json_table[$pool_num] -> ref2 -> name;
                                        $ref2nat = $json_table[$pool_num] -> ref2 -> nation;
                                    }
                                }

                                $piste = "Blue";
                                $time = "2:00";
                            ?>
                            <div>
                                <div class="entry">
                                    <div class="table_row">
                                        <div class="table_item bold">No.<?php echo $pool_num ?></div>
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
                                                    Rp
                                                </div>

                                            </div>
                                            <div class="table_row_wrapper alt" ondragover="tableWrapperHoverOn(this)" ondragleave="tableWrapperHoverOff(this)">
                                                <div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>
                                                <?php
                                                    for ($fencer_number = 1;$fencer_number <= $pool_of && isset($json_table[$pool_num] -> $fencer_number); $fencer_number++) {

                                                        $fencer_name = $json_table[$pool_num] -> $fencer_number -> prenom_nom;
                                                        $fencer_nat = $json_table[$pool_num] -> $fencer_number -> nation;
                                                        $fencer_id = $json_table[$pool_num] -> $fencer_number -> id;
                                                        $fencer_cp = $json_table[$pool_num] -> $fencer_number -> c_pos;
                                                        $fencer_rp = $json_table[$pool_num] -> $fencer_number -> r_pos;
                                                ?>

                                                    <div class="table_row">
                                                        <div class="table_item">
                                                            <p class="drag_fencer" draggable="true" ondragstart="drag(event, this)" ondragend="dragEnd(this)" id="<?php echo $fencer_id ?>"><?php echo $fencer_name ?></p>
                                                        </div>
                                                        <div class="table_item">
                                                            <p><?php echo $fencer_nat ?></p>
                                                        </div>
                                                        <div class="table_item square">
                                                            <p><?php echo $fencer_cp ?></p>
                                                        </div>
                                                        <div class="table_item square">
                                                            <p><?php echo $fencer_rp ?></p>
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