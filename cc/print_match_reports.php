<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php

//Get table object for further use
$qry_get_table = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
$qry_get_table_do = mysqli_query($connection, $qry_get_table);

if ($row = mysqli_fetch_assoc($qry_get_table_do)) {

    $out_table = json_decode($row["data"]);
}

$table_round = $_GET["table_round"];


//get data for display from db
$qry_get_data = "SELECT * FROM formulas WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);
if ($row = mysqli_fetch_assoc($do_get_data)) {
    $json_string = $row['data'];
}

$json_table = json_decode($json_string);
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
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Print Match Reports</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button bold" onclick="window.close()" shortcut="SHIFT+C">
                        <p>Close Page</p>
                        <img src="../assets/icons/close_black.svg" />
                    </button>
                    <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                        <p>Print Selected Table</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                </div>

                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg" />
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main" class="loose">
                <div class="search_wrapper wide fixed">

                    <button type="button" class="search select altalt" onfocus="isOpen(this)" onblur="isClosed(this)">
                        <input type="text" name="" placeholder="Select Table" value="<?php

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
                            <a type="button" id="gr" href="print_match_reports.php?comp_id=<?php echo $comp_id . "&table_round=" . $round_name ?>"><?php echo "Table of " . ltrim($round_name, "t_") ?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php

                if (isset($_GET["table_round"])) {

                ?>

                        <div id="pool_print_wrapper" class="paper_wrapper">

                            <?php

                            $counter = 3;

                            foreach ($out_table->$table_round as $key => $value) {
                                if ($counter == 3) {
                                    echo '<div class="paper"><div class="paper_content full">';
                                    $counter = 0;
                                }
                            ?>

                                <div class="match_report">
                                    <table class="report_information">
                                        <tr>
                                            <td><?php echo $table_round . "_" . $key ?></td>
                                            <td><?php echo $value->referees->ref->name ?></td>
                                            <td class="signature">REFEREE'S SIGNATURE</td>
                                            <td><?php echo $value->pistetime->pistename ?></td>
                                            <td><?php echo $value->pistetime->time ?></td>
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

                                                <?php

                                                foreach ($value as $key => $match) {
                                                    if ($key == "referees" || $key == "pistetime") {
                                                        continue;
                                                    }

                                                ?>
                                                    <tr>
                                                        <td><?php echo $match->name ?></td>

                                                        <?php

                                                        for ($i = 0; $i < $json_table->tablePoints; $i++) {
                                                            echo '<td class="square"></td>';
                                                        }

                                                        ?>

                                                    </tr>

                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="report_footer">
                                        <div class="report_fencers">

                                            <?php foreach ($value as $key => $match) {
                                                if ($key == "referees" || $key == "pistetime") {
                                                    continue;
                                                }
                                            ?>
                                                <table>
                                                    <tr>
                                                        <td><?php echo $match->name ?></td>
                                                        <td class="signature">SIGNATURE</td>
                                                    </tr>
                                                </table>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="report_misc">
                                            <div>
                                                <p>NOTES</p>
                                                <div class="notes">

                                                </div>
                                            </div>
                                            <div>
                                                <table>
                                                    <?php

                                                    $count = 0;

                                                    foreach ($value as $key => $match) {
                                                        if ($key == "referees" || $key == "pistetime") {
                                                            continue;
                                                        }
                                                        if ($count == 0) {
                                                            $count = 1;
                                                            echo '<tr><td rowspan="2">WINNER</td>';
                                                        }
                                                    ?>
                                                        <td><?php echo $match->name ?></td>
                                                        <td class="square"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                if ($counter == 2) {
                                    echo '</div></div>';
                                }

                                $counter++;
                            } ?>
                        </div>


                <?php
                }
                ?>

            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/search.js"></script>
    <script src="javascript/print.js"></script>
</body>

</html>