<?php ob_start(); ?>
<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php

$lastlogin = $_COOKIE["lastlogin"];
$comp_id = $_GET["comp_id"];


$query_comp = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
$check_comp_name_query = mysqli_query($connection, $query_comp);

if($row = mysqli_fetch_assoc($check_comp_name_query)){

    $comp_name = $row["comp_name"];
    
}



if($lastlogin == 1){
    $org_id = $_COOKIE["org_id"];
}
else{
    $tech_id = $_COOKIE["tech_id"];
}


if($lastlogin == 1){

    $query_org = "SELECT * FROM organisers WHERE id = '$org_id'";
    $check_org_query = mysqli_query($connection, $query_org);

    if($row = mysqli_fetch_assoc($check_org_query)){

        $name = $row["username"];
        
    }

    $role = "Organiser";

}
else{

    $query_tech = "SELECT * FROM technicians WHERE id = '$tech_id'";
    $check_comp_tech_query = mysqli_query($connection, $query_tech);
    
    if($row = mysqli_fetch_assoc($check_comp_tech_query)){
    
        $name = $row["username"];
        $tech_role = $row["role"];
        
    }

    $role = roleConverter($tech_role);

}

if(isset($_POST["logout"])) {

$_COOKIE["org_id"] = NULL;
$_COOKIE["tech_id"] = NULL;

header("Location: ../index.php");

}

?>

<header>
    <div id="header_bar">
        <p id="app_name">Competition Control Alpha</p>

        <!-- hamburger tab for navbar left -->
        <div id="menu_button_section">
            <button type="button" onclick="toggle_nav_bar()" id="menu_button">
                <img src="../assets/icons/menu-black-18dp.svg" >
            </button>
        </div>
        
        <!-- colormode and language buttons -->
        <div class="settings_section">
            <button class="hb_button" id="language_button" onclick="toggle_language_panel()">
                <img src="../assets/icons/language-black-18dp.svg" >
            </button>
            <button class="hb_button" id="colormode_button" onclick="toggle_colormode_panel()">
                <img src="../assets/icons/color_lens-black-18dp.svg" >
            </button>
        </div>
        
        <!-- language select drop-down -->
        <div id="language_panel" class="small overlay_panel hidden">

            <div id="languages_wrapper">  
                <button id="close_lang_button" class="panel_button fixed" onclick="toggle_language_panel()">
                    <img src="../assets/icons/close-black-18dp.svg" >
                </button>
                <button id="language_english" class="language_button selected">
                    <img src="../assets/icons/english.svg"  class="not_icon">
                    <p class="language_label">English</p>  
                </button>
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/russian.svg"  class="not_icon">
                    <p class="language_label">Russian</p>  
                </button>
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/french.svg"  class="not_icon">
                    <p class="language_label">French</p>  
                </button>
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/japanese.svg"  class="not_icon">
                    <p class="language_label">Japanese</p>  
                </button> 
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/korean.svg" class="not_icon">
                    <p class="language_label">Korean</p>  
                </button>  
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/hungarian.svg" class="not_icon">
                    <p class="language_label">Hungarian</p>  
                </button>  
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/romanian.svg" class="not_icon">
                    <p class="language_label">Romanian</p>  
                </button>
            </div>
        </div>

        <!-- colormode select drop-down -->
        <div id="colormode_panel" class="small overlay_panel hidden">
            <button class="panel_button" onclick="toggle_colormode_panel()">
                <img src="../assets/icons/close-black-18dp.svg" >
            </button>
            <input type="range" id="cs_range" value="1" min="1" max="3">
            <div class="cs_label_section">
                <p>Light</p>
                <p>High Contrast</p>
                <p>Dark</p>
            </div>
        </div>

        <!-- profile pic -->
        <img src="https://thispersondoesnotexist.com/image" alt="profile picture" id="profile_picture" onclick="toggle_profile_panel()">
        
        <!-- profile data -->
        <div class="identity_section">
            <p id="username"><?php echo $name; ?></p>
            <p id="role"><?php echo $role; ?></p>
        </div>

        <!-- profile panel drop-down -->
        <div id="profile_panel" class="small overlay_panel hidden">
            <button class="panel_button" onclick="toggle_profile_panel()">
                <img src="../assets/icons/close-black-18dp.svg" >
            </button>
            <button class="panel_button left" onclick="">
                <img src="../assets/icons/edit-black-18dp.svg" >
            </button>
            <img src="https://thispersondoesnotexist.com/image" class="profile_picture_big">
            <p class="username_big"><?php echo $name; ?></p>
            <p class="role_big"><?php echo $role; ?></p>
            <form action="" method="POST" id="logout_form">
                <button type="submit" name="logout" class="logout_button">Log out</button>
            </form>
        </div>
    </div>
</header>
-->