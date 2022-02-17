<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
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
    $array_issues = array(
        "FIE mark on blade",
        "Arm gap and weight",
        "Arm lenght",
        "Blade lenght",
        "Grip lenght",
        "Form and depth of the guard",
        "Guard oxydation/ deformation",
        "Excentricity of the blade",
        "Blade flexibility",
        "Curve on the blade",
        "Foucault current device",
        "point and arm size",
        "spring of the point",
        "total travel of the point",
        "residual travel of the point",
        "isolation of the point",
        "resistance of the arm",
        "length/ condition of body/ mask wire",
        "resistance of body/ mask wire",
        "mask: FIE mark",
        "mask: condition and insulation",
        "mask: resistance (sabre, foil)",
        "metallic jacket condition",
        "metallic jacket resistance",
        "sabre glove/ overlay condition",
        "sabre glove/ overlay resistance",
        "glove condition",
        "jacket condition",
        "breeches condition",
        "under-plastron condition",
        "foil chest protector",
        "socks",
        "incorrect name printing",
        "incorrect national logo",
        "commercial",
        "other items",
    );

    $fencer_id = $_POST['fencer_id'];
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
        }
    }

    //get fencers existing wc
    $qry_select = "SELECT notes FROM weapon_control WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id' LIMIT 1";
    $do_select = mysqli_query($connection, $qry_select);
    if (mysqli_fetch_assoc($do_select)['notes'] === null) {
        $notes = "";
        $real_issues_array = [];
        foreach ($array_issues as $issue) {
            $real_issues_array[] = 0;
        }
    } else {
        $notes = mysqli_fetch_assoc($do_select)['notes'];
        $qry_select2 = "SELECT issues_array FROM weapon_control WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id' LIMIT 1";
        $do_select2 = mysqli_query($connection, $qry_select2);
        if ($row = mysqli_fetch_assoc($do_select2)) {
            $string = $row['issues_array'];
            $real_issues_array = json_decode($string);
        } else {
            echo "error: atika matika: " . mysqli_error($connection) . "<br>";
        }
    }

    if (isset($_POST['submit_wc'])) {

        $notes = $_POST['notes'];

        //compile issues array and test for empty post
        $real_issues_array = [];
        $empty = true;
        for ($i = 0; $i < count($array_issues); $i++) {
            if ($_POST['issue_n_' . $i] == "") {
                $real_issues_array[] = 0;
            } else {
                $real_issues_array[] = $_POST['issue_n_' . $i];
                $empty = false;
            }
        }

        if ($notes !== "") {
            $empty = false;
        }

        if (!$empty) {
            $real_issues_array = json_encode($real_issues_array);

            $qry_update = "UPDATE weapon_control SET notes = '$notes', issues_array = '$real_issues_array' WHERE assoc_comp_id = '$comp_id' AND fencer_id = '$fencer_id'";
            if (!mysqli_query($connection, $qry_update)) {
                echo "See you again! " . mysqli_error($connection);
            }


        }
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
                <p class="page_title"><?php echo $fencer_name ?>'s weapon control</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button" href="../cc/<?php echo $wc_page?>.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Weapon Control</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <button name="submit_wc" class="stripe_button primary" type="submit" form="fencers_weapon_control_wrapper">
                        <p>Save Weapon Control</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <form action="" id="fencers_weapon_control_wrapper" class="wrapper" method="POST">
                    <table id="issues_panel">
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
                                if (isset($array_of_real_issues[$issue_id]) && $array_of_real_issues[$issue_id] != 0) {
                                    $issue_numbers = $array_of_real_issues[$issue_id];
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
</body>
</html>
