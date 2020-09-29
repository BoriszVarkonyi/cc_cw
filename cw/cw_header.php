<header id="cw_header">
    <a href="competition_view.php">CompetitionView</a>
    <div>
        <a href="cw_saved_competitions.php">Saved Competitions</a>
        <button class="hb_button" id="language_button" onclick="toggle_language_panel()">
            <img src="../assets/icons/language-black-18dp.svg" alt="">
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