<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$qry_check_row = "SELECT data FROM tables WHERE ass_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
} else {
    echo mysqli_error($connection);
}

$tableround = $_GET["table_round"];
$matchid = $_GET["match_id"];

$actualobject = $json_table->$tableround->$matchid;


if (isset($_POST["save_match"])) {

    print_r($_POST);

    //Creating empty objects
    $fencer1_data = new stdClass;
    $fencer2_data = new stdClass;

    $fencer1_cards = [];
    $fencer2_cards = [];

    //fencer1 data
    $fencer1_data->id = $_POST["fencid_1"];
    $fencer1_data->points = $_POST["points_f1"];


    array_push($fencer1_cards, $_POST["f1_y"]);
    array_push($fencer1_cards, $_POST["f1_r"]);
    array_push($fencer1_cards, $_POST["f1_b"]);
    array_push($fencer1_cards, $_POST["f1_y_p"]);
    array_push($fencer1_cards, $_POST["f1_r_p"]);
    array_push($fencer1_cards, $_POST["f1_b_p"]);

    //fencer2 data
    $fencer2_data->id = $_POST["fencid_2"];
    $fencer2_data->points = $_POST["points_f2"];


    array_push($fencer2_cards, $_POST["f2_y"]);
    array_push($fencer2_cards, $_POST["f2_r"]);
    array_push($fencer2_cards, $_POST["f2_b"]);
    array_push($fencer2_cards, $_POST["f2_y_p"]);
    array_push($fencer2_cards, $_POST["f2_r_p"]);
    array_push($fencer2_cards, $_POST["f2_b_p"]);


    //decide WINNER system

    $winnerfencer = 0;

    if ($fencer1_data->points == "ABD") {

        $winnerfencer = 2;
    } elseif ($fencer2_data->points == "ABD") {

        $winnerfencer = 1;
    } elseif ($fencer1_data->points == "EXC") {

        $winnerfencer = 2;
    } elseif ($fencer2_data->points == "EXC") {

        $winnerfencer = 1;
    } elseif ($fencer1_data->points == "NCB") {

        $winnerfencer = 2;
    } elseif ($fencer2_data->points == "NCB") {

        $winnerfencer = 1;
    } elseif ($fencer1_data->points > $fencer2_data->points) {

        $winnerfencer = 1;
    } elseif ($fencer2_data->points > $fencer1_data->points) {

        $winnerfencer = 2;
    } elseif ($fencer1_data->points == $fencer2_data->points) {

        if ($_POST["draw_winner"] == 1) {

            $winnerfencer = 1;
        } elseif ($_POST["draw_winner"] == 2) {

            $winnerfencer = 2;
        }
    }

    //Move winner fencer to next table
    $nextplace = 1024;
    foreach ($actualobject as $key => $value) {
        if ($key == "referees" || $key == "pistetime") {
            continue;
        } else {

            if ($nextplace > $key) {
                $nextplace = $key;
            }
        }
    }

    //searching and modifying fencer1 data
    foreach ($actualobject as $key => $value) {

        if ($fencer1_data->id == $value->id) {

            $json_table->$tableround->$matchid->$key->score = $fencer1_data->points;
            $json_table->$tableround->$matchid->$key->cards = $fencer1_cards;

            if ($winnerfencer == 1) {

                $json_table->$tableround->$matchid->$key->isWinner = true;
                $objtomove = $json_table->$tableround->$matchid->$key;
            }

            break;
        }
    }

    //searching and modifying fencer2 data
    foreach ($actualobject as $key => $value) {

        if ($fencer2_data->id == $value->id) {

            $json_table->$tableround->$matchid->$key->score = $fencer2_data->points;
            $json_table->$tableround->$matchid->$key->cards = $fencer2_cards;

            if ($winnerfencer == 2) {

                $json_table->$tableround->$matchid->$key->isWinner = true;
                $objtomove = $json_table->$tableround->$matchid->$key;
            }

            break;
        }
    }

    $next_table =  "t_" . ltrim($tableround, "t_") / 2;

    foreach ($json_table->$next_table as $m_key => $nextmatch) {
        foreach ($nextmatch as $key => $value) {

            if ($nextplace == $key) {
                $json_table->$next_table->$m_key->$key->name = $objtomove->name;
                $json_table->$next_table->$m_key->$key->nation = $objtomove->nation;
                $json_table->$next_table->$m_key->$key->id = $objtomove->id;
                $json_table->$next_table->$m_key->$key->score = "";
                $json_table->$next_table->$m_key->$key->cards = [];
                $json_table->$next_table->$m_key->$key->isWinner = false;
            }
        }
    }

    echo $table_upload = json_encode($json_table, JSON_UNESCAPED_UNICODE);

    $qry_upload_table = "UPDATE tables SET data = '$table_upload' WHERE ass_comp_id = $comp_id";
    $qry_upload_table_do = mysqli_query($connection, $qry_upload_table);

    if (!$qry_upload_table_do) {
        echo mysqli_error($connection);
    }

    header("Location: table.php?comp_id=$comp_id");
}


