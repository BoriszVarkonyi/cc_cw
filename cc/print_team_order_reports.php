<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php
    //get competition data
    $qry_get_comp_data = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $do_get_comp_data = mysqli_query($connection, $qry_get_comp_data);

    if ($row = mysqli_fetch_assoc($do_get_comp_data)) {
        $comp_name = $row['comp_name'];
        $comp_type = weaponConverter($row['comp_weapon']);
        $comp_sex = strtoupper(sexConverter($row['comp_sex']));
        $comp_start = $row['comp_start'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Team Order Reports</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_paper_style.min.css">
    <link rel="stylesheet" href="../css/print_list_style.min.css">
    <link rel="stylesheet" href="../css/print_team_order_reports_style.min.css">
</head>
<body>
    <?php include "includes/navigation.php"; ?>
    <main>
        <div id="title_stripe">
            <p class="page_title">Print Team Order Reports</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button bold" onclick="window.close()" shortcut="SHIFT+C">
                    <p>Close Page</p>
                    <img src="../assets/icons/close_black.svg"/>
                </button>
                <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                    <p>Print All Reports</p>
                    <img src="../assets/icons/print_black.svg"/>
                </button>
            </div>

            <div class="view_button_wrapper first">
                <button onclick="zoomOut()" id="zoomOutButton">
                    <img src="../assets/icons/zoom_out_black.svg"/>
                </button>
                <button onclick="zoomIn()" id="zoomInButton">
                    <img src="../assets/icons/zoom_in_black.svg"/>
                </button>
            </div>
        </div>
        <div id="page_content_panel_main" class="loose">
            <div>
                <div id="pool_print_wrapper" class="paper_wrapper">

                    <div class="paper">
                        <div class="title_container">
                            <div><p class="title">Pool no.: 1</p></div>
                            <div class="pool_info">
                                <div>
                                    <p class="info_label">PISTE:</p>
                                    <p>2</p>
                                </div>
                                <div>
                                    <p class="info_label">REFEREES:</p>
                                    <p>Ref 1</p>
                                    <p>Ref 2</p>
                                </div>
                                <div>
                                    <p class="info_label">TIME:</p>
                                    <p>Time</p>
                                </div>
                            </div>
                            <div class="comp_info">
                                <p class="info_label">Compname</p>
                                <div>
                                    <p>{SEX}'S</p>
                                    <p>WP TYPE</p>
                                </div>
                                <p>Starting year</p>
                            </div>
                        </div>
                        <div class="paper_content">
                            <div class="team_report">
                                <p class="team_title">VASAS</p>
                                <table class="no_interaction">
                                    <thead>
                                        <tr>
                                            <!-- ALWYAYS VISBLE COLUMN -->

                                            <th rowspan="2">
                                                <p>FENCERS NAME</p>
                                            </th>

                                            <!-- FIRST COLUMN -->
                                            <th rowspan="2">
                                                <p>T64</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- SECOND COLUMN -->
                                            <th rowspan="2">
                                                <p>T32</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- THIRD COLUMN -->
                                            <th rowspan="2">
                                                <p>T16</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- FORTH COLUMN -->
                                            <th rowspan="2">
                                                <p>T8</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- FIFTH COLUMN -->
                                            <th rowspan="2">
                                                <p>T4</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- SIXTH COLUMN -->
                                            <th rowspan="2">
                                                <p>T2</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>
                                        </tr>
                                        <tr>
                                            <!-- FIRST COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- SECOND COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- THIRD COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- FORTH COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- FIFTH COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- SIXTH COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>FENCER 1</p>
                                            </td>
                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>


                                        </tr>
                                        <tr>
                                            <td>
                                                <p>FENCER 1</p>
                                            </td>
                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="team_report">
                                <p class="team_title">VASAS</p>
                                <table class="no_interaction">
                                    <thead>
                                        <tr>
                                            <!-- ALWYAYS VISBLE COLUMN -->

                                            <th rowspan="2">
                                                <p>FENCERS NAME</p>
                                            </th>

                                            <!-- FIRST COLUMN -->
                                            <th rowspan="2">
                                                <p>T64</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- SECOND COLUMN -->
                                            <th rowspan="2">
                                                <p>T32</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- THIRD COLUMN -->
                                            <th rowspan="2">
                                                <p>T16</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- FORTH COLUMN -->
                                            <th rowspan="2">
                                                <p>T8</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- FIFTH COLUMN -->
                                            <th rowspan="2">
                                                <p>T4</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- SIXTH COLUMN -->
                                            <th rowspan="2">
                                                <p>T2</p>
                                            </th>
                                            <th>
                                                <p>1-3</p>
                                            </th>
                                            <th class="square"></th>
                                        </tr>
                                        <tr>
                                            <!-- FIRST COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- SECOND COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- THIRD COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- FORTH COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- FIFTH COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>

                                            <!-- SIXTH COLUMN -->
                                            <th>
                                                <p>4-6</p>
                                            </th>
                                            <th class="square"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>FENCER 1</p>
                                            </td>
                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>


                                        </tr>
                                        <tr>
                                            <td>
                                                <p>FENCER 1</p>
                                            </td>
                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="td_wrapper">
                                                    <div></div>
                                                    <div class="td_replacement">
                                                        <p>R</p>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </td>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/print_pools.js"></script>
    <script src="javascript/print.js"></script>
</body>
</html>