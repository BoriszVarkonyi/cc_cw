<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

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
                           Immidiate
                            <div class="stats_wrapper">
                                <a class="stat" href="weapon_control_immediate.php?comp_id=<?php echo $comp_id ?>">
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
                                    <p class="stat_number">38</p>
                                </a>
                                <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/report_problem_black.svg">
                                    <p class="stat_title">Fencers with equipment issues</p>
                                    <p class="stat_number">100</p>
                                </a>
                            </div>
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
                        </div>
                    </div>
                    <div class="db_panel">
                        <div class="db_panel_header">
                            <img src="../assets/icons/pie_chart_black.svg" />
                            <p>Data by Nation or Club</p>
                        </div>
                        <div class="db_panel_main small entry_wrapper">
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