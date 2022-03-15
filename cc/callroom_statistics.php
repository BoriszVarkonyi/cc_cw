<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php include "includes/wc_issues_array.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php
    //set group by
    $qry_get_formula = "SELECT data FROM formulas WHERE assoc_comp_id = '$comp_id'";
    $do_get_formula = mysqli_query($connection, $qry_get_formula);
    if ($row = mysqli_fetch_assoc($do_get_formula)) {
        $formula_string = $row['data'];
        $formula_table = json_decode($formula_string);

        $sort_by_num = $formula_table -> groupBy;
        $sort_by = sortByConverter($sort_by_num);

    } else {
        echo "error:    " . mysqli_error($connection);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Callroom Statistics</title>
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
                <p class="page_title">Callroom Statistics</p>
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
                            <p>General Callroom Statistics</p>
                        </div>
                        <div class="db_panel_main small">
                            <div class="stats_wrapper">
                                <a class="stat" href="callroom_immediate.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/weapon_control_black.svg">
                                    <p class="stat_title">Callrooms</p>
                                    <p class="stat_number">52 / 4</p>
                                </a>
                                <a class="stat" href="callroom_statistics.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/report_problem_black.svg">
                                    <p class="stat_title">Issues Reported</p>
                                    <p class="stat_number">14</p>
                                </a>
                                <a class="stat" href="callroom_statistics.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/report_problem_black.svg">
                                    <p class="stat_title">Fencers without equipment issues</p>
                                    <p class="stat_number">3</p>
                                </a>
                                <a class="stat" href="callroom_statistics.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/report_problem_black.svg">
                                    <p class="stat_title">Fencers with equipment issues</p>
                                    <p class="stat_number">1</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="db_panel">
                        <div class="db_panel_header">
                            <img src="../assets/icons/pie_chart_black.svg" />
                            <p>Data by <?php echo strtoupper($sort_by) ?></p>
                        </div>
                        <div class="db_panel_main small entry_wrapper">
                        <?php foreach($teams_sum_issues as $nation => $issues_array) {  if (count($issues_array) > 0) {?>
                            <div class="entry">
                                <div class="tr">
                                    <div class="td bold"><p><?php echo $nation ?></p></div>
                                    <div class="td"><p><?php echo $fencer_in_team[$nation] ?> Fencers</p></div>
                                    <div class="td"><p><?php echo $issue_num_teams[$nation] ?> Issues</p></div>
                                    <?php if (reset($teams_sum_issues[$nation]) != 0) { ?>
                                    <div class="td"><p><?php echo key($teams_sum_issues[$nation]) . " (" . reset($teams_sum_issues[$nation]) . ")" ?></p></div>
                                    <?php } ?>
                                </div>
                                <div class="entry_panel split">
                                    <table class="small no_interaction">
                                        <thead class="no_background">
                                            <tr>
                                                <th><p>ISSUE</p></th>
                                                <th><p>NUMBER OF ISSUES</p></th>
                                            </tr>
                                        </thead>
                                        <tbody class="alt">

                                            <?php $empty = true; foreach ($teams_sum_issues[$nation] as $key => $value) { if ($value != 0) { $empty = false; ?>
                                            <tr>
                                                <td><p><?php echo $key ?></p></td>
                                                <td><p><?php echo $value ?></p></td>
                                            </tr>
                                            <?php }} if ($empty) {  ?>
                                            <tr>
                                                <td colspan="2">
                                                <p>No known issues!</p>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <table class="small no_interaction">
                                        <thead class="no_background">
                                            <tr>
                                                <th><p>FENCER NAME</p></th>
                                                <th><p>NUMBER OF ISSUES</p></th>
                                            </tr>
                                        </thead>
                                        <tbody class="alt">

                                        <?php foreach ($teams_indi_issues[$nation] as $name => $value_array){ ?>

                                            <tr>
                                                <td><p><?php echo $name ?></p></td>
                                                <td><p><?php echo $value_array["issues"] ?></p></td>
                                            </tr>
                                            <?php } ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>


                                        <?php }} ?>

                        </div>
                    </div>
                    <div class="db_panel">
                        <div class="db_panel_header">
                            <img src="../assets/icons/pie_chart_black.svg" />
                            <p>Most to least common equipment issue</p>
                        </div>
                        <div class="db_panel_main small">
                            <table class="no_interaction">
                                <thead class="no_stick">
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
                                    /*
                                        $empty = true;
                                        foreach ($assoc_sorted_issues_array as $key => $value) {
                                        $empty = false;
                                    */
                                    ?>
                                    <tr>
                                        <td>
                                            <p><?php /* echo $key */ ?>issue name</p>
                                        </td>
                                        <td>
                                            <p><?php /* echo $value */ ?> no. of issues</p>
                                        </td>
                                    </tr>

                                    <?php
                                    /*
                                        }
                                        if ($empty)  {*/?>

                                    <tr>
                                        <td colspan="2">
                                            <p>No known issues yet!</p>
                                        </td>
                                    </tr>


                                        <?php /*}*/
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="print_only">
                    <div>

                        <p class="print_title">General Callroom Statistics</p>

                        <div class="print_stat">
                            <img src="../assets/icons/weapon_control_black.svg">
                            <p class="bold">Callrooms</p>
                            <p>54 / 4</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Issues Reported</p>
                            <p>5</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Fencers without equipment issues</p>
                            <p>1</p>
                        </div>
                        <div class="print_stat">
                            <img src="../assets/icons/report_problem_black.svg">
                            <p class="bold">Fencers with equipment issues</p>
                            <p>1</p>
                        </div>

                    </div>

                    <div>
                        <p class="print_title">Data by <?php echo strtoupper($sort_by) ?></p>
                        <?php foreach($teams_sum_issues as $nation => $issues_array) {  if (count($issues_array) > 0) {?>
                        <div class="entry">
                            <div class="tr">
                                <div class="td bold"><p><?php echo $nation ?></p></div>
                                <div class="td"><p><?php echo $fencer_in_team[$nation] ?> Fencers</p></div>
                                <div class="td"><p><?php echo $issue_num_teams[$nation] ?> Issues</p></div>
                                <?php if (reset($teams_sum_issues[$nation]) != 0) { ?>
                                <div class="td"><p><?php echo key($teams_sum_issues[$nation]) . " (" . reset($teams_sum_issues[$nation]) . ")" ?></p></div>
                                <?php } ?>
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
                                        <?php $empty = true; foreach ($teams_sum_issues[$nation] as $key => $value) { if ($value != 0) { $empty = false; ?>
                                        <tr>
                                            <td><p><?php echo $key ?></p></td>
                                            <td><p><?php echo $value ?></p></td>
                                        </tr>
                                        <?php }} if ($empty) {  ?>
                                        <tr>
                                            <td colspan="2">
                                            <p>No known issues!</p>
                                            </td>
                                        </tr>
                                        <?php } ?>
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

                                        <?php foreach ($teams_indi_issues[$nation] as $name => $value_array){ ?>

                                            <tr>
                                                <td><p><?php echo $name ?></p></td>
                                                <td><p><?php echo $value_array["issues"] ?></p></td>
                                            </tr>
                                            <?php } ?>



                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                    <div>
                        <p class="print_title">Most to least common equipment issue</p>
                        <table>
                            <thead class="no_stick">
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
                                        $empty = true;
                                        foreach ($assoc_sorted_issues_array as $key => $value) {
                                        $empty = false;
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
                                        if ($empty)  {?>

                                    <tr>
                                        <td colspan="2">
                                            <p>No known issues yet!</p>
                                        </td>
                                    </tr>


                                        <?php }
                                    ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/controls.js"></script>
</body>
</html>