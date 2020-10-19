<?php

    $cookie_name = "fav_comps";
    $expires = time() + 31556926;
    $comp_id;
    $test = TRUE;
    $star = "../assets/icons/star_border-black-18dp.svg";

    if (isset($_COOKIE[$cookie_name])) {

        $value = $_COOKIE[$cookie_name];
        $test = strpos($value, $comp_id);

        if ($test != FALSE) {
            $star = "../assets/icons/star_border-black-18dp.svg";
        } else {
            $star = "../assets/icons/star-black-18dp.svg"; 
        }

    } else {

        $value = "";

    }

    if (isset($_POST['submit_button'])) {

        if ($test != FALSE) {

            $newvalue .= $value . $comp_id . ",";

            setcookie($cookie_name, $newvalue, $expires);

        } else {

            $newvalue = preg_replace($comp_id . ",", "", $value);

            setcookie($cookie_name, $newvalue, $expires);

        }
    }
?>
