<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php include '../includes/sortfunction.php' ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overview</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Overview</p>
                <div class="stripe_button_wrapper">
                    <input type="text" class="selected_list_item_input">
                    <button class="stripe_button primary" type="button" onclick="">
                        <p>Export Results</p>
                        <img src="../assets/icons/upgrade_black.svg" />
                    </button>
                    <button class="stripe_button primary" type="button" onclick="window.print()">
                        <p>Print Overview</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <table class="wrapper">
                    <thead>
                        <tr>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Position" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>POSITION</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Name" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>NAME</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Nationality" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>NATION / CLUB</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                            <th class="square"></div>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $counter = 1;

                        $thirdplace = false;

                        foreach ($json_table as $key => $value) {

                        ?>
                            <tr>
                                <td>
                                    <p><?php echo $value->final_rank ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value->prenom . " " . $value->nom ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value->nation ?></p>
                                </td>
                                <td class="square <?php

                                                            if ($counter == 1) {
                                                                echo "gold";
                                                            } elseif ($counter == 2) {
                                                                echo "silver";
                                                            } elseif ($counter == 3 && $thirdplace == false) {
                                                                echo "bronze";
                                                                $thirdplace = true;
                                                            } elseif ($counter == 4 && $thirdplace == true) {
                                                                echo "bronze";
                                                            } else {
                                                                echo "";
                                                            }

                                                            ?>"></td>
                            </tr>
                        <?php $counter++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/list_search.js"></script>
</body>

</html>