//Get referee object for future use

$qry_get_data = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $data = $row['data'];

    $refereearray = json_decode($data);
}


//Get piste object for future use

$qry_get_data = "SELECT data FROM pistes WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $data = $row['data'];

    $pistearray = json_decode($data);
}

//Handle changes (ref, vref, piste, time)

if (isset($_POST["ref_change"])) {

    $refdatastring = $_POST["ref_change_data"];
    $refdataarray = explode(",", $refdatastring);

    $json_table->$tableround->$matchid->referees->ref->id = $refdataarray[0];
    $json_table->$tableround->$matchid->referees->ref->name = $refdataarray[1];
    $json_table->$tableround->$matchid->referees->ref->nation = $refdataarray[2];
    $json_table->$tableround->$matchid->referees->ref->club = $refdataarray[3];

    $table_upload = json_encode($json_table, JSON_UNESCAPED_UNICODE);

    $qry_upload_table = "UPDATE tables SET data = '$table_upload' WHERE ass_comp_id = $comp_id";
    echo $qry_upload_table_do = mysqli_query($connection, $qry_upload_table);

    header("Location: match_results.php?comp_id=$comp_id&table_round=$tableround&match_id=$matchid");
}

if (isset($_POST["vref_change"])) {

    $refdatastring = $_POST["vref_change_data"];
    $refdataarray = explode(",", $refdatastring);

    $json_table->$tableround->$matchid->referees->vref->id = $refdataarray[0];
    $json_table->$tableround->$matchid->referees->vref->name = $refdataarray[1];
    $json_table->$tableround->$matchid->referees->vref->nation = $refdataarray[2];
    $json_table->$tableround->$matchid->referees->vref->club = $refdataarray[3];

    $table_upload = json_encode($json_table, JSON_UNESCAPED_UNICODE);

    $qry_upload_table = "UPDATE tables SET data = '$table_upload' WHERE ass_comp_id = $comp_id";
    $qry_upload_table_do = mysqli_query($connection, $qry_upload_table);

    header("Location: match_results.php?comp_id=$comp_id&table_round=$tableround&match_id=$matchid");
}

if (isset($_POST["piste_change"])) {

    $pistename = $_POST["piste_change_data"];
    $json_table->$tableround->$matchid->pistetime->pistename = $pistename;

    $table_upload = json_encode($json_table, JSON_UNESCAPED_UNICODE);

    $qry_upload_table = "UPDATE tables SET data = '$table_upload' WHERE ass_comp_id = $comp_id";
    $qry_upload_table_do = mysqli_query($connection, $qry_upload_table);

    header("Location: match_results.php?comp_id=$comp_id&table_round=$tableround&match_id=$matchid");
}

