<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Competitors</title>
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
                <p class="page_title">Competitors</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button disabled" type="button">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/message_black.svg"/>
                    </button>
                    <form action="" method="POST" id="IDE KELL A FORM IDJE">
                        <input type="text" class="selected_list_item_input hidden" name="selected_id" readonly>
                    </form>
                    <button class="stripe_button red" name="remove_fencer" type="submit" form="IDE KELL A FORM IDJE">
                        <p>Remove Fencer</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>
                    <button class="stripe_button primary" type="button" onclick="window.print()">
                        <p>Print Competitors</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                    <a class="stripe_button primary" href="import_competitors.php?comp_id=<?php echo $comp_id ?>">
                        <p>Import Competitors from XML</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                </div>
            </div>
            <div id="page_content_panel_main">

                <table class="wrapper small w90">
                    <thead>
                        <tr>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Classement Position" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>R. POS</p>
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
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Nation" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>NATION</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Club" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>CLUB</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Team" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>TEAM</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                            <tr id="" onclick="selectRow(this)">
                                <td>
                                    <p>R. POS</p>
                                </td>
                                <td>
                                    <p>NAME</p>
                                </td>
                                <td>
                                    <p>NATION</p>
                                </td>
                                <td>
                                    <p>CLUB</p>
                                </td>
                                <td>
                                    <p>TEAM</p>
                                </td>
                            </tr>
                    </tbody>


                </table>
            </div>
        </div>
    </main>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list_2.js"></script>
    <script src="../js/controls_2.js"></script>
    <script src="../js/list_search_2.js"></script>
    <script src="../js/competitors.js"></script>
</body>
</html>