<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

print_r($_POST);
$table_round = $_GET["table_round"];

//Get table object for further use
$qry_get_table = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
$qry_get_table_do = mysqli_query($connection, $qry_get_table);

if ($row = mysqli_fetch_assoc($qry_get_table_do)) {

    $out_table = json_decode($row["data"]);
}

//Get pistes array of objects for further use
$qry_get_data = "SELECT data FROM pistes WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $data = $row['data'];

    $json_table = json_decode($data);
}

if (isset($_POST["save_piste_time"])) {

    $datastring = $_POST["data_to_upload"];

    $pistetime_strings_array = explode("//", $datastring);

    foreach($pistetime_strings_array as $ptobj){

        $innerdata = explode(",",$ptobj);

        print_r($innerdata);

        foreach($out_table->$table_round as $matchkey => $match){

            if ($matchkey == $innerdata[0]) {

                $out_table->$table_round->$matchkey->pistetime->pistename = $innerdata[1];
                $out_table->$table_round->$matchkey->pistetime->time = $innerdata[2];

                break;
            }

        }

    }

    $table_upload = json_encode($out_table, JSON_UNESCAPED_UNICODE);

    $qry_upload_table = "UPDATE tables SET data = '$table_upload' WHERE ass_comp_id = $comp_id";
    $qry_upload_table_do = mysqli_query($connection, $qry_upload_table);

    header("Location: table.php?comp_id=$comp_id");

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
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>

<body>
    <!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Table Pistes & Time setup</p>
                <form class="stripe_button_wrapper" method="POST">
                    <input type="text" id="data_to_upload" name="data_to_upload">
                    <button name="save_piste_time" class="stripe_button primary" type="submit" shortcut="SHIFT+S">
                        <p>Save</p>
                        <img src="../assets/icons/save-black.svg"/>
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
                            <button type="button"><img src="../assets/icons/arrow_drop_down-black.svg"></button>
                            <div class="search_results">


                                <?php

                                foreach ($out_table as $round_name => $tableround) { ?>

                                    <a type="button" id="gr" href="table_pistes_and_time.php?comp_id=<?php echo $comp_id . "&table_round=" . $round_name ?>"><?php echo "Table of " . ltrim($round_name, "t_") ?></a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                    <?php
                    //Only shows panels if he had already chosen tableround

                    if (isset($_GET["table_round"])) {

                    ?>

                        <div id="table_piste_time_wrapper">
                            <div class="db_panel full" id="pistes_and_time_panel">
                                <div class="db_panel_title_stripe">
                                    <img src="../assets/icons/build-black.svg">
                                    <p>Set Time and Piste for table</p>
                                </div>
                                <div class="db_panel_main full">
                                    <div class="form_wrapper" method="POST">
                                        <div>
                                            <div>
                                                <label for="">STARTING TIME</label>
                                                <input type="time" id="starting_time">
                                            </div>
                                            <div>
                                                <label for="">INTERVAL OF MATCHES (min)</label>
                                                <input type="number" id="interval" class="number_input centered" placeholder="#">
                                            </div>
                                            <div>
                                                <label for="">USAGE OF PISTES</label>
                                                <div class="option_container row">
                                                    <input type="radio" name="piste_usage" id="all" value=""/>
                                                    <label for="all">Use all</label>
                                                    <input type="radio" name="piste_usage" id="not_all" checked value=""/>
                                                    <label for="not_all">Automatic</label>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="">PISTE & TIME RELATION</label>
                                                <div class="option_container">
                                                    <input type="radio" name="piste_time_relation" id="diff_time" value=""/>
                                                    <label for="diff_time">Same piste different time</label>
                                                    <input type="radio" name="piste_time_relation" id="diff_piste" value=""/>
                                                    <label for="diff_piste">Different piste same time</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="full">
                                                <!-- USED PISTES STARTS HERE -->

                                                <label for="">SELECT PISTES</label>
                                                <div id="selection_list_wrapper">
                                                    <div class="selection_list">
                                                        <p class="selection_list_title">Selected pistes</p>
                                                        <div class="piste_wrapper" id="used_selection_list">

                                                            <!-- JS MOVES PISTES HERE -->

                                                        </div>
                                                        <div class="selection_list_controls">
                                                            <button type="button" onclick="removeAllFromSelection()">Deselect all</button>
                                                        </div>
                                                    </div>

                                                    <!-- NOT USED PISTES STARTS HERE -->

                                                    <div class="selection_list">
                                                        <p class="selection_list_title">Not selected pistes</p>
                                                        <div class="piste_wrapper" id="not_used_selection_list">

                                                            <?php

                                                            foreach ($json_table as $piste) { ?>

                                                                <div class="piste not_used">
                                                                    <div class="piste_name"><?php echo $piste->name ?></div>
                                                                    <div class="piste_order hidden" id="arrow_buttons">
                                                                        <button type="button" onclick="moveUp(this)">
                                                                            <img src="../assets/icons/keyboard_arrow_up-black.svg">
                                                                        </button>
                                                                        <button type="button" onclick="moveDown(this)">
                                                                            <img src="../assets/icons/keyboard_arrow_down-black.svg">
                                                                        </button>
                                                                    </div>
                                                                    <div class="piste_button">
                                                                        <button class="func_button" type="button" id="<?php echo $piste->name ?>" onclick="useOnePiste(this)">
                                                                            <img class="plus" src="../assets/icons/add-black.svg">
                                                                            <img class="minus hidden" src="../assets/icons/remove-black.svg">
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
                                    <img src="../assets/icons/build-black.svg">
                                    <p>Preview matches</p>
                                </div>
                                <div class="db_panel_main list">
                                    <div class="table fixed">
                                        <div class="table_header">
                                            <div class="table_header_text"><p>MATCH ID</p></div>
                                            <div class="table_header_text"><p>PISTE</p></div>
                                            <div class="table_header_text"><p>STARTING TIME</p></div>
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
                                                    <div class="table_item key"><?php echo $matchkey ?></div>
                                                    <div class="table_item pistes"><?php echo $matches->pistetime->pistename ?></div>
                                                    <div class="table_item time"><?php echo $matches->pistetime->time ?></div>
                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <button class="try_button" onclick="tryConfig()">Try</button>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/table_config.js"></script>
    <script src="../js/table_pistes_and_time.js"></script>
</body>
</html>