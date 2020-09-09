<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Videos</title>
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
    
    <div id="cw_main_narrow">
        <p class="cw_panel_title">Videos</p>
        <div id="browsing_bar">
            <input type="submit" value="Search">
        </div>
        <div id="videos_wrapper">
            <div id="latest_videos_panel_full">
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

            <div id="top_videos_panel_full">
                <p class="cw_panel_title">Top Videos</p>

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