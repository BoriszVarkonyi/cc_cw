<?php include "includes\db.php"; ?>
<?php ob_start(); ?>

<?php

if (isset($_POST["submit"])) {

    $user_error = "";
    $pass_error = "";
    $role_error = "";

    $test = date("m");
    $test1 = date("Y");

if(strlen($test, 1) == 0){

    $testuse = ltrim($test, $test[0]);

}else{
    
    $testuse = $test;

}

    $choose = $_POST["role"];

    if(!$choose) {

        header("Location: index.php?roleerror=3");

    }


    if($choose == 1){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $hashFormat = "$2y$10$";

        $salt = "passwordencryptionform";

        $hashF_and_salt = $hashFormat . $salt;

        $encrypt_password = crypt($password, $hashF_and_salt);

        $query = "SELECT * FROM organisers WHERE username = '$username'";
        $select_organisers_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_organisers_query)) {

        $db_id = $row["id"];
        $db_user = $row["username"];
        $db_pass = $row["password"];

        }


    if($username != "" && $password != ""){

        if($username == $db_user && $password == $db_pass) {

            setcookie("org_id", $db_id, time() + 31536000);
            setcookie("lastlogin", 1, time() + 31536000);
            setcookie("year",$test1,time()+31556926);
            setcookie("month",$test,time()+31556926);

            header("Location: php/choose_competition.php");

        }
        else{

            header("Location: index.php?loginerror=4");

        }
    }
    else{
        if(!$username){

            $user_error = "usererror=1&";
    
        }
        else{
            $user_error = "";
        }
        if(!$password){
    
            $pass_error = "passerror=2&";
    
        }
        else{
            $pass_error = "";
        }
        $errors = $user_error . $pass_error;
        header("Location: index.php?$errors");
    }

}
elseif ($choose == 2) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM technicians WHERE username = '$username'";
        $select_technicians_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_technicians_query)) {

        $db_id = $row["id"];
        $db_user = $row["username"];
        $db_pass = $row["password"];
        $ass_comp_id = $row["ass_comp_id"];

        }


    if($username != "" && $password != ""){

        if($username == $db_user && $password == $db_pass) {

            setcookie("tech_id", $db_id, time() + 31536000);
            setcookie("lastlogin", 2, time() + 31536000);
            setcookie("year",$test1,time()+31556926);
            setcookie("month",$test,time()+31556926);

            header("Location: php/choose_competition.php");

        }
        else{

            header("Location: index.php?loginerror=4");

        }

    }
    else{
        if(!$username){

            $user_error = "usererror=1&";
    
        }
        else{
            $user_error = "";
        }
        if(!$password){
    
            $pass_error = "passerror=2&";
    
        }
        else{
            $pass_error = "";
        }
        $errors = $user_error . $pass_error;
        header("Location: index.php?$errors");
    }


}
}
print_r($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC Login</title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="images/ico"/>
    <link rel="stylesheet" href="/css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body id="illustration_bg">
    <div id="login_panel" class="panel">
        <div id="title_stripe"><section class="stripe_section"><p class="page_title">Login</p></section></div>
        <div id="panel_main">


        <?php 
                    
                    if(in_array(4, $_GET)) {

                        echo '<p class="error_text bold">Incorrect username or password</p>';

                    }
                    
                    ?>


            <div class="form_wrapper">

            <!-- login form -->
               <form action="index.php" method="POST">
                    <label for="username" class="label_text">LOGIN ID</label></br>
                    <input type="text" placeholder="Type in your username" id="username_input" name="username"<?php 
                    
                    if(in_array(1, $_GET)) {

                        echo 'class="error"';

                    }
                    
                    ?>><br>
                    <?php 
                    
                    if(in_array(1, $_GET)) {

                        echo '<p class="error_text">Please fill in username field</p>';

                    }
                    
                    ?>
                     <!-- appear when problem with error class on the affected input-->
                <!--    <p class="error_text">Problem desc 2</p>
                    <p class="error_text">Problem desc 3</p> -->
                    <label for="password"class="label_text">PASSWORD</label></br>
                    <input type="password" placeholder="Type in your password" id="password_input" name="password"<?php 
                    
                    if(in_array(2, $_GET)) {

                        echo 'class="error"';

                    }
                    
                    ?>><br>
                    <?php 
                    
                    if(in_array(2, $_GET)) {

                        echo '<p class="error_text">Please fill in password field</p>';

                    }
                    
                    ?>
                   <div class="option_container login_option">
                          <input type="radio" name="role" id="a" value="1"/>
                          <label for="a">I am an organiser</label>

                          <input type="radio" name="role" id="b" value="2"/>
                          <label for="b">I am a technician</label>
                    </div> 
                    <?php 
                    
                    if(in_array(3, $_GET)) {

                        echo '<p class="error_text_option">Please choose a role</p>';

                    }
                    
                    ?>
                    <input type="submit" name="submit" value="Login">
                </form>
                <!-- login form end -->


            </div>
        </div>
        <div id="panel_footer"></div>
    </div>
    <div id="other_apps" class="">
        <button type="button" class="other_apps_button" onclick="toggleOtherApps()">Other Applications</button>
        <div id="other_apps_dropdown">
            <p>For Organisers</p>
            <a href="">CC Wheelchair</a>
            <p>For Federations</p>
            <a href="">CC FC</a>
        </div>
    </div>
    <p id="copyright_text">Competition Control &copy; v1.0</p>
    <script src="/js/login.js"></script>
</body>
</html>