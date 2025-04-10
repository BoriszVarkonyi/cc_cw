<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
    class deleteRef {
        public $id = null;
        public $prenom = "DELETE";
        public $nom = "current referee";
        public $club = "";
    }
    $delete_obj = new deleteRef();

    class pisteTime {
        public $hours;
        public $minutes;

        function __construct($string) {
            $time_array = explode(':',$string);

            $this -> hours = $time_array[0];
            $this -> minutes = $time_array[1];
        }

        function addTime($mins_to_add) {
            if ($mins_to_add > 60) {
                $hours = floor($mins_to_add / 60);
                $mins = $mins_to_add  % 60;

                $this -> hours += $hours;
                $this -> minutes += $mins;
            } else {
                $this -> minutes += $mins_to_add;
            }

            if ($this -> minutes >= 60) {
                $new_mins = $this -> minutes % 60;
                $plus_hours = floor($this -> minutes / 60);

                $this -> minutes = $new_mins;
                $this -> hours += $plus_hours;
            }

            if ($this -> hours > 24) {
                $new_hours = $this -> hours % 24;

                $this -> hours = $new_hours;
            }

            if (strlen($this ->  hours) === 1) {
                $current_hours = $this -> hours;

                $this -> hours = "0" . $current_hours;
            }

            if (strlen($this ->  minutes) === 1) {
                $current_minutes = $this -> minutes;

                $this -> minutes = "0" . $current_minutes;
            }
        }

        function getTime() {
            $output = $this -> hours . ":" . $this -> minutes;

            return $output;
        }
    }
    $ref_query = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
    $ref_query_do = mysqli_query($connection, $ref_query);
    if ($row = mysqli_fetch_assoc($ref_query_do)) {
        $ref_string = $row['data'];
        $ref_table = json_decode($ref_string);
    }

    $qry_check_row = "SELECT `fencers`, `pool_of`, `sort_by_club` FROM `pools` WHERE `assoc_comp_id` = '$comp_id'";
    $do_check_row = mysqli_query($connection, $qry_check_row);
    if ($row = mysqli_fetch_assoc($do_check_row)) {
        $json_string = $row['fencers'];
        $json_table = json_decode($json_string);
        $pool_of = $row['pool_of'];
        $sort_by_class = $row['sort_by_club'];

        //detrmine sorting attribute
        if ($sort_by_class) {
            $sort_by = "club";
        } else {
            $sort_by = "nation";
        }
    } else {
        echo mysqli_error($connection);
    }

    if (isset($_POST['save_pools'])) {
        $saved_pools_string = $_POST['save_pools_hidden_input'];
        $saved_fencers_table = json_decode($saved_pools_string);

        for ($pool_num = 0; $pool_num < count($saved_fencers_table); $pool_num++) {
            $real_pool_num = $pool_num + 1;
            $json_table[$real_pool_num] -> nationality = [];
            for ($fencer_num = 0; $fencer_num < $pool_of; $fencer_num++) {
                $real_fencer_num = $fencer_num + 1;
                $json_table[$real_pool_num] -> $real_fencer_num = $saved_fencers_table[$pool_num][$fencer_num];
                array_push($json_table[$real_pool_num] -> nationality, $saved_fencers_table[$pool_num][$fencer_num] -> $sort_by);
            }
        }

        $json_table = array_values($json_table);
        //update db
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        $qry_update = "UPDATE `pools` SET `fencers` = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        $do_update = mysqli_query($connection, $qry_update);

        header("Refresh:0");
    }

    //only after piste drawing
    //referee drawing
    if (isset($_POST['draw_ref'])) {
        $fail = "";
        $ref_can = $_POST['ref_can'];
        $referees = $_POST['ref_select'];
        $number_of_refs = $_POST['number_of_refs'];
        //get referees from db
        $qry_get_refs = "SELECT `data` FROM `referees` WHERE `assoc_comp_id` = $comp_id";
        $do_get_refs = mysqli_query($connection, $qry_get_refs);
        if ($row = mysqli_fetch_assoc($do_get_refs)) {
            $refs_string = $row['data'];
            $refs_table = json_decode($refs_string);
        }
        $selected_refs_array = [];

        //choose referees
        if ($referees == "manual_select_ref") {
            for ($i = 0; $i < $number_of_refs; $i++) {
                if (isset($_POST["ref_$i"])) {
                    $ref_id = $_POST["ref_$i"];
                    if (($id_to_find = findObject($refs_table, $ref_id, "id")) !== false) {
                        array_push($selected_refs_array, $refs_table[$id_to_find]);
                    } else {
                        $fail = "couldn't find id among referees";
                    }
                }
            }
        } else {
            $selected_refs_array = array_values($refs_table);
        }

        //draw refs
        if ($ref_can == 1) {
            $ref_counter = 0;
            //go through pools
            for ($pool_num = 1; $pool_num < count($json_table); $pool_num++) {
    
                //assigne ref to pools then go to next ref
                $json_table[$pool_num] -> ref1 = $selected_refs_array[$ref_counter];

				if (count($selected_refs_array) > $ref_counter + 1) {
                    $ref_counter++;
                } else {
                    $ref_counter = 0;
                }
                           
			}
	
        } else {
            //referees can't match with own nationality
            for ($pool_num = 1; $pool_num < count($json_table); $pool_num++) {
                foreach ($selected_refs_array as $key => $ref_obj) {
                    if (false === array_search($ref_obj -> $sort_by, $json_table[$pool_num] -> nationalitys)) {
                        $json_table[$pool_num] -> ref1 = $ref_obj;
                        unset($selected_refs_array[$key]);
                        $selected_refs_array = array_values($selected_refs_array);
                        break;
                    }
                }

                if ($json_table[$pool_num] -> ref1 == NULL) {
                    $json_table[$pool_num] -> ref1 = $selected_refs_array[0];
                    $ref1_nat = $selected_refs_array[0] -> $sort_by;
                    unset($selected_refs_array[0]);
                    $selected_refs_array = array_values($selected_refs_array);

                    //search for 2nd ref
                    foreach ($selected_refs_array as $key => $ref2_obj) {
                        if ($ref2_obj -> $sort_by != $ref1_nat) {
                            $json_table[$pool_num] -> ref2 = $ref2_obj;
                            unset($selected_refs_array[$key]);
                            $selected_refs_array = array_values($selected_refs_array);
                            break;
                        }
                    }

                    if ($json_table[$pool_num] -> ref2 == NULL) {
                        $fail = "REFEREE NATIONALITYS ARE NOT DIVERSE ENOUGH";
                        break;
                    }
                }
            }
        }

        if ($fail == "") {
            $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
            $qry_update_r = "UPDATE `pools` SET `fencers` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
            $do_update_r = mysqli_query($connection, $qry_update_r);
        } else {
            echo $fail;
        }
    }

    //piste
    if (isset($_POST['piste_time'])) {

        //get table from db
        $qry_get_pistes = "SELECT `data` FROM `pistes` WHERE `assoc_comp_id` = '$comp_id'";
        $do_get_pistes = mysqli_query($connection, $qry_get_pistes);
        if ($row = mysqli_fetch_assoc($do_get_pistes)) {
            $piste_string = $row['data'];
            $piste_table = json_decode($piste_string);
        }

        //get data from form
        $piste_usage = $_POST['pistes_usage_type'];
        $piste_time_add = $_POST['interval_of_match'];
        $piste_start_s = $_POST['starting_time'];

        //new pisteTime obj
        $piste_time = new pisteTime($piste_start_s);

        $pistes_array = [];

        //select pistes based on input
        if ($piste_usage == 1) {
            $pistes_array = $piste_table;
        } else {
            for ($i =  0; $i < count($piste_table); $i++) {
                if (isset($_POST["piste_$i"])) {
                    array_push($pistes_array, $piste_table[$i]);
                }
            }
        }

        //draw pistes
        $piste_counter = -1;
        for ($pool_num = 1; $pool_num < count($json_table); $pool_num++) {
            $piste_counter++;
            //set back counter if we ran out of pistes
            if (!isset($pistes_array[$piste_counter])) {
                $piste_counter = 0;
                $piste_time -> addTime($piste_time_add);
            }
            $current_piste_name = $pistes_array[$piste_counter] -> name;
            $current_piste_time = $piste_time -> getTime();

            $json_table[$pool_num] -> piste = $current_piste_name;
            $json_table[$pool_num] -> time = $current_piste_time;
        }

        //update db
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
        $qry_update_p = "UPDATE `pools` SET `fencers` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
        $do_update_p = mysqli_query($connection, $qry_update_p);

        header("Refresh:0");
    }

    if (isset($_POST['start_pools'])) {


        class match {
            public $w_id = NULL;
            public $given = 0;
            public $gotten = 0;
            public $id;
            public $enemy;

            function __construct($id, $enemy) {
                $this -> id = $id;
                $this -> enemy = $enemy;
            }
        }

        class matches {
            function __construct($pool_num, $number_of_fencers, $start, $json_table) {
                for ($j = $start + 1; $j <= $number_of_fencers; $j++) {

                    $id = $json_table[$pool_num] -> {$start} -> id;
                    $enemy = $json_table[$pool_num] -> {$j} -> id;

                    $this -> {$j} = new match($id, $enemy);
                }
            }
        }

        function getNumberOfFencers($json_table, $pool_num) {
            for ($i = 7; $i > 0; $i--) {
                if (isset($json_table[$pool_num] -> {$i})) {
                    return $i;
                }
            }
        }

        class pool {

            function __construct($pool_num, $json_table) {
                $number_of_fencers = getNumberOfFencers($json_table, $pool_num);

                for ($i = 1; $i < $number_of_fencers; $i++) {
                    $this -> {$i} = new matches($pool_num, $number_of_fencers, $i, $json_table);
                }
            }
        }

        $array_of_pools = [];

        for ($pool_num = 1; $pool_num < count($json_table); $pool_num++) {
            $pool_obj = new pool($pool_num, $json_table);

            array_push($array_of_pools, $pool_obj);
        }

        //update databse
        $json_string = json_encode($array_of_pools, JSON_UNESCAPED_UNICODE);
        $qry_upadte_matches = "UPDATE `pools` SET `matches` = '$json_string'";
        $do_update_matches = mysqli_query($connection, $qry_upadte_matches);

        header("Location: ../cc/pools_view.php?comp_id=$comp_id");
    }

    if (isset($_POST['sumbit_changes'])) {
        //get data
        $ref1id = $_POST['ref1id_input'];
        $ref1id = explode("*", $ref1id)[1];

        $ref2id = $_POST['ref2id_input'];
        $ref2id = explode("*", $ref2id)[1];

        $piste_id = $_POST['piste_id_input'];
        $piste_id = explode('*', $piste_id)[1];

        $current_pool_num = $_POST['pool_num_input'];
        $string_time = $_POST['input_time'];

        //get current pool into var
        $current_pool = $json_table[$current_pool_num];

        //get time
        $time = new pisteTime($string_time);
        if ($ref1id == null || $ref2id == null) {
            if ($ref1id == null) {
                $current_pool -> ref1 = null;
            }
            if ($ref2id == null) {
                $current_pool -> ref2 = null;
            }
        }

        if ($ref1id != "" || $ref2id != "") {
            //get refs
            $qry_get_refs = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
            $do_get_refs = mysqli_query($connection, $qry_get_refs);

            if ($row = mysqli_fetch_assoc($do_get_refs)) {
                $ref_string = $row['data'];
                $ref_table = json_decode($ref_string);
            }
            //set new ref to ref spots
            if ($ref1id != "") {
                if (($ref_id_array = findObject($ref_table, $ref1id, "id")) !== false) {
                    $current_pool -> ref1 = $ref_table[$ref_id_array];
                } else {
                    echo "coulndt find id: 1";
                }
            }

            if ($ref2id != "") {
                if (($ref_id_array = findObject($ref_table, $ref2id, "id")) !== false) {
                    $current_pool -> ref2 = $ref_table[$ref_id_array];
                } else {
                    echo "coulndt find id: 2";
                }
            }
        }

        if ($piste_id != "") {
            $current_pool -> piste = $piste_id;
        }

        $json_table[$current_pool_num] = $current_pool;

        //update database
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        $qry_update = "UPDATE `pools` SET `fencers` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
        if ($do_update = mysqli_query($connection, $qry_update)) {
            header("Refresh: 0");
        } else {
            echo mysqli_error($connection);
        }
    }

    //revert poool
    if (isset($_POST['revert_pool'])) {
        $qry_del_row = "DELETE FROM pools WHERE assoc_comp_id = '$comp_id'";
        if (mysqli_query($connection, $qry_del_row)) {
            header("Location: pools_generate.php?comp_id=$comp_id");
        } else {
            echo "error";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pools of <?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_pools_style.min.css" media="print">
</head>
<body>
    <div class="modal_wrapper hidden" id="modal_1">
        <div class="modal">
            <div class="modal_header red">
                <p class="modal_title">You reached this pool's limit. You cannot put more fencers into this pool.</p>
                <p class="modal_subtitle">The fencer has been relocated to it's previous position.</p>
            </div>
            <div class="modal_footer">
                <div class="modal_footer_content">
                    <button class="modal_confirmation_button" onclick="toggleModal(1)">Okay</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/navigation.php"; ?>
    <main class="with_aside">
        <div id="title_stripe">
            <p class="page_title">Configure Pools</p>
            <div class="stripe_button_wrapper">

                <button class="stripe_button" type="button" onclick="window.print()" id='printPools' shortcut="SHIFT+P">
                    <p>Print Pools</p>
                    <img src="../assets/icons/print_black.svg"/>
                </button>

                <button class="stripe_button bold" type="button" onclick="toggleRefPanel()" id="referees" shortcut="SHIFT+R">
                    <p>Referees</p>
                    <img src="../assets/icons/ballot_black.svg"/>
                </button>

                <button class="stripe_button bold" type="button" onclick="togglePistTimePanel()" id="pistesNTimeBt" shortcut="SHIFT+T">
                    <p>Pistes & Time</p>
                    <img src="../assets/icons/ballot_black.svg"/>
                </button>

                <button class="stripe_button bold" type="button" onclick="reloadByCookie()">
                    <p>Restore changes</p>
                    <img src="../assets/icons/restore_page_black.svg"/>
                </button>

                <form action="" method="POST">
                    <button class="stripe_button primary" type="submit" name="start_pools" id="startPoolsBt" shortcut="SHIFT+ENTER">
                        <p>Start Pools</p>
                        <img src="../assets/icons/outlined_flag_black.svg"/>
                    </button>
                </form>

                <form action="" method="POST">
                    <button class="stripe_button primary" type="submit" name="revert_pool" id="startPoolsBt" shortcut="SHIFT+ENTER">
                        <p>Revert Pool</p>
                        <img src="../assets/icons/outlined_flag_black.svg"/>
                    </button>
                </form>

                <form method="POST" action="">
                    <input class="hidden" type="text" name="save_pools_hidden_input" id="savePoolsHiddenInput" readonly>
                    <button class="stripe_button primary" name="save_pools" onclick="savePools()" type="submit" id="savePoolsBt" shortcut="SHIFT+S">
                        <p>Save Pools</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </form>
            </div>
            <div id="ref_panel" class="overlay_panel hidden">
                <button class="panel_button" name="Close panel" onclick="toggleRefPanel()">
                    <img src="../assets/icons/close_black.svg">
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
                    <div class="option_container row no_bottom">
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

                        $ref_counter = 0;
                        foreach ($ref_table as $ref_obj) {
                            $refid = $ref_obj -> id;
                            $prenom_nom = $ref_obj -> prenom . $ref_obj -> nom;
                            $ref_nat = $ref_obj -> $sort_by;

                            $value_array = [
                                $refid,
                                $prenom_nom,
                                $ref_nat
                            ];

                        ?>

                            <div class="piste_select">
                                <input type="checkbox" name="ref_<?php echo $ref_counter ?>" id="ref_<?php echo $refid ?>" value="<?php echo $refid ?>"/>
                                <label for="ref_<?php echo $refid ?>"><?php echo $prenom_nom ?></label>
                            </div>

                        <?php
                            $ref_counter++;
                        }

                        ?>
                    </div>
                    <input type="number" name="number_of_refs" value="<?php echo $ref_counter?>" id="number_of_refs" hidden/>
                    <button type="submit" name="draw_ref" value="Save" class="panel_submit" id="rfrsSaveButton">Save</button>
                </form>
            </div>
            <div id="pist_time_panel" class="overlay_panel hidden">
                <button class="panel_button" name="Close panel" onclick="togglePistTimePanel()">
                    <img src="../assets/icons/close_black.svg">
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
                    <div class="option_container row no_bottom">
                        <input type="radio" name="pistes_usage_type" checked id="all" onclick="useAllPistes()" value="1"/>
                        <label for="all">Use all</label>

                        <input type="radio" name="pistes_usage_type" id="manual_select" onclick="selectPistes()" value="2"/>
                        <label for="manual_select">Select manually</label>
                    </div>

                    <div class="option_container grid piste_select disabled" id="select_pistes_panel">

                        <?php

                        $qry_get_pistes = "SELECT `data` FROM `pistes` WHERE `assoc_comp_id` = '$comp_id'";
                        $do_get_pistes = mysqli_query($connection, $qry_get_pistes);

                        if ($row = mysqli_fetch_assoc($do_get_pistes)) {
                            $piste_string = $row['data'];
                            $piste_table = json_decode($piste_string);
                        }

                        $r = 0;
                        foreach ($piste_table as $piste_obj) {

                            $pistenum = $piste_obj -> name;
                            $pistecolor = $piste_obj -> color;

                        ?>


                            <div class="piste_select">
                                <input type="checkbox" name="piste_<?php echo $r ?>" id="piste_<?php echo $r ?>" value="1"/>
                                <label for="piste_<?php echo $r ?>">Piste
                                <?php
                                    echo $pistenum;
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
            <div class="wrapper entry_wrapper">
                <?php
                    $number_of_pools = count($json_table);

                    for ($pool_num = 1; $pool_num < $number_of_pools; $pool_num++) {

                        $ref2name = "";
                        $ref2nat = "";
                        $ref2id = "";
                        if ($json_table[$pool_num] -> ref1 !==  NULL) {
                            $refname = $json_table[$pool_num] -> ref1 -> prenom . " " . $json_table[$pool_num] -> ref1 -> nom;
                            $refnat = $json_table[$pool_num] -> ref1 -> $sort_by;
                            $ref1id = $json_table[$pool_num] -> ref1 -> id;

                            if ($json_table[$pool_num] -> ref2 !==  NULL) {
                                $ref2name = $json_table[$pool_num] -> ref2 -> prenom . " " . $json_table[$pool_num] -> ref2 -> nom;
                                $ref2nat = $json_table[$pool_num] -> ref2 -> $sort_by;
                                $ref2id = $json_table[$pool_num] -> ref2 -> id;
                            }
                        } else {
                            $refname = "";
                            $refnat = "";
                        }

                        $piste = $json_table[$pool_num] -> piste;
                        $time = $json_table[$pool_num] -> time;
                    ?>
                    <div class="entry" id="entry_<?php echo $pool_num ?>">
                        <form name="change_ref" class="tr bold clickable" method="POST" onclick="selectEntry(this)">
                            <input type="text" name="pool_num_input" value="<?php echo $pool_num ?>" class="hidden" readonly>
                            <div class="td bold">No.<?php echo $pool_num ?></div>
                            <div class="td">
                                <p>Piste <?php echo $piste?></p>

                                <div class="search_wrapper narrow hidden">
                                    <button type="button" class="search select input" onfocus="isOpen(this)" onblur="isClosed(this)" tabindex="3">

                                        <!-- EZ AZ ID -->
                                        <input type="text" class="hidden" name="piste_id_input" value="<?php echo $piste ?>" readonly>

                                        <!-- IDE KELL BECHOZNI -->
                                        <input type="text" value="<?php echo $piste ?>" placeholder="Select Piste" readonly>

                                    </button>
                                    <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg"></button>
                                    <div class="search_results">

                                            <?php
                                                $qry_get_pistes = "SELECT data FROM pistes WHERE assoc_comp_id = '$comp_id'";
                                                $do_get_pistes = mysqli_query($connection, $qry_get_pistes);
                                                if ($row = mysqli_fetch_assoc($do_get_pistes)) {
                                                    $pists_array = json_decode($row['data']);
                                                }

                                                foreach ($pists_array as $piste_obj) {
                                                    $piste_name = $piste_obj -> name;
                                                    $piste_color = $piste_obj -> color;
                                                    $piste_url = $piste_obj -> url;

                                            ?>
                                            <button type="button" id="<?php echo $pool_num . "*" . $piste_name ?>" onclick="selectSystemExtended(this)">Piste <?php echo $piste_name ?></button>
                                            <?php } ?>
                                    </div>
                                </div>

                            </div>
                            <div class="td">
                                <p>
                                Ref 1: <?php
                                if (isset($refname)) {

                                    echo $refname;
                                    echo "(" . $refnat . ")";
                                } else {
                                    echo "No ref assigned!";
                                }
                                ?>
                                </p>
                                <div class="search_wrapper narrow hidden">
                                    <button type="button" class="search select input" onfocus="isOpen(this)" onblur="isClosed(this)" tabindex="3">

                                        <!-- EZ AZ ID -->
                                        <input type="text" name="ref1id_input" value="<?php echo $ref1id ?>" class="hidden" readonly>

                                        <!-- IDE KELL BECHOZNI -->
                                        <input type="text" placeholder="Select Referee" value="<?php echo $refname ?>" readonly>

                                    </button>
                                    <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg"></button>
                                    <div class="search_results">

                                            <?php


                                                $refs_array = [$delete_obj];
                                                $qry_get_refs = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
                                                $do_get_refs = mysqli_query($connection, $qry_get_refs);
                                                if ($row = mysqli_fetch_assoc($do_get_refs)) {
                                                    $refs_array += json_decode($row['data']);
                                                }

                                                foreach ($refs_array as $ref_obj) {

                                                    $ref_name = $ref_obj -> prenom . " " . $ref_obj -> nom;
                                                    $ref_id = $ref_obj -> id;
                                                    if ($sort_by_class) {
                                                        $ref_nation = $ref_obj -> club;
                                                    } else {
                                                        $ref_nation = $ref_obj -> nation;
                                                    }

                                            ?>
                                            <button type="button" id="<?php echo "1" . $pool_num . "*" . $ref_id ?>" onclick="selectSystemExtended(this)"><?php echo $ref_name . " (" . $ref_nation . ")"  ?></button>
                                            <?php } ?>
                                    </div>
                                </div>
                            </div>


                            <div class="td">
                                <p> Ref 2: <?php echo $ref2name ?> (<?php echo $ref2nat ?>)</p>
                                <div class="search_wrapper narrow hidden">
                                    <button type="button" class="search select input" onfocus="isOpen(this)" onblur="isClosed(this)" tabindex="3">

                                        <!-- EZ AZ ID -->
                                        <input type="text" class="hidden" value="<?php echo $ref2id ?>" name="ref2id_input" readonly>

                                        <!-- IDE KELL BECHOZNI -->
                                        <input type="text" placeholder="Select Referee" value="<?php echo $ref2name ?>" readonly>

                                    </button>
                                    <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg"></button>
                                    <div class="search_results">
                                        <?php
                                                $qry_get_refs = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
                                                $do_get_refs = mysqli_query($connection, $qry_get_refs);
                                                if ($row = mysqli_fetch_assoc($do_get_refs)) {
                                                    $refs_array = json_decode($row['data']);
                                                }

                                                foreach ($refs_array as $ref_obj) {

                                                    $ref_name = $ref_obj -> prenom . " " . $ref_obj -> nom;
                                                    $ref_id = $ref_obj -> id;
                                                    if ($sort_by_class) {
                                                        $ref_nation = $ref_obj -> club;
                                                    } else {
                                                        $ref_nation = $ref_obj -> nation;
                                                    }
                                            ?>
                                            <button type="button" id="<?php echo "2" . $pool_num . "*" . $ref_id ?>" onclick="selectSystemExtended(this)"><?php echo $ref_name . " (" . $ref_nation . ")"  ?></button>
                                            <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="td">
                                <p><?php echo $time ?></p>
                                <input type="time" name="input_time" value="<?php echo $time ?>"  class="pool_time_input centered hidden">
                            </div>
                            <div class="td square">
                                <button type="button" onclick="poolConfig(this)" class="pool_config_button">
                                    <img src="../assets/icons/settings_black.svg">
                                </button>
                            </div>
                            <button name="sumbit_changes" type="submit"  class="pool_config_submit hidden">Save</button>
                        </form>
                        <div class="entry_panel">
                            <table class="no_interaction">
                                <thead>
                                    <tr>
                                        <th>
                                            <p>NAME</p>
                                        </th>
                                        <th>
                                            <p>CLUB</p>
                                        </th>
                                        <th>
                                            <p>CP</p>
                                        </th>
                                        <th>
                                            <p>PR</p>
                                        </th>
                                        <th class="wide_controls">
                                            <p>CONTROLS</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="alt">
                                    <?php
                                        for ($fencer_number = 1;$fencer_number <= $pool_of && isset($json_table[$pool_num] -> $fencer_number); $fencer_number++) {

                                            $fencer_name = $json_table[$pool_num] -> $fencer_number -> prenom_nom;
                                            $fencer_nat = $json_table[$pool_num] -> $fencer_number -> $sort_by;
                                            $fencer_id = $json_table[$pool_num] -> $fencer_number -> id;
                                            $fencer_cp = $json_table[$pool_num] -> $fencer_number -> c_pos;
                                            $fencer_rp = $json_table[$pool_num] -> $fencer_number -> r_pos;

                                            $json_string_obj = json_encode($json_table[$pool_num] -> $fencer_number,JSON_UNESCAPED_UNICODE);
                                    ?>

                                    <tr>
                                        <td>
                                            <p id="<?php echo $fencer_id ?>" x-fencersave='<?php echo $json_string_obj ?>'><?php echo $fencer_name ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $fencer_nat ?></p>
                                        </td>
                                        <td class="square">
                                            <p><?php echo $fencer_cp ?></p>
                                        </td>
                                        <td class="square">
                                            <p><?php echo $fencer_rp ?></p>
                                        </td>
                                        <td class="wide_controls">
                                            <button type="button" onclick="moveFencer(this, false)">
                                                <img src="../assets/icons/arrow_upward_black.svg">
                                            </button>
                                            <button type="button" onclick="moveFencer(this, true)">
                                                <img src="../assets/icons/arrow_downward_black.svg">
                                            </button>
                                            <button type="button" onclick="moveFencerAside(this)">
                                                <img src="../assets/icons/last_page_black.svg">
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <?php
                }
                    ?>

                <input type="text" name="pool_of" id="pool_of" class="hidden" value="<?php echo $pool_of ?>" readonly/>
            </div>
        </div>
        <aside>
            <div id="aside_content">
                <div id="fencer_holder">

                    <!--
                    <div class="fencer">
                        <button type="button" onclick="moveFencerBack(this)">
                            <img src="../assets/icons/keyboard_double_arrow_left_black.svg">
                        </button>
                        <p>name</p>
                    </div>
                    -->

                </div>
            </div>
        </aside>
        <button class="aside_button" type="button" onclick="closeAside()">
            <img src="../assets/icons/last_page_black.svg">
        </button>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/overlay_panel.js"></script>
    <script src="javascript/modal.js"></script>
    <script src="javascript/search.js"></script>
    <script src="javascript/pools_config.js"></script>
</body>
</html>