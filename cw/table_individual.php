<?php include "includes/get_comp_data.php"; ?>
<?php

$qry_check_existance = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
$qry_check_existance_do = mysqli_query($connection, $qry_check_existance);

echo $existance = mysqli_num_rows($qry_check_existance_do);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s table</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
    <link rel="stylesheet" href="../css/table_style.min.css">
</head>
<body class="competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href="competition.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    Table of <?php echo $comp_name ?>
                </h1>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                </form>
                <div id="call_room" class="cw">
                    <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()" aria-label="Go to previous Table Column">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </div>
                    <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()" aria-label="Go to next Table Column">
                        <img src="../assets/icons/arrow_forward_ios_black.svg" alt="Go forward button">
                    </div>
                    <!-- State 0 -->
                <?php
                if ($existance == 0) {
                ?>
                    <div id="empty_content_notice">
                        <p>You have no table generated!</p>
                    </div>

                <?php } else { ?>
                    <!-- State 1 -->
                    <div id="call_room" class="cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <?php

                        $qry_get_table = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
                        $qry_get_table_do = mysqli_query($connection, $qry_get_table);

                        if ($row = mysqli_fetch_assoc($qry_get_table_do)) {

                            $out_table = json_decode($row["data"]);
                        }
                        $r_counter = 1;

                        foreach ($out_table as $key => $tablerounds) {

                            if ($key == "t_1") {
                                break;
                            }

                        ?>

                            <div id="e_<?php echo $r_counter ?>" class="elimination">
                                <div class="elimination_label">Table of <?php echo ltrim($key, "t_") ?></div>
                                <?php

                                $check = ltrim($key, "t_");

                                if ($check >= 8) {

                                    $change_every = $check / 8;
                                }
                                $innercounter = 0;
                                $changecounter = 1;
                                foreach ($tablerounds as $keyofmatch => $tablematches) {

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

                                    <div class="table_round_wrapper finished <?php echo $writecolor ?>" id="<?php echo $key . "_" . $keyofmatch ?>" tabindex="1" onclick="selectRound(this), window.location.href='match_results_individual.php?comp_id=<?php echo $comp_id ?>&table_round=<?php echo $key ?>&match_id=<?php echo $keyofmatch ?>'">
                                        <div class="table_round">

                                            <?php
                                            $firstrun = 0;
                                            foreach ($tablematches as $fencerkey => $tablefencer) {
                                                if ($fencerkey == "referees" || $fencerkey == "pistetime") {
                                                    continue;
                                                }
                                                //var_dump($fencerkey);
                                                var_dump($tablefencer);
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

                        <div id="winner" class="elimination">
                            <div class="elimination_label">Table of __</div>
                            <div class="table_round_wrapper finished purple">
                                <div class="table_round" onclick="tableRoundConfig(this)">
                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>1</p>
                                        </div>
                                        <div class="table_fencer_name">
                                            <p><?php
                                                $firstplace = "1";
                                                echo $out_table->t_1->m_1->$firstplace->name; ?></p>
                                        </div>
                                        <div class="table_fencer_nat">
                                            <p><?php echo $out_table->t_1->m_1->$firstplace->nation; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                    <!--
                    <div id="e_1" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_2" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_3" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_4" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished purple">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished purple">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_5" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished purple">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
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
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_6" class="elimination">
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
                    -->


                </div>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/table.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>