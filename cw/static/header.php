<header>
    <div>
        <a href="index.php" id="app_name">d'Artganan View</a>
    </div>
    <nav id="desktop">
        <div>
            <a href="index.php"><?= $i18n->get('home') ?></a>
        </div>
        <div>
            <a href="search.php"><?= $i18n->get('search') ?></a>
        </div>
        <div>
            <a href="blog.php"><?= $i18n->get('blog') ?></a>
        </div>
        <div>
            <a href="videos.php"><?= $i18n->get('videos') ?></a>
        </div>
        <!--
        <div>
            <a href="rankings.php">Rankings</a>
        </div>
        -->
        <div>
            <a href="saved_competitions.php"><?= $i18n->get('saved_competitions') ?></a>
        </div>
    </nav>
    <div id="change_language">
        <div>
            <button onclick="toggleLanguagesPanel(this)">
                <p id="selected_language">EN</p>
                <img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropwon icon">
            </button>
            <div id="change_language_panel">
                <div>
                    <button onclick="btnChangeLang('en')" class="btn btn-en">English</button>
                    <button onclick="btnChangeLang('de')" class="btn btn-de">German</button>
                    <button onclick="btnChangeLang('fr')" class="btn btn-fr">French</button>
                    <button onclick="btnChangeLang('ru')" class="btn btn-ru">Russian</button>
                    <button onclick="btnChangeLang('hu')" class="btn btn-hu">Hungarian</button>
                </div>
            </div>
        </div>
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
                <!--
                <a href="rankings.php">Rankings</a>
                -->
                <a href="saved_competitions.php">Saved Competitions</a>
            </div>
        </nav>
    </div>
</header>