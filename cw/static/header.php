<header>
    <div>
        <a href="index.php" id="app_name">CompetitionView</a>
    </div>
    <nav id="desktop">
        <div>
            <a href="index.php">Home</a>
        </div>
        <div>
            <a href="search.php">Search</a>
        </div>
        <div>
            <a href="blog.php">Blog</a>
        </div>
        <div>
            <a href="videos.php">Videos</a>
        </div>
        <!--
        <div>
            <a href="rankings.php">Rankings</a>
        </div>
        -->
        <div>
            <a href="saved_competitions.php">Saved Competitions</a>
        </div>
    </nav>
    <div id="change_language">
        <!--
        <div>
            <button onclick="toggleLanguagesPanel(this)">
                <p>En</p>
                <img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropwon icon">
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
        -->
    </div>
    <div id="mobile_navigation_wrapper">
        <button onclick="toggleMobileNavigation(this)" aria-label="Open Mobile Navigation" aria-label="Open Mobile Navigation">
            <img src="../assets/icons/menu_black.svg" alt="Menu button icon">
        </button>
        <nav id="mobile">
            <div>
                <a href="index.php">Home</a>
                <a href="search.php">Search</a>
                <a href="blog.php">Blog</a>
                <a href="videos.php">Videos</a>
                <a href="rankings.php">Rankings</a>
                <a href="saved_competitions.php">Saved Competitions</a>
            </div>
        </nav>
    </div>
</header>