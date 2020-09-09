<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ongoing Competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <header id="cw_header">
        <p>CompetitionView</p>
        <div>
            <a href="saved_competitions.php">Saved Competitions</a>
            <button class="hb_button" id="language_button" onclick="toggle_language_panel()">
                <img src="../assets/icons/language-black-18dp.svg" alt="">
            </button>
            <button class="hb_button" id="colormode_button" onclick="toggle_colormode_panel()">
                <img src="../assets/icons/color_lens-black-18dp.svg" alt="">
            </button>
        </div>
        <div>
            <div id="competition_dropdown" class="closed">
                <a href="cw_sheduled_competitions.php">Sheduled</a>
                <a href="">Ongoing</a>
                <a href="">Finished</a>
            </div>
            <button value="Competitions" class="opened" onclick="openCompetitionsDropdown()">Competitions</button>
            <button value="Blog">Blog</button>
            <button value="Videos">Videos</button>
            <button value="Rankings">Rankings</button>
        </div>
    </header>
    
    <div id="cw_main_full">
        <p class="cw_panel_title">ONGOING COMPETITIONS</p>
        <form id="browsing_bar">
            <input type="submit" value="Search">
        </form>

        <div id="competition_color_legend">
            <button id="registration_lengend" value="Registration Finished"></button>
            <p>Registration Finished</p>
            <button id="pools_lengend" value="Ongoing Pools"></button>
            <p>Ongoing Pools</p>
            <button id="table_lengend" value="Ongoing Table"></button>
            <p>Ongoing Table</p>
        </div>

        <div class="cw_table_wrapper competitions">
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
                <div class="table_item live">
                    <a href="">Live</a>
                </div>
                <div class="small_status_item blue"></div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
                <div class="table_item live">
                    <a href="">Live</a>
                </div>
                <div class="small_status_item blue"></div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
                <div class="table_item live">
                    <a href="">Live</a>
                </div>
                <div class="small_status_item yellow"></div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
                <div class="table_item live">
                    <a href="">Live</a>
                </div>
                <div class="small_status_item purple"></div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
                <div class="table_item live">
                    <a href="">Live</a>
                </div>
                <div class="small_status_item yellow"></div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
                <div class="table_item live">
                    <a href="">Live</a>
                </div>
                <div class="small_status_item blue"></div>
            </div>
        </div>
    </div>
    <footer>
        <div>
            <div>
                <p>CompetitionView &copy 2020</p>
                <img src="../assets/img/favicon.svg" alt="" class="footer_logo">
            </div>
            <div>
                <p>CONTACTS</p>
                <a href="">Email</a>
                <a href="">Facebook</a>
                <a href="">Instagram</a>
                <a href="" class="about_us">About us</a>

            </div>
            <div>
                <p>OTHER APPLICATIONS</p>
                <a href="">CompetitionControl</a>
                <a href="">CompetitionControl Wheelchair</a>
            </div>

        </div>
    </footer>
</body>
<script src="../js/cw_main.js"></script>
</html>