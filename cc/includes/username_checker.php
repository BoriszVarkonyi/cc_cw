<?php


    if (session_status() != 2) {
        session_start();
    }


    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        header("Location: ../index.php");
    }

?>
