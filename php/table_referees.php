<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

//Get table object for further use
$qry_get_table = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
$qry_get_table_do = mysqli_query($connection, $qry_get_table);

if ($row = mysqli_fetch_assoc($qry_get_table_do)) {

    $out_table = json_decode($row["data"]);
}

//Get pistes array of objects for further use
$qry_get_data = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $data = $row['data'];

    $json_table = json_decode($data);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table Pistes & Time setup</title>
    <link rel="stylesheet" href="../css/table_pistes_and_time_style.min.css">
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
                <p class="page_title">Table Referees setup</p>
                <form class="stripe_button_wrapper">
                    <input type="text" id="">
                    <button name="submit_form" class="stripe_button primary" type="submit" shortcut="SHIFT+S">
                        <p>Save</p>
                        <img src="../assets/icons/save-black-18dp.svg" />
                    </button>
                </form>
            </div>
            <div id="page_content_panel_main">
                <div id="" class="wrapper margin">
                    <div id="table_select_wrapper">
                        <div class="search_wrapper wide">
                            <button type="button" class="search select altalt" tabindex="3" onfocus="isOpen(this)" onblur="isClosed(this)">
                                <input type="text" name="" placeholder="" value="<?php

                                                                                    //Checks if there is any table selected

                                                                                    if (isset($_GET["table_round"])) {
                                                                                        echo 'Table of ' . ltrim($_GET["table_round"], 't_');
                                                                                    } else {
                                                                                        echo 'Please select a round';
                                                                                    }

                                                                                    ?>">
                            </button>
                            <button type="button"><img src="../assets/icons/arrow_drop_down-black-18dp.svg"></button>
                            <div class="search_results">


                                <?php

                                foreach ($out_table as $round_name => $tableround) { ?>

                                    <a type="button" id="gr" href="table_referees.php?comp_id=<?php echo $comp_id . "&table_round=" . $round_name ?>"><?php echo "Table of " . ltrim($round_name, "t_") ?></a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                    <?php
                    //Only shows panels if he had already chosen tableround

                    if (isset($_GET["table_round"])) {

                        $table_round = $_GET["table_round"];
                    ?>

                        <div id="table_referees_wrapper">
                            <div class="db_panel full" id="pistes_and_time_panel">
                                <div class="db_panel_title_stripe">
                                    <img src="../assets/icons/build-black-18dp.svg">
                                    <p>Set Referees for table</p>
                                </div>
                                <div class="db_panel_main full">
                                    <div class="form_wrapper" method="POST">
                                        <div>
                                            <div>
                                                <label for="">REFEREE TYPE</label>
                                                <div class="option_container">
                                                    <input type="radio" name="referee_type" id="m_ref" value="" />
                                                    <label for="m_ref">Match Referee</label>
                                                    <input type="radio" name="referee_type" id="v_ref" value="" />
                                                    <label for="v_ref">Video Referee</label>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="">SEPARATE BY</label>
                                                <div class="option_container row">
                                                    <input type="radio" name="separate_by" id="club" value="" />
                                                    <label for="club">Club</label>
                                                    <input type="radio" name="separate_by" id="nat" checked value="" />
                                                    <label for="nat">Nationality</label>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="">REFEREES STAY ON PISTE</label>
                                                <div class="option_container row">
                                                    <input type="radio" name="stay_on_piste" id="stay" value="" />
                                                    <label for="stay">Stay</label>
                                                    <input type="radio" name="stay_on_piste" id="dont_stay" checked value="" />
                                                    <label for="dont_stay">Don't Stay</label>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="">USAGE OF REFEREES</label>
                                                <div class="option_container row">
                                                    <input type="radio" name="referees_usage" id="enough" value="" />
                                                    <label for="enough">Just enough</label>
                                                    <input type="radio" name="referees_usage" id="automatic" checked value="" />
                                                    <label for="automatic">Automatic</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="full">
                                                <!-- USED REFEREES STARTS HERE -->

                                                <label for="">SELECT REFEREES</label>
                                                <div id="selection_list_wrapper">
                                                    <div class="selection_list">
                                                        <p class="selection_list_title">Selected referees</p>
                                                        <div class="piste_wrapper" id="used_selection_list">

                                                            <!-- JS MOVES PISTES HERE -->

                                                        </div>
                                                        <div class="selection_list_controls">
                                                            <button type="button" onclick="removeAllFromSelection()">Deselect all</button>
                                                        </div>
                                                    </div>

                                                    <!-- NOT USED REFEREES STARTS HERE -->

                                                    <div class="selection_list">
                                                        <p class="selection_list_title">Not selected referees</p>
                                                        <div class="piste_wrapper" id="not_used_selection_list">

                                                            <?php

                                                            foreach ($json_table as $referee) { ?>

                                                                <div class="piste not_used">
                                                                    <div class="piste_name"><?php echo $referee->prenom . " " . $referee->nom ?></div>
                                                                    <div class="referee_nation"><?php echo $referee->nation ?></div>
                                                                    <div class="piste_order hidden" id="arrow_buttons">
                                                                        <button type="button" onclick="moveUp(this)">
                                                                            <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                        </button>
                                                                        <button type="button" onclick="moveDown(this)">
                                                                            <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                        </button>
                                                                    </div>
                                                                    <div class="piste_button">
                                                                        <button class="func_button" type="button" id="<?php echo $referee->id ?>" onclick="useOnePiste(this)">
                                                                            <img class="plus" src="../assets/icons/add-black-18dp.svg">
                                                                            <img class="minus hidden" src="../assets/icons/remove-black-18dp.svg">
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="selection_list_controls">
                                                            <button type="button" onclick="addAllToSelection()">Select all</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="db_panel full" id="matches_preview_panel">
                                <div class="db_panel_title_stripe">
                                    <img src="../assets/icons/build-black-18dp.svg">
                                    <p>Preview matches</p>
                                    <button onclick="">Preview Referees</button>
                                </div>
                                <div class="db_panel_main list">
                                    <div class="table fixed">
                                        <div class="table_header">
                                            <div class="table_header_text"><p>MATCH ID</p></div>
                                            <div class="table_header_text"><p>PISTE</p></div>
                                            <div class="table_header_text"><p>STARTING TIME</p></div>
                                            <div class="table_header_text"><p>FENCER 1 NAT</p></div>
                                            <div class="table_header_text"><p>FENCER 2 NAT</p> </div>
                                            <div class="table_header_text"><p>REFEREE</p></div>
                                            <div class="table_header_text"><p>REFEREE NAT</p></div>
                                        </div>
                                        <div class="table_row_wrapper alt" id="table_row_wrapper">

                                            <?php

                                            foreach ($out_table->$table_round as $matchkey => $matches) {

                                                $canskip = false;

                                                foreach ($matches as $fencerkey => $fencer) {

                                                    if ($canskip == true) {
                                                        break;
                                                    }

                                                    if ($fencerkey == "referees" || $fencerkey == "pistetime") {
                                                        continue;
                                                    }
                                                    if (isset($fencer->name)) {
                                                        if ($fencer->name == "" || $fencer->isWinner == true) {
                                                            $canskip = true;
                                                        }
                                                    }
                                                }

                                            ?>

                                                <div class="table_row <?php

                                                                        if ($canskip == true) {
                                                                            echo "skip";
                                                                        }

                                                                        ?>">
                                                    <div class="table_item"><p><?php echo $matchkey ?></p></div>
                                                    <div class="table_item pistes"><p><?php echo $matches->pistetime->pistename ?></p></div>
                                                    <div class="table_item time"><p><?php echo $matches->pistetime->time ?></p></div>
                                                    <div class="table_item "><p>47</p></div>
                                                    <div class="table_item "><p>47</p></div>
                                                    <div class="table_item "><p>47</p></div>
                                                    <div class="table_item "><p>47</p></div>
                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <button class="try_button" onclick="tryConfig()">Try</button>
                                </div>
                            </div>
                            <div class="db_panel full hidden" id="referees_preview_panel">
                                <div class="db_panel_title_stripe">
                                    <img src="../assets/icons/build-black-18dp.svg">
                                    <p>Preview referees</p>
                                    <button onclick="">Preview Matches</button>
                                </div>
                                <div class="db_panel_main list">
                                    <div class="table fixed">
                                        <div class="table_header">
                                            <div class="table_header_text"><p>REFEREE</p></div>
                                            <div class="table_header_text"><p>PISTE</p></div>
                                            <div class="table_header_text"><p>STARTING TIME</p></div>
                                            <div class="table_header_text"><p>FENCER 1 NAT</p></div>
                                        </div>
                                        <div class="table_row_wrapper alt" id="table_row_wrapper_referees">
                                            <div class="table_row">
                                                <div class="table_item "><p>47</p></div>
                                                <div class="table_item "><p>47</p></div>
                                                <div class="table_item "><p>47</p></div>
                                                <div class="table_item "><p>47</p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/search.js"></script>
<script src="../js/table_config.js"></script>
<script src="../js/table_referees.js"></script>
</html>