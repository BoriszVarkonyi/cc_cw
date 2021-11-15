<?php include "cw_comp_getdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s pools</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="competitions">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">
                    <a class="back_button" href="competition.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    Pools of <?php echo $comp_name ?>
                </p>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                    <input type="submit" value="Search">
                </form>

                <?php
                    $pools_query = "SELECT * FROM pools WHERE assoc_comp_id = '$comp_id';";
                    $query_result = mysqli_query($connection, $pools_query);

                    if($row = mysqli_fetch_assoc($query_result)) {
                        $fencers_json = $row["fencers"];
                        $fencers_table = json_decode($fencers_json);
                    } else {
                        echo mysqli_error($connection);
                    }

                    for ($pool_num = 1; $pool_num < count($fencers_table); $pool_num++){
                        $current_pool = $fencers_table[$pool_num];

                        if($fencers_table[$pool_num]->ref1 !== null) {
                            $ref1_name = $fencers_table[$pool_num]->ref1->prenom . " " . $fencers_table[$pool_num]->ref1->nom;
                            $ref1_nation = $fencers_table[$pool_num]->ref1->nation;
                            $ref1_club = $fencers_table[$pool_num]->ref1->club;
                            echo "<h2>$ref1_name ($ref1_nation): $ref1_club; ";
                        } else {
                            echo "<h2>No REF 1; ";
                        }
                        if($fencers_table[$pool_num]->ref2 !== null) {
                            $ref2_name = $fencers_table[$pool_num]->ref2->prenom . " " . $fencers_table[$pool_num]->ref2->nom;
                            $ref2_nation = $fencers_table[$pool_num]->ref2->nation;
                            $ref2_club = $fencers_table[$pool_num]->ref2->club;
                            echo " $ref2_name ($ref2_nation): $ref2_club</h2>";
                        } else {
                            echo " No REF 2</h2>";
                        }
                        if($fencers_table[$pool_num]->piste !== null) {
                            $piste = $fencers_table[$pool_num]->piste;
                            echo "<h3>Piste: $piste</h3>";
                        } else {
                            echo "<h3>Piste is not set</h3>";
                        }
                        if($fencers_table[$pool_num]->time !== null) {
                            $time = $fencers_table[$pool_num]->time;
                            echo "<h3>Time: $time</h3>";
                        } else {
                            echo "<h3>Time is not set</h3>";
                        }
                ?>
                <table>
                    <th>Name (Nationality)</th>
                    <th>Club</th>
                    <th>CP</th>
                    <th>PR</th>
                        <?php
                        $number_of_fencers = getFencersInPool($fencers_table[$pool_num]);
                        for($fencer_num = 1; $fencer_num < $number_of_fencers; $fencer_num++) {
                ?>
                    <tr>
                        <td><?php echo $fencers_table[$pool_num]->{$fencer_num}->prenom_nom . " (" .$fencers_table[$pool_num]->{$fencer_num}->nation . ")" ?></td>
                        <td><?php echo $fencers_table[$pool_num]->{$fencer_num}->club ?></td>
                        <td><?php echo $fencers_table[$pool_num]->{$fencer_num}->c_pos?></td>
                        <td><?php echo $fencers_table[$pool_num]->{$fencer_num}->r_pos?></td>

                    </tr>
                <?php } ?>
                    </table>
                <?php } ?>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/cw_pools.js"></script>
    <script src="../js/entry_controls.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>