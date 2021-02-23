<header>
    <div>
        <a href="competition_view.php" id="app_name">CompetitionView</a>
    </div>
    <div id="navigation">
        <div>
            <a href="competition_view.php">Home</a>
        </div>
        <div>
            <button onclick="toggleCompetitionsPanel(this)" type="button">Competitions</button>
            <div id="competitions_navigation">
                <a href="upcoming_competitions.php">Upcoming</a>
                <a href="ongoing_competitions.php">Ongoing</a>
                <a href="finished_competitions.php">Finished</a>
            </div>
        </div>
        <div>
            <a href="blog.php">Blog</a>
        </div>
        <div>
            <a href="videos.php">Videos</a>
        </div>
        <div>
            <a href="rankings.php">Rankings</a>
        </div>
        <div>
            <a href="saved_competitions.php">Saved Competitions</a>
        </div>
    </div>
    <div id="change_language">
        <div>
            <button onclick="toggleLanguagesPanel(this)">
                <p>En</p>
                <img src="../assets/icons/arrow_drop_down-black-18dp.svg">
            </button>
            <div id="change_language_panel">
                <div>
                    <button class="selected">English</button>
                    <button>German</button>
                    <button>French</button>
                    <button>Russian</button>
                    <button>Spanish</button>
                </div>
            </div>
        </div>
    </div>
    <div id="navigation_mobile">
        <button onclick="toggleMobileNavigation(this)">
            <img src="../assets/icons/menu-black-18dp.svg">
        </button>
        <div id="mobile_navigation">
            <div>
                <a href="competition_view.php">Home</a>
                <p>Competitions</p>
                <div>
                    <a href="upcoming_competitions.php">Upcoming</a>
                    <a href="ongoing_competitions.php">Ongoing</a>
                    <a href="finished_competitions.php">Finished</a>
                </div>
                <a href="blog.php">Blog</a>
                <a href="videos.php">Videos</a>
                <a href="rankings.php">Rankings</a>
                <a href="saved_competitions.php">Saved Competitions</a>
            </div>
        </div>
    </div>
</header>