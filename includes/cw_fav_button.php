<?php

    $cookie_expires = time() + 31556926;
    $cookie_name = "fav_comp";

    //get comp_id
    if (isset($_GET['comp_id'])) {
        $comp_id = $_GET['comp_id'];

        if (isset($_COOKIE[$cookie_name])) {
            $cookie_value = $_COOKIE[$cookie_name];
        } else {
            $cookie_value = "%";
        }

        $contains = strrpos($cookie_value, $comp_id . "%");

        if ($contains != FALSE) {
            $contains = TRUE;
        }

        if ($contains) {
            $star = "../assets/icons/star_black.svg";
        } else {
            $star = "../assets/icons/star_border_black.svg";
        }
    }

    if (isset($_POST['submit_button'])) {

        if ($contains) {
            $cookie_value = str_replace($comp_id . "%", "", $cookie_value);
        } else {
            $cookie_value = $cookie_value . $comp_id . "%";
        }

        setcookie($cookie_name, $cookie_value, $cookie_expires, "/");
        header("Refresh:0");
    }
?>
