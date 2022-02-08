<?php
    include "../includes/functions.php";
    include "../includes/db.php";
    $comp_id = $_GET['comp_id'];

    $qry_get_pools_data = "SELECT `matches`,`fencers` FROM `pools` WHERE `assoc_comp_id` = $comp_id";
    $do_get_pools_data = mysqli_query($connection, $qry_get_pools_data);
    if ($row = mysqli_fetch_assoc($do_get_pools_data)) {
        $m_string = $row['matches'];
        $m_table = json_decode($m_string);
        $f_string = $row['fencers'];
        $f_table = json_decode($f_string);
    }

    class ranking {
        function sort() {
            //set up arrays

            foreach ($this as $key => $obj) {
                $tmp_ratio[$key] = $obj -> ratio;
                $tmp_diff[$key] = $obj -> difference;
                $tmp_given[$key] = $obj -> given_points;
                $tmp_random[$key] = $obj -> random;
                $tmp_id[$key] = $obj -> id;
            }

            array_multisort($tmp_ratio, SORT_DESC, $tmp_diff, SORT_DESC, $tmp_given, SORT_DESC, $tmp_random, SORT_ASC, $tmp_id, SORT_DESC);

            return $tmp_id;
        }
    }

    function addDead($array_of_dead, $ranked_id_array) {
        foreach ($array_of_dead as $id) {
            array_push($ranked_id_array, $id);
        }

        return $ranked_id_array;
    }

    class fencer_ranking {
        public $given_points = 0;
        public $gotten_points = 0;
        public $played_games = 0;
        public $won_games = 0;
        public $random = 0;
        public $id;

        function __construct($id) {
            $this -> random = rand(0,2047);
            $this -> id = $id;
        }

        function newData($given, $gotten, $won) {
            if ($won) {
                $this -> won_games++;
            }
            $this -> given_points += $given;
            $this -> gotten_points += $gotten;
            $this -> played_games++;
        }

        function calculate() {
            $this -> ratio = $this -> won_games = $this -> played_games;
            $this -> difference = $this -> given_points - $this -> gotten_points;
        }

        function setDead() {
            $this -> given_points = -2048;
            $this -> won_games = -2048;
            $this -> gotten_points = 2048;
            $this -> random = 2048;
        }
    }

    $array_of_dead = [];
    $ranking = new ranking;
    //get data from m_table
    foreach ($m_table as $key => $m_pool) {
        //get current number of fencers
        $f_in_pool = getFencersInPool($f_table[$key+1]);
        for ($number_id = 1; $number_id < $f_in_pool; $number_id++) {
            for ($opponent_id = $number_id + 1; $opponent_id <= $f_in_pool; $opponent_id++) {

                //get data into variables
                $given_points = $m_pool -> $number_id -> $opponent_id -> given;
                $gotten_points = $m_pool -> $number_id -> $opponent_id -> gotten;
                $id = $m_pool -> $number_id -> $opponent_id -> id;
                $enemy_id = $m_pool -> $number_id -> $opponent_id -> enemy;
                $win_id = $m_pool -> $number_id -> $opponent_id -> w_id;

                //check data (exc, med, abd)
                if (!isDisqualified($given_points) && !isDisqualified($gotten_points)) {

                    //determine winner
                    if ($win_id == $id) {
                        $win_id = true;
                    } else {
                        $win_id = false;
                    }

                    //our player
                    if (!isset($ranking -> {$id})) {
                        $ranking -> {$id} = new fencer_ranking($id);
                    }
                    $ranking -> {$id} -> newData($given_points, $gotten_points, $win_id);

                    //enemy player
                    if (!isset($ranking -> {$enemy_id})) {
                        $ranking -> {$enemy_id} = new fencer_ranking($enemy_id);
                    }
                    $ranking -> {$enemy_id} -> newData($gotten_points, $given_points, $win_id);

                } else { //deal with med exc ...
                    if ($given_points != "exc" && $gotten_points != "exc") {
                        if (isDisqualified($given_points)) { //our player is dead
                            $array_of_dead[$id] = $gotten_points;
                        } else { //enemy is dead
                            $array_of_dead[$enemy_id] = $given_points;
                        } //at the end we put them at last place with worst possible stats
                    }
                }
            }
        }
    }


    //add the dead and calculate points
    foreach ($ranking as $id_key => $obj){
        $ranking -> {$id_key} -> calculate();
    }

    $sorted = $ranking -> sort();

    //var_dump($sorted);


    //update give temp rank to fencers in db
        //get competitors from db
    $qry_update = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_update = mysqli_query($connection, $qry_update);

    if ($row = mysqli_fetch_assoc($do_update)) {
        $competitors_string = $row['data'];
        $compet_table = json_decode($competitors_string);
    }



    //get updated compet table
    foreach ($sorted as $key => $id_to_find) {
        $array_id = findObject($compet_table, $id_to_find, "id");

        $compet_table[$array_id] -> temp_rank = $key + 1;
    }

//for the future
    //add dead fencers to last places
    // foreach ($array_of_dead as $id_to_find => $text) {
    //     $array_id = findObject($compet_table, $id_to_find, "id");

    //     $compet_table[$array_id] -> temp_rank = 99999;
    // }

    //update database
    $compet_string = json_encode($compet_table, JSON_UNESCAPED_UNICODE);
    $qry_update = "UPDATE `competitors` SET `data` = '$compet_string' WHERE `assoc_comp_id` = '$comp_id'";
    if ($do_update = mysqli_query($connection, $qry_update)) {
        echo "MYSQLI UPDATE SUCCESSFUL!";
        header("Location: ../php/temporary_ranking.php?comp_id=$comp_id");
    } else {
        echo "MYSQLI UPDATE WAS UNSUCCESSFUL!:   " . mysqli_error($connection) . "  LAST PART?";
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process pools</title>
</head>
<body>
    Ha ezt olvasod valami nagy vaj van!
</body>
</html>