<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
}

$qry_check_row = "SELECT data FROM teams WHERE assoc_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
    $json_string = $row['data'];
    $json_teams = json_decode($json_string);
}

print_r($_POST);

if (isset($_POST["assign_auto_submit"])) {

    if ($_POST["role"] == 1) {

        echo "response";

        foreach ($json_teams as $team_name => $team) {
            foreach ($json_table as $fencer) {
                if (count($team->tireurs) >= 4) {
                    break;
                } elseif ($fencer->nation == $team->nation) {
                    array_push($json_teams->$team_name->tireurs, $fencer);
                }
            }
        }
    }
    if ($_POST["role"] == 2) {

        echo "response";

        foreach ($json_teams as $team_name => $team) {
            foreach ($json_table as $fencer) {
                if (count($team->tireurs) >= 4) {
                    break;
                } elseif ($fencer->club == $team->id) {
                    array_push($json_teams->$team_name->tireurs, $fencer);
                }
            }
        }
    }

    $json_string = json_encode($json_teams, JSON_UNESCAPED_UNICODE);
    echo $qry_update = "UPDATE teams SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
    $qry_update_do = mysqli_query($connection, $qry_update);

    echo mysqli_error($connection);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assign Fencers to Teams</title>
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
                <p class="page_title">Assign Fencers to Teams</p>
                <div class="stripe_button_wrapper">

                    <form action="" method="POST" id="save_team_assignments">
                        <input type="text" class="hidden" readonly>
                    </form>

                    <a class="stripe_button bold" href="teams.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Teams</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg" />
                    </a>
                    <button class="stripe_button bold" onclick="toggleAssignAutoPanel()">
                        <p>Assign Fencers Automatically</p>
                        <img src="../assets/icons/list_alt_black.svg" />
                    </button>
                    <button class="stripe_button primary" type="submit" form="save_team_assignments">
                        <p>Save</p>
                        <img src="../assets/icons/save_black.svg" />
                    </button>
                </div>

                <div id="assign_auto_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggleAssignAutoPanel()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form class="overlay_panel_form" autocomplete="off" action="" method="POST" id="assign_auto">

                        <label for="">ASSIGN AUTOMATICALLY BY</label>
                        <div class="option_container">
                            <input type="radio" class="option_button" name="role" id="a" value="1" />
                            <label for="a">Nation</label>
                            <input type="radio" class="option_button" name="role" id="b" value="2" />
                            <label for="b">Club</label>
                        </div>
                        <button type="submit" name="assign_auto_submit" class="panel_submit">Assign</button>
                    </form>
                </div>

                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search Team" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
                    <div class="search_results">
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button">Ide kell a kuki</button>
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button">Ide kell a kuki</button>
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button">Ide kell a kuki</button>
                    </div>
                </div>
            </div>
            <div id="page_content_panel_main" class="no_scroll no_wrap">
                <div class="splitscreen big">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <p>NAME</p>
                                </th>
                                <th>
                                    <p>NATION</p>
                                </th>
                                <th>
                                    <p>CLUB</p>
                                </th>
                                <th class="square"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            foreach ($json_table as $json_obj) {
                            ?>
                                <tr id="<?php echo $json_obj->id ?>">
                                    <td>
                                        <p><?php echo $json_obj->prenom . " " . $json_obj->nom ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $json_obj->nation ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $json_obj->club ?></p>
                                    </td>
                                    <td class="square">
                                        <input type="checkbox" name="emberek" id="<?php echo $json_obj->id ?>">
                                        <label for="<?php echo $json_obj->id ?>"></label>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="splitscreen small">
                    <div class="splitscreen_section header">
                        <div class="splitscreen_select">
                            <p>Unselected Fencers</p>
                            <div>
                                <p>3</p>
                                <img src="../assets/icons/person_black.svg">
                            </div>
                        </div>
                    </div>
                    <div class="splitscreen_section">
                        <?php

                        foreach ($json_teams as $team_name => $team) {
                        ?>
                            <div class="splitscreen_select selected">
                                <p><?php echo $team_name ?></p>
                                <div class="red">
                                    <p><?php echo count($team->tireurs) ?></p>
                                    <img src="../assets/icons/person_black.svg">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    </div>
    </main>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list_2.js"></script>
    <script src="../js/controls_2.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/list_search.js"></script>
    <script src="../js/assign_fencers_to_teams.js"></script>
</body>

</html>