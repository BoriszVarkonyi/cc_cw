<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php include "includes/wc_issues_array.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    //determine wc back button
    $qry_get_wc = "SELECT comp_wc_type FROM competitions WHERE comp_id = '$comp_id'";
    $do_get_wc = mysqli_query($connection, $qry_get_wc);
    if ($row = mysqli_fetch_assoc($do_get_wc)) {
        $wc_type = $row['comp_wc_type'];
        if ($wc_type == 1) {
            $wc_page = "weapon_control_immediate";
        } else if ($wc_type == 2) {
            $wc_page = "weapon_control_administrated";
        }
    } else {
        echo "stan: " . mysqli_error($connection);
    }


    $fencer_id = $_GET['fencer_id'];
    //get fencer data
    $qry_get_comptetitors = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_competitors = mysqli_query($connection, $qry_get_comptetitors);
    if ($row = mysqli_fetch_assoc($do_get_competitors)) {
        $string = $row['data'];
        $json_compet = json_decode($string);
        //search for fencer
        if (($id_to_find = findObject($json_compet, $fencer_id, "id")) !== false) {
            $fencer = $json_compet[$id_to_find];

            $fencer_name = $fencer -> prenom . " " . $fencer -> nom;

        } else {
            echo "Volare!!";
            header("Location: $wc_page.php?comp_id=$comp_id");
        }
    }

    //get fencers existing wc
    $qry_select = "SELECT issues_array FROM weapon_control WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id' LIMIT 1";
    $do_select = mysqli_query($connection, $qry_select);

    if (($array_string = mysqli_fetch_assoc($do_select)['issues_array']) === null) {
        $notes = "";
        $real_issues_array = [];
        foreach ($array_issues as $issue) {
            $real_issues_array[] = 0;
        }
    } else {
        $qry_select2 = "SELECT notes FROM weapon_control WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id' LIMIT 1";
        $do_select2 = mysqli_query($connection, $qry_select2);
        if ($row = mysqli_fetch_assoc($do_select2)) {
            $notes = $row['notes'];
            $real_issues_array = json_decode($array_string);
        } else {
            echo "error: atika matika: " . mysqli_error($connection) . "<br>";
        }
    }

    if (isset($_POST['submit_wc'])) {

        $notes = $_POST['wc_notes'];

        //compile issues array and test for empty post
        $real_issues_array = [];
        $empty = true;
        for ($i = 0; $i < count($array_issues); $i++) {
            if ($_POST['issue_n_' . $i] == "") {
                $real_issues_array[$i] = 0;
            } else {
                $real_issues_array[$i] = $_POST['issue_n_' . $i];
            }
        }

        $temps = json_encode($real_issues_array);
        $notes = addslashes($notes);
        $qry_update = "UPDATE weapon_control SET notes = '$notes', issues_array = '$temps' WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id'";
        if (!mysqli_query($connection, $qry_update)) {
            echo "See you again! " . mysqli_error($connection);

        } else {
            header("Location: ../cc/$wc_page.php?comp_id=$comp_id");
            //echo "St vitus dance";
        }
    }


    if (isset($_POST['delete_wc'])) {
        $qry_delete = "UPDATE weapon_control SET notes = null, issues_array = null WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id'";
        $do_delete = mysqli_query($connection, $qry_delete);
        header("Location: ../cc/$wc_page.php?comp_id=$comp_id");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fencer_name ?>'s weapon control</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title"><?php echo $fencer_name ?>'s Weapon Control</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button" href="../cc/<?php echo $wc_page?>.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Weapon Control</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <button name="delete_wc" class="stripe_button red" type="submit" form="fencers_weapon_control_wrapper">
                        <p>Delete Weapon Control</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>
                    <button name="submit_wc" class="stripe_button primary" type="submit" form="fencers_weapon_control_wrapper">
                        <p>Save Weapon Control</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <form action="" id="fencers_weapon_control_wrapper" class="wrapper" method="POST">
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
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                foreach ($array_issues as $issue_id => $issue) {
                                if ($real_issues_array[$issue_id] != 0) {
                                    $issue_numbers = $real_issues_array[$issue_id];
                                } else {
                                    $issue_numbers = "";
                                }
                            ?>

                            <tr>
                                <td><p><?php echo $issue ?></p></td>
                                <td><input value="<?php echo $issue_numbers?>" name="issue_n_<?php echo $issue_id ?>" type="number" placeholder="#"></td>
                            </tr>

                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <div id="notes_panel">
                        <p>NOTES</p>
                        <textarea name="wc_notes" id="wc_notes" placeholder="Type the notes here"><?php echo $notes ?></textarea>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_search_2.js"></script>
    <script src="javascript/fencers_weapon_control.js"></script>
</body>
</html>