if (isset($_POST["time_change"])) {

    $time = $_POST["time_change_data"];

    $json_table->$tableround->$matchid->pistetime->time = $time;

    $table_upload = json_encode($json_table, JSON_UNESCAPED_UNICODE);

    $qry_upload_table = "UPDATE tables SET data = '$table_upload' WHERE ass_comp_id = $comp_id";
    $qry_upload_table_do = mysqli_query($connection, $qry_upload_table);

    header("Location: match_results.php?comp_id=$comp_id&table_round=$tableround&match_id=$matchid");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Match results</title>
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
                <?php
                $fencer12 = 1;
                foreach ($json_table->$tableround->$matchid as $key => $value) {
                    if ($key == "referees" || $key == "pistetime") {
                        continue;
                    } else {

                        if ($value == NULL) {
                            ${'fencer_' . $fencer12} = new stdClass;
                            ${'fencer_' . $fencer12}->name = "";
                            ${'fencer_' . $fencer12}->nation = "";
                        } else {
                            ${'fencer_' . $fencer12} = $value;
                        }
                        $fencer12++;
                    }
                }

                ?>
                <p class="page_title"><?php echo $fencer_1->name . "(" . $fencer_1->nation . ")" ?> vs <?php echo $fencer_2->name . "(" . $fencer_2->nation . ")" ?></p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" name="save_match" type="submit" form="save_match">
                        <p>Save Match</p>
                        <img src="../assets/icons/save-black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper" id="match_result_wrapper">
                    <div class="match_fencers_wrapper">
                        <div>
                            <p><?php echo $fencer_1->name . "(" . $fencer_1->nation . ")" ?></p>
                            <button>
                                <img src="../assets/icons/message-black.svg">
                            </button>
                        </div>

                        <div>
                            <p><?php echo $fencer_2->name . "(" . $fencer_2->nation . ")"  ?></p>
                            <button>
                                <img src="../assets/icons/message-black.svg">
                            </button>
                        </div>
                    </div>
                    <div class="match_settings_wrapper">
                        <form class="match_settings_form" method="POST">
                            <p class="setting_title">Referee:</p>
                            <p class="setting"><?php echo $actualobject->referees->ref->name . "(" . $actualobject->referees->ref->nation . ")"  ?></p>
                            <button class="underlined_button" type="button" onclick="changeThis(this)">
                                <p>Change</p>
                            </button>
                            <div class="collapsed">
                                <button class="change_back_button" type="button" onclick="closeWrapper(this)">
                                    <img src="../assets/icons/close-black.svg">
                                </button>
                                <div class="search_wrapper wide">
                                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="rfrInput" placeholder="Search and Select referee" class="search input has_icon">
                                    <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close-black.svg"></button>
                                    <div class="search_results">

                                        <?php

                                        foreach ($refereearray as $referee) {

                                        ?>
                                            <button type="button" id="<?php echo $referee->id . "," . $referee->prenom . " " . $referee->nom . "," . $referee->nation . "," . $referee->club ?>" onclick="setreferee(this)"><?php echo $referee->prenom . " " . $referee->nom . " (" . $referee->nation . ")" ?></button>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <input type="text" name="ref_change_data">
                                <input type="submit" name="ref_change" class="save_change_button" value="Save">
                            </div>
                        </form>
                        <form class="match_settings_form" method="POST">
                            <p class="setting_title">Video Referee:</p>
                            <p class="setting"><?php echo $actualobject->referees->vref->name . "(" . $actualobject->referees->vref->nation . ")" ?></p>
                            <button class="underlined_button" type="button" onclick="changeThis(this)">
                                <p>Change</p>
                            </button>
                            <div class="collapsed">
                                <button class="change_back_button" type="button" onclick="closeWrapper(this)">
                                    <img src="../assets/icons/close-black.svg">
                                </button>
                                <div class="search_wrapper wide">
                                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="vdrfrInput" placeholder="Search and Select referee" class="search input has_icon">
                                    <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close-black.svg"></button>
                                    <div class="search_results">
                                        <?php

                                        foreach ($refereearray as $referee) {

                                        ?>
                                            <button type="button" id="<?php echo $referee->id . "," . $referee->prenom . " " . $referee->nom . "," . $referee->nation . "," . $referee->club ?>" onclick="setreferee(this)"><?php echo $referee->prenom . " " . $referee->nom . " (" . $referee->nation . ")" ?></button>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <input type="text" name="vref_change_data">
                                <input type="submit" name="vref_change" class="save_change_button" value="Save">
                            </div>
                        </form>
                        <form class="match_settings_form" method="POST">
                            <p class="setting_title">Piste:</p>
                            <p class="setting"><?php echo $actualobject->pistetime->pistename ?></p>
                            <button class="underlined_button" type="button" onclick="changeThis(this)">
                                <p>Change</p>
                            </button>
                            <div class="collapsed">
                                <button class="change_back_button" type="button" onclick="closeWrapper(this)">
                                    <img src="../assets/icons/close-black.svg">
                                </button>
                                <div class="search_wrapper narrow">
                                    <button type="button" class="search select input" tabindex="3" onfocus="isOpen(this)" onblur="isClosed(this)">
                                        <input type="text" name="date_to_select" placeholder="Select Date">
                                    </button>
                                    <button type="button"><img src="../assets/icons/arrow_drop_down-black.svg"></button>
                                    <div class="search_results">
                                        <?php

                                        foreach ($pistearray as $piste) {

                                        ?>

                                            <button type="button" id="<?php echo $piste->name ?>" onclick="setreferee(this)"><?php echo $piste->name ?></button>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <input type="text" name="piste_change_data">
                                <input type="submit" name="piste_change" class="save_change_button" value="Save">
                            </div>
                        </form>
                        <form class="match_settings_form" method="POST">
                            <p class="setting_title">Time:</p>
                            <p class="setting"><?php echo $actualobject->pistetime->time ?></p>
                            <button class="underlined_button" type="button" onclick="changeThis(this)">
                                <p>Change</p>
                            </button>
                            <div class="collapsed">
                                <button class="change_back_button" type="button" onclick="closeWrapper(this)">
                                    <img src="../assets/icons/close-black.svg">
                                </button>
                                <input type="time" name="time_change_data">
                                <input type="submit" name="time_change" class="save_change_button" value="Save">
                            </div>
                        </form>
                    </div>
                    <form class="match_fencers_results" id="save_match" method="POST">
                        <div id="fencer_1" class="fencer_wrapper">
                            <div>
                                <p><?php echo $fencer_1->name . "(" . $fencer_1->nation . ")" ?></p>
                                <input type="number" name="fencid_1" class="" placeholder="fencers id" value="<?php echo $fencer_1->id ?>">
                                <input type="text" class="match_fencer_input number_input" value="<?php if (isset($fencer_1->score)) {
                                                                                                        echo $fencer_1->score;
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>" name="points_f1" id="points_f1">
                                <div class="result_advanced_choice">
                                    <p class="winner_text" id="winner_f1"></p>
                                    <input type="radio" name="draw_winner" id="draw_winner_f11" value="1"/>
                                    <label style="display: none;" id="draw_winner_f1" for="draw_winner_f11">Winner</label>
                                </div>
                            </div>
                            <div class="fencers_cards_wrapper">
                                <div>
                                    Regular
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_1->cards[0] ?>" name="f1_y">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_1->cards[1] ?>" name="f1_r">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_1->cards[2] ?>" name="f1_b" id="f1_b">
                                    </div>
                                </div>
                                <div>
                                    Passive
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_1->cards[3] ?>" name="f1_y_p">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_1->cards[4] ?>" name="f1_r_p">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_1->cards[5] ?>" name="f1_b_p" id="f1_b_p">
                                    </div>
                                </div>
                                <button type="button" name="1" onclick="abandonment(this)" class="disqualify_button">Abandonment</button>
                            </div>
                        </div>

                        <div id="fencer_2" class="fencer_wrapper">
                            <div>
                                <p><?php echo $fencer_2->name . "(" . $fencer_2->nation . ")" ?></p>
                                <input type="number" name="fencid_2" class="" placeholder="fencers id" value="<?php echo $fencer_2->id ?>">
                                <input type="text" class="match_fencer_input number_input" value="<?php if (isset($fencer_2->score)) {
                                                                                                        echo $fencer_2->score;
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>" name="points_f2" id="points_f2">
                                <div class="result_advanced_choice">
                                    <p class="winner_text" id="winner_f2"></p>
                                    <input type="radio" name="draw_winner" id="draw_winner_f22" value="2"/>
                                    <label style="display: none;" id="draw_winner_f2" for="draw_winner_f22">Winner</label>
                                </div>
                            </div>
                            <div class="fencers_cards_wrapper">
                                <div>
                                    Regular
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_2->cards[0] ?>" name="f2_y">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_2->cards[1] ?>" name="f2_r">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_2->cards[2] ?>" name="f2_b" id="f2_b">
                                    </div>
                                </div>
                                <div>
                                    Passive
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_2->cards[3] ?>" name="f2_y_p">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_2->cards[4] ?>" name="f2_r_p">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black.svg">
                                        <input type="number" class="match_fencer_input number_input" value="<?php echo $fencer_2->cards[5] ?>" name="f2_b_p" id="f2_b_p">
                                    </div>
                                </div>
                                <button type="button" name="2" onclick="abandonment(this)" class="disqualify_button">Abandonment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
        <script src="../js/match_results.js"></script>
        <script src="../js/search.js"></script>
        <script src="../js/controls.js"></script>
        <script src="../js/overlay_panel.js"></script>
</body>

</html>