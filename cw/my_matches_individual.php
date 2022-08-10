<?php
    include "../i18n/i18n.php";
    $i18n = new I18N();
?>
<?php
    session_start();
    if(!isset($_SESSION["fencer_id"])) {
        session_destroy();
        header("Location: index.php");
    }

    include "includes/db.php";

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


    $qry_get_table = "SELECT fencer_num, data FROM tables WHERE ass_comp_id = $comp_id";
    $do_get_table = mysqli_query($connection, $qry_get_table);
    if($rows = mysqli_fetch_assoc($do_get_table)) {
        $fencer_num = json_decode($rows["fencer_num"]);
        $table_data = json_decode($rows["data"]);
        /*
        If someone can decipher this feel free to commit it :D

        foreach($table_data->{"t_$fencer_num"} as $item) {
            foreach($item as $value) {
                var_dump($value);
                echo "<br>";
            }
        }
        */
    } else {
        $fencer_num = "Not set";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Matches</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
</head>
<body class="finished_competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href="competition.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to Competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    My Matches
                </h1>
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
                    <?php include "views/Matches.php" ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/competitions.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>