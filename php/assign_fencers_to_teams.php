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
    <title>Assign Fencers to Teams</title>
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
                <p class="page_title">Assign Fencers to Teams</p>
                <div class="stripe_button_wrapper">

                    <form action="" method="POST" id="auto_team_assignment">
                        <input type="text" class="hidden" readonly>
                    </form>

                    <form action="" method="POST" id="save_team_assignments">
                        <input type="text" class="hidden" readonly>
                    </form>

                    <a class="stripe_button bold" href="teams.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Teams</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <button class="stripe_button bold" type="submit" form="auto_team_assignment">
                        <p>Assign Fencers Automatically</p>
                        <img src="../assets/icons/list_alt_black.svg"/>
                    </button>
                    <button class="stripe_button primary" type="submit" form="save_team_assignments">
                        <p>Save</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>

                <div class="search_wrapper">
                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search Team" class="search page">
                    <button type="button"><img src="../assets/icons/close_black.svg"></button>
                    <div class="search_results">
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button">Ide kell a kuki</button>
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button">Ide kell a kuki</button>
                        <button id="" href="#" onclick="selectSearch(this), autoFill(this)" type="button">Ide kell a kuki</button>
                    </div>
                </div>
            </div>
            <div id="page_content_panel_main" class="no_scroll no_wrap">
                <div class="splitscreen big">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <p>NAME</p>
                                </th>
                                <th>
                                    <p>NATION</p>
                                </th>
                                <th>
                                    <p>CLUB</p>
                                </th>
                                <th class="square"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>Ez a neve</p>
                                </td>
                                <td>
                                    <p>Ez nem</p>
                                </td>
                                <td>
                                    <p>Ez igen ?</p>
                                </td>
                                <td class="square">
                                    <input type="checkbox" name="emberek" id="ember1">
                                    <label for="ember1"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Ez a neve</p>
                                </td>
                                <td>
                                    <p>Ez nem</p>
                                </td>
                                <td>
                                    <p>Ez igen ?</p>
                                </td>
                                <td class="square">
                                    <input type="checkbox" name="emberek" id="ember2">
                                    <label for="ember2"></label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="splitscreen small">
                    <div class="splitscreen_section header">
                        <div class="splitscreen_select">
                            <p>Unselected Fencers</p>
                            <div>
                                <p>3</p>
                                <img src="../assets/icons/person_black.svg">
                            </div>
                        </div>
                    </div>
                    <div class="splitscreen_section">
                        <div class="splitscreen_select selected">
                            <p>Team 1</p>
                            <div class="red">
                                <p>5</p>
                                <img src="../assets/icons/person_black.svg">
                            </div>
                        </div>
                        <div class="splitscreen_select">
                            <p>Team 1</p>
                            <div class="gray">
                                <p>5</p>
                                <img src="../assets/icons/person_black.svg">
                            </div>
                        </div>
                        <div class="splitscreen_select">
                            <p>Team 1</p>
                            <div class="green">
                                <p>5</p>
                                <img src="../assets/icons/person_black.svg">
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
    <script>
        function toggleAddTeamPanel() {
            var panel = document.getElementById("add_team_panel");
            panel.classList.toggle("hidden");
        }
    </script>
</body>
</html>