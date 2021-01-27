<?php include "../includes/db.php"; ?>
<?php

    $comp_id = $_GET['comp_id'];
    $table = "pool_matches_$comp_id";

    $ARRAY_fencers = [];
    $temp_array_fencers = [];

    //get fencer ids
    $qry_get_fencer_ids = "SELECT f1_id, f2_id FROM $table";
    $do_get_fencer_ids = mysqli_query($connection, $qry_get_fencer_ids);
    echo mysqli_error($connection);
    while ($row = mysqli_fetch_assoc($do_get_fencer_ids)) {
        $f1 = $row['f1_id'];
        $f2 = $row['f2_id'];
        array_push($temp_array_fencers, $f1);
        array_push($temp_array_fencers, $f2);
    }

    $array_of_fencer_ids = array_unique($temp_array_fencers);
    $array_of_fencer_ids = array_values($array_of_fencer_ids);
    foreach ($array_of_fencer_ids as $fencer_id) {
        array_push($ARRAY_fencers, ["id" => $fencer_id]);
    }

    //get won and lost games
    foreach ($array_of_fencer_ids as $fencer_id) {
    //get 1. ratio
        //get number of won games
        $qry_get_count_of_won_games = "SELECT COUNT(*) FROM $table WHERE w_id = '$fencer_id'";
        $do_get_count_of_won_games = mysqli_query($connection, $qry_get_count_of_won_games);
        if ($row = mysqli_fetch_assoc($do_get_count_of_won_games)) {
            $won_games = $row['COUNT(*)'];
        }
        echo mysqli_error($connection);

        //get played games if won games is not 0
        if ($won_games != 0) {
            $qry_get_played_games = "SELECT COUNT(*) FROM $table WHERE f1_id = '$fencer_id' OR f2_id = '$fencer_id'";
            $do_get_played_games = mysqli_query($connection, $qry_get_played_games);

            if ($row = mysqli_fetch_assoc($do_get_played_games)) {
                $games_played = $row['COUNT(*)'];
            }

            $won_per_played_game_ratio = $won_games / $games_played;

        } else {
            $won_per_played_game_ratio = 0;
        }

        echo mysqli_error($connection);

    //given points, given-gotten points
        //get given points in f1
        $given_points = 0;
        $qry_get_given_points_f1 = "SELECT f1_sc FROM $table WHERE f2_id = '$fencer_id'";
        $do_get_given_points_f1 = mysqli_query($connection, $qry_get_given_points_f1);
        while ($row = mysqli_fetch_assoc($do_get_given_points_f1)) {
            $given_points += $row['f1_sc'];
        }
        echo mysqli_error($connection);
        //get given points in f2
        $qry_get_given_points_f2 = "SELECT f2_sc FROM $table WHERE f1_id = '$fencer_id'";
        $do_get_given_points_f2 = mysqli_query($connection, $qry_get_given_points_f1);
        while ($row = mysqli_fetch_assoc($do_get_given_points_f1)) {
            $given_points += $row['f2_sc'];
        }
        echo mysqli_error($connection);
        //get gotten points
        //f1
        $gotten_points = 0;
        $qry_get_gotten_points_f1 = "SELECT f1_sc FROM $table WHERE f1_id = '$fencer_id'";
        $do_get_gotten_points_f1 = mysqli_query($connection, $qry_get_gotten_points_f1);
        while ($row = mysqli_fetch_assoc($do_get_gotten_points_f1)) {
            $gotten_points += $row['f1_sc'];
        }
        echo mysqli_error($connection);
        //f2
        $qry_get_gotten_points_f2 = "SELECT f2_sc FROM $table WHERE f2_id = '$fencer_id'";
        $do_get_gotten_points_f2 = mysqli_query($connection, $qry_get_gotten_points_f2);
        while ($row = mysqli_fetch_assoc($do_get_gotten_points_f2)) {
            $gotten_points += $row['f2_sc'];
        }
        echo mysqli_error($connection);
        $got_giv_dif = $given_points - $gotten_points;

        
        foreach ($ARRAY_fencers as $key_of_a => $value) {
            if (in_array($fencer_id, $value)) {
                $ARRAY_fencers[$key_of_a]['ratio'] = $won_per_played_game_ratio;
                $ARRAY_fencers[$key_of_a]['point_difference'] = $got_giv_dif;
                $ARRAY_fencers[$key_of_a]['given'] = $given_points;
            }
        }
    }

    //define columns
    $ratio_column = array_column($ARRAY_fencers, "ratio", "id");
    $point_diff_column = array_column($ARRAY_fencers, "point_difference", "id");
    $given_points_column = array_column($ARRAY_fencers, "given", "id");

     //start sorting the array array
    if (!array_multisort($ratio_column, SORT_DESC, SORT_NUMERIC, $point_diff_column, SORT_DESC, SORT_NUMERIC, $given_points_column, SORT_DESC, SORT_NUMERIC, $ARRAY_fencers)) {
        echo "CRITICAL ERROR: array_multisort could not complete the sort!";
    } 

    //do this because stack overflow said so
    $ARRAY_fencers = array_column($ARRAY_fencers, null, "id");

    //update competitors temp ranking
    $temp_ranking_array = array_keys($ARRAY_fencers);

    foreach ($temp_ranking_array as $fencer_pos => $fencer_id) {
        $real_pos = $fencer_pos + 1;
        $qry_update_temp_rank = "UPDATE `cptrs_$comp_id` SET `temporary_rank`= '$real_pos' WHERE `id` = '$fencer_id'";
        $do_update_temp_rank = mysqli_query($connection, $qry_update_temp_rank);
        echo mysqli_error($connection);
        echo $real_pos . " ";
    }
    print_r($ratio_column);
    echo "<br>";
    print_r($point_diff_column);
    echo "<br>";
    print_r($given_points_column);

    echo "<br>";
    print_r($ARRAY_fencers);

    //header("Location: ../php/temporary_ranking.php?comp_id=$comp_id");
    //ind meg az adott tus valamiert nem jó lehet szarul van szamolva ertekek sem egyeznek meg!
?>
