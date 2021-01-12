<?php 

    $WHERE_CLAUSE = "WHERE `comp_status` = '$statusofpage' ";

    if (isset($_POST['submit_search'])) {

        echo "asdasdasd";
        $year = $_POST['year'];
        $weapont_type = $_POST['wt'];
        $sex = $_POST['sex'];
        print_r($_POST);

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
?>