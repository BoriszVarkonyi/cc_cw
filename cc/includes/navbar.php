<?php $comp_id = $_GET["comp_id"] ?>
<?php include "db.php" ?>
<?php include "navbar_btn_checker.php" ?>
<?php include "tech_safety_sys.php" ?>
<?php setOnline($connection); ?>

<nav>
    <button id="nav_bar_pin" onclick="togglePinButton(this)" class="pinned desktop_only">
        <img src="../assets/icons/push_pin_black.svg">
    </button>
    <div id="nav_bar_content">
        <p id="overview_text" class="nav_bar_title">OVERVIEW</p>
        <!-- dashboard -->
        <a href="index.php?comp_id=<?php echo $comp_id ?>" class="nav_bar_item">
            <img src="../assets/icons/dashboard_black.svg">
            <p>Dashboard</p>
        </a>
        <a href="chat_login.php" class="nav_bar_item" target="_blank">
            <img src="../assets/icons/chat_black.svg">
            <p>Chat</p>
        </a>

        <p id="controls_text" class="nav_bar_title">CONTROLS</p>
        <!-- DT -->
        <button class="nav_bar_item" onclick="toggleDropdown(this)" type="button">
            <img src="../assets/icons/list_alt_black.svg">
            <p>DT</p>
            <img src="../assets/icons/arrow_drop_down_black.svg" id="dt_dropdown_icon" class="dropdown_icon">
        </button>

        <!-- DT drop-down -->
        <div id="dt_dropdown_menu" class="dropdown_menu hidden">
            <a href="<?php echo $navbar -> competitors -> href ?>" class="nav_bar_item <?php echo $navbar -> competitors -> class ?>">Competitors</a>
            <a href="<?php echo $navbar -> teams -> href ?>" class="nav_bar_item <?php echo $navbar -> teams -> class ?>">Teams</a>
            <a href="<?php echo $navbar -> pools -> href ?>" class="nav_bar_item <?php echo $navbar -> pools -> class ?>">Pools</a>
            <a href="<?php echo $navbar -> temporary_ranking -> href ?>" class="nav_bar_item <?php echo $navbar -> temporary_ranking -> class ?>">Temporary Ranking</a>
            <a href="<?php echo $navbar -> table -> href ?>" class="nav_bar_item <?php echo $navbar -> table -> class ?>">Table</a>
            <a href="<?php echo $navbar -> overview -> href ?>" class="nav_bar_item <?php echo $navbar -> overview -> class ?>">Overview</a>
        </div>

        <!-- callroom -->
        <a href="<?php echo $navbar -> call_room -> href ?>" class="nav_bar_item <?php echo $navbar -> call_room -> class ?>">
            <img src="../assets/icons/account_tree_black.svg">
            <p>Callroom</p>
        </a>

        <!-- registration -->
        <a href="<?php echo $navbar -> registration -> href ?>" class="nav_bar_item <?php echo $navbar -> registration -> class ?>">
            <img src="../assets/icons/how_to_reg_black.svg">
            <p>Registration</p>
        </a>

        <!-- weapon control -->
        <a href="<?php echo $navbar -> weapon_control -> href ?>" class="nav_bar_item <?php echo $navbar -> weapon_control -> class ?>">
            <img src="../assets/icons/weapon_control_black.svg">
            <p>Weapon Control</p>
        </a>

        <a href="<?php echo $navbar -> announcements -> href ?>" class="nav_bar_item <?php echo $navbar -> announcements -> class ?>">
            <img src="../assets/icons/announcement_black.svg">
            <p>Announcements</p>
        </a>

        <p id="setup_text" class="nav_bar_title">SETUP</p>

        <!-- general -->
        <button type="button"class="nav_bar_item" onclick="toggleDropdown(this)">
            <img src="../assets/icons/widgets_black.svg">
            <p>General</p>
            <img src="../assets/icons/arrow_drop_down_black.svg" id="general_dropdown_icon" class="dropdown_icon">
        </button>

        <!-- general drop-down -->
        <div id="general_dropdown_menu" class="dropdown_menu hidden">
            <a href="<?php echo $navbar -> basic_information -> href ?>" class="nav_bar_item <?php echo $navbar -> basic_information -> class ?>">Basic Information</a>
            <a href="<?php echo $navbar -> information_for_fencers -> href ?>" class="nav_bar_item <?php echo $navbar -> information_for_fencers -> class ?>">Information for fencers</a></li>
            <a href="<?php echo $navbar -> invitation -> href ?>" class="nav_bar_item <?php echo $navbar -> invitation -> class ?>">Invitation</a>
        </div>

        <!-- technical -->
        <button type="button"class="nav_bar_item" onclick="toggleDropdown(this)">
            <img src="../assets/icons/home_repair_service_black.svg">
            <p>Technical</p>
            <img src="../assets/icons/arrow_drop_down_black.svg" id="technical_dropdown_icon" class="dropdown_icon">
        </button>

        <!-- technical drop-down -->
        <div id="technical_dropdown_menu" class="dropdown_menu hidden">
            <a href="<?php echo $navbar -> technicians -> href ?>" class="nav_bar_item <?php echo $navbar -> technicians -> class ?>">Technicians</a>
            <a href="<?php echo $navbar -> referees -> href ?>" class="nav_bar_item <?php echo $navbar -> referees -> class ?>">Referees</a>
            <a href="<?php echo $navbar -> pistes -> href ?>" class="nav_bar_item <?php echo $navbar -> pistes -> class ?>">Pistes</a>
            <a href="<?php echo $navbar -> formula -> href ?>" class="nav_bar_item <?php echo $navbar -> formula -> class ?>">Formula</a>
        </div>

        <!-- ranking  -->
        <a href="<?php echo $navbar -> ranking -> href ?>" class="nav_bar_item <?php echo $navbar -> ranking -> class ?>">
            <img src="../assets/icons/leaderboard_black.svg">
            <p>Ranking</p>
        </a>

        <!-- manage ebtries -->
        <a href="<?php echo $navbar -> manage_entries -> href ?>" class="nav_bar_item <?php echo $navbar -> manage_entries -> class ?>">
            <img src="../assets/icons/all_inbox_black.svg">
            <p>Manage Entries</p>
        </a>

        <p id="referee_text" class="nav_bar_title">CCREFEREE</p>

        <a href="referee_matches.php?comp_id=<?php echo $comp_id ?>" class="nav_bar_item">
            <img src="../assets/icons/leaderboard_black.svg">
            <p>Matches</p>
        </a>

        <a href="referee_match.php?comp_id=<?php echo $comp_id ?>" class="nav_bar_item">
            <img src="../assets/icons/leaderboard_black.svg">
            <p>Match</p>
        </a>

        <!-- help -->
        <a href="user_guide.php?comp_id=<?php echo $comp_id ?>" id="documentation_label">
            <img src="../assets/icons/help_black.svg">
            <p>Docs and more</p>
        </a>
    </div>
</nav>