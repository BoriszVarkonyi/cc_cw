<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php include '../includes/sortfunction.php' ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
error_reporting(E_ERROR | E_PARSE);
//This section checks if table has already been gererated;

$qry_check_existance = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
$qry_check_existance_do = mysqli_query($connection, $qry_check_existance);

echo $existance = mysqli_num_rows($qry_check_existance_do);

//START OF TABLE GERERATION

if (isset($_POST["generate_table"])) {

    //GET FORMULA AND FENCERS WHO ARE TAKING PART

    $qry_get_formula = "SELECT * FROM formulas WHERE assoc_comp_id = $comp_id";
    $qry_get_formula_do = mysqli_query($connection, $qry_get_formula);

    if ($row = mysqli_fetch_assoc($qry_get_formula_do)) {

        $formula_json = json_decode($row["data"]);
    }

    print_r($formula_json);

    $fencer_objects = [];

    $qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_check_row = mysqli_query($connection, $qry_check_row);
    if ($row = mysqli_fetch_assoc($do_check_row)) {
        $json_string = $row['data'];
        $json_table = json_decode($json_string);
    } else {
        echo mysqli_error($connection);
    }

    $objects = new ObjSorter($json_table, 'classement');

    $objects_array  = $objects->sorted;

    echo count($objects_array) . " VÍVÓ";

    class tablefencer
    {

        public $name;
        public $nation;
        public $id;
        public $score;
        public $cards;
        public $isWinner;

        function __construct($fencer_obj)
        {
            $this->name = $fencer_obj->prenom . " " . $fencer_obj->nom;
            $this->nation = $fencer_obj->nation;
            $this->id = $fencer_obj->id;
            $this->score = NULL;
            $this->cards = [];
            $this->isWinner = false;
        }
    }

    class referees
    {

        public $name;
        public $nation;
        public $id;

        function __construct()
        {
            $this->name = "";
            $this->nation = "";
            $this->id = NULL;
        }
    }

    class pistetime
    {

        public $id;
        public $pistename;
        public $time;

        function __construct()
        {
            $this->id = NULL;
            $this->pistename = "";
            $this->time = "";
        }
    }

    class emptyfencer
    {

        public $name;
        public $nation;
        public $id;
        public $isWinner;

        function __construct()
        {
            $this->name = "";
            $this->nation = "";
            $this->id = NULL;
            $this->isWinner = false;
        }
    }


    //CHECK WHICH TABLE WILL PROGRAM USE

    $tables = [1, 2, 4, 8, 16, 32, 64, 128, 256, 512, 1024];

    $fencernum = $formula_json->qualifiers;

    foreach ($tables as $x) {

        if ($x >= $fencernum) {
            $tablesize = $x;
            break;
        }
    }

    $f_count = 0;
    foreach ($objects_array as $key => $value) {

        if ($f_count >= $fencernum) {
            break;
        }

        $actualfencer = new tablefencer($value);

        array_push($fencer_objects, $actualfencer);

        $f_count++;
    }

    print_r($fencer_ids);

    $remaining = $tablesize - $fencernum;

    $fencer_empty = new emptyfencer();

    for ($i = 0; $i < $remaining; $i++) {

        array_push($fencer_objects, $fencer_empty);
    }


    //CREATING THE TABLE OBJECT WITH FENCERS
    //INCLUDING: FENCERS(IDS), POINTS(EMPTY), REFREES(EMPTY), PISTE(EMPTY), TIME(EMPTY), WINNER(EMPTY)

    $table_object = new stdClass();

    $isfirst = 0;

    while ($tablesize > 1) {

        $tableorder = tableArrays($tablesize);

        $namevariable = "t_" . $tablesize;

        $match = 1;
        $h_counter = 0;

        for ($i = 0; $i < count($tableorder); $i++) {

            if ($h_counter == 2) {

                $match++;
                $h_counter = 0;
            }

            $postoplace = $tableorder[$i];
            $matchname = "m_" . $match;

            $ref_empty = new referees();
            $pistetime_empty = new pistetime();

            if ($isfirst == 0) {
                $table_object->$namevariable->$matchname->$postoplace = $fencer_objects[$postoplace - 1];
                $table_object->$namevariable->$matchname->referees->ref = $ref_empty;
                $table_object->$namevariable->$matchname->referees->vref = $ref_empty;
                $table_object->$namevariable->$matchname->pistetime = $pistetime_empty;
            } else {
                $table_object->$namevariable->$matchname->$postoplace = "";
                $table_object->$namevariable->$matchname->referees->ref = $ref_empty;
                $table_object->$namevariable->$matchname->referees->vref = $ref_empty;
                $table_object->$namevariable->$matchname->pistetime = $pistetime_empty;;
            }


            $h_counter++;
        }

        $tablesize = $tablesize / 2;
        $isfirst++;
    }

    print_r($fencer_ids);

    foreach ($table_object as $mainkey => $tableturn) {

        foreach ($tableturn as $matches) {

            $fencers = [];
            $keys = [];

            foreach ($matches as $key => $fencer) {

                if ($key == "referees" || $key == "pistetime") {
                    continue;
                }

                //var_dump($key);
                //var_dump($fencer);

                if ($fencer->name != "") {
                    array_push($fencers, $fencer);
                    array_push($keys, $key);
                }

                //HA AZ ARRAY NEM KÉT ELEMŰ AKKOR MEGJEGYZI A KEY-T, ÉS A KÖVI TÁBLÁN BERAKJA ARRA A HELYRE
            }

            if (count($fencers) < 2) {

                $oldtalbe = ltrim($mainkey, "t_");
                $newtable = $oldtalbe / 2;
                $newtable_write = "t_" . $newtable;

                foreach ($table_object->$newtable_write as $matchkey => $m_change) {

                    foreach ($m_change as $down_key => $useless) {

                        if ($down_key == $keys[0]) {

                            var_dump($table_object->$newtable_write->$matchkey->$down_key = $fencers[0]);
                        }
                    }
                }
            }
            //print_r($keys);
            //print_r($fencers);
        }
        break;
    }
    print_r($table_object);

    $toupload = json_encode($table_object);

    echo $insert_table_query = "INSERT INTO tables(`ass_comp_id`, `fencer_num`, `type`, `data`) VALUES ($comp_id,$formula_json->qualifiers,$formula_json->isOnePhase,'$toupload')";
    $insert_table_query_do = mysqli_query($connection, $insert_table_query);

    header("Location: table.php?comp_id=$comp_id");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table of {Comp's name}</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
    <link rel="stylesheet" href="../css/table_style.css">
</head>

<body>
    <!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Table</p>

                <?php
                if ($existance == 0) {
                ?>
                    <form id="generate_table" method="POST" action="">
                    </form>
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button primary" type="submit" name="generate_table" form="generate_table">
                            <p>Generate Table</p>
                            <img src="../assets/icons/add_box-black-18dp.svg" />
                        </button>
                    </div>

                <?php } else { ?>
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button disabled" type="button">
                            <p>Message Fencer</p>
                            <img src="../assets/icons/message-black-18dp.svg" />
                        </button>
                        <button class="stripe_button bold" type="button" onclick="toggleRefPanel()">
                            <p>Referees</p>
                            <img src="../assets/icons/ballot-black-18dp.svg" />
                        </button>
                        <button class="stripe_button bold" type="button" onclick="togglePistTimePanel()">
                            <p>Pistes & Time</p>
                            <img src="../assets/icons/ballot-black-18dp.svg" />
                        </button>
                        <button class="stripe_button primary" type="submit">
                            <p>Start next Round</p>
                            <img src="../assets/icons/next_plan-black-18dp.svg" />
                        </button>
                    </div>
                <?php } ?>
                <div class="view_button_wrapper zoom">
                    <button class="view_button" onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out-black-18dp.svg"/>
                    </button>
                    <button class="view_button" onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in-black-18dp.svg"/>
                    </button>
                </div>
            </div>
            <div id="ref_panel" class="overlay_panel hidden">
                <button class="panel_button" onclick="toggleRefPanel()">
                    <img src="../assets/icons/close-black-18dp.svg">
                </button>
                <form action="" method="post" autocomplete="off" class="overlay_panel_form dense flex">
                    <label for="ref_type">REFEREES CAN MATCH WITH SAME NATIONALITY / CLUB FENCER</label>
                    <div class="option_container row">
                        <input type="checkbox" name="pistes_type" checked id="true" value="" />
                        <label for="true">True</label>
                    </div>
                    <label for="pistes_type">SELECT REFEREES</label>
                    <div class="option_container row">
                        <input type="radio" name="pistes_type" checked id="all_ref" onclick="useAllReferees()" value="" />
                        <label for="all_ref">Use all</label>

                        <input type="radio" name="pistes_type" id="manual_select_ref" onclick="selectReferees()" value="" />
                        <label for="manual_select_ref">Select manually</label>
                    </div>

                    <div class="option_container grid piste_select disabled" id="select_referees_panel">
                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" checked />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" checked />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" checked />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" checked />
                            <label for="piste_1">Piste 1</label>
                        </div>
                    </div>
                    <button type="submit" name="submit" value="Save" class="panel_submit">Save</button>
                </form>
            </div>
            <div id="pist_time_panel" class="overlay_panel hidden">
                <button class="panel_button" onclick="togglePistTimePanel()">
                    <img src="../assets/icons/close-black-18dp.svg">
                </button>
                <form action="" method="post" autocomplete="off" class="overlay_panel_form dense flex">
                    <label for="starting_time">STARTING TIME</label>
                    <input type="time">

                    <label for="interval_of_match">INTERVAL OF MATCH</label>
                    <div id="interval_of_match_wrapper">
                        <input type="number" class="number_input centered">
                        <p>Min.</p>
                    </div>

                    <label for="pistes_type">PISTES</label>
                    <div class="option_container row">
                        <input type="radio" name="pistes_type" checked id="all" onclick="useAllPistes()" value="" />
                        <label for="all">Use all</label>

                        <input type="radio" name="pistes_type" id="manual_select" onclick="selectPistes()" value="" />
                        <label for="manual_select">Select manually</label>
                    </div>

                    <div class="option_container grid piste_select disabled" id="select_pistes_panel">
                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select ghost">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select ghost">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                        <div class="piste_select ghost">
                            <input type="checkbox" name="piste_1" id="piste_1" value="" />
                            <label for="piste_1">Piste 1</label>
                        </div>

                    </div>

                    <button type="submit" name="submit" value="Save" class="panel_submit">Save</button>
                </form>
            </div>
            <div id="page_content_panel_main">
                <!-- State 0 -->
                <?php
                if ($existance == 0) {
                ?>
                    <div id="no_something_panel">
                        <p>You have no table generated!</p>
                    </div>

                <?php } else { ?>
                    <!-- State 1 -->
                    <div id="call_room" class="cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios-black-18dp.svg">
                        </div>

                        <?php

                        $qry_get_table = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
                        $qry_get_table_do = mysqli_query($connection, $qry_get_table);

                        if ($row = mysqli_fetch_assoc($qry_get_table_do)) {

                            $out_table = json_decode($row["data"]);
                        }
                        $r_counter = 1;
                        foreach ($out_table as $key => $tablerounds) { ?>

                            <div id="e_<?php echo $r_counter ?>" class="elimination">
                                <div class="elimination_label">Table of <?php echo ltrim($key, "t_") ?></div>
                                <?php

                                $check = ltrim($key, "t_");

                                if ($check >= 8) {

                                    $change_every = $check / 8;
                                }
                                $innercounter = 0;
                                $changecounter = 1;
                                foreach ($tablerounds as $tablematches) {

                                    if ($innercounter == $change_every) {

                                        $changecounter++;
                                        $innercounter = 0;
                                    }
                                    if ($check >= 8) {

                                        $writecolor = tablecolor($changecounter);
                                    } else {

                                        $writecolor = "Purple";
                                    }
                                ?>

                                    <div class="table_round_wrapper finished <?php echo $writecolor ?>">
                                        <div class="table_round" onclick="tableRoundConfig(this)">

                                            <?php
                                            $firstrun = 0;
                                            foreach ($tablematches as $fencerkey => $tablefencer) {
                                                if ($fencerkey == "referees" || $fencerkey == "pistetime") {
                                                    continue;
                                                }
                                            ?>
                                                <div class="table_fencer">
                                                    <div class="table_fencer_number">
                                                        <p><?php echo $fencerkey ?></p>
                                                    </div>

                                                    <div class="table_fencer_name">
                                                        <p><?php echo $tablefencer->name ?></p>
                                                    </div>
                                                    <div class="table_fencer_nat">
                                                        <p><?php echo $tablefencer->nation ?></p>
                                                    </div>

                                                </div>
                                                <?php
                                                if ($firstrun == 0) { ?>
                                                <div class="table_round_info">
                                                    <div>
                                                        <p>Ref: <?php echo $tablematches->referees->ref->name ?> (<?php echo $tablematches->referees->ref->nation ?>)</p>
                                                        <p><?php echo $tablematches->pistetime->time ?></p>
                                                    </div>
                                                    <div>
                                                        <p>VRef: <?php echo $tablematches->referees->vref->name ?> (<?php echo $tablematches->referees->vref->nation ?>)</p>
                                                        <p>Piste: <?php echo $tablematches->pistetime->pistename ?></p>
                                                    </div>
                                                </div>
                                            <?php }
                                                $firstrun++;
                                            } ?>
                                        </div>

                                    </div>
                                <?php $innercounter++;
                                } ?>
                            </div>

                        <?php
                            $r_counter++;
                        }
                        ?>


                        <div id="e_5" class="elimination">
                            <div class="elimination_label">Table of __</div>
                            <div class="table_round_wrapper finished purple">
                                <div class="table_round" onclick="tableRoundConfig(this)">
                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>25</p>
                                        </div>
                                        <div class="table_fencer_name">
                                            <p>Bida Sergey Bida Sergey Bida</p>
                                        </div>
                                        <div class="table_fencer_nat">
                                            <p>rus</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <div class="color_legend">
                    <div class="green">Finished</div>
                    <div class="yellow">Ongoing</div>
                    <div class="red">Haven't started</div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/table.js"></script>
<script src="../js/overlay_panel.js"></script>

</html>