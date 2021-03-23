<?php ob_start(); ?>
<?php include "../includes/functions.php" ?>
<?php include "db.php"; ?>
<?php include "username_checker.php"; ?>
<?php


$lastlogin = $_COOKIE["lastlogin"];
$comp_id = $_GET["comp_id"];


$query_comp = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
$check_comp_name_query = mysqli_query($connection, $query_comp);

if ($row = mysqli_fetch_assoc($check_comp_name_query)) {

    $comp_name = $row["comp_name"];
    $ass_tourn_id = $row["ass_tournament_id"];
}

if ($lastlogin == 1) {

    $query_org = "SELECT * FROM organisers WHERE username = '$username'";
    $check_org_query = mysqli_query($connection, $query_org);

    if ($row = mysqli_fetch_assoc($check_org_query)) {

        $id = $row['id'];
    }

    $role = "Organiser";
} else {

    $query_tech = "SELECT * FROM technicians WHERE username = '$username'";
    $check_comp_tech_query = mysqli_query($connection, $query_tech);

    if ($row = mysqli_fetch_assoc($check_comp_tech_query)) {

        $id = $row['id'];
        $tech_role = $row["role"];
    }

    $role = roleConverter($tech_role);
}

if (isset($_POST["logout"])) {

    session_destroy();

    header("Location: ../index.php");
}

?>

<header>
    <p id="app_name" class="closed">Competition Control <b>Alpha</b></p>
    <?php
    if (isset($_GET['comp_id'])) {
    ?>
        <!-- hamburger tab for navbar left -->
        <div id="menu_button_section" class="closed">
            <button type="button" onclick="toggle_nav_bar()" id="menu_button">
                <img src="../assets/icons/menu-black.svg"/>
            </button>
        </div>
        <div id="competition_select_wrapper">
            <div id="competition_select" onclick="toggleCompSelect()">
                <p><?php echo $comp_name ?></p>
                <div>
                    <img src="../assets/icons/arrow_drop_down-black.svg" id="">
                </div>
            </div>
            <div class="small_scroll">
                <p>TOURNAMENT'S PAGES</p>
                <button class="competition_button separate" onclick="location.href=''">Tournament's timetable</button>
                <button class="competition_button separate" onclick="location.href=''">Manage Weapon Control Bookings</button>
                <p>TOURNAMENT'S COMPETITIONS</p>
                <?php

                $get_comps_in_t = "SELECT * FROM competitions WHERE ass_tournament_id = $ass_tourn_id";
                $get_comps_in_t_do = mysqli_query($connection, $get_comps_in_t);

                while ($row = mysqli_fetch_assoc($get_comps_in_t_do)) {

                    $c_id = $row["comp_id"];
                    $c_name = $row["comp_name"];
                ?>
                    <button class="competition_button <?php if($c_id == $comp_id){echo "selected";} ?>" onclick="location.href='<?php echo $_SERVER['PHP_SELF'] . '?comp_id=' . $c_id ?>'"><?php echo $c_name ?></button>
                <?php } ?>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- colormode and language buttons -->
    <div class="settings_section">
        <button class="header_button" id="language_button" onclick="toggleLanguagePanel()">
            <img src="../assets/icons/language-black.svg"/>
        </button>
        <button class="header_button" id="colormode_button" onclick="toggleColormodePanel()">
            <img src="../assets/icons/color_lens-black.svg"/>
        </button>
    </div>

    <!-- language select drop-down -->
    <div id="language_panel" class="header_overlay_panel hidden">
        <div>
            <button id="close_lang_button" class="panel_button fixed" onclick="toggleLanguagePanel()">
                <img src="../assets/icons/close-black.svg"/>
            </button>
        </div>
        <div id="languages_wrapper">
            <button id="english" class="language_button selected">
                <img src="../assets/icons/english.svg" class="not_icon"/>
                <p>English</p>
            </button>
            <button id="russian" class="language_button" disabled>
                <img src="../assets/icons/russian.svg" class="not_icon"/>
                <p>Russian</p>
            </button>
            <button id="french" class="language_button" disabled>
                <img src="../assets/icons/french.svg" class="not_icon"/>
                <p>French</p>
            </button>
            <button id="japanese" class="language_button" disabled>
                <img src="../assets/icons/japanese.svg" class="not_icon"/>
                <p>Japanese</p>
            </button>
            <button id="korean" class="language_button" disabled>
                <img src="../assets/icons/korean.svg" class="not_icon"/>
                <p>Korean</p>
            </button>
            <button id="hungarian" class="language_button" disabled>
                <img src="../assets/icons/hungarian.svg" class="not_icon"/>
                <p>Hungarian</p>
            </button>
            <button id="romanian" class="language_button" disabled>
                <img src="../assets/icons/romanian.svg" class="not_icon"/>
                <p>Romanian</p>
            </button>
        </div>
    </div>

    <!-- colormode select drop-down -->
    <div id="colormode_panel" class="header_overlay_panel hidden">
        <button class="panel_button" onclick="toggleColormodePanel()">
            <img src="../assets/icons/close-black.svg"/>
        </button>
        <div class="color_mode_wrapper" id="color_mode_wrapper">
            <button class="color_mode" onclick="setToLight()">
                <div class="color_sample light">Aa</div>
                <p>Light</p>
            </button>
            <button class="color_mode" onclick="setToHighContrast()" disabled>
                <div class="color_sample high_contrast">Aa</div>
                <p>High Contrast</p>
            </button>
            <button class="color_mode" onclick="setToDark()" disabled>
                <div class="color_sample dark">Aa</div>
                <p>Dark</p>
            </button>
        </div>
        <div class="color_variations">
            <button class="color_square vanilla" onclick="setToVanilla()" name="vanilla"></button>
            <button class="color_square danube" onclick="setToDanube()" name="danube" disabled></button>
        </div>
    </div>

    <!-- profile pic -->
    <?php
    //profile pic if not set by user
    $profile_pic = "../assets/icons/profile_picture.svg";

    //test for uploaded profil pic
    if (file_exists("../profile_pics/$id.png")) {
        $profile_pic = "../profile_pics/$id.png";
    }

    ?>
    <img src="<?php echo $profile_pic ?>" id="profile_picture" onclick="toggleProfilePanel()" height="30" width="30"/>

    <!-- profile data -->
    <div class="identity_section" onclick="toggleProfilePanel()">
        <p id="username"><?php echo $username; ?></p>
        <p id="role"><?php echo $role; ?></p>
    </div>

    <!-- profile panel drop-down -->
    <div id="profile_panel" class="header_overlay_panel hidden">
        <a class="panel_button left" href="your_profile.php" target="_blank" aria-label="Check and edit your profile" name="Edit profile">
            <img src="../assets/icons/edit-black.svg"/>
        </a>
        <button class="panel_button" onclick="toggleProfilePanel()">
            <img src="../assets/icons/close-black.svg"/>
        </button>
        <img src="<?php echo $profile_pic ?>" class="profile_picture_big" height="55" width="55">
        <p class="username_big"><?php echo $username; ?></p>
        <p class="role_big"><?php echo $role; ?></p>
        <form action="" method="POST" id="logout_form">
            <button type="submit" name="logout" class="logout_button">Log out</button>
        </form>
    </div>
</header>
<div id="loading_bar"></div>