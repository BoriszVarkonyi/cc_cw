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


if (isset($_POST["submit_referees"])) {

    echo ("BEFORE<br>");
    print_r(json_encode($out_table));
    echo("<br>");

    $table_round = $_GET["table_round"];

    $ref_to_use_string = $_POST["ref_to_use"];
    $vref_to_use_string = $_POST["vref_to_use"];

    $ref_separated = explode("//", $ref_to_use_string);
    $vref_separated = explode("//", $vref_to_use_string);

    foreach ($out_table->$table_round as $matchkey => $matches) {

        echo ($matchkey);

        foreach ($ref_separated as $fullrefobject) {

            $fullRefArray = explode("&&", $fullrefobject); //[0] match id to assign to - [1] ref object
            //print_r($fullRefArray);
            $refobject = json_decode($fullRefArray[1]);

            if ($matchkey == $fullRefArray[0]) {
                echo "OK<br>";
                print_r($refobject);

                $out_table->$table_round->$matchkey->referees->ref->name = $refobject->name;
                $out_table->$table_round->$matchkey->referees->ref->nation = $refobject->n1;
                $out_table->$table_round->$matchkey->referees->ref->club = $refobject->c1;
                $out_table->$table_round->$matchkey->referees->ref->id = $refobject->ref_id;
            }
        }
        foreach ($vref_separated as $fullrefobject) {

            $fullRefArray = explode("&&", $fullrefobject); //[0] match id to assign to - [1] ref object
            //print_r($fullRefArray);
            $refobject = json_decode($fullRefArray[1]);

            if ($matchkey == $fullRefArray[0]) {
                echo "OK<br>";
                print_r($refobject);

                $out_table->$table_round->$matchkey->referees->vref->name = $refobject->name;
                $out_table->$table_round->$matchkey->referees->vref->nation = $refobject->n1;
                $out_table->$table_round->$matchkey->referees->vref->club = $refobject->c1;
                $out_table->$table_round->$matchkey->referees->vref->id = $refobject->ref_id;
            }
        }
    }
    echo ("AFTER");
    echo("<br>");
    print_r(json_encode($out_table));
    echo("<br>");

    $table_upload = json_encode($out_table, JSON_UNESCAPED_UNICODE);

    $qry_upload_table = "UPDATE tables SET data = '$table_upload' WHERE ass_comp_id = $comp_id";
    $qry_upload_table_do = mysqli_query($connection, $qry_upload_table);

    header("Location: table_individual.php?comp_id=$comp_id");

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table Pistes & Time setup</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/table_config_style.min.css">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Table Referees setup</p>
                <form class="stripe_button_wrapper" method="POST" action="">
                    <input type="text" id="ref_to_use" name="ref_to_use">
                    <input type="text" id="vref_to_use" name="vref_to_use">
                    <button name="submit_referees" class="stripe_button primary" type="submit" shortcut="SHIFT+S">
                        <p>Save</p>
                        <img src="../assets/icons/save_black.svg" />
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
                            <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                            <div class="search_results">


                                <?php

                                foreach ($out_table as $round_name => $tableround) { ?>

                                    <a type="button" href="table_referees_individual.php?comp_id=<?php echo $comp_id . "&table_round=" . $round_name ?>"><?php echo "Table of " . ltrim($round_name, "t_") ?></a>
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
                                <div class="db_panel_header">
                                    <img src="../assets/icons/build_black.svg">
                                    <p>Set Referees for table</p>
                                </div>
                                <div class="db_panel_main full">
                                    <div class="form_wrapper" method="POST">
                                        <div>
                                            <div>
                                                <label for="">REFEREE TYPE</label>
                                                <div class="option_container">
                                                    <input type="radio" name="referee_type" id="m_ref" value="" checked onclick="vref_to_ref()" />
                                                    <label for="m_ref">Match Referee</label>
                                                    <input type="radio" name="referee_type" id="v_ref" value="" onclick="ref_to_vref()" />
                                                    <label for="v_ref">Video Referee</label>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="">SEPARATE BY</label>
                                                <div class="option_container row">
                                                    <input type="radio" name="separate_by" id="club" value="" onclick="nation_to_club()" />
                                                    <label for="club">Club</label>
                                                    <input type="radio" name="separate_by" id="nat" checked value="" onclick="club_to_nation()" />
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
                                                    <input type="radio" name="referees_usage" id="manual" value="" />
                                                    <label for="manual">Manual</label>
                                                    <input type="radio" name="referees_usage" id="automatic" checked value="" />
                                                    <label for="automatic">Automatic</label>
                                                </div>
                                            </div>
                                            <div id="">
                                                <label for="">MAX MATCH PER REFEREE</label>
                                                <input type="number" name="" id="mpr" class="number_input centered" placeholder="#">
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
                                                                    <div class="referee_id hidden"><?php echo $referee->id ?></div>
                                                                    <div class="referee_name"><?php echo $referee->prenom . " " . $referee->nom ?></div>
                                                                    <div class="referee_nation"><?php echo $referee->nation ?></div>
                                                                    <div class="referee_club hidden"><?php echo $referee->club ?></div>
                                                                    <div class="piste_order hidden" id="arrow_buttons">
                                                                        <button type="button" onclick="moveUp(this)">
                                                                            <img src="../assets/icons/keyboard_arrow_up_black.svg">
                                                                        </button>
                                                                        <button type="button" onclick="moveDown(this)">
                                                                            <img src="../assets/icons/keyboard_arrow_down_black.svg">
                                                                        </button>
                                                                    </div>
                                                                    <div class="piste_button">
                                                                        <button class="func_button" type="button" id="<?php echo $referee->id ?>" onclick="useOnePiste(this)">
                                                                            <img class="plus" src="../assets/icons/add_black.svg">
                                                                            <img class="minus hidden" src="../assets/icons/remove_black.svg">
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
                            <button class="try_button" onclick="try_referees()">Try</button>
                            <div class="db_panel full" id="matches_preview_panel">
                                <div class="db_panel_header">
                                    <img src="../assets/icons/build_black.svg">
                                    <p class="table_text">Preview matches</p>
                                    <button id="preview_button" onclick="nation_to_club(this)">Preview Referees</button>
                                </div>
                                <div class="db_panel_main list">
                                    <table class="fixed no_interaction">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <p>MATCH ID</p>
                                                </th>
                                                <th>
                                                    <p>PISTE</p>
                                                </th>
                                                <th>
                                                    <p>STARTING TIME</p>
                                                </th>
                                                <th id="f1_head">
                                                    <p>F1 NATION</p>
                                                </th>
                                                <th id="f2_head">
                                                    <p>F2 NATION</p>
                                                </th>
                                                <th id="vr_name_head">
                                                    <p>REFEREE</p>
                                                </th>
                                                <th id="vr_nat_head">
                                                    <p>REFEREE NATION</p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="alt" id="tbody">

                                            <?php

                                            foreach ($out_table->$table_round as $matchkey => $matches) {

                                                $canskip = false;

                                                $fencersnat = [];
                                                $fencersclub = [];

                                                foreach ($matches as $fencerkey => $fencer) {

                                                    if ($fencerkey == "referees" || $fencerkey == "pistetime") {
                                                        continue;
                                                    }
                                                    if (isset($fencer->name)) {
                                                        if ($fencer->name == "" || $fencer->isWinner == true) {
                                                            $canskip = true;
                                                        }
                                                        array_push($fencersnat, $fencer->nation);
                                                        if (isset($fencer->club)) {
                                                            array_push($fencersclub, $fencer->club);
                                                        }
                                                    }
                                                }

                                            ?>

                                                    <tr class="<?php

                                                    if ($canskip == true) {
                                                        echo "skip";
                                                    }

                                                    ?>">
                                                        <td class="id">
                                                            <p><?php echo $matchkey ?></p>
                                                        </td>

                                                        <td class="pistes">
                                                            <p><?php if ($canskip == true) {
                                                                    echo "FINISHED";
                                                                } else {
                                                                    echo $matches->pistetime->pistename;
                                                                } ?></p>
                                                        </td>

                                                        <td class="time">
                                                            <p><?php
                                                                if ($canskip == true) {
                                                                    echo "FINISHED";
                                                                } else {
                                                                    echo $matches->pistetime->time;
                                                                } ?></p>
                                                        </td>

                                                        <td class="nation n_for_ref">
                                                            <p><?php if ($canskip == true) {
                                                                    echo "FINISHED";
                                                                } else {
                                                                    echo $fencersnat[0];
                                                                } ?></p>
                                                        </td>

                                                        <td class="nation n_for_ref">
                                                            <p><?php if ($canskip == true) {
                                                                    echo "FINISHED";
                                                                } else {
                                                                    echo $fencersnat[1];
                                                                } ?></p>
                                                        </td>

                                                        <td class="club c_for_ref hidden">
                                                            <p><?php if ($canskip == true) {
                                                                    echo "FINISHED";
                                                                } else {
                                                                    echo $fencersclub[0];
                                                                } ?></p>
                                                        </td>

                                                        <td class="club c_for_ref hidden">
                                                            <p><?php if ($canskip == true) {
                                                                    echo "FINISHED";
                                                                } else {
                                                                    echo $fencersclub[1];
                                                                } ?></p>
                                                        </td>

                                                    <td class="referee refname">
                                                        <p><?php echo $matches->referees->ref->name ?></p>
                                                    </td>
                                                    <td class="nation referee refnat">
                                                        <p><?php echo $matches->referees->ref->nation ?></p>
                                                    </td>
                                                    <td class="club referee refclub hidden">
                                                        <p><?php echo $matches->referees->ref->club ?></p>
                                                    </td>
                                                    <td class="video hidden vrefname">
                                                        <p><?php echo $matches->referees->vref->name ?></p>
                                                    </td>
                                                    <td class="nation video vrefnat hidden">
                                                        <p><?php echo $matches->referees->vref->nation ?></p>
                                                    </td>
                                                    <td class="club video vrefclub hidden">
                                                        <p><?php echo $matches->referees->vref->club ?></p>
                                                    </td>
                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="db_panel full hidden" id="referees_preview_panel">
                                <div class="db_panel_header">
                                    <img src="../assets/icons/build_black.svg">
                                    <p>Preview referees</p>
                                    <button onclick="">Preview Matches</button>
                                </div>
                                <div class="db_panel_main list">
                                    <div class="table fixed">
                                        <div class="table_header">
                                            <div class="table_header_text">
                                                <p>REFEREE</p>
                                            </div>
                                            <div class="table_header_text">
                                                <p>PISTE</p>
                                            </div>
                                            <div class="table_header_text">
                                                <p>STARTING TIME</p>
                                            </div>
                                            <div class="table_header_text">
                                                <p>FENCER 1 NAT</p>
                                            </div>
                                        </div>
                                        <div class="table_row_wrapper alt" id="table_row_wrapper_referees">
                                            <div class="table_row">
                                                <div class="table_item ">
                                                    <p>47</p>
                                                </div>
                                                <div class="table_item ">
                                                    <p>47</p>
                                                </div>
                                                <div class="table_item ">
                                                    <p>47</p>
                                                </div>
                                                <div class="table_item ">
                                                    <p>47</p>
                                                </div>
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
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/table_config.js"></script>
    <script src="../js/table_referees.js"></script>
</body>

</html>