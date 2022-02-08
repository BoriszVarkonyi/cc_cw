<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Match Results</title>
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

                <p class="page_title">TEAM 1 vs TEAM 2</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" name="save_match" type="submit" form="save_match">
                        <p>Save Match</p>
                        <img src="../assets/icons/save_black.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper" id="match_result_wrapper">
                    <div class="match_fencers_wrapper">
                        <div>
                            <p>TEAM 1</p>
                        </div>

                        <div>
                            <p>TEAM 2</p>
                        </div>
                    </div>
                    <div class="match_settings_wrapper">
                        <form class="match_settings_form" method="POST">
                            <p class="setting_title">Referee 1:</p>
                            <p class="setting">REF 1 NAME (NAT)</p>
                            <button class="underlined_button" type="button" onclick="changeThis(this)">
                                <p>Change</p>
                            </button>
                            <div class="collapsed">
                                <button class="change_back_button" type="button" onclick="closeWrapper(this)">
                                    <img src="../assets/icons/close_black.svg">
                                </button>
                                <div class="search_wrapper wide">
                                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="rfrInput" placeholder="Search and Select referee" class="search input has_icon">
                                    <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close_black.svg"></button>
                                    <div class="search_results">

                                        <button type="button" id="ID" onclick="setSetting(this)">NEVE</button>

                                    </div>
                                </div>
                                <input type="text" name="ref_change_data">
                                <input type="submit" name="ref_change" class="save_change_button" value="Save">
                            </div>
                        </form>
                        <form class="match_settings_form" method="POST">
                            <p class="setting_title">Referee 2:</p>
                            <p class="setting">REF 2 NAME (NAT)</p>
                            <button class="underlined_button" type="button" onclick="changeThis(this)">
                                <p>Change</p>
                            </button>
                            <div class="collapsed">
                                <button class="change_back_button" type="button" onclick="closeWrapper(this)">
                                    <img src="../assets/icons/close_black.svg">
                                </button>
                                <div class="search_wrapper wide">
                                    <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="rfrInput" placeholder="Search and Select referee" class="search input has_icon">
                                    <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close_black.svg"></button>
                                    <div class="search_results">

                                        <button type="button" id="ID" onclick="setSetting(this)">NEVE</button>

                                    </div>
                                </div>
                                <input type="text" name="ref_change_data">
                                <input type="submit" name="ref_change" class="save_change_button" value="Save">
                            </div>
                        </form>
                        <form class="match_settings_form" method="POST">
                            <p class="setting_title">Piste:</p>
                            <p class="setting">Mostani iste</p>
                            <button class="underlined_button" type="button" onclick="changeThis(this)">
                                <p>Change</p>
                            </button>
                            <div class="collapsed">
                                <button class="change_back_button" type="button" onclick="closeWrapper(this)">
                                    <img src="../assets/icons/close_black.svg">
                                </button>
                                <div class="search_wrapper narrow">
                                    <button type="button" class="search select input" tabindex="3" onfocus="isOpen(this)" onblur="isClosed(this)">
                                        <input type="text" name="date_to_select" placeholder="Select Date">
                                    </button>
                                    <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                                    <div class="search_results">

                                        <button type="button" id="ID" onclick="setSetting(this)">PISTE NAME</button>

                                    </div>
                                </div>
                                <input type="text" name="piste_change_data">
                                <input type="submit" name="piste_change" class="save_change_button" value="Save">
                            </div>
                        </form>
                        <form class="match_settings_form" method="POST">
                            <p class="setting_title">Time:</p>
                            <p class="setting">Mostabni zime</p>
                            <button class="underlined_button" type="button" onclick="changeThis(this)">
                                <p>Change</p>
                            </button>
                            <div class="collapsed">
                                <button class="change_back_button" type="button" onclick="closeWrapper(this)">
                                    <img src="../assets/icons/close_black.svg">
                                </button>
                                <input type="time" name="time_change_data">
                                <input type="submit" name="time_change" class="save_change_button" value="Save">
                            </div>
                        </form>
                    </div>

                    <form id="team_match_results" method="POST">

                        <table class="small">
                            <thead>
                                <tr>
                                    <th>
                                        <p>REPLACEMENT</p>
                                        <p>NAME 1</p>
                                    </th>
                                    <th class="square">
                                        <p>NO.</p>
                                    </th>
                                    <th>
                                        <p>NAME</p>
                                    </th>
                                    <th>
                                        <p>POINTS</p>
                                    </th>
                                    <th>
                                        <p>POINTS</p>
                                    </th>
                                    <th>
                                        <p>NAME</p>
                                    </th>
                                    <th class="square">
                                        <p>NO.</p>
                                    </th>
                                    <th>
                                        <p>REPLACEMENT</p>
                                        <p>NAME 2</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="alt">
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                    <td class="square"><p>1</p></td>
                                    <td><p>NAME 1</p></td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td>
                                        <input type="number" name="" id="">
                                    </td>
                                    <td><p>NAME 2</p></td>
                                    <td class="square"><p>4</p></td>
                                    <td>
                                        <input type="radio" name="replacement1" id="match1">
                                        <label for="match1"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div id="winner_wrapper">
                            <div>
                                <p>TEAM 1 NAME</p>
                                <p class="winner_text">WINNER</p>
                                <input type="text" class="no_margin" name="" id="" placeholder="valaminek" readonly>
                                <input type="text" class="no_margin" name="" id="" placeholder="disqualifynak" readonly>

                                <input type="radio" name="draw_winner" id="draw_winner_t1" value="1" />
                                <label style="display: none;" id="draw_winner_t1" for="draw_winner_t1">Winner</label>

                                <div>
                                    <button type="button" onclick="disqualify(this)" class="disqualify_button">Disqualify</button>
                                    <button type="button" onclick="toggleDisqualifyPanel(this)" class="disqualify_button">Disqualify Fencer</button>
                                </div>

                                <div class="disqualify_panel collapsed">
                                    <input type="radio" name="disqualify1" id="team_1_fencer_1">
                                    <label for="team_1_fencer_1">Fencer 1</label>
                                    <input type="radio" name="disqualify1" id="team_1_fencer_2">
                                    <label for="team_1_fencer_2">Fencer 2</label>
                                    <input type="radio" name="disqualify1" id="team_1_fencer_3">
                                    <label for="team_1_fencer_3">Fencer 3</label>
                                    <input type="radio" name="disqualify1" id="team_1_fencer_4">
                                    <label for="team_1_fencer_4">Fencer 4</label>
                                </div>
                            </div>

                            <div>
                                <p>TEAM 2 NAME</p>
                                <p class="winner_text">WINNER</p>
                                <input type="text" class="no_margin" name="" id="" placeholder="valaminek" readonly>
                                <input type="text" class="no_margin" name="" id="" placeholder="disqualifynak" readonly>

                                <input type="radio" name="draw_winner" id="draw_winner_t2" value="1" />
                                <label style="display: none;" id="draw_winner_t2" for="draw_winner_t2">Winner</label>

                                <div>
                                    <button type="button" onclick="disqualify(this)" class="disqualify_button">Disqualify</button>
                                    <button type="button" onclick="toggleDisqualifyPanel(this)" class="disqualify_button">Disqualify Fencer</button>
                                </div>

                                <div class="disqualify_panel collapsed">
                                    <input type="radio" name="disqualify2" id="team_2_fencer_1">
                                    <label for="team_2_fencer_1">Fencer 1</label>
                                    <input type="radio" name="disqualify2" id="team_2_fencer_2">
                                    <label for="team_2_fencer_2">Fencer 2</label>
                                    <input type="radio" name="disqualify2" id="team_2_fencer_3">
                                    <label for="team_2_fencer_3">Fencer 3</label>
                                    <input type="radio" name="disqualify2" id="team_2_fencer_4">
                                    <label for="team_2_fencer_4">Fencer 4</label>
                                </div>
                            </div>


                        </div>

                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/match_results_team.js"></script>
    <script src="javascript/search.js"></script>
    <script src="javascript/controls.js"></script>
    <script src="javascript/overlay_panel.js"></script>
</body>

</html>