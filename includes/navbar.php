<?php include "compid.php" ?>
<?php include "db.php" ?>
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
                <img src="../assets/icons/dashboard-black-18dp.svg" alt="">
                <p>Dashboard</p>
            </a>

            <p id="controls_text" class="nav_bar_title">CONTROLS</p>
            <!-- DT -->
            <button type="button" onclick="toggle_dt_dropdown()" class="nav_bar_item disabled">
                <img src="../assets/icons/list_alt-black-18dp.svg" alt="">
                <p>DT</p>
                <img src="../assets/icons/arrow_drop_down-black-18dp.svg" alt="" id="dt_dropdown_icon" class="dropdown_icon">
            </button>

            <!-- DT drop-down -->
            <div id="dt_dropdown_menu" class="dropdown_menu hidden">
                <a href="">Competitiors</a>
                <a href="">Pools</a>
                <a href="">Table</a>
                <a href="">Overview</a>
            </div>

            <!-- callroom -->
           <a href="call_room.php" class="nav_bar_item">
               <img src="../assets/icons/account_tree-black-18dp.svg" alt="">
               <p>Call Room</p>
            </a>

            <!-- registration -->
           <a href="registration.php" class="nav_bar_item disabled">
               <img src="../assets/icons/how_to_reg-black-18dp.svg" alt="">
               <p>Registration</p>
            </a>

            <!-- weapon control -->
            <a href="weapon_control.php?comp_id=<?php echo $comp_id ?>" class="nav_bar_item">
                <img src="../assets/icons/weapon_control-black-18dp.svg" alt="">
                <p>Weapon Control</p>
            </a>

            <p id="setup_text" class="nav_bar_title">SETUP</p>

            <!-- general -->
            <button type="button" onclick="toggle_general_dropdown()" class="nav_bar_item">
                <img src="../assets/icons/widgets-black-18dp.svg" alt="">
                <p>General</p>
                <img src="../assets/icons/arrow_drop_down-black-18dp.svg" alt="" id="general_dropdown_icon" class="dropdown_icon">
            </button>

            <!-- general drop-down -->
            <div id="general_dropdown_menu" class="dropdown_menu hidden">
                <a href="basic_information.php?comp_id=<?php echo $comp_id ?>">Basic Information</a>
                <a href="information_for_fencers.php?comp_id=<?php echo $comp_id; ?>">Information for fencers</a></li>
                <a href="timetable.php?comp_id=<?php echo $comp_id; ?>">Timetable</a>
                <a href="invitation.php?comp_id=<?php echo $comp_id; ?>">Invitation</a>
            </div>

            <!-- technical -->
            <button type="button" onclick="toggle_technical_dropdown()" class="nav_bar_item">
                <img src="../assets/icons/home_repair_service-black-18dp.svg" alt="">
                <p>Technical</p>
                <img src="../assets/icons/arrow_drop_down-black-18dp.svg" alt="" id="technical_dropdown_icon" class="dropdown_icon">
            </button>

            <!-- technical drop-down -->
            <div id="technical_dropdown_menu" class="dropdown_menu hidden">
                <a href="technicians.php?comp_id=<?php echo $comp_id ?>" class="disabled">Technicians</a>
                <a href="referees.php?comp_id=<?php echo $comp_id ?>">Referees</a>
                <a href="pistes.php?comp_id=<?php echo $comp_id ?>">Pistes</a>
                <a href="">Formula</a>
            </div>

            <!-- ranking  -->
            <a href="choose_ranking.php?comp_id=<?php echo $comp_id ?>" class="nav_bar_item setup">
                <img src="../assets/icons/leaderboard-black-18dp.svg" alt="">
                <p>Ranking</p>
            </a>

            <!-- manage ebtries -->
            <a href="manage_entries.php?comp_id=<?php echo $comp_id ?>" class="nav_bar_item">
                <img src="../assets/icons/all_inbox-black-18dp.svg" alt="">
                <p>Manage Entries</p>
            </a>

            <!-- ?help -->
            <a href="" id="need_help">
                <img src="../assets/icons/help-black-18dp.svg" alt="">
                <p>Need help?</p>
            </a>
        </div>
    </div>
</div>