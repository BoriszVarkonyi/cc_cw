<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
<?php include "includes/wc_issues_array.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php

    $sort_by = "club";

    //check for wc type
    $qry_check = "SELECT comp_wc_type FROM competitions WHERE comp_id = '$comp_id'";
    $do_check = mysqli_query($connection, $qry_check);
    if ($row = mysqli_fetch_assoc($do_check)) {
        $wc_type = $row['comp_wc_type'];
    }

    //sort fencer ids by nation
    $qry_get_compet_table = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_compet_table = mysqli_query($connection, $qry_get_compet_table);
    if ($row = mysqli_fetch_assoc($do_get_compet_table)) {
        $string_table = $row['data'];
        $competit_table = json_decode($string_table);
    }

    $sorted_teams_array = [];

    for ($i = 0; $i < count($competit_table); $i++) {
        $fencers_nat = $competit_table[$i] -> $sort_by;
        $fencers_id = $competit_table[$i] -> id;

        $sorted_teams_array[$fencers_nat][] = $fencers_id;
    }


    $qry_select_wc = "SELECT * FROM weapon_control WHERE assoc_comp_id = '$comp_id'";
    $do_select_wc = mysqli_query($connection, $qry_select_wc);

    $all_wcs_count= 0;
    $all_issues_count = 0;
    $submitted_wcs_count = 0;
    $perfect_fencers_count = 0;
    $imperfect_fencers_count = 0;
    $sorted_issues_array = [];
    while ($row = mysqli_fetch_assoc($do_select_wc)) {
        //check fencer
        $all_wcs_count++;
        if ($row['issues_array'] !== null) {
            $submitted_wcs_count++;
            $real_issues_string = $row['issues_array'];
            $real_issues_array = json_decode($real_issues_string);
            //loop through fencers issues
            $all_zero = true;
            for ($issues_id = 0; $issues_id < count($array_issues); $issues_id++) {
                $count_issue = $real_issues_array[$issues_id];
                if ($count_issue > 0) {
                    $all_issues_count += $real_issues_array[$issues_id];
                    $all_zero = false;
                    if (isset($sorted_issues_array[$issues_id])) {
                        $sorted_issues_array[$issues_id] += $count_issue;
                    } else {
                        $sorted_issues_array[$issues_id] = $count_issue;
                    }
                }
            }
            if ($all_zero) {
                //no issues
                $perfect_fencers_count++;
            } else {
                //had issues
                $imperfect_fencers_count++;
            }
        }
    }
    //make sorted issues array
    $assoc_sorted_issues_array = [];
    foreach ($sorted_issues_array as $issue_id => $issue_value) {
        if (isset($assoc_sorted_issues_array[$array_issues[$issue_id]])) {
            $assoc_sorted_issues_array[$array_issues[$issue_id]] += $issue_value;
        } else {
            $assoc_sorted_issues_array[$array_issues[$issue_id]] = $issue_value;
        }
    }
    arsort($assoc_sorted_issues_array, 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weapon Control Statistics</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_paper_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <form id="title_stripe" method="POST" action="">
                <p class="page_title">Weapon Control Statistics</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button bold" onclick="window.close()" shortcut="SHIFT+C">
                        <p>Close Page</p>
                        <img src="../assets/icons/close_black.svg"/>
                    </button>
                    <button class="stripe_button primary" type="button" onclick="window.print()">
                        <p>Print Statistics</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                </div>
            </form>
            <div id="page_content_panel_main">
                <div class="wrapper screen_only">
                    <div class="db_panel">
                        <div class="db_panel_header">
                            <img src="../assets/icons/pie_chart_black.svg" />
                            <p>General Weapon Control Statistics</p>
                        </div>
                        <div class="db_panel_main small">
                            <?php
                                if ($wc_type == 1) {
                            ?>
                                    Immidiate
                                    <div class="stats_wrapper">
                                        <a class="stat" href="weapon_control_immediate.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/weapon_control_black.svg">
                                            <p class="stat_title">Weapon Controls</p>
                                            <p class="stat_number"><?php echo $all_wcs_count . " / " . $submitted_wcs_count ?></p>
                                        </a>
                                        <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/report_problem_black.svg">
                                            <p class="stat_title">Issues Reported</p>
                                            <p class="stat_number"><?php echo $all_issues_count ?></p>
                                        </a>
                                        <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/report_problem_black.svg">
                                            <p class="stat_title">Fencers without equipment issues</p>
                                            <p class="stat_number"><?php echo $perfect_fencers_count ?></p>
                                        </a>
                                        <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/report_problem_black.svg">
                                            <p class="stat_title">Fencers with equipment issues</p>
                                            <p class="stat_number"><?php echo $imperfect_fencers_count ?></p>
                                        </a>
                                    </div>
                            <?php
                                } else if ($wc_type == 2) {
                            ?>
                                    Administrated
                                    <div class="stats_wrapper">
                                        <a class="stat" href="weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/check_circle_outline_black.svg">
                                            <p class="stat_title">Check-ins</p>
                                            <p class="stat_subtitle">READY</p>
                                            <p class="stat_number">159 / 159</p>
                                        </a>
                                        <a class="stat" href="weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/check_circle_black.svg">
                                            <p class="stat_title">Check-outs</p>
                                            <p class="stat_number">159 / 120</p>
                                        </a>
                                        <a class="stat" href="weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/weapon_control_black.svg">
                                            <p class="stat_title">Weapon Controls</p>
                                            <p class="stat_number">159 / 138</p>
                                        </a>
                                        <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/report_problem_black.svg">
                                            <p class="stat_title">Issues Reported</p>
                                            <p class="stat_number">56</p>
                                        </a>
                                        <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/report_problem_black.svg">
                                            <p class="stat_title">Fencers without equipment issues</p>
                                            <p class="stat_number">56</p>
                                        </a>
                                        <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                            <img src="../assets/icons/report_problem_black.svg">
                                            <p class="stat_title">Fencers with equipment issues</p>
                                            <p class="stat_number">56</p>
                                        </a>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="db_panel">
                        <div class="db_panel_header">
                            <img src="../assets/icons/pie_chart_black.svg" />
                            <p>Data by Nation and Club</p>
                        </div>



                        <div class="db_panel_main small entry_wrapper">
                            <div class="entry">
                                <div class="tr">
                                    <?php if ($sort_by == "nation") { ?>
                                    <div class="td bold"><p>{NATION}</p></div>
                                    <?php } else { ?>
                                    <div class="td bold"><p>{club}</p></div>
                                    <?php } ?>
                                    <div class="td"><p>{NUMBER OF FENCERS} Fencers</p></div>
                                    <div class="td"><p>{NUMBER OF ISSUES} Issues</p></div>
                                    <div class="td"><p>{Most common issue} (Count)</p></div>
                                </div>
                                <div class="entry_panel split">
                                    <table class="small">
                                        <thead class="no_background">
                                            <tr>
                                                <th><p>ISSUE</p></th>
                                                <th><p>NUMBER OF ISSUES</p></th>
                                            </tr>
                                        </thead>
                                        <tbody class="alt">
                                            <tr>
                                                <td><p>Isuename issuename</p></td>
                                                <td><p>Isuename issuename</p></td>
                                            </tr>
                                            <tr>
                                                <td><p>Isuename issuename</p></td>
                                                <td><p>Isuename issuename</p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="small">
                                        <thead class="no_background">
                                            <tr>
                                                <th><p>FENCER NAME</p></th>
                                                <th><p>NUMBER OF ISSUES</p></th>
                                            </tr>
                                        </thead>
                                        <tbody class="alt">
                                            <tr>
                                                <td><p>LONG NAMED dimitry</p></td>
                                                <td><p>Isuename issuename</p></td>
                                            </tr>
                                            <tr>
                                                <td><p>LONG NAMED dimitry</p></td>
                                                <td><p>Isuename issuename</p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>




                        </div>
                    </div>
                    <div class="db_panel">
                        <div class="db_panel_header">
                            <img src="../assets/icons/pie_chart_black.svg" />
                            <p>Most to least common equipment issue</p>
                        </div>
                        <div class="db_panel_main small">
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            <p>ISSUE NAME</p>
                                        </th>
                                        <th>
                                            <p>NUMBER OF ISSUES</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="alt">
                                    <?php
                                        foreach ($assoc_sorted_issues_array as $key => $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <p><?php echo $key ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $value ?></p>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="db_panel">
                        <div class="db_panel_header">
                            <img src="../assets/icons/pie_chart_black.svg" />
                            <p>All additional notes on weapon controls</p>
                        </div>
                        <div class="db_panel_main small">
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            <p>NOTE</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="alt">
                                    <?php
                                        $qry_select_notes = "SELECT `notes`, `fencer_id` FROM `weapon_control` WHERE `assoc_comp_id` = '$comp_id' AND notes != ''";
                                        $do_select_notes = mysqli_query($connection, $qry_select_notes);
                                        echo mysqli_error($connection);
                                        while ($row = mysqli_fetch_assoc($do_select_notes)) {
                                            $note_fencer_id = $row['fencer_id'];
                                            $notes = $row["notes"];

                                    ?>
                                    <tr>
                                        <td>
                                            <p fencer_id='<?php echo $note_fencer_id ?>'><?php echo $notes ?></p>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="print_only">
                    <div>
                        <p class="print_title">General Weapon Control Statistics</p>
                        Immidiate
                        <div class="print_stat">
                            <img src="../assets/icons/weapon_control_black.svg">
                            <p class="bold">Weapon Controls</p>
                            <p>150 / 50</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Issues Reported</p>
                            <p>150</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Fencers without equipment issues</p>
                            <p>150</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Fencers with equipment issues</p>
                            <p>19</p>
                        </div>
                        Administrated
                        <div class="print_stat">
                            <img src="../assets/icons/weapon_control_black.svg">
                            <p class="bold">Check-ins</p>
                            <p>150 / 50</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/weapon_control_black.svg">
                            <p class="bold">Check-outs</p>
                            <p>150 / 50</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/weapon_control_black.svg">
                            <p class="bold">Weapon Controls</p>
                            <p>150 / 50</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Issues Reported</p>
                            <p>150</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Fencers without equipment issues</p>
                            <p>150</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Fencers with equipment issues</p>
                            <p>19</p>
                        </div>
                    </div>
                    <div>
                        <p class="print_title">Data by Nation and Club</p>
                        <div class="entry">
                            <div class="tr">
                                <div class="td bold"><p>{NATION}</p></div>
                                <div class="td bold"><p>{CLUB}</p></div>
                                <div class="td"><p>{NUMBER OF FENCERS} Fencers</p></div>
                                <div class="td"><p>{NUMBER OF ISSUES} Issues</p></div>
                                <div class="td"><p>{Most common issue} (Count)</p></div>
                            </div>
                            <div class="entry_panel split">
                                <table class="small">
                                    <thead class="no_background">
                                        <tr>
                                            <th><p>ISSUE</p></th>
                                            <th><p>NUMBER OF ISSUES</p></th>
                                        </tr>
                                    </thead>
                                    <tbody class="alt">
                                        <tr>
                                            <td><p>Isuename issuename</p></td>
                                            <td><p>Isuename issuename</p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Isuename issuename</p></td>
                                            <td><p>Isuename issuename</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="small">
                                    <thead class="no_background">
                                        <tr>
                                            <th><p>FENCER NAME</p></th>
                                            <th><p>NUMBER OF ISSUES</p></th>
                                        </tr>
                                    </thead>
                                    <tbody class="alt">
                                        <tr>
                                            <td><p>LONG NAMED dimitry</p></td>
                                            <td><p>Isuename issuename</p></td>
                                        </tr>
                                        <tr>
                                            <td><p>LONG NAMED dimitry</p></td>
                                            <td><p>Isuename issuename</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="print_title">Most to least common equipment issue</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <p>ISSUE NAME</p>
                                    </th>
                                    <th>
                                        <p>NUMBER OF ISSUES</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="alt">
                                <tr>
                                    <td>
                                        <p>{Issue name}</p>
                                    </td>
                                    <td>
                                        <p>{Issue count}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>{Issue name}</p>
                                    </td>
                                    <td>
                                        <p>{Issue count}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <p class="print_title">All additional notes on weapon controls</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <p>NOTE</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="alt">
                                <tr>
                                    <td>
                                        <p>{NOTE}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>{NOTE}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/weapon_control.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/controls.js"></script>
</body>
</html>