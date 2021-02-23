<?php include "includes\db.php"; ?>
<?php ob_start(); ?>

<?php



if (isset($_SESSION)) {
    session_destroy();
}
if (isset($_POST["submit"])) {

    $user_error = "";
    $pass_error = "";
    $role_error = "";

    $test = date("m");
    $test1 = date("Y");

    if (strlen($test, 1) == 0) {

        $testuse = ltrim($test, $test[0]);
    } else {

        $testuse = $test;
    }

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
                setcookie("year", $test1, time() + 31556926);
                setcookie("month", $test, time() + 31556926);

                session_start();
                $_SESSION['username'] = $db_user;
                $_SESSION['role'] = "organisers";
                header("Location: php/choose_tournament.php");
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
                    setcookie("year", $test1, time() + 31556926);
                    setcookie("month", $test, time() + 31556926);

                    session_start();
                    $_SESSION['username'] = $db_user;
                    header("Location: php/choose_competition.php");
                } else {

                    header("Location: index.php?loginerror=4");
                }
            } else {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = "technicians";
                header("Location: php/set_new_pass_first.php?where=$where");
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
    <link rel="stylesheet" href="/css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>

<body class="bg_fencers">
    <div id="login_panel" class="panel">
        <div id="title_stripe">
            <div class="stripe_section">
                <p class="page_title">Login</p>
            </div>
        </div>
        <div id="panel_main" class="no_padding">
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
                </div>
                <input type="submit" name="submit" value="Login" class="login_button">
            </form>
        </div>
    </div>
    <div id="login_links_wrapper">
        <div id="program_news">
            <a type="button" class="other_apps_button">News and updates</a>
        </div>
        <div id="other_apps">
            <button type="button" class="other_apps_button" onclick="toggleOtherApps()">Other Applications</button>
            <div id="other_apps_dropdown">
                <p>For Organisers</p>
                <a href="">CC Wheelchair</a>
                <p>For Federations</p>
                <a href="">Competition View</a>
            </div>
        </div>
    </div>

    <div id="apps">
        <div>
            <input type="radio" name="app" id="cc" value="cc" checked />
            <label for="cc">Competition Control</label>
        </div>

        <div>
            <input type="radio" name="app" id="ccw" value="ccw"/>
            <label for="ccw" other>Competition Control Wheelchair</label>
            <button>OPEN</button>
        </div>
    </div>

    <p id="copyright_text">Competition Control &copy; Pre-Alpha</p>
    <script src="/js/login.js"></script>
</body>

</html>