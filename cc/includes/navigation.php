<?php $comp_id = $_GET["comp_id"] ?>
<?php include "db.php" ?>
<?php include "navigation_btn_checker.php" ?>
<?php include "tech_safety_sys.php" ?>
<?php setOnline($connection); ?>

<nav>
    <button id="navigation_pin" onclick="togglePinButton(this)" class="pinned desktop_only">
        <img src="../assets/icons/push_pin_black.svg">
    </button>
    <div id="navigation_content">

        <p id="overview_text" class="navigation_title">TOURNAMENT</p>
        <a href="competitions.php?comp_id=<?php echo $comp_id ?>" class="navigation_item">
            <img src="../assets/icons/dashboard_black.svg">
            <p>Competitions</p>
        </a>
        <a href="timetable.php?comp_id=<?php echo $comp_id ?>" class="navigation_item">
            <img src="../assets/icons/date_range_black.svg">
            <p>Timetable</p>
        </a>
        <a href="<?php echo $navbar -> staff -> href ?>" class="navigation_item <?php echo $navbar -> staff -> class ?>">
            <img src="../assets/icons/badge_black.svg">
            <p>Staff</p>
        </a>
        <a href="<?php echo $navbar -> staff -> href ?>" class="navigation_item <?php echo $navbar -> staff -> class ?>">
            <img src="../assets/icons/badge_black.svg">
            <p>Doctors</p>
        </a>
        <a href="<?php echo $navbar -> staff -> href ?>" class="navigation_item <?php echo $navbar -> staff -> class ?>">
            <img src="../assets/icons/badge_black.svg">
            <p>Piste tech.</p>
        </a>


        <div id="competition_select_wrapper">
            <div id="competition_select" onclick="toggleCompSelect()">
                <p><?php echo $title ?></p>
                <div>
                    <img src="../assets/icons/arrow_drop_down_black.svg" id="">
                </div>
            </div>
            <div class="small_scroll">
                <?php

                $get_comps_in_t = "SELECT * FROM competitions WHERE ass_tournament_id = $ass_tourn_id";
                $get_comps_in_t_do = mysqli_query($connection, $get_comps_in_t);

                while ($row = mysqli_fetch_assoc($get_comps_in_t_do)) {

                    $c_id = $row["comp_id"];
                    $c_name = $row["comp_name"];
                ?>
                    <a class="competition_button <?php if($c_id == $comp_id){echo "selected";} ?>" href='/cc/index.php?comp_id=<?php echo $c_id ?>'><?php echo $c_name ?></a>
                <?php } ?>
            </div>
        </div>

        <p id="overview_text" class="navigation_title">COMPETITION</p>
        <!-- dashboard -->
        <a href="index.php?comp_id=<?php echo $comp_id ?>" class="navigation_item">
            <img src="../assets/icons/dashboard_black.svg">
            <p>Dashboard</p>
        </a>
        <!--
        <a href="chat_login.php" class="navigation_item" target="_blank">
            <img src="../assets/icons/chat_black.svg">
            <p>Chat</p>
        </a>
        -->


        <p id="controls_text" class="navigation_title">CONTROLS</p>
        <button class="navigation_item" onclick="toggleDropdown(this)" type="button">
            <img src="../assets/icons/list_alt_black.svg">
            <p>DT</p>
            <img src="../assets/icons/arrow_drop_down_black.svg" id="dt_navigation_dropdown_icon" class="navigation_dropdown_icon">
        </button>
        <div id="dt_navigation_dropdown_menu" class="navigation_dropdown_menu hidden">
            <a href="<?php echo $navbar -> competitors -> href ?>" class="navigation_item <?php echo $navbar -> competitors -> class ?>">Competitors</a>
            <a href="<?php echo $navbar -> teams -> href ?>" class="navigation_item <?php echo $navbar -> teams -> class ?>">Teams</a>
            <a href="<?php echo $navbar -> pools -> href ?>" class="navigation_item <?php echo $navbar -> pools -> class ?>">Pools</a>
            <a href="<?php echo $navbar -> temporary_ranking -> href ?>" class="navigation_item <?php echo $navbar -> temporary_ranking -> class ?>">Temporary Ranking</a>
            <a href="<?php echo $navbar -> table -> href ?>" class="navigation_item <?php echo $navbar -> table -> class ?>">Table</a>
            <a href="<?php echo $navbar -> overview -> href ?>" class="navigation_item <?php echo $navbar -> overview -> class ?>">Overview</a>
        </div>
        <a href="<?php echo $navbar -> call_room -> href ?>" class="navigation_item <?php echo $navbar -> call_room -> class ?>">
            <img src="../assets/icons/account_tree_black.svg">
            <p>Callroom</p>
        </a>
        <a href="<?php echo $navbar -> registration -> href ?>" class="navigation_item <?php echo $navbar -> registration -> class ?>">
            <img src="../assets/icons/how_to_reg_black.svg">
            <p>Registration</p>
        </a>
        <a href="<?php echo $navbar -> weapon_control -> href ?>" class="navigation_item <?php echo $navbar -> weapon_control -> class ?>">
            <img src="../assets/icons/weapon_control_black.svg">
            <p>Weapon Control</p>
        </a>
        <a href="<?php echo $navbar -> announcements -> href ?>" class="navigation_item <?php echo $navbar -> announcements -> class ?>">
            <img src="../assets/icons/announcement_black.svg">
            <p>Announcements</p>
        </a>


        <p id="setup_text" class="navigation_title">SETUP</p>
        <button type="button"class="navigation_item" onclick="toggleDropdown(this)">
            <img src="../assets/icons/widgets_black.svg">
            <p>General</p>
            <img src="../assets/icons/arrow_drop_down_black.svg" id="general_navigation_dropdown_icon" class="navigation_dropdown_icon">
        </button>
        <div id="general_navigation_dropdown_menu" class="navigation_dropdown_menu hidden">
            <a href="<?php echo $navbar -> basic_information -> href ?>" class="navigation_item <?php echo $navbar -> basic_information -> class ?>">Basic Information</a>
            <a href="<?php echo $navbar -> information_for_fencers -> href ?>" class="navigation_item <?php echo $navbar -> information_for_fencers -> class ?>">Info. for fencers</a></li>
            <a href="<?php echo $navbar -> invitation -> href ?>" class="navigation_item <?php echo $navbar -> invitation -> class ?>">Invitation</a>
        </div>
        <button type="button"class="navigation_item" onclick="toggleDropdown(this)">
            <img src="../assets/icons/home_repair_service_black.svg">
            <p>Technical</p>
            <img src="../assets/icons/arrow_drop_down_black.svg" id="technical_navigation_dropdown_icon" class="navigation_dropdown_icon">
        </button>
        <div id="technical_navigation_dropdown_menu" class="navigation_dropdown_menu hidden">
            <a href="<?php echo $navbar -> referees -> href ?>" class="navigation_item <?php echo $navbar -> referees -> class ?>">Referees</a>
            <a href="<?php echo $navbar -> pistes -> href ?>" class="navigation_item <?php echo $navbar -> pistes -> class ?>">Pistes</a>
            <a href="<?php echo $navbar -> formula -> href ?>" class="navigation_item <?php echo $navbar -> formula -> class ?>">Formula</a>
        </div>


        <p id="referee_text" class="navigation_title">REFEREE</p>
        <a href="referee_matches.php?comp_id=<?php echo $comp_id ?>" class="navigation_item">
            <img src="../assets/icons/leaderboard_black.svg">
            <p>Matches</p>
        </a>
        <a href="referee_match.php?comp_id=<?php echo $comp_id ?>" class="navigation_item">
            <img src="../assets/icons/leaderboard_black.svg">
            <p>Match</p>
        </a>

        <p id="referee_text" class="navigation_title">DOCTOR</p>
        <a href="referee_matches.php?comp_id=<?php echo $comp_id ?>" class="navigation_item">
            <img src="../assets/icons/leaderboard_black.svg">
            <p>Matches</p>
        </a>

        <a href="user_guide.php?comp_id=<?php echo $comp_id ?>" id="documentation_label">
            <img src="../assets/icons/help_black.svg">
            <p>Docs and more</p>
        </a>

    </div>
</nav>