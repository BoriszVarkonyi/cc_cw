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

    }
    elseif ($fencer2_data->points == "ABD") {

        $winnerfencer = 1;

    }
    elseif ($fencer1_data->points > $fencer2_data->points) {

        $winnerfencer = 1;

    }
    elseif ($fencer2_data->points > $fencer1_data->points) {

        $winnerfencer = 2;

    }
    elseif ($fencer1_data->points == $fencer2_data->points) {

        if ($_POST["draw_winner"] == 1) {

            $winnerfencer = 1;

        }
        elseif ($_POST["draw_winner"] == 2) {

            $winnerfencer = 2;

        }

    }

    //searching and modifying fencer1 data
    foreach ($actualobject as $key => $value) {

        if ($fencer1_data->id == $value->id) {

            $json_table->$tableround->$matchid->$key->score = $fencer1_data->points;
            $json_table->$tableround->$matchid->$key->cards = $fencer1_cards;

            if ($winnerfencer == 1) {

                $json_table->$tableround->$matchid->$key->isWinner = true;

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

            }

            break;
        }

    }

    echo json_encode($json_table);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
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
                        }
                        else{
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
                        <img src="../assets/icons/save-black-18dp.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper width_80" id="match_result_wrapper">
                    <div class="match_fencers_wrapper">
                        <div>
                            <p><?php echo $fencer_1->name . "(" . $fencer_1->nation . ")" ?></p>
                            <button>
                                <img src="../assets/icons/message-black-18dp.svg">
                            </button>
                        </div>

                        <div>
                            <p><?php  echo $fencer_2->name . "(" . $fencer_2->nation . ")"  ?></p>
                            <button>
                                <img src="../assets/icons/message-black-18dp.svg">
                            </button>
                        </div>
                    </div>
                    <div class="match_referees_wrapper">
                        <div>
                            Referee: <?php echo $actualobject->referees->ref->name . "(" . $actualobject->referees->ref->nation . ")"  ?>
                            <button class="underlined_button" type="submit">
                                <p>Change</p>
                            </button>
                        </div>
                        <div>
                            Video Referee: <?php echo $actualobject->referees->vref->name . "(" . $actualobject->referees->vref->nation . ")"  ?>
                            <button class="underlined_button" type="submit">
                                <p>Change</p>
                            </button>
                        </div>
                        <div>
                            Piste: <?php echo $actualobject->pistetime->pistename ?>
                            <button class="underlined_button" type="submit">
                                <p>Change</p>
                            </button>
                        </div>
                        <div>
                            Time: <?php echo $actualobject->pistetime->time ?>
                            <button class="underlined_button" type="submit">
                                <p>Change</p>
                            </button>
                        </div>
                    </div>
                    <form class="match_fencers_results" id="save_match" method="POST">
                        <div id="fencer_1" class="fencer_wrapper">
                            <div>
                                <p><?php echo $fencer_1->name . "(" . $fencer_1->nation . ")" ?></p>
                                <input type="number" name="fencid_1" class="" placeholder="fencers id" value="<?php echo $fencer_1->id ?>">
                                <input type="text" class="match_fencer_points" placeholder="#" name="points_f1" id="points_f1">
                                <p class="winner_text" id="winner_f1"></p>
                                <input type="radio" name="draw_winner" id="draw_winner_f11" value="1"/>
                                    <label style="display: none;" id="draw_winner_f1" for="draw_winner_f11">Winner</label>
                            </div>
                            <div class="fencers_cards_wrapper">
                                <div>
                                    Regular
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f1_y">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f1_r">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f1_b">
                                    </div>
                                </div>
                                <div>
                                    Passive
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f1_y_p">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f1_r_p">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f1_b_p">
                                    </div>
                                </div>
                                <button type="button" name="1" onclick="abandonment(this)" class="disqualify_button">Abandonment</button>
                            </div>
                        </div>

                        <div id="fencer_2" class="fencer_wrapper">
                            <div>
                                <p><?php echo $fencer_2->name . "(" . $fencer_2->nation . ")" ?></p>
                                <input type="number" name="fencid_2" class="" placeholder="fencers id" value="<?php echo $fencer_2->id ?>">
                                <input type="text" class="match_fencer_points" placeholder="#" name="points_f2" id="points_f2">
                                <p class="winner_text" id="winner_f2"></p>
                                <input type="radio" name="draw_winner" id="draw_winner_f22" value="2"/>
                                    <label style="display: none;" id="draw_winner_f2" for="draw_winner_f22">Winner</label>
                            </div>
                            <div class="fencers_cards_wrapper">
                                <div>
                                    Regular
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f2_y">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f2_r">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f2_b">
                                    </div>
                                </div>
                                <div>
                                    Passive
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f2_y_p">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f2_r_p">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#" name="f2_b_p">
                                    </div>
                                </div>
                                <button type="button" name="2" onclick="abandonment(this)" class="disqualify_button">Abandonment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/match_results.js"></script>

</html>