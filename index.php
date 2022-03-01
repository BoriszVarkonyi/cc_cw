<?php include "db.php"; ?>
<?php ob_start(); ?>

<?php

session_start();
if(isset($_SESSION["login_error"]) && $_SESSION["login_error"] == true) {
    $login_error = true;
}

session_destroy();
session_start();

if (isset($_POST["submit"])) {

    $user_error = "";
    $pass_error = "";
    $role_error = "";

    $choose = filter_input(INPUT_POST, "role");

    if (!$choose) {
        header("Location: index.php?roleerror=3");
    }

    $username = filter_input(INPUT_POST, "username");

    if(!$username || $username == "") {
        $_SESSION["login_error"] = true;
        header("Location: index.php");
    }

    $password = filter_input(INPUT_POST, "password");

    if(!$password || $password == "") {
        $_SESSION["login_error"] = true;
        header("Location: index.php");
    }

    switch($choose) {
        case 1:
            $query = "SELECT * FROM organisers WHERE username = '$username'";
            break;
        case 2:
            $query = "SELECT * FROM technicians WHERE username = '$username'";
            break;
        case 3:
            //Implement for your own sanity
            header("Location: index.php");
            break;
    }

    $do_get_data = mysqli_query($connection, $query);
    if($do_get_data) {
        $row = mysqli_fetch_assoc($do_get_data);
    } else {
        $_SESSION["login_error"] = true;
        header("Location: index.php");
    }
    if(password_verify($password, $row["password"])) {
        setcookie("org_id", $row["id"], time() + 31536000);
        setcookie("year", date("Y"), time() + 31556926);
        setcookie("month", date("m"), time() + 31556926);

        session_start();
        $_SESSION['username'] = $username;

        if($choose == 1) {
            $_SESSION['role'] = "organisers";
            header("Location: cc/choose_tournament.php");
            setcookie("lastlogin", 1, time() + 31536000);
        } else if($choose == 2) {
            $_SESSION['role'] = "technicians";
            setcookie("lastlogin", 2, time() + 31536000);
            //redirect to technician page
        } else if($choose == 3) {
            //TODO
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-content-theme="danube">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC Login</title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="images/ico"/>
    <link rel="stylesheet" href="css/basestyle.min.css">
    <link rel="stylesheet" href="css/login_style.min.css">
    <meta name="description" content="Login page d'Artagnan. Create and Control Fencing Competitions with ease using d'Artagnan">
</head>
<body class="fencers">
    <div id="login_panel">
        <div id="title_stripe">
            <p class="page_title">Login</p>
        </div>
        <div id="panel_main">
            <!-- login form -->
            <form action="index.php" method="POST" autocomplete="off" class="overlay_panel_form <?php if(isset($login_error)) echo "error"; ?>">
                <label for="username">LOGIN ID</label>
                <input type="text" placeholder="Type in your username" name="username" class="username_input" onblur="errorChecker(this)">

                <label for="password">PASSWORD</label>
                <input type="password" placeholder="Type in your password" name="password" class="password_input" onblur="errorChecker(this)">

                <label>ROLE</label>
                <div class="option_container">
                    <input type="radio" name="role" id="a" value="1"/>
                    <label for="a">I am an organiser</label>
                    <input type="radio" name="role" id="b" value="2"/>
                    <label for="b">I am a staff member</label>
                    <input type="radio" name="role" id="c" value="3"/>
                    <label for="c">I am a referee</label>
                    <input type="radio" name="role" id="d" value="4"/>
                    <label for="d">I am a doctor</label>
                    <input type="radio" name="role" id="e" value="5"/>
                    <label for="e">I am a piste technician</label>
                </div>
                <input type="submit" name="submit" value="Login" id="login_button">
            </form>
        </div>
    </div>
    <p id="copyright_text">d'Artagnan &copy; Pre-Alpha</p>
    <script src="../CC/javascript/login.js"></script>
</body>
</html>