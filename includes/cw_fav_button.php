<?php

    $cookie_name = "fav_comps";
    $expires = time() + 31556926;
    $comp_id = $_GET['comp_id'];
    $test = TRUE;
    $star = "../assets/icons/star_border-black-18dp.svg";

    if (isset($_COOKIE[$cookie_name])) {

        $value = $_COOKIE[$cookie_name];
        //$test = strpos($value, $comp_id);

        $array_value = explode(",", $value);
        $test = in_array($comp_id, $array_value);
        if ($test == FALSE) {
            $star = "../assets/icons/star_border-black-18dp.svg";
        } else {
            $star = "../assets/icons/star-black-18dp.svg"; 
        }

    } else {

        $value = "";

    }

    if (isset($_POST['submit_button'])) {
        
        if ($test == FALSE) {

            $newvalue = $value . $comp_id . ",";

        } else {

            unset($array_value[array_search($comp_id, $array_value)]);
            $array_value = array_values($array_value);
            
            if (count($array_value) == 1) {
                $newvalue = $array_value[0] . ",";
            } else {
                $newvalue = implode(",", $array_value);
            }
        }

        setcookie($cookie_name, $newvalue, $expires, "/");
    }
?>
