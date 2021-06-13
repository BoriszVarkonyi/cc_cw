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
    <title>Teams</title>
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
                <p class="page_title">Teams</p>
                <div class="stripe_button_wrapper">
                    <form action="" method="POST" id="IDE KELL A FORM IDJE">
                        <input type="text" class="selected_list_item_input hidden" name="selected_id" readonly>
                    </form>

                    <a class="stripe_button" href="import_teams.php?comp_id=<?php echo $comp_id ?>">
                        <p>Import Teams from XML</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                    <button class="stripe_button red" name="remove_team" type="submit" form="IDE KELL A FORM IDJE">
                        <p>Remove Team</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>
                    <button class="stripe_button primary" type="button" onclick="toggleAddTeamPanel()">
                        <p>Add Team</p>
                        <img src="../assets/icons/add_black.svg"/>
                    </button>
                    <a class="stripe_button primary" href="team_order_reports.php?comp_id=<?php echo $comp_id ?>">
                        <p>Teams Order Reports</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                    <a class="stripe_button primary" href="assign_fencers_to_teams.php?comp_id=<?php echo $comp_id ?>">
                        <p>Assign Fencers to Teams</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </a>
                </div>

                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search Team" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
                    <div class="search_results">
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button"></button>
                    </div>
                </div>

                <div id="add_team_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggleAddTeamPanel()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form action="" id="add_team" method="POST" class="overlay_panel_form" autocomplete="off">
                        <label for="">TEAM NAME</label>
                        <input type="text" placeholder="Type in the team's name">

                        <button type="submit" name="submit_add_team" class="panel_submit" value="">Add</button>
                    </form>
                </div>
            </div>
            <div id="page_content_panel_main">

                <div class="wrapper list w90">

                    <div>
                        <div class="entry">
                            <div class="tr bold">
                                <p>NAME</p>
                            </div>
                            <div class="entry_panel small">
                                <div class="entry_header">
                                    <form>
                                        <div>
                                            <label for="">TEAM LEADER</label>
                                            <input type="text" class="name_input" placeholder="Type in the team leader's name">
                                        </div>
                                        <div>
                                            <label for="">COACH</label>
                                            <input type="text" class="name_input" placeholder="Type in the team leader's name">
                                        </div>
                                        <div class="hidden">
                                            <button type="submit">SAVE</button>
                                        </div>
                                    </form>
                                </div>
                                <table class="small">
                                    <thead>
                                        <tr>
                                            <th>
                                                <p>NAME</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="alt">
                                        <tr>
                                            <td>
                                                <p>JANI KICSI JÜ</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>