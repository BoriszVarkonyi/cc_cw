<?php include "cw_comp_getdata.php"; ?>
<?php

class Competitor {
    public string $fullName;
    public int $rank;
    public string $nation;
    public string $club;

    function __construct($obj) {
        if($obj->final_rank != null) {
            $this->rank = $obj->final_rank;
        } else if ($obj->temp_rank != null) {
            $this->rank = $obj->temp_rank;
        } else {
            $this->rank = "0";
        }
        $this->fullName = $obj->prenom . " " . $obj->nom;
        $this->nation = $obj->nation;
        $this->club = $obj->club;
    }
}

function sortByRank($a, $b) {
    return $a->rank - $b->rank;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s competitors</title>
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
                    Competitors of <?php echo $comp_name ?>
                </p>
            </div>
            <div id="content_wrapper">
                <form method="POST" id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="name" placeholder="Search by Name" class="search page alt">
                        <button type="button"><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>

                    <div class="search_wrapper narrow">
                        <input type="number" name="year" class="search select alt" onfocus="isOpen(this)" onblur="isClosed(this)" placeholder="-Year-Of-Birth-" onkeyup="searchEngine(this)">
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                        <div class="search_results">
                            <?php
                                for ($i = +3; $i <= 100; $i++) {
                                    $year = date("Y") - $i;
                                    ?><button type="button" onclick="autoFill(this)"><?php echo $year ?></button><?php
                                }
                            ?>
                        </div>
                    </div>
                    <input name="submit_search" type="submit" value="Search">
                </form>

                <table class="cw">
                    <?php
                    $qry = "SELECT * FROM competitors WHERE assoc_comp_id = '$comp_id';";
                    $do = mysqli_query($connection, $qry);
                    if ($do == FALSE || mysqli_num_rows($do) == 0) {
                        echo "<p>You have no competitors set up or the search criteria is too narrow!</p>";
                    } else {
                        ?>
                        <thead>
                            <th><p>RANK</p></th>
                            <th><p>NAME</p></th>
                            <th><p>NATION</p></th>
                            <th><p>CLUB</p></th>
                        </thead>
                        <tbody class="alt">
                        <?php
                            if ($row = mysqli_fetch_assoc($do)) {
                                $json_string = $row['data'];
                                $json_table = json_decode($json_string);
                            } else {
                                echo mysqli_error($connection);
                            }
                            $competitors = array();
                            foreach($json_table as $obj) {
                                array_push($competitors, new Competitor($obj));
                            }
                            try {
                                usort($competitors, "sortByRank");
                            } catch (Exception $ex) {
                                //hopefully this won't happen in prod :D
                            }
                            foreach($competitors as $competitor) {
                        ?>

                            <tr>
                                <td>
                                    <p><?php echo $competitor->rank ?></p>
                                </td>
                                <td>
                                    <p><?php echo $competitor->fullName ?></p>
                                </td>
                                <td>
                                    <p><?php echo $competitor->nation ?></p>
                                </td>
                                <td>
                                    <p><?php echo $competitor->club ?></p>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                        </tbody>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>