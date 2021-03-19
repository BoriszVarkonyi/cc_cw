<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
} else {
    echo mysqli_error($connection);
}

$fencers = count($json_table);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Pools</title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>

<body>
    <!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">View Pools</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button primary" href="print_pools.php?comp_id=<?php echo $comp_id ?>" target="_blank" id="printButton">
                        <p>Print Pools</p>
                        <img src="../assets/icons/print-black-18dp.svg"/>
                    </a>
                    <a class="stripe_button primary <?php echo $is_disabled ?>" href="process_pools.php?comp_id=<?php echo $comp_id ?>" target="_blank">
                        <p>Finish Pools</p>
                        <img src="../assets/icons/save-black-18dp.svg"/><!-- ide kell majd egy másik icon pls krisz segits-->
                    </a>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="pool_listing" class="state_2 wrapper">
                    <?php

                    $qry_get_pool_number = "SELECT MAX(`pool_number`) FROM `pools_$comp_id`";
                    $do_get_pool_number = mysqli_query($connection, $qry_get_pool_number);
                    if ($row = mysqli_fetch_assoc($do_get_pool_number)) {
                        $pool_of = $row['MAX(`pool_number`)'];
                    }

                    $f = [];
                    for ($i = 1; $i <= $pool_of; $i++) {

                        $inside_query = "SELECT * FROM pools_$comp_id WHERE pool_number = $i";
                        $inside_query_do = mysqli_query($connection, $inside_query);

                        if ($row = mysqli_fetch_assoc($inside_query_do)) {

                            $pool_f_in = $row["pool_of"];
                            $f[0] = $row['f1'];
                            $f[1] = $row['f2'];
                            $f[2] = $row['f3'];
                            $f[3] = $row['f4'];
                            $f[4] = $row['f5'];
                            $f[5] = $row['f6'];
                            $f[6] = $row['f7'];
                            $ref = $row["ref"];
                            $ref_2 = $row["ref2"];
                            $piste = $row["piste"];
                            $time = $row["time"];


                            $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = '$ref'";
                            $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                            if ($refrow = mysqli_fetch_assoc($get_ref_name_do)) {

                                $refname = $refrow["full_name"];
                                $refnat = $refrow["nat"];
                            }

                            $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = '$ref_2'";
                            $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                            $ref2name = "";
                            $ref2nat = "";

                            if ($refrow = mysqli_fetch_assoc($get_ref_name_do)) {

                                $ref2name = $refrow["full_name"];
                                $ref2nat = $refrow["nat"];
                            }
                        } ?>
                        <div>
                            <div class="entry">
                                <div class="table_row start">
                                    <div class="table_item bold">No. <?php echo $i ?></div>
                                    <div class="table_item">Piste <?php echo $piste ?></div>
                                    <div class="table_item">Ref: <?php echo $refname ?></div>
                                    <div class="table_item"><?php echo $time ?></div>
                                    <button type="button" onclick="window.location.href='pool_results.php?comp_id=<?php echo $comp_id ?>&poolid=<?php echo $i ?>'" class="pool_config">
                                        <img src="../assets/icons/open_in_new-black-18dp.svg">
                                    </button>
                                </div>
                                <div class="entry_panel">
                                    <div class="pool_table_wrapper table">
                                        <div class="table_header">
                                            <div class="table_header_text">
                                                Fencers name
                                            </div>
                                            <div class="table_header_text">
                                                Fencers nationality
                                            </div>
                                            <div class="table_header_text square">
                                                No.
                                            </div>
                                            <?php
                                            for ($k = 0; $k < $pool_f_in; $k++) { ?>
                                                <div class="table_header_text square">
                                                    <?php echo $k + 1; ?>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="table_row_wrapper alt">
                                            <?php
                                            for ($n = 0; $n < $pool_f_in; $n++) {
                                                $fx = $f[$n];
                                                $get_fencer_data = "SELECT * FROM cptrs_$comp_id WHERE id = '$fx'";
                                                $do_get_fencer_data = mysqli_query($connection, $get_fencer_data);

                                                if ($row = mysqli_fetch_assoc($do_get_fencer_data)) {
                                                    $fencer_nat = $row['nationality'];
                                                    $fencer_name = $row['name'];
                                                } ?>


                                                <div class="table_row">
                                                    <div class="table_item"><?php echo $fencer_name ?></div>
                                                    <div class="table_item"><?php echo $fencer_nat ?></div>
                                                    <div class="table_item square row_title"><?php echo $n + 1 ?></div>
                                                    <?php
                                                    $filled = "";
                                                    for ($l = 0; $l < $pool_f_in; $l++) {

                                                        if ($l == $n) {

                                                            $filled = "filled";
                                                        } ?>

                                                        <div class="table_item square <?php echo $filled ?>">

                                                            <?php
                                                            $front = 0;
                                                            $back = 0;
                                                            if ($l > $n) {

                                                                $front = $n + 1;
                                                                $back = $l + 1;
                                                            } else {

                                                                $front = $l + 1;
                                                                $back = $n + 1;
                                                            }
                                                            if ($l != $n) {
                                                                $scorenow = 0;
                                                                $m_id = $front . "-" . $back;

                                                                if ($l > $n) {
                                                                    $ret = $i + 1;
                                                                    $query_get_scores = "SELECT * FROM pool_matches_$comp_id WHERE m_id = '$m_id' AND p_in = $i";
                                                                    $query_get_scores_do = mysqli_query($connection, $query_get_scores);

                                                                    while ($row4 = mysqli_fetch_assoc($query_get_scores_do)) {

                                                                        $scorenow = $row4["f1_sc"];
                                                                    }
                                                                    echo $scorenow;
                                                                } elseif ($n > $l) {
                                                                    $ret = $i + 1;
                                                                    $query_get_scores = "SELECT * FROM pool_matches_$comp_id WHERE m_id = '$m_id' AND p_in = $i";
                                                                    $query_get_scores_do = mysqli_query($connection, $query_get_scores);

                                                                    while ($row4 = mysqli_fetch_assoc($query_get_scores_do)) {

                                                                        $scorenow = $row4["f2_sc"];
                                                                    }
                                                                    echo $scorenow;
                                                                }
                                                            }

                                                            ?>

                                                        </div>

                                                    <?php
                                                        $filled = "";
                                                    }

                                                    ?>
                                                </div>
                                            <?php
                                            }
                                            ?>
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
        </div>
    </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/pools.js"></script>
<script src="../js/overlay_panel.js"></script>
</html>