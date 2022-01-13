<?php
    session_start();
    if(!isset($_SESSION["fencer_id"])) {
        session_destroy();
        header("Location: index.php");
    }

    include "db.php";

    $matches = array();
    $ids = array();
    
    $comp_id = $_SESSION["comp_id"];
    $qry_get_matches = "SELECT fencers, matches FROM pools WHERE assoc_comp_id = $comp_id";
    $do_get_matches = mysqli_query($connection, $qry_get_matches);
    if($rows = mysqli_fetch_assoc($do_get_matches)) {
        $fencers_data = json_decode($rows["fencers"]);
        $rows = json_decode($rows["matches"]);

        //add matches that the fencer is going to play to $matches array
        foreach($rows as $row) {
            foreach($row as $item) {
                foreach($item as $entity) {
                    //echo json_encode($entity);
                    if($entity->id == $_SESSION["fencer_id"]) {
                        array_push($matches, $entity);
                    }
                    else if($entity->enemy == $_SESSION["fencer_id"]) {
                        array_push($matches, $entity);
                    }

                    //push every playing id into $ids array
                    if(!in_array($entity->id, $ids))
                        array_push($ids, $entity->id);
                    if(!in_array($entity->enemy, $ids))
                        array_push($ids, $entity->enemy);
                }
            }
        }
    } else {
        echo "ERROR " . mysqli_error($connection);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finished competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="finished_competitions">
    <?php include "static/cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>My Matches</h1>
            </div>
            <div id="content_wrapper">
                <div id="browsing_bar">
                    <a href="my_matches_individual.php?comp_id=<?php echo $comp_id ?>" class="current">
                        <p>Pools</p>
                    </a>
                    <a href="my_matches_individual.php?comp_id=<?php echo $comp_id ?>">
                        <p>Table</p>
                    </a>
                </div>
                <div id="pool_listing">
                    <div>
                        <!-- ezt kell loopolni -->
                        <div class="entry">
                            <div class="tr">
                                <div class="td bold">No. {num}</div>
                                <div class="td">Piste: {piste}</div>
                                <div class="td">Ref1: {ref1}</div>
                                <div class="td">Ref2: {ref2}</div>
                                <div class="td">Time</div>
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
                                            <th class="square">
                                                <p>1</p>
                                            </th>
                                            <th class="square">
                                                <p>2</p>
                                            </th>
                                            <th class="square">
                                                <p>3</p>
                                            </th>

                                            <!-- Win per Lose -->
                                            <th class="square">
                                                <p>W/L</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="alt">
                                    <?php
                                        foreach($ids as $id) {
                                            $fencer_name = "";
                                            $nationality = "";
                                            $piste = "";
                                            $ref1 = "";
                                            $ref2 = "";
                                            $time = "";
                                            
                                            if(isset($fencers_data)) {
                                                foreach($fencers_data as $row) {
                                                    if($row == null) continue;
                                                    foreach($row as $item) {
                                                        if(isset($item->id) && $item->id == $id) {
                                                            $fencer_name = $item->prenom_nom;
                                                            $nationality = $item->nation;
                                                        }
                                                    }
                                                }
                                            }
                                    ?>
                                        <tr class="">
                                            <td><?php echo $fencer_name ?></td>
                                            <td><?php echo $nationality ?></td>
                                            <td class="square row_title">1</td>
                                            <td class="square">W</td>
                                            <td class="square">L</td>
                                            <td class="square">W</td>
                                            <td class="square">1.2</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="matches_wrapper">
                <?php 
                    foreach($matches as $match) {
                        $fencer_name = "";
                        $opponent_name = "";

                        if(isset($fencers_data)) {
                            foreach($fencers_data as $row) {
                                if($row == null) continue;
                                foreach($row as $item) {
                                    if(isset($item->id) && $_SESSION["fencer_id"] == $item->id) {
                                        $fencer_name = $item->prenom_nom;
                                    }
                                    else if(isset($item->id) && $match->id == $item->id) {
                                        $opponent_name = $item->prenom_nom;
                                    }
                                    else if(isset($item->id) && $match->enemy == $item->id) {
                                        $opponent_name = $item->prenom_nom;
                                    }
                                }
                            }
                        }
                ?>
                    <div class="match">
                        <div class="match_header upcoming">
                            <p>UPCOMING</p>
                        </div>
                        <div class="match_data">
                            <p>11:40</p>
                            <p>{piste name} PISTE</p>
                        </div>
                        <div class="match_content">
                            <div>
                                <p>OPPONENT:</p>
                                <p><?php echo $opponent_name; ?></p>
                            </div>
                            <div>
                                <p>TABLE:</p>
                                <p>t32</p>
                            </div>
                            <!-- IF FINISHED -->
                            <div>
                                <p>RESULTS:</p>
                                <?php 
                                    if($match->id == $_SESSION["fencer_id"]) {
                                        echo  "<p class='winner'>" . $fencer_name . " - " . $match->given . "</p>";
                                        echo "<p>" . $opponent_name . " - " . $match->gotten . "</p>";
                                    } else {
                                        echo  "<p class='winner'>" . $fencer_name . " - " . $match->gotten . "</p>";
                                        echo "<p>" . $opponent_name . " - " . $match->given . "</p>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "static/cw_footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/cw_bookmark_competition.js"></script>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>