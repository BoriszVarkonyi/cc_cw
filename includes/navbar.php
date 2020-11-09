<?php include "compid.php" ?>
<?php include "db.php" ?>
<?php include "navbar_btn_checker.php" ?>
<?php setOnline($connection); ?>
<?php

$test = date("Y-m-d");
setcookie("today",$test,time()+31556926);

?>

<!-- navbar -->
<div class="nav_bar_flex">
    <div id="nav_bar">
        <div id="nav_bar_wrapper">
            <p id="overview_text" class="nav_bar_title">OVERVIEW</p> 
            <!-- dashboard -->
            <a href="index.php?comp_id=<?php echo $comp_id ?>" class="nav_bar_item">
                <img src="../assets/icons/dashboard-black-18dp.svg">
                <p>Dashboard</p>
            </a>

            <p id="controls_text" class="nav_bar_title">CONTROLS</p>
            <!-- DT -->
            <button type="button" <?php echo $assoc_array_functions['dt'] ?> >
                <img src="../assets/icons/list_alt-black-18dp.svg">
                <p>DT</p>
                <img src="../assets/icons/arrow_drop_down-black-18dp.svg" id="dt_dropdown_icon" class="dropdown_icon">
            </button>

            <!-- DT drop-down -->
            <div id="dt_dropdown_menu" class="dropdown_menu hidden">
                <a <?php echo $assoc_array_functions['competitors'] ?>>Competitiors</a>
                <a <?php echo $assoc_array_functions['pools'] ?>>Pools</a>
                <a <?php echo $assoc_array_functions['table'] ?>>Table</a>
                <a <?php echo $assoc_array_functions['overview'] ?>>Overview</a>
            </div>

            <!-- callroom -->
           <a <?php echo $assoc_array_functions['call_room'] ?>>
               <img src="../assets/icons/account_tree-black-18dp.svg">
               <p>Call Room</p>
            </a>

            <!-- registration -->
           <a <?php echo $assoc_array_functions['registration'] ?>>
               <img src="../assets/icons/how_to_reg-black-18dp.svg">
               <p>Registration</p>
            </a>

            <!-- weapon control -->
            <a <?php echo $assoc_array_functions['weapon_control'] ?>>
                <img src="../assets/icons/weapon_control-black-18dp.svg">
                <p>Weapon Control</p>
            </a>

            <a <?php echo $assoc_array_functions['announcements'] ?>>
                <img src="../assets/icons/new_releases-black-18dp.svg">
                <p>Announcements</p>
            </a>

            <p id="setup_text" class="nav_bar_title">SETUP</p>

            <!-- general -->
            <button type="button" <?php echo $assoc_array_functions['general'] ?>>
                <img src="../assets/icons/widgets-black-18dp.svg">
                <p>General</p>
                <img src="../assets/icons/arrow_drop_down-black-18dp.svg" id="general_dropdown_icon" class="dropdown_icon">
            </button>

            <!-- general drop-down -->
            <div id="general_dropdown_menu" class="dropdown_menu hidden">
                <a <?php echo $assoc_array_functions['basic_info'] ?>>Basic Information</a>
                <a <?php echo $assoc_array_functions['info_for_fencers'] ?>>Information for fencers</a></li>
                <a <?php echo $assoc_array_functions['timetable'] ?>>Timetable</a>
                <a <?php echo $assoc_array_functions['invitation'] ?>>Invitation</a>
            </div>

            <!-- technical -->
            <button type="button" <?php echo $assoc_array_functions['technical'] ?>>
                <img src="../assets/icons/home_repair_service-black-18dp.svg">
                <p>Technical</p>
                <img src="../assets/icons/arrow_drop_down-black-18dp.svg" id="technical_dropdown_icon" class="dropdown_icon">
            </button>

            <!-- technical drop-down -->
            <div id="technical_dropdown_menu" class="dropdown_menu hidden">
                <a <?php echo $assoc_array_functions['technicians'] ?>>Technicians</a>
                <a <?php echo $assoc_array_functions['referees'] ?>>Referees</a>
                <a <?php echo $assoc_array_functions['pistes'] ?>>Pistes</a>
                <a <?php echo $assoc_array_functions['formula'] ?>>Formula</a>
            </div>

            <!-- ranking  -->
            <a <?php echo $assoc_array_functions['ranking'] ?>>
                <img src="../assets/icons/leaderboard-black-18dp.svg">
                <p>Ranking</p>
            </a>

            <!-- manage ebtries -->
            <a <?php echo $assoc_array_functions['manage_entries'] ?>>
                <img src="../assets/icons/all_inbox-black-18dp.svg">
                <p>Manage Entries</p>
            </a>

            <!-- ?help -->
            <a href="user_guide.php?comp_id=<?php echo $comp_id ?>" id="need_help">
                <img src="../assets/icons/help-black-18dp.svg">
                <p>Need help?</p>
            </a>
        </div>
    </div>
</div>