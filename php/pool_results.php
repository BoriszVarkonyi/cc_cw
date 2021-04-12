<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
    $qry_get_data = "SELECT fencers, matches FROM pools WHERE assoc_comp_id = '$comp_id'";
    $do_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $fencers_string = $row['fencers'];
        $matches_string = $row['matches'];

        $fencers_table = json_decode($fencers_string);
        $matches_table = json_decode($matches_string);
    }

    $pool_num = $_GET['poolid'];
    $current_f_pool = $fencers_table[$pool_num];
    $current_m_pool = $matches_table[$pool_num-1];

    //get number of fencers in pools
    $pool_f_in = getFencersInPool($current_f_pool);

    //get number of mathces in round robin
    $number_of_matches = $pool_f_in * ($pool_f_in - 1) / 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pool No. <?php echo $pool_num ?> 's results</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Pool No. <?php echo $pool_num ?> 's results</p>
                <input type="text" name="" id="" class="selected_list_item_input">
                <div class="stripe_button_wrapper">
                    <button class="stripe_button disabled" type="button">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/message-black.svg"/>
                    </button>

                    <button class="stripe_button red disabled" type="button" onclick="disqualifyToggle()">
                        <p>Disqualify</p>
                        <img src="../assets/icons/highlight_off-black.svg"/>
                    </button>

                    <button class="stripe_button primary" type="submit">
                        <p>Save Pool</p>
                        <img src="../assets/icons/save-black.svg"/>
                    </button>
                </div>
                <div id="disqualify_panel" class="overlay_panel hidden">
                    <p class="panel_title">Disqualify {Fencer's name}</p>
                    <button class="panel_button" onclick="disqualifyToggle()">
                        <img src="../assets/icons/close-black.svg">
                    </button>
                    <form action="" method="post"  autocomplete="off" class="overlay_panel_form" autocomplete="off">
                        <label for="ref_type">REASON OF DISQUALIFICATION</label>
                        <div class="option_container">
                            <input type="radio" name="ref_type" id="medical" value=""/>
                            <label for="medical">Medical</label>

                            <input type="radio" name="ref_type" id="surrender" value=""/>
                            <label for="surrender">Surrender</label>

                            <input type="radio" name="ref_type" id="exclusion" value=""/>
                            <label for="exclusion">Exclusion</label>
                        </div>

                        <button type="submit" name="submit" class="submit_button" value="Disqualify">Disqualify</button>
                    </form>
                </div>

            </div>

            <div id="page_content_panel_main">
                <div class="wrapper full" id="pool_results">
                    <div>


                    <?php

                        //get pools data
                        $piste = $current_f_pool -> piste;
                        $time =  $current_f_pool -> time;

                        $ref1name = $current_f_pool -> ref1 -> prenom . $current_f_pool -> ref1 -> nom;
                        $ref1nat = $current_f_pool -> ref1 -> nation;

                        if ($current_f_pool -> ref2 != NULL) {
                            $ref2nat = $current_f_pool -> ref2 -> nation;
                            $ref2name = $current_f_pool -> ref2 -> prenom . $current_f_pool -> ref2 -> nom;
                        }
                    ?>
                    <div>
                        <div class="entry">
                            <div class="table_row start">
                                <div class="table_item bold">No. <?php echo $pool_num ?></div>
                                <div class="table_item">Piste <?php echo $piste ?></div>
                                <div class="table_item">Ref:
                                <?php
                                //echo out ref(s)
                                echo $ref1name . " (" . $ref1nat . ")";
                                if ($current_f_pool -> ref2 != NULL) {
                                    echo "Ref 2: " . $ref2name . " (" . $ref2nat . ") ";
                                }
                                ?></div>
                                <div class="table_item"><?php echo $time ?></div>
                            </div>
                            <div class="entry_panel">
                                <div class="pool_table_wrapper table">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text square">
                                            No.
                                        </div>
                                        <?php
                                            //echo out fencer number top(horizontal)
                                            for ($i = 1; $i <= $pool_f_in; $i++ ) {
                                        ?>
                                        <div class="table_header_text square"><?php echo $i ?></div>
                                        <?php
                                            }
                                        ?>
                                    </div>

                                    <div class="table_row_wrapper alt">
                                        <?php
                                            //echo the fencers vertical
                                            for ($f_num = 1; $f_num <= $pool_f_in; $f_num++) {
                                                //get fencers data
                                                $fencer_name = $current_f_pool -> $f_num -> prenom_nom;

                                        ?>

                                        <div id="" class="table_row" onclick="selectRow(this)">
                                            <div class="table_item"><?php echo $fencer_name ?></div>
                                            <div class="table_item square row_title"><?php echo $f_num ?></div>
                                            <?php
                                                for ($i = 1; $i <= $pool_f_in; $i++) {

                                                    //get scores from matches_table!

                                                    if ($i == $f_num) {
                                                        ?><div class="table_item square filled"></div><?php
                                                    } else {
                                                        ?><div class="table_item square"></div><?php
                                                    }

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







                    <div id="pool_matches">

                        <?php



                        ?>
                        <div class="match <?php echo $szin = ($f1_sc == NULL ? "red" : "green") ?>">
                            <div class="match_number">
                                <p>Match num</p>
                            </div>
                            <div>
                                <p>fencer 1</p>
                                <input type="number" form="savepool" placeholder="#" name="" id="" class="number_input" value="">
                            </div>
                            <div class="vs">
                                <p>VS.</p>
                            </div>
                            <div>
                                <input type="number" form="savepool" placeholder="#" name="" id="" class="number_input" value="">
                                <p>fencer 2</p>
                            </div>
                        </div>


                        <?php



                        ?>


                    </div>
                </div>
            </div>
        </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/pool_results.js"></script>
    <script src="../js/overlay_panel.js"></script>
</body>
</html>
