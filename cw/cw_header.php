<header id="cw_header">
    <img src="../assets/img/favicon.svg">
    <a href="competition_view.php">CompetitionView</a>
    <div>
        <a href="cw_saved_competitions.php">Saved Competitions</a>
        <button class="hb_button" id="language_button" onclick="toggle_language_panel()">
            <img src="../assets/icons/language-black-18dp.svg" >
        </button>
    </div>
    <div>
        <div>
            <button value="Competitions" onclick="openCompetitionsDropdown()">Competitions</button>
            <div id="competition_dropdown" class="closed">
                <a href="cw_sheduled_competitions.php">Sheduled</a>
                <a href="cw_ongoing_competitions.php">Ongoing</a>
                <a href="cw_finished_competitions.php">Finished</a>
            </div>
        </div>
        <a href="cw_blog.php">Blog</a>
        <a href="cw_videos.php">Videos</a>
        <a href="cw_rankings.php">Rankings</a>
    </div>
</header>