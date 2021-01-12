<?php 
    if (isset($_POST['submit_search'])) {

        $year = $_POST['year'];
        $weapont_type = $_POST['wt'];
        $sex = $_POST['sex'];
        $name = $_POST['name'];

        $WHERE_CLAUSE = "WHERE comp_status = '$statusofpage' ";

        if ($weapont_type != "") {
            $WHERE_CLAUSE .= "";
        } else {

        }

        if ($sex != "") {

        } else {
            
        }

        if ($name != "") {

        } else {
            
        }

        if ($year != "") {

        } else {
            
        }




    }



?>