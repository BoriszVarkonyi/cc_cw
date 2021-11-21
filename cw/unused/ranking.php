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
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body>
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">
                    <a class="back_button" href="rankings.php" aria-label="Go back to Rankings">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    <?php echo $comp_name . "'s ranking" ?>
                </p>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                </form>
                <table class="cw">
                    <thead>
                        <tr>
                            <th><p>POSITION</p></th>
                            <th><p>FENCER'S NAME</p></th>
                            <th><p>NATION / CLUB</p></th>
                            <th><p>DATE OF BIRTH</p></th>
                            <th><p>POINTS</p></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
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
                        <tr>
                            <td><p><?php echo $fencer_position ?></p></td>
                            <td><p><?php echo $fencer_name?></p></td>
                            <td><p><?php echo $fencer_nat?></p></td>
                            <td><p><?php echo $fencer_dob?></p></td>
                            <td><p><?php echo $fencer_points?></p></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>