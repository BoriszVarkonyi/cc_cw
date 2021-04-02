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
    <title>Print Pools</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_pools_style.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Print Pools</p>
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                            <p id="save_text">Print All Pools</p>
                            <img src="../assets/icons/print-black.svg"/>
                        </button>
                    </div>

                    <div class="view_button_wrapper zoom">
                        <button class="view_button" onclick="zoomOut()" id="zoomOutButton">
                            <img src="../assets/icons/zoom_out-black.svg"/>
                        </button>
                        <button class="view_button" onclick="zoomIn()" id="zoomInButton">
                            <img src="../assets/icons/zoom_in-black.svg"/>
                        </button>
                    </div>
                </div>
                <div id="page_content_panel_main" class="loose">
                    <div>
                        <div id="pool_print_wrapper" class="paper_wrapper">
                            <?php
                                $qry_get_pool = "SELECT * FROM `pools_$comp_id`";
                                $do_get_pool = mysqli_query($connection, $qry_get_pool);

                                while ($row = mysqli_fetch_assoc($do_get_pool)) {
                                $pool_num = $row['pool_number'];
                                $pool_of = $row['pool_of'];
                                $ref1 = $row['ref'];
                                $ref2 = $row['ref2'];
                                $piste = $row['piste'];
                                $time = $row['time'];


                                if ($ref1 != 0) {

                                    $qry_get_ref = "SELECT `full_name` FROM `ref_$comp_id` WHERE id = $ref1";
                                    $do_get_ref = mysqli_query($connection, $qry_get_ref);
                                    if ($row = mysqli_fetch_assoc($do_get_ref)) {
                                        $ref1_name = $row['full_name'];
                                    }
                                } else {
                                    $ref1_name = "Referees are not set up!";
                                }
                                if ($ref2 != 0) {

                                    $qry_get_ref2 = "SELECT `full_name` FROM `ref_$comp_id` WHERE id = $ref2";
                                    $do_get_ref2 = mysqli_query($connection, $qry_get_ref2);
                                    if ($row = mysqli_fetch_assoc($do_get_ref2)) {
                                        $ref2_name = $row['full_name'];
                                    }
                                } else {
                                    $ref2_name = "";
                                }

                            ?>
                            <div class="pool_print" class="paper">
                                <div class="title_container">
                                    <div><p class="title">Pool no.: <?php echo $echo = isset($pool_num) ? $pool_num : "Pool number is not set" ?></p></div>
                                    <div class="pool_info">
                                        <div>
                                            <p class="info_label">PISTE:</p>
                                            <p><?php echo $echo = $piste != 0 ? $piste : "Piste is not set" ?></p>
                                        </div>
                                        <div>
                                            <p class="info_label">REFEREES:</p>
                                            <p><?php echo $ref1_name ?></p>
                                            <p><?php echo $ref2_name ?></p>
                                        </div>
                                        <div>
                                            <p class="info_label">TIME:</p>
                                            <p><?php echo $echo = $time != "" ? $time : "Starting time is not set" ?></p>
                                        </div>
                                    </div>
                                    <div class="comp_info">
                                        <p class="info_label"><?php echo $comp_name ?></p>
                                        <div>
                                            <p><?php echo $comp_sex ?>'S</p>
                                            <p><?php echo $comp_type ?></p>
                                        </div>
                                        <p><?php echo $comp_start ?></p>
                                    </div>
                                </div>
                                <div class="paper_content">
                                    <div class="pool_matches">
                                        <?php
                                            $fencer_signiture = [];
                                            $fencer_grid = [];

                                            $qry_get_pool_match = "SELECT * FROM `pool_matches_$comp_id` WHERE `p_in` = '$pool_num'";
                                            $do_get_pool_match = mysqli_query($connection, $qry_get_pool_match);
                                            while ($row = mysqli_fetch_assoc($do_get_pool_match)) {

                                                $m_id = $row['m_id'];
                                                $f1_id = $row['f1_id'];
                                                $f2_id = $row['f2_id'];
                                                $oip = $row['oip'];

                                                $m_id_array = explode("-", $m_id);


                                                //get fencer data by id
                                                $qry_get_fencer_data1 = "SELECT `name` FROM cptrs_$comp_id WHERE id = '$f1_id'";
                                                $do_get_fencer_data1 = mysqli_query($connection, $qry_get_fencer_data1);
                                                if ($row = mysqli_fetch_assoc($do_get_fencer_data1)) {
                                                    $f1_name = $row['name'];
                                                } else {
                                                    echo mysqli_error($connection);
                                                }
                                                $qry_get_fencer_data2 = "SELECT `name` FROM cptrs_$comp_id WHERE id = '$f2_id'";
                                                $do_get_fencer_data2 = mysqli_query($connection, $qry_get_fencer_data2);
                                                if ($row = mysqli_fetch_assoc($do_get_fencer_data2)) {
                                                    $f2_name = $row['name'];
                                                } else {
                                                    echo mysqli_error($connection);
                                                }

                                                array_push($fencer_signiture, $m_id_array[0] . ". " . $f1_name);
                                                array_push($fencer_signiture, $m_id_array[1] . ". " . $f2_name);
                                                $fencer_signiture = array_unique($fencer_signiture);
                                                $fencer_grid[$m_id_array[0]] = $f1_name;
                                                $fencer_grid[$m_id_array[1]] = $f2_name;


                                        ?>
                                        <div class="pool_match">
                                            <div class="number">
                                                <p><?php echo $oip?></p>
                                            </div>
                                            <div class="numbering">
                                                <p><?php echo $m_id_array[0] ?>.</p>
                                                <p><?php echo $m_id_array[1] ?>.</p>
                                            </div>
                                            <div class="names">
                                                <p><?php echo $f1_name ?></p>
                                                <p><?php echo $f2_name ?></p>
                                            </div>
                                            <div class="grid">
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="signatures">
                                        <div class="grid_table fencers">
                                            <div class="grid_header">
                                                <div class="grid_header_text">NAME</div>
                                                <div class="grid_header_text square">No.</div>
                                                <?php
                                                for ($i = 1; $i <= $pool_of; $i++) {
                                                ?>
                                                <div class="grid_header_text square"><?php echo $i ?></div>
                                                <?php } ?>
                                                <div class="grid_header_text signature">SIGNATURE</div>
                                            </div>
                                            <div class="grid_row_wrapper">
                                                <?php
                                                    ksort($fencer_grid);
                                                    foreach ($fencer_grid as $key => $value) {




                                                ?>


                                                <div class="grid_row">
                                                    <div class="grid_item"><?php echo $value ?></div>
                                                    <div class="grid_item square header"><?php echo $key . "." ?></div>
                                                    <?php
                                                        for ($i = 1; $i <= $pool_of; $i++ ) {

                                                            if ($i == $key){
                                                                ?><div class="grid_item square filled"></div><?php
                                                            } else {
                                                                ?><div class="grid_item square"></div><?php
                                                            }
                                                        }
                                                    ?>
                                                    <div class="grid_item signature"></div>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="grid_table referees">
                                            <div class="grid_header">
                                                <div class="grid_header_text">NAME</div>
                                                <div class="grid_header_text signature">SIGNATURE</div>
                                            </div>
                                            <div class="grid_row_wrapper">
                                                <div class="grid_row">
                                                    <div class="grid_item"><?php echo $ref1_name ?></div>
                                                    <div class="grid_item signature"></div>
                                                </div>
                                                <?php
                                                    if ($ref2_name != "") {
                                                ?>
                                                <div class="grid_row">
                                                    <div class="grid_item"><?php echo $ref2_name ?></div>
                                                    <div class="grid_item signature"></div>
                                                </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/print_pools.js"></script>
<script src="../js/print.js"></script>
</html>