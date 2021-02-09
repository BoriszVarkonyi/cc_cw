<?php include "../includes/db.php" ?>
<?php

    $comp_id = $_GET['comp_id'];
    //get comp_name
    $qry_get_comp_name = "SELECT * FROM competitions WHERE comp_id = $comp_id";
    $do_get_comp_name = mysqli_query($connection, $qry_get_comp_name);
    if ($row = mysqli_fetch_assoc($do_get_comp_name)) {
        $comp_name = $row['comp_name'];
        $ranking_id = $row['comp_ranking_id'];
    } else {
        echo mysqli_error($connection). "asd";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head class="rankings">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name . "'s ranking" ?></title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title"><?php echo $comp_name . "'s ranking" ?></p>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div>
                        <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" placeholder="Search by Name" class="search">
                    </div>
                </form>
                <div class="table cw">
                    <div class="table_header">
                        <div class="table_header_text">POSITION</div>
                        <div class="table_header_text">FENCER'S NAME</div>
                        <div class="table_header_text">NATION / CLUB</div>
                        <div class="table_header_text">DATE OF BIRTH</div>
                        <div class="table_header_text">POINTS</div>
                    </div>
                    <div class="table_row_wrapper alt">
                    <?php
                        //echo out rankings fencers
                        $qry_get_fencer = "SELECT * FROM rk_$ranking_id ORDER BY position ASC";
                        $do_get_fencer = mysqli_query($connection, $qry_get_fencer);

                        while ($row = mysqli_fetch_assoc($do_get_fencer)) {

                            $fencer_name = $row['name'];
                            $fencer_nat = $row['nationality'];
                            $fencer_dob = $row['dob'];
                            $fencer_position = $row['position'];
                            $fencer_points = $row['points'];

                    ?>
                        <div class="table_row">
                            <div class="table_item"><p><?php echo $fencer_position ?></p></div>
                            <div class="table_item"><p><?php echo $fencer_name?></p></div>
                            <div class="table_item"><p><?php echo $fencer_nat?></p></div>
                            <div class="table_item"><p><?php echo $fencer_dob?></p></div>
                            <div class="table_item"><p><?php echo $fencer_points?></p></div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>