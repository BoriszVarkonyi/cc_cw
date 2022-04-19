<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tournament's Timetable</title>
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
            <p class="page_title">Tournament's Timetable</p>
            <div class="stripe_button_wrapper">
                <button type="button" class="stripe_button primary" name="add_wc_phase" id="add_wc_phase_button" onclick="toggleAddPanel()" shortcut="SHIFT+A">
                    <p>Add Weapon Control Phase</p>
                    <img src="../assets/icons/add_black.svg" />
                </button>
            </div>

			<div id="add_technician_panel" class="overlay_panel hidden">
				<button class="panel_button" name="Close panel" onclick="toggleAddPanel()">
					<img src="../assets/icons/close_black.svg">
				</button>
				<form class="overlay_panel_form" autocomplete="off" action="staff.php?comp_id=<?php echo $comp_id; ?>" method="POST" id="new_technician" autocomplete="off">

                    <label for="">DATE</label>
                    <div class="search_wrapper narrow">
                        <button type="button" class="search select input" onfocus="isOpen(this)" onblur="isClosed(this)" tabindex="3">
                            <input type="text" name="date_to_select" placeholder="Select Date">
                        </button>
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg"></button>
                        <div class="search_results">

                            <?php

                            $period = new DatePeriod(

                                new DateTime($dates->start_date),
                                new DateInterval('P1D'),
                                new DateTime(date('Y-m-d', strtotime($dates->end_date . "+1 days")))
                            );

                            foreach ($period as $key => $value) {

                                if ($key == "min_fencer") {
                                    continue;
                                }

                                $checker = 0;

                                $dateshow = $value->format('Y-m-d');

                                if ($appointments != "") {

                                    foreach ($appointments as $keydate => $timevalue) {

                                        if ($keydate == $dateshow) {

                                            $checker++;
                                        }
                                    }
                                }

                                if ($checker == 0) {
                            ?>

                                    <button type="button" onclick="selectSystem(this)"><?php echo $dateshow; ?></button>

                            <?php }
                            } ?>
                        </div>
                    </div>

                    <label for="">STARTING TIME</label>
                    <input type="time" class="" name="st_t" step="3600">

                    <label for="">ENDING TIME</label>
                    <input type="time" class="" name="ed_t" step="3600">

                    <label for="">MINUTE / FENCER</label>
                    <input type="number" class="number_input centered" placeholder="#" name="min_fencer" step="1">


					<button type="submit" name="submit_tech" class="panel_submit" form="new_technician">Save</button>
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