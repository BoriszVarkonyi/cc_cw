<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php include "includes/issues_array.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    //get GET[] info
    $fencer_id = $_GET['fencer_id'];
    $t_id = $_GET['t'];

    //get fencers data
    $qry_get_fencer_data = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_fencer_data = mysqli_query($connection, $qry_get_fencer_data);
    if ($row = mysqli_fetch_assoc($do_get_fencer_data)) {
        $json_string = $row['data'];
        $compet_table = json_decode($json_string);

        //search for fencer
        if (($id_to_find = findObject($compet_table,$fencer_id,"id")) !== false) {
            $fencer_obj = $compet_table[$id_to_find];
        } else {
            echo "cant find fencer ID!!";
        }
    } else {
        echo "cant find fencer!";
    }

    //make callroom row for fencer if there is not one
    $qry_check_fencer = "SELECT issues_array, notes FROM call_room_wc WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id'";
    $do_check_fencer = mysqli_query($connection, $qry_check_fencer);
    if (mysqli_num_rows($do_check_fencer) === 0) {
        $has_data = false;
    } else {
        //get data from
        if ($row = mysqli_fetch_assoc($do_check_fencer)) {
            $db_issues_string = $row['issues_array'];
            $db_issues_array = explode(',', $db_issues_string);
            $db_notes = $row['notes'];
        }
        $has_data = true;
    }

    //var_dump($has_data);
    //submitted
    if (isset($_POST['submit_cr'])) {
        //update last table
            $last_table = mysqli_real_escape_string($connection, $t_id);
        //get data from FORM
            //isses
            $issues_string = "";
            foreach ($cr_array_issues as $issue_id => $issue_name) {
                if ($_POST["issue_n_$issue_id"] != "") {
                    $issues_string .= $_POST["issue_n_$issue_id"] . ",";
                } else {
                    $issues_string .= "0,";
                }
            }
            $issues_string = substr_replace($issues_string ,"", -1, 1);
            //notes
            $notes = mysqli_real_escape_string($connection, $_POST['cr_notes']);

            if (!$has_data) {
                //make new row
                $qry_add_fencer = "INSERT INTO call_room_wc (fencer_id, assoc_comp_id, notes) VALUES ('$fencer_id', '$comp_id', '')";
                if (!mysqli_query($connection, $qry_add_fencer)) {
                    echo mysqli_error($connection);
                } else {
                    echo "OK!!";
                }
            }
        //update database;
            $qry_update = "UPDATE call_room_wc SET issues_array = '$issues_string', notes = '$notes', last_table = '$last_table' WHERE fencer_id = '$fencer_id' AND assoc_comp_id = '$comp_id'";
            if (mysqli_query($connection, $qry_update)) {
                echo "OK";
                header("Refresh: 0");
            } else {
                echo "error: " . mysqli_error($connection);
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fencer_obj -> prenom . " " . $fencer_obj->nom ?>'s Callroom</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <main>
            <div id="title_stripe">
                <p class="page_title"><?php echo $fencer_obj -> prenom . " " . $fencer_obj->nom ?>'s Callroom for #<?php echo $t_id ?> table</p>
                <div class="stripe_button_wrapper">
                    <!-- callroom_indiviudal vagy callroom_teams -->
                    <a class="stripe_button" href="../cc/<?php echo $navbar -> call_room -> href ?>">
                        <p>Go back to Callroom</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <button name="submit_cr" class="stripe_button primary" type="submit" form="fencers_callroom_wrapper">
                        <p>Save Callroom</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <form action="" id="fencers_callroom_wrapper" class="wrapper" method="POST">
                    <table id="issues_panel" class="no_interaction">
                        <thead>
                            <tr>
                                <th>
                                    <div class="search_panel">
                                        <div class="search_wrapper">
                                            <input type="text" onkeyup="searchInLists()" placeholder="Search by Name" class="search page">
                                            <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                        </div>
                                    </div>
                                    <div class="table_buttons_wrapper">
                                        <button type="button" onclick="sortButton(this)">
                                            <img src="../assets/icons/switch_full_black.svg">
                                        </button>
                                        <p>ISSUE</p>
                                        <button type="button" onclick="searchButton(this)">
                                            <img src="../assets/icons/search_black.svg">
                                        </button>
                                    </div>
                                </th>
                                <th>
                                    <p>QUANTITY</p>
                                </th>
                                <th class="wide_controls">
                                    <p>CONTROLS</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cr_array_issues as $issue_id => $issue_name) {
                                if ($has_data) {
                                    $issue_numbers = $db_issues_array[$issue_id];
                                } else {
                                    $issue_numbers = 0;
                                }
                            ?>
                            <tr>
                                <td><p><?php echo $issue_name ?></p></td>
                                <td><input value="<?php echo $issue_numbers?>" name="issue_n_<?php echo $issue_id ?>" type="number" placeholder="#"></td>
                                <td class="wide_controls">
                                    <button type="button" onclick="addNumber(this, 1)"><img src="../assets/icons/add_black.svg"></button>
                                    <button type="button" onclick="addNumber(this, -1)"><img src="../assets/icons/remove_black.svg"></button>
                                    <button type="button" onclick="resetNumber(this)"><img src="../assets/icons/close_black.svg"></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div id="notes_panel">
                        <p>NOTES</p>
                        <textarea name="cr_notes" id="cr_notes" class="notes" placeholder="Type the notes here"><?php echo $has_data ? $db_notes : "" ?></textarea>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_search_2.js"></script>
    <script src="javascript/fencers_wc_cr.js"></script>
</body>
</html>
