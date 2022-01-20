<?php
    $WHERE_CLAUSE = "WHERE `comp_status` = '$statusofpage' ";

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

    /*
    if (isset($_POST['submit_search'])) {

        $year = $_POST['year'];
        $weapont_type = $_POST['wt'];
        $sex = $_POST['sex'];
        $name = $_POST['name'];

        if ($name != "") {
            $WHERE_CLAUSE .= " AND `comp_name` LIKE '%$name%'";
        }
        if ($year != "") {
            $WHERE_CLAUSE .= " AND $year = YEAR(`comp_start`)";
        }
        if ($sex != "") {
            $sex = sexConverterReversed($sex);
            $WHERE_CLAUSE .= " AND comp_sex = $sex";
        }
        if ($weapont_type != "") {
            $weapont_type = weaponConenverterReversed($weapont_type);
            $WHERE_CLAUSE .= " AND comp_weapon = $weapont_type";
        }
    }
    */
?>