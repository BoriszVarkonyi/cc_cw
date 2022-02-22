<?php
    $WHERE_CLAUSE = "WHERE `comp_status` > 0";

    if(isset($_GET['type'])) {
        if($type != 0)
            $WHERE_CLAUSE = "WHERE `comp_status` = '$type' ";
    }
    if(isset($_GET['q'])) {
        $WHERE_CLAUSE .= " AND `comp_name` LIKE '%$q%'";
    }
    if(isset($_GET['year'])) {
        if($yearInput != "Every") {
            $WHERE_CLAUSE .= " AND year(comp_start) = $yearInput";
        }
    }
    if(isset($_GET['sex'])) {
        if($sex != "Both") {
            if($sex == "Male")
                $WHERE_CLAUSE .= " AND comp_sex = 1";
            else
                $WHERE_CLAUSE .= " AND comp_sex = 2";
        }
    }
    if(isset($_GET['weapon'])) {
        if($weapon != "All") {
            if($weapon == "Epee")
                $WHERE_CLAUSE .= " AND comp_weapon = 1";
            if($weapon == "Foil")
                $WHERE_CLAUSE .= " AND comp_weapon = 2";
            if($weapon == "Sabre")
                $WHERE_CLAUSE .= " AND comp_weapon = 3";
        }
    }
?>