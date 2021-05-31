<?php

    //get type of technician
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];

    if ($role == "technicians") {

        //get tech role and store it in a session for future uses
        if (!isset($_SESSION['tech_role'])) {
            //get type of technician from database
            $qry_get_data = "SELECT `data` FROM `technicians` WHERE `assoc_comp_id` = '$comp_id'";
            $do_get_data = mysqli_query($connection, $qry_get_data);

            if ($row = mysqli_fetch_assoc($do_get_data)) {
                $json_string = $row['data'];
                $json_table = json_decode($json_string);
            } else {
                //error message if something goes wrong
                echo "ERROR: technician role determiation; can't access database";
            }

            //find tech with matching username
            //there shouldn't be multiple (hopefully)
            if ($id_to_find = findObject($json_table, $username, "username") !== false) {

                $tech_role = $json_table[$id_to_find] -> role;

            } else {
                //error message tech_role session is still set but with NULL value
                echo "ERROR: techician with current username can't be found; multiple usernames(?)";
                $tech_role = NULL;
            }

            //set session
            $_SESSION['tech_role'] = $tech_role;
        } else {
            $tech_role = $_SESSION['tech_role'];
        }

        //get approved pages based on the role of the technician

        //array of pages approved for all roles:
        $approved_pages = ["index.php"];

        switch ($tech_role) {
            case 1://semi
                array_push($approved_pages, "competitors.php", "pools_generate.php", "pools_config.php", "pools_view.php", "pool_matches.php", "temporary_ranking.php", "table.php", "overview.php", "weapon_control_immediate.php", "weapon_control_administrated.php", "weapon_control_statistics.php", "registration.php");
            break;

            case 2://DT
                array_push($approved_pages, "competitors.php", "pools_generate.php", "pools_config.php", "pools_view.php", "pool_matches.php", "temporary_ranking.php", "table.php", "overview.php");
            break;

            case 3://weaponControl
                array_push($approved_pages, "weapon_control_immediate.php", "weapon_control_administrated.php", "weapon_control_statistics.php");
            break;

            case 4://registration
                array_push($approved_pages, "registration.php");
            break;
        }

        //redirect technician if on a non approved page
        if (array_search(basename($_SERVER['PHP_SELF']),$approved_pages) === false) {
            header("Location: ../php/index.php?comp_id=$comp_id");
        }
    }

?>
