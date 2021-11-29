<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    $qry_get_pools = "SELECT `fencers`, `matches` FROM `pools` WHERE `assoc_comp_id` = '$comp_id'";
    $do_get_pools = mysqli_query($connection, $qry_get_pools);

    if ($row = mysqli_fetch_assoc($do_get_pools)) {
        $json_string = $row['fencers'];
        $fencers_table = json_decode($json_string);
        $json_string = $row['matches'];
        $matches_table = json_decode($json_string);

    } else {
        echo mysqli_error($connection);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Pools</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">View Pools</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button primary" href="print_pool_matches.php?comp_id=<?php echo $comp_id ?>" target="_blank" id="printButton" shortcut="SHIFT+P">
                        <p>Print Pool Matches</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </a>
                    <a class="stripe_button primary <?php echo $is_disabled ?>" href="pools_process.php?comp_id=<?php echo $comp_id ?>" target="_blank" id="finishPools" shortcut="SHIFT+F">
                        <p>Finish Pools</p>
                        <img src="../assets/icons/save_black.svg"/><!-- ide kell majd egy másik icon pls krisz segits-->
                    </a>
                    <form id="barcode_form" method="POST" action="">
                        <button type="button" class="barcode_button" onclick="toggleBarCodeButton(this)">
                            <img src="../assets/icons/barcode_black.svg">
                        </button>
                        <input type="text" name="barcode" class="barcode_input" placeholder="Barcode" onfocus="toggleBarCodeInput(this)" onblur="toggleBarCodeInput(this)">
                        <button type="submit" form="barcode_form"></button>
                    </form>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="pool_listing" class="wrapper state_2 list">
                    <?php

                    for ($pool_num = 1; $pool_num < count($fencers_table); $pool_num++){
                        $current_pool = $fencers_table[$pool_num];

                        $piste = $current_pool -> piste;
                        if ($current_pool -> ref1 !== NULL) {
                            $ref1name = $current_pool -> ref1 -> prenom . " " . $current_pool -> ref1 -> nom;
                        }

                        if ($current_pool -> ref2 != NULL) {
                            $ref2name = $current_pool -> ref2 -> prenom . " " . $current_pool -> ref2 -> nom;
                        }
                        $time = $current_pool -> time;

                        //get number of fencers in pools
                        $number_of_fencers = getFencersInPool($fencers_table[$pool_num]);


                    ?>
                        <div>
                            <div class="entry">
                                <div class="tr">
                                    <div class="td bold">No. <?php echo $pool_num ?></div>
                                    <div class="td">Piste <?php echo $piste ?></div>
                                    <?php
                                    if ($current_pool -> ref2 != NULL) {
                                        ?>><div class="td">Ref1: <?php echo $ref1name ?></div><?php
                                    }
                                    if ($current_pool -> ref2 != NULL) {
                                        ?><div class="td">Ref2: <?php echo $ref2name ?></div><?php
                                    }
                                    ?>
                                    <div class="td"><?php echo $time ?></div>
                                    <button type="button" onclick="window.location.href='pool_results.php?comp_id=<?php echo $comp_id ?>&poolid=<?php echo $pool_num ?>'" class="pool_config td">
                                        <img src="../assets/icons/open_in_new_black.svg">
                                    </button>
                                </div>
                                <div class="entry_panel">
                                    <table class="pool_table_wrapper no_interaction">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <p>NAME</p>
                                                </th>
                                                <th>
                                                    <p>NATION</p>
                                                </th>
                                                <th class="square">
                                                    <p>NO.</p>
                                                </th>
                                            <?php
                                            for ($k = 1; $k <= $number_of_fencers; $k++) { ?>
                                                <th class="square">
                                                    <?php echo $k; ?>
                                                </th>
                                            <?php
                                            }
                                            ?>
                                            </tr>
                                        </thead>
                                        <tbody class="alt">
                                            <?php
                                            for ($n = 1; $n <= $number_of_fencers; $n++) {

                                                $fencer_nat = $current_pool -> {$n} -> nation;
                                                $fencer_name = $current_pool -> {$n} -> prenom_nom;
                                                $fencer_id = $current_pool -> {$n} -> id;

                                                if ($n < 4) {
                                                    $points = $matches_table[$pool_num-1] -> {$n} -> {$number_of_fencers} -> given;
                                                } else {
                                                    $points = $matches_table[$pool_num-1] -> {1} -> {$number_of_fencers} -> gotten;
                                                }

                                                $disq_class = "";
                                                if (isDisqualified($points)) {
                                                    $disq_class = "disqualified";
                                                }

                                                ?>
                                                <tr class="<?php echo $disq_class ?>">
                                                    <td><?php echo $fencer_name ?></td>
                                                    <td><?php echo $fencer_nat ?></td>
                                                    <td class="square row_title"><?php echo $n?></td>
                                                    <?php
                                                    for ($l = 1; $l <= $number_of_fencers; $l++) {

                                                        $color_class = "";

                                                        if ($n == $l) {//middle strip

                                                            $color_class = " filled";

                                                        } else if ($n > $l) { //right upper

                                                            //get points
                                                            $gotten = $matches_table[$pool_num-1] -> {$l} -> {$n} -> gotten;
                                                            $given = $matches_table[$pool_num-1] -> {$l} -> {$n} -> given;
                                                            $win_id = $matches_table[$pool_num-1] -> {$l} -> {$n} -> w_id;

                                                            if (isDisqualified($given) || isDisqualified($gotten)) {
                                                                $color_class = " disqualified";
                                                            } else if ($win_id == $fencer_id) {
                                                                $color_class = " green";
                                                            } else {
                                                                $color_class = " red";
                                                            }

                                                        } else { //left downer

                                                            //get points rev
                                                            $gotten = $matches_table[$pool_num-1] -> {$n} -> {$l} -> gotten;
                                                            $given = $matches_table[$pool_num-1] -> {$n} -> {$l} -> given;
                                                            $win_id = $matches_table[$pool_num-1] -> {$n} -> {$l} -> w_id;

                                                            if (isDisqualified($given) || isDisqualified($gotten)) {
                                                                $color_class = " disqualified";
                                                            } else if ($win_id == $fencer_id) {
                                                                $color_class = " green";
                                                            } else {
                                                                $color_class = " red";
                                                            }
                                                        }
                                                    ?>

                                                        <td class="square <?php echo $color_class ?>">

                                                            <?php
                                                                if ($n > $l) {
                                                                    //ha forditva van a givent meg a gottent kell megcserelni
                                                                    $given = $matches_table[$pool_num-1] -> {$l} -> {$n} -> gotten;
                                                                    echo $given;
                                                                } else if ($n == $l) {
                                                                    echo "x";
                                                                } else {
                                                                    $gotten = $matches_table[$pool_num-1] -> {$n} -> {$l} -> given;
                                                                    echo $gotten;
                                                                }
                                                            ?>

                                                        </td>

                                                    <?php
                                                        $filled = "";
                                                    }

                                                    ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/pools_view.js"></script>
    <script src="../js/overlay_panel.js"></script>
</body>
</html>