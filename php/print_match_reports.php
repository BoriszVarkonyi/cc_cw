<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
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
    <title>Print Pool Matches</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_paper_style.min.css">
    <link rel="stylesheet" href="../css/print_list_style.min.css">
    <link rel="stylesheet" href="../css/print_match_reports_style.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Print Match Reports</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button" onclick="window.close()" shortcut="SHIFT+C">
                        <p>Close Page</p>
                        <img src="../assets/icons/close_black.svg"/>
                    </button>
                    <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                        <p>Print Selected Table</p>
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
                <div class="search_wrapper wide fixed">
                    <button type="button" class="search select altalt" onfocus="isOpen(this)" onblur="isClosed(this)">
                        <input type="text" name="" placeholder="Select Table" value="">
                    </button>
                    <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                    <div class="search_results">
                        <a type="button" href="print_match_reports.php?comp_id=">Table of 32</a>
                    </div>
                </div>
                <div>
                    <div id="pool_print_wrapper" class="paper_wrapper">

                        <div class="paper">
                            <div class="paper_content full">

                                <div class="match_report">
                                    <table class="report_information">
                                        <tr>
                                            <td>MATCH ID</td>
                                            <td>REFEREE</td>
                                            <td class="signature">{REFEREE}'S SIGNATURE</td>
                                            <td>PISTE</td>
                                            <td>TIME</td>
                                        </tr>
                                    </table>
                                    <div class="report_content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>NAME</th>
                                                    <th class="square">1.</th>
                                                    <th class="square">2.</th>
                                                    <th class="square">3.</th>
                                                    <th class="square">4.</th>
                                                    <th class="square">5.</th>
                                                    <th class="square">6.</th>
                                                    <th class="square">7.</th>
                                                    <th class="square">8.</th>
                                                    <th class="square">9.</th>
                                                    <th class="square">10.</th>
                                                    <th class="square">11.</th>
                                                    <th class="square">12.</th>
                                                    <th class="square">13.</th>
                                                    <th class="square">14.</th>
                                                    <th class="square">15.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                </tr>
                                                <tr>
                                                    <td>FENCER 2</td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="report_footer">
                                        <div class="report_fencers">
                                            <table>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="signature">SIGNATURE</td>
                                                </tr>
                                            </table>
                                            <table>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="signature">SIGNATURE</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="report_misc">
                                            <div>
                                                <p>NOTES</p>
                                                <div class="notes">

                                                </div>
                                            </div>
                                            <div>
                                                <table>
                                                    <tr>
                                                        <td rowspan="2">WINNER</td>
                                                        <td>FENCER 1</td>
                                                        <td class="square"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FENCER 1</td>
                                                        <td class="square"></td>
                                                    </tr>
                                                </table>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="match_report">
                                    <table class="report_information">
                                        <tr>
                                            <td>MATCH ID</td>
                                            <td>REFEREE</td>
                                            <td class="signature">{REFEREE}'S SIGNATURE</td>
                                            <td>PISTE</td>
                                            <td>TIME</td>
                                        </tr>
                                    </table>
                                    <div class="report_content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>NAME</th>
                                                    <th class="square">1.</th>
                                                    <th class="square">2.</th>
                                                    <th class="square">3.</th>
                                                    <th class="square">4.</th>
                                                    <th class="square">5.</th>
                                                    <th class="square">6.</th>
                                                    <th class="square">7.</th>
                                                    <th class="square">8.</th>
                                                    <th class="square">9.</th>
                                                    <th class="square">10.</th>
                                                    <th class="square">11.</th>
                                                    <th class="square">12.</th>
                                                    <th class="square">13.</th>
                                                    <th class="square">14.</th>
                                                    <th class="square">15.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                </tr>
                                                <tr>
                                                    <td>FENCER 2</td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="report_footer">
                                        <div class="report_fencers">
                                            <table>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="signature">SIGNATURE</td>
                                                </tr>
                                            </table>
                                            <table>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="signature">SIGNATURE</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="report_misc">
                                            <div>
                                                <p>NOTES</p>
                                                <div class="notes">

                                                </div>
                                            </div>
                                            <div>
                                                <table>
                                                    <tr>
                                                        <td rowspan="2">WINNER</td>
                                                        <td>FENCER 1</td>
                                                        <td class="square"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FENCER 1</td>
                                                        <td class="square"></td>
                                                    </tr>
                                                </table>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="match_report">
                                    <table class="report_information">
                                        <tr>
                                            <td>MATCH ID</td>
                                            <td>REFEREE</td>
                                            <td class="signature">{REFEREE}'S SIGNATURE</td>
                                            <td>PISTE</td>
                                            <td>TIME</td>
                                        </tr>
                                    </table>
                                    <div class="report_content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>NAME</th>
                                                    <th class="square">1.</th>
                                                    <th class="square">2.</th>
                                                    <th class="square">3.</th>
                                                    <th class="square">4.</th>
                                                    <th class="square">5.</th>
                                                    <th class="square">6.</th>
                                                    <th class="square">7.</th>
                                                    <th class="square">8.</th>
                                                    <th class="square">9.</th>
                                                    <th class="square">10.</th>
                                                    <th class="square">11.</th>
                                                    <th class="square">12.</th>
                                                    <th class="square">13.</th>
                                                    <th class="square">14.</th>
                                                    <th class="square">15.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                </tr>
                                                <tr>
                                                    <td>FENCER 2</td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                    <td class="square"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="report_footer">
                                        <div class="report_fencers">
                                            <table>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="signature">SIGNATURE</td>
                                                </tr>
                                            </table>
                                            <table>
                                                <tr>
                                                    <td>FENCER 1</td>
                                                    <td class="signature">SIGNATURE</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="report_misc">
                                            <div>
                                                <p>NOTES</p>
                                                <div class="notes">

                                                </div>
                                            </div>
                                            <div>
                                                <table>
                                                    <tr>
                                                        <td rowspan="2">WINNER</td>
                                                        <td>FENCER 1</td>
                                                        <td class="square"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FENCER 1</td>
                                                        <td class="square"></td>
                                                    </tr>
                                                </table>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/print.js"></script>
</body>
</html>