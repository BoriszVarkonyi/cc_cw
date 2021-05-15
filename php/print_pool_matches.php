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
    <link rel="stylesheet" href="../css/print_pool_matches_style.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Print Pool Matches</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button bold" onclick="window.close()" shortcut="SHIFT+C">
                        <p>Close Page</p>
                        <img src="../assets/icons/close_black.svg"/>
                    </button>
                    <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                        <p>Print All Pools</p>
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

                        <div class="pool_print" class="paper">
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
                                <div class="pool_matches">

                                    <div class="pool_match">
                                        <div class="number">
                                            <p>1</p>
                                        </div>
                                        <div class="numbering">
                                            <p>1.</p>
                                            <p>2.</p>
                                        </div>
                                        <div class="names">
                                            <p>fencer 1</p>
                                            <p>fencer 2</p>
                                        </div>
                                        <div class="grid">
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="signatures">
                                    <div class="grid_table fencers">
                                        <div class="grid_header">
                                            <div class="grid_header_text">NAME</div>
                                            <div class="grid_header_text square">No.</div>
                                            <div class="grid_header_text square">1</div>
                                            <div class="grid_header_text square">2</div>
                                            <div class="grid_header_text square">3</div>
                                            <div class="grid_header_text signature">SIGNATURE</div>
                                        </div>
                                        <div class="grid_row_wrapper">
                                            <div class="grid_row">
                                                <div class="grid_item">NAME</div>
                                                <div class="grid_item square header">1</div>
                                                <div class="grid_item square filled"></div>
                                                <div class="grid_item square"></div>
                                                <div class="grid_item square"></div>
                                                <div class="grid_item signature"></div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">name</div>
                                                <div class="grid_item square header">2</div>
                                                <div class="grid_item square"></div>
                                                <div class="grid_item square filled"></div>
                                                <div class="grid_item square"></div>
                                                <div class="grid_item signature"></div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">name</div>
                                                <div class="grid_item square header">2</div>
                                                <div class="grid_item square"></div>
                                                <div class="grid_item square"></div>
                                                <div class="grid_item square filled"></div>
                                                <div class="grid_item signature"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid_table referees">
                                        <div class="grid_header">
                                            <div class="grid_header_text">NAME</div>
                                            <div class="grid_header_text signature">SIGNATURE</div>
                                        </div>
                                        <div class="grid_row_wrapper">
                                            <div class="grid_row">
                                                <div class="grid_item">Ref 1 name</div>
                                                <div class="grid_item signature"></div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Ref 2 name</div>
                                                <div class="grid_item signature"></div>
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
    <script src="../js/print_pools.js"></script>
    <script src="../js/print.js"></script>
</body>
</html>