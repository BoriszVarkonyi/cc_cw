<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tournament's Competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/list_style.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>
<body>
    <?php include "includes/navigation.php"; ?>
    <main>
        <div id="title_stripe">
            <p class="page_title">Tournament's Competitions</p>
            <div class="stripe_button_wrapper">
                <form action="">
                    <input type="text" name="id" class="selected_list_item_input" readonly>
                    <button type="submit" class="stripe_button red" name="remove_competition" id="remove_competition_button" shortcut="SHIFT+R">
                        <p>Remove Competition</p>
                        <img src="../assets/icons/delete_black.svg" />
                    </button>
                </form>

                <form action="">
                    <input type="text" name="id" class="selected_list_item_input" readonly>
                    <button type="submit" class="stripe_button bold" name="edit_competition" id="edit_competition_button" shortcut="SHIFT+R">
                        <p>Edit Competition</p>
                        <img src="../assets/icons/edit_black.svg" />
                    </button>
                </form>

                <form action="">
                    <button type="submit" class="stripe_button primary" name="create_competition" id="create_competition_button" shortcut="SHIFT+R">
                        <p>Create Competition</p>
                        <img src="../assets/icons/add_black.svg" />
                    </button>
                </form>

            </div>

        </div>
        <div id="page_content_panel_main">

            <!--
                <div id="empty_content_notice">
                    <p>This tournament has no competitions yet!</p>
                </div>
            -->

            <table class="wrapper">

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
                                <p>NAME</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="search hidden">
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="c_type" id="listsearch_individual" value="Individual" />
                                    <label for="listsearch_individual">Individual</label>
                                    <input type="radio" name="c_type" id="listsearch_team" value="Team" />
                                    <label for="listsearch_team">Team</label>
                                </div>
                            </div>
                            <div class="table_buttons_wrapper">
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>COMPETITORS</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="search hidden">
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="w_type" id="listsearch_epee" value="Epee" />
                                    <label for="listsearch_epee">Epee</label>
                                    <input type="radio" name="w_type" id="listsearch_foil" value="Foil" />
                                    <label for="listsearch_foil">Foil</label>
                                    <input type="radio" name="w_type" id="listsearch_sabre" value="Sabre" />
                                    <label for="listsearch_sabre">Sabre</label>
                                </div>
                            </div>
                            <div class="table_buttons_wrapper">
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>WEAPON</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="search hidden">
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="sex" id="listsearch_men" value="Men" />
                                    <label for="listsearch_men">Men</label>
                                    <input type="radio" name="sex" id="listsearch_women" value="Women" />
                                    <label for="listsearch_women">Women</label>
                                </div>
                            </div>
                            <div class="table_buttons_wrapper">
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>SEX</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="search hidden">
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="wc_type" id="listsearch_individual" value="Individual" />
                                    <label for="listsearch_individual">No weapon control</label>
                                    <input type="radio" name="wc_type" id="listsearch_immediate" value="Immediate" />
                                    <label for="listsearch_immediate">Immediate</label>
                                    <input type="radio" name="wc_type" id="listsearch_administrated" value="Administrated" />
                                    <label for="listsearch_administrated">Administrated</label>
                                </div>
                            </div>
                            <div class="table_buttons_wrapper">
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>WEAPON CONTROL</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="search_panel option">
                                <div class="search_panel_buttons">
                                    <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                </div>
                                <div class="search_wrapper">
                                    <input type="text" onkeyup="searchInLists()" class="search hidden">
                                </div>
                                <div class="option_container">
                                    <input type="radio" name="status" id="listsearch_sheduled" value="Sheduled" />
                                    <label for="listsearch_sheduled">Sheduled</label>
                                    <input type="radio" name="status" id="listsearch_published" value="Published" />
                                    <label for="listsearch_published<">Published</label>
                                    <input type="radio" name="status" id="listsearch_ongoing" value="Ongoing" />
                                    <label for="listsearch_ongoing">Ongoing</label>
                                    <input type="radio" name="status" id="listsearch_finished" value="Finished" />
                                    <label for="listsearch_finished">Finished</label>
                                </div>
                            </div>
                            <div class="table_buttons_wrapper">
                                <button type="button" onclick="sortButton(this)">
                                    <img src="../assets/icons/switch_full_black.svg">
                                </button>
                                <p>STATUS</p>
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="1" onclick="selectRow(this)">
                        <td>
                            <p>Name</p>
                        </td>
                        <td>
                            <p>Individual</p>
                        </td>
                        <td>
                            <p>Foil</p>
                        </td>
                        <td>
                            <p>Men</p>
                        </td>
                        <td>
                            <p>Immidate</p>
                        </td>
                        <td>
                            <p>Published</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_2.js"></script>
    <script src="javascript/overlay_panel.js"></script>
    <script src="javascript/referees.js"></script>
    <script src="javascript/technicans_referees.js"></script>
    <script src="javascript/controls_2.js"></script>
    <script src="javascript/importoverlay.js"></script>
    <script src="javascript/list_search_2.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>