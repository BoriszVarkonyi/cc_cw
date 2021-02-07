<?php
    session_start();

    if (isset($_SESSION['usernameblog'])) {
        $username = $_SESSION['usernameblog'];
    } else {
        header('Location: ../cw/admin_login.php');
    }
?>
