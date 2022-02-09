<?php include "db.php"; ?>
<?php ob_start(); ?>

<?php



if (isset($_SESSION)) {
    session_destroy();
}
if (isset($_POST["submit"])) {

    $user_error = "";
    $pass_error = "";
    $role_error = "";

    $choose = $_POST["role"];

    if (!$choose) {

        header("Location: index.php?roleerror=3");
    }


    if ($choose == 1) { // organiser

        $username = $_POST["username"];
        $password = $_POST["password"];


        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);


        $query = "SELECT * FROM organisers WHERE username = '$username'";
        $select_organisers_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_organisers_query)) {

            $db_id = $row["id"];
            $db_user = $row["username"];
            $db_pass = $row["password"];
        }


        if ($username != "" && $password != "") {

            if ($username == $db_user && password_verify($password, $db_pass)) {

                setcookie("org_id", $db_id, time() + 31536000);
                setcookie("lastlogin", 1, time() + 31536000);
                setcookie("year", date("Y"), time() + 31556926);
                setcookie("month", date("m"), time() + 31556926);

                session_start();
                $_SESSION['username'] = $db_user;
                $_SESSION['role'] = "organisers";
                header("Location: cc/choose_tournament.php");
            } else {

                header("Location: index.php?loginerror=4");
            }
        } else {
            $errors = $user_error . $pass_error;
            header("Location: index.php?$errors");
        }
    } elseif ($choose == 2) { //technician

        $db_user = "";
        $db_pass = "";

        $username = $_POST["username"];
        $password = $_POST["password"];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query_get_comp_ids = "SELECT * FROM competitions";
        $do_get_comp_ids = mysqli_query($connection, $query_get_comp_ids);

        $comp_ids[] = array();
        $feedback[] = array();
        $where = "";
        while ($row = mysqli_fetch_assoc($do_get_comp_ids)) {
            array_push($comp_ids, $row['comp_id']);
        }

        foreach ($comp_ids as $value) {

            $table_name = "tech_" . $value;

            $query = "SELECT * FROM `$table_name` WHERE `name` = '$username'";
            $select_technicians_query = mysqli_query($connection, $query);


            if ($row = mysqli_fetch_assoc($select_technicians_query)) {

                $db_id = $row["id"];
                $db_pass = $row["pass"];
                $role = $row['role'];
                $where .= $value . "_";
                array_push($feedback, "ok!");
            } else {
                array_push($feedback, mysqli_error($connection) . "aight but nope");
            }
        }



        if ($username != "") {

            if ($password != "") {

                if ($username == $db_user && password_verify($password, $db_pass)) {

                    setcookie("tech_id", $db_id, time() + 31536000);
                    setcookie("lastlogin", 2, time() + 31536000);
                    setcookie("year", date("Y"), time() + 31556926);
                    setcookie("month", date("m"), time() + 31556926);

                    session_start();
                    $_SESSION['username'] = $db_user;
                    header("Location: cc/choose_competition.php");
                } else {

                    header("Location: index.php?loginerror=4");
                }
            } else {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = "technicians";
                header("Location: cc/set_new_pass_first.php?where=$where");
            }
        } else {
            $errors = $user_error . $pass_error;
            header("Location: index.php?$errors");
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
    <link rel="stylesheet" href="css/mainstyle.min.css">
    <link rel="stylesheet" href="css/login_style.min.css">
</head>
<body class="fencers">
    <div id="login_panel">
        <div id="title_stripe">
            <p class="page_title">Login</p>
        </div>
        <div id="panel_main">
            <!-- login form -->
            <form action="index.php" method="POST" autocomplete="off" class="overlay_panel_form <?php if ($_GET["loginerror"] == 4) {
                    echo "error";
                } ?>">
                <label for="username">LOGIN ID</label>
                <input type="text" placeholder="Type in your username" name="username" class="username_input" onblur="errorChecker(this)">

                <label for="password">PASSWORD</label>
                <input type="password" placeholder="Type in your password" name="password" class="password_input" onblur="errorChecker(this)">

                <label>ROLE</label>
                <div class="option_container">
                    <input type="radio" name="role" id="a" value="1"/>
                    <label for="a">I am an organiser</label>
                    <input type="radio" name="role" id="b" value="2"/>
                    <label for="b">I am a technician</label>
                    <input type="radio" name="role" id="c" value="3"/>
                    <label for="c">I am a referee</label>
                </div>
                <input type="submit" name="submit" value="Login" class="login_button">
            </form>
        </div>
    </div>
    <div id="login_links_wrapper">
        <div class="login_link_wrapper">
            <button class="login_link_button" onclick="window.location.href='https://www.youtube.com/watch?v=dQw4w9WgXcQ'">News and updates</button>
        </div>
        <div class="login_link_wrapper">
            <button class="login_link_button" onclick="toggleOtherApps(this)">Other Applications</button>
            <div class="login_link_dropdown">
                <p>For Organisers</p>
                <a href="">CC Wheelchair</a>
                <p>For Federations</p>
                <a href="../cw/index.php">Competition View</a>
            </div>
        </div>
    </div>

    <!--
    <div id="apps">
        <div class="app_wrapper current" onclick="chooseApp(this)">
            <p>Competition Control</p>
        </div>
        <div class="app_wrapper" onclick="chooseApp(this)">
            <p>Competition Control Wheelchair</p>
            <button>OPEN</button>
        </div>
    </div>
     -->


    <p id="copyright_text">Competition Control &copy; Pre-Alpha</p>
    <script src="/js/login.js"></script>
</body>
</html>