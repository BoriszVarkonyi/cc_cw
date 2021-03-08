<?php
    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);

    if($row = mysqli_fetch_assoc($check_comp_query)){

        $comp_status = $row["comp_status"];
        $comp_id = $row["comp_id"];
        $wc_type = $row['comp_wc_type'];

    }

    define("NORMAL_CLASS", ' class="nav_bar_item" ');
    define("DISABLED_CLASS", ' class="nav_bar_item disabled" ');

    if ($wc_type == 1) {
        $wc_page = 'href="weapon_control_immediate.php?comp_id=' . $comp_id . '"';
    } else {
        $wc_page = 'href="weapon_control_administrated.php?comp_id=' . $comp_id . '"';
    }


    //check for existing pool
    $qry_check_pool = "SELECT count(*) FROM pools WHERE assoc_comp_id = '$comp_id'";
    $do_check_pool = mysqli_query($connection, $qry_check_pool);

    //logic
    if ($row = mysqli_fetch_assoc($do_check_pool)) {
        $n = $row['count(*)'];
        if ($n == 1) {
            $href_pools = 'href="pools.php?comp_id=' . $comp_id . '"';
        } else {
            $href_pools = 'href="generate_pools.php?comp_id=' . $comp_id . '"';
        }
    }
    $assoc_array_functions = // creating assoc array of button names and onclicks, and hrefs
    [
        "dt" =>                 'onclick="toggle_dtDropdown()"',
        "competitors" =>        'href="competitors.php?comp_id=' . $comp_id . '"',
        "pools" =>              $href_pools,
        "temp_ranking" =>       'href="temporary_ranking.php?comp_id=' . $comp_id . '"',
        "table" =>              'href="table.php?comp_id=' . $comp_id . '"',
        "overview" =>           'href="overview.php?comp_id=' . $comp_id .'"',
        "call_room" =>          'href="call_room.php?comp_id=' . $comp_id . '"',
        "registration" =>       'href="registration.php?comp_id=' . $comp_id . '"',
        "weapon_control" =>     $wc_page,
        "announcements" =>      'href="announcements.php?comp_id=' . $comp_id . '"',
        "general" =>            'onclick="toggle_general_dropdown()"',
        "basic_info" =>         'href="basic_information.php?comp_id=' . $comp_id . '"',
        "info_for_fencers" =>   'href="information_for_fencers.php?comp_id=' . $comp_id . '"',
        "invitation" =>         'href="invitation.php?comp_id=' . $comp_id . '"',
        "technical" =>          'onclick="toggle_technical_dropdown()"',
        "technicians" =>        'href="technicians.php?comp_id=' . $comp_id . '"',
        "referees" =>           'href="referees.php?comp_id=' . $comp_id . '"',
        "pistes" =>             'href="pistes.php?comp_id=' . $comp_id . '"',
        "formula" =>            'href="formula.php?comp_id=' . $comp_id . '"',
        "ranking" =>            'href="choose_ranking.php?comp_id=' . $comp_id . '"',
        "manage_entries" =>     'href="manage_entries.php?comp_id=' . $comp_id . '"',
    ];

    foreach ($assoc_array_functions as $key => $value) {
        $assoc_array_functions[$key] = $value . NORMAL_CLASS;
    }

    switch ($comp_status) {

        case 1: /* scheduled */

            $array_button_names_for_change = ["dt", "competitors", "pools", "table", "overview", "manage_entries"];

            foreach ($array_button_names_for_change as $name) {
                $assoc_array_functions[$name] = DISABLED_CLASS;
            }
        break;
        case 2: /* published */

            $array_button_names_for_change = ["basic_info", "info_for_fencers", "ranking"];

            foreach ($array_button_names_for_change as $name) {
                $assoc_array_functions[$name] = DISABLED_CLASS;
            }

        break;
        case 3: /* outgoing */

            $array_button_names_for_change = ["general", "basic_info", "info_for_fencers", "timetable", "invitation", "ranking", "manage_entries"];

            foreach ($array_button_names_for_change as $name) {
                $assoc_array_functions[$name] = DISABLED_CLASS;
            }

        break;
        default: /* error line */
            echo 'ERROR: YOUR COMPETITION DOES NOT HAVE CORRECT $comp_status! $comp_status=' . $comp_status;
        break;
    }
?>
