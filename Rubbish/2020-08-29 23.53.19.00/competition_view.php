<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CompetitionView</title>
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
                <a href="cw_ongoing_competitions.php">Ongoing</a>
                <a href="cw_finished_competitions.php">Finished</a>
            </div>
            <button value="Competitions" class="opened" onclick="openCompetitionsDropdown()">Competitions</button>
            <a href="">Blog</a>
            <a href="cw_videos.php">Videos</a>
            <a href="">Rankings</a>
        </div>
    </header>
    <div id="slideshow">
        <div id="slide_nav">
            <button class="active" id="first_button" onclick="toggleFirst()"></button>
            <button id="second_button" onclick="toggleSecond()"></button>
            <button id="third_button" onclick="toggleThird()"></button>
            <button id="fourth_button" onclick="toggleForth()"></button>
        </div>
        <div class="slide">
            <p>Check Competitions</p>
            <button>Competitions</button>
            <img src="../assets/img/fencers_bg.svg" alt="">
        </div>

        <div class="slide">
            <p>Check Results</p>
            <button>Finished Competitions</button>
            <img src="../assets/img/fencers_bg.svg" alt="">
        </div>

        <div class="slide">
            <p>Watch Competitions Live</p>
            <button>Ongoing Competitions</button>
            <img src="../assets/img/fencers_bg.svg" alt="">
        </div>

        <div class="slide">
            <p>Watch Videos</p>
            <button>Videos</button>
            <img src="../assets/img/fencers_bg.svg" alt="">
        </div>
    </div>

    <div id="cw_main">
        <div id="ongoing_competitions_panel">
            <p class="cw_panel_title">Ongoing Competitions</p>
            <div class="cw_table_wrapper">
                <div class="table_row">
                    <div class="table_item">
                        Landesmeisterschaft Mecklenburg-Vorpommern
                    </div>
                    <div class="table_item live">
                        <a href="">Live</a>
                    </div>
                </div>
                <div class="table_row">
                    <div class="table_item">
                        Landesmeisterschaft Mecklenburg-Vorpommern
                    </div>
                    <div class="table_item live">
                        <a href="">Live</a>
                    </div>
                </div>
                <div class="table_row">
                    <div class="table_item">
                        Landesmeisterschaft Mecklenburg-Vorpommern
                    </div>
                    <div class="table_item live">
                        <a href="">Live</a>
                    </div>
                </div>
                <div class="table_row">
                    <div class="table_item">
                        Landesmeisterschaft Mecklenburg-Vorpommern
                    </div>
                    <div class="table_item live">
                        <a href="">Live</a>
                    </div>
                </div>
                <div class="table_row">
                    <div class="table_item">
                        Landesmeisterschaft Mecklenburg-Vorpommern
                    </div>
                    <div class="table_item live">
                        <a href="">Live</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="latest_videos_panel">
            <p class="cw_panel_title">Latest Videos</p>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
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