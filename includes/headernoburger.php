<?php ob_start(); ?>
<?php include "db.php"; ?>
<?php

$test = date("m");
$test1 = date("Y");

if(strlen($test, 1) == 0){

    $testuse = ltrim($test, $test[0]);

}else{
    
    $testuse = $test;

}

$lastlogin = $_COOKIE["lastlogin"];

if($lastlogin == 1){
    $org_id = $_COOKIE["org_id"];
}
else{
    $tech_id = $_COOKIE["tech_id"];
}

setcookie("year",$test1,time()+31556926);
setcookie("month",$test,time()+31556926);


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
        
        <!-- header title left -->
        <p id="app_name">Competition Control Alpha</p>
        
        <!-- colormode and language buttons -->
        <section class="settings_section">
            <button class="hb_button" id="language_button" onclick="toggle_language_panel()">
                <img src="../assets/icons/language-black-18dp.svg" alt="">
            </button>
            <button class="hb_button" id="colormode_button" onclick="toggle_colormode_panel()">
                <img src="../assets/icons/color_lens-black-18dp.svg" alt="">
            </button>
        </section>

        <!-- language select drop-down -->
        <div id="language_panel" class="small_overlay_panel hidden">
            <div class="close_button_wrapper">
                <button id="close_lang_button" class="round_button" onclick="toggle_language_panel()">
                    <img src="../assets/icons/close-black-18dp.svg" alt="">
                </button>  
            </div>
            <div id="languages_wrapper">  
                <button id="language_english" class="language_button selected">
                    <img src="../assets/icons/english.svg" alt="" class="not_icon">
                    <p class="language_label">English</p>  
                </button>
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/russian.svg" alt="" class="not_icon">
                    <p class="language_label">Russian</p>  
                </button>
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/french.svg" alt="" class="not_icon">
                    <p class="language_label">French</p>  
                </button>
                <button id="language_english" class="language_button">
                    <img src="../assets/icons/japanese.svg" alt="" class="not_icon">
                    <p class="language_label">Japanese</p>  
                </button> 
                <button id="language_english" class="language_button" class="not_icon">
                    <img src="../assets/icons/korean.svg" alt="">
                    <p class="language_label">Korean</p>  
                </button>  
                <button id="language_english" class="language_button" class="not_icon">
                    <img src="../assets/icons/hungarian.svg" alt="">
                    <p class="language_label">Hungarian</p>  
                </button>  
                <button id="language_english" class="language_button" class="not_icon">
                    <img src="../assets/icons/romanian.svg" alt="">
                    <p class="language_label">Romanian</p>  
                </button>
            </div>
        </div>

        <!-- colormode select drop-down -->
        <div id="colormode_panel" class="small_overlay_panel hidden">
            <button id="close_button" class="round_button" onclick="toggle_colormode_panel()">
                <img src="../assets/icons/close-black-18dp.svg" alt="">
            </button>
            <input type="range" id="cs_range" value="1" min="1" max="3">
            <section class="cs_label_section">
                <p>Light</p>
                <p>High Contrast</p>
                <p>Dark</p>
            </section>
        </div>
        
        <!-- profile pic -->
        <img src="https://thispersondoesnotexist.com/image" alt="profile picture" id="profile_picture" onclick="toggle_profile_panel()">
        
        <!-- profile data -->
        <section class="identity_section">
            <p id="username"><?php echo $name; ?></p>
            <p id="role"><?php echo $role; ?></p>
        </section>

        <!-- profile panel drop-down -->
        <div id="profile_panel" class="small_overlay_panel hidden">
            <button id="close_button" class="round_button" onclick="toggle_profile_panel()">
                <img src="../assets/icons/close-black-18dp.svg" alt="">
            </button>
            <button id="edit_button" class="round_button" onclick="">
                <img src="../assets/icons/edit-black-18dp.svg" alt="">
            </button>
            <img src="https://thispersondoesnotexist.com/image" class="profile_picture_big">
            <p class="username_big"><?php echo $name; ?></p>
            <p class="role_big"><?php echo $role; ?></p>
            <form action="" method="POST" id="logout_form">
            <button type="submit" name="logout" class="logout_button" form="logout_form">Log out</button>
            </form>
        </div>
    </div>
</header>