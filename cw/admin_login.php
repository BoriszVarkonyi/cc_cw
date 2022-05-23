<?php include "includes/db.php" ?>
<?php include "controllers/AdminController.php" ?>
<?php
    session_start();

    $adminController = new AdminController($connection);

    //register new admin
    if (isset($_POST['r_submit']) ) {
        $rpass = $_POST['r_pass'];
        $rpassa = $_POST['r_passa'];
        $rusername = $_POST['r_username'];

        if ($rpass != "" && $rpassa != "" && $rusername != "") {
            if ($rpassa == $rpass) {
                if (!$adminController->adminExists($rusername)) {
                    $pass_crypt = password_hash($rpass, PASSWORD_DEFAULT);

                    $qry_new_admin = "INSERT INTO `cw_admin` (`name`, `password`) VALUES ('$rusername', '$pass_crypt')";
                    $success = $adminController->insert($rusername, $pass_crypt);
                    if (!$success) {
                        $feedback = mysqli_error($connection);
                    } else {
                        $_SESSION['usernameblog'] = $rusername;
                        header('Location: ../cw/admin.php');
                    }
                } 
            } 
        }
    }

    //login existing admin
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['pass'];

        $admin = $adminController->getAdminByName($username);
        if($admin) {
            if (password_verify($password, $admin->Password)) {
                $_SESSION['usernameblog'] = $admin->Name;
                header('Location: ../cw/admin.php');
            } 
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/barebone_page_style.min.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="basic_panel">
        <h1>LOGIN</h1>
        <form id="login" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pass" placeholder="Password">
            <button type="submit" name="submit">Login<button>
        </form>

        <h1>REGISTER</h1>
        <form id="register" method="POST">
            <input type="text" name="r_username" placeholder="Username">
            <input type="password" name="r_pass" placeholder="Password">
            <input type="password" name="r_passa" placeholder="Confirm password">
            <button type="submit" name="r_submit">Register</button>
        </form>
    </div>
</body>
</html>
