<?php include "db.php" ?>
<?php include "../includes/functions.php" ?>
<?php
    session_start();
    $feedback = "";

    //create admin table
    $qry_table = "CREATE TABLE `ccdatabase`.`cw_admin` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_table = mysqli_query($connection, $qry_table);

    //register new admin
    if (isset($_POST['r_submit']) ) {
        $rpass = $_POST['r_pass'];
        $rpassa = $_POST['r_passa'];
        $rusername = $_POST['r_username'];

        if ($rpass != "" && $rpassa != "" && $rusername != "") {
            if ($rpassa == $rpass) {
                $qry_name_test = "SELECT * FROM `cw_admin` WHERE name = '$rusername'";
                $do_name_test = mysqli_query($connection, $qry_name_test);
                $row_num = mysqli_num_rows($do_name_test);

                if ($row_num == 0) {
                    $pass_crypt = password_hash($rpass, PASSWORD_DEFAULT);

                    $qry_new_admin = "INSERT INTO `cw_admin` (`name`, `password`) VALUES ('$rusername', '$pass_crypt')";
                    if (!$do_new_admin = mysqli_query($connection, $qry_new_admin)) {
                        $feedback = mysqli_error($connection);
                    } else {
                        $_SESSION['usernameblog'] = $rusername;
                        header('Location: ../cw/admin.php');
                    }
                } else {
                    $feedback = 3;
                }

            } else {
                $feedback = 2;
            }
        } else {
            $feedback = 1;
        }
    }

    //login existing admin
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['pass'];

        $qry_get_pass = "SELECT `password` FROM cw_admin WHERE name = '$username'";
        $do_get_pass = mysqli_query($connection, $qry_get_pass);
        if ($row = mysqli_fetch_assoc($do_get_pass)) {
            $pass_crypt = $row['password'];
            if (password_verify($password, $pass_crypt)) {
                $feedback = "ok!";
                $_SESSION['usernameblog'] = $username;

                header('Location: ../cw/admin.php');
            } else {
                $feedback = "error with password or username!";
            }
        } else {
            $feedback = "ERROR " . mysqli_error($connection);
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_barebone_page_style.min.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="basic_panel">
        <h1>LOGIN</h1>
        <?php $feedback ?>
        <form id="login" method="POST">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="pass" placeholder="password">
            <button type="submit" name="submit">Login<button>
        </form>

        <h1>REGISTER</h1>
        <form id="login" method="POST">
            <input type="text" name="r_username" placeholder="username">
            <input type="password" name="r_pass" placeholder="password">
            <input type="password" name="r_passa" placeholder="password again">
            <button type="submit" name="r_submit">Register</button>
        </form>
    </div>
</body>
</html>
