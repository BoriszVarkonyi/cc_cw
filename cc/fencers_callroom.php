<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php include "includes/cr_issues_array.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
    $array_issues = ["Missing weapon control mark on weapon","Missing Weapon Control mark on bodywire / maskwire","Resistance of weapon","Grip condition","Guard condition","Missing tip screw","Weight","Gauge","Bodywire / maskwire condition"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fencername's Callroom</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <main>
            <div id="title_stripe">
                <p class="page_title">Fencername's Callroom for {Table}</p>
                <div class="stripe_button_wrapper">
                    <!-- callroom_indiviudal vagy callroom_teams -->
                    <a class="stripe_button" href="../cc/<?php echo $cr_page?>.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Callroom</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <button name="delete_cr" class="stripe_button red" type="submit" form="fencers_callroom_wrapper">
                        <p>Delete Callroom</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($array_issues as $issue_id => $issue_name) {
                                $issue_numbers = 0;
                            ?>
                            <tr>
                                <td><p><?php echo $issue_name ?></p></td>
                                <td><input value="<?php echo $issue_numbers?>" name="issue_n_<?php echo $issue_id ?>" type="number" placeholder="#"></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div id="notes_panel">
                        <p>NOTES</p>
                        <textarea name="cr_notes" id="cr_notes" placeholder="Type the notes here"><?php /*echo $notes */ ?></textarea>
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
