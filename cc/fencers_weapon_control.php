<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
    $fencer_id = $_POST['fencer_id'];
    //get fencer data
    $qry_get_comptetitors = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_competitors = mysqli_query($connection, $qry_get_comptetitors);
    if ($row = mysqli_fetch_assoc($do_get_competitors)) {
        $string = $row['data'];
        $json_compet = json_decode($string);
        //search for fencer
        if (($id_to_find = findObject($json_compet, $fencer_id, "id")) !== false) {
            $fencer = $json_compet -> $id_to_find;

            $fencer_name = $fencer -> prenom . " " . $fencer -> nom;

        } else {
            echo "Volare!!";
        }
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
                                foreach ($array_issues as $issue) {

                                $issue_id = array_search($issue, $array_issues);
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
