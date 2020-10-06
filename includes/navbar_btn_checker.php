<?php
    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);

    if($row = mysqli_fetch_assoc($check_comp_query)){

        $comp_status = $row["comp_status"];
        $comp_id = $row["comp_id"];

    }

    define("NORMAL_CLASS", ' class="nav_bar_item" ');
    define("DISABLED_CLASS", ' class="nav_bar_item disabled" ');

    $array_names = [ // creating names of buttons
        "dt",
        "competitors",
        "pools",
        "table",
        "overview",
        "call_room",
        "registration",
        "weapon_control",
        "announcements",
        "general",
        "basic_info",
        "info_for_fencers",
        "timetable",
        "invitation",
        "technical",
        "technicians",
        "referees",
        "pistes",
        "formula",
        "ranking",
        "manage_entries"
    ];

    $array_functions = // creating href and onclick tags in array
    [
        'onclick="toggle_dt_dropdown()"',
        'href=""',
        'href=""',
        'href=""',
        'href=""',
        'href="call_room.php?comp_id=' . $comp_id . '"',
        'href="registration.php?comp_id=' . $comp_id . '"',
        'href="weapon_control.php?comp_id=' . $comp_id . '"',
        'href  =""',
        'onclick="toggle_general_dropdown()"',
        'href="basic_information.php?comp_id=' . $comp_id . '"',
        'href="information_for_fencers.php?comp_id=' . $comp_id . '"',
        'href="timetable.php?comp_id=' . $comp_id . '"',
        'href="invitation.php?comp_id=' . $comp_id . '"',
        'onclick="toggle_technical_dropdown()"',
        'href="technicians.php?comp_id=' . $comp_id . '"',
        'href="referees.php?comp_id=' . $comp_id . '"',
        'href="pistes.php?comp_id=' . $comp_id . '"',
        'href=""',
        'href="choose_ranking.php?comp_id=' . $comp_id . '"',
        'href="manage_entries.php?comp_id=' . $comp_id . '"'
    ];

    if (count($array_functions)==count($array_names)) { //error test

        for ($i=0; $i<count($array_functions); $i++) { //creating assoc array with hrefs and onclick tags
            if ($i === 0) {
                $assoc_array_functions = [$array_names[$i] => $array_functions[$i] . NORMAL_CLASS];
            } else {
                $assoc_array_functions[$array_names[$i]] = $array_functions[$i] . NORMAL_CLASS;
            }
        }

    } else { 
        echo "ERROR: THE 2 ARRAYS DOES NOT HAVE THE SAME COUNT()"; //error code
    }
    
    switch ($comp_status) {

        case 1: /* scheduled */

            $array_button_names_for_change = ["dt", "competitors", "pools", "table", "overview", "manage_entries"];

            foreach ($array_button_names_for_change as $name) {
                $assoc_array_functions[$name] = DISABLED_CLASS;
            }
        break;
        case 2: /* published */

            $array_button_names_for_change = ["basic_info", "info_for_fencers", "timetable", "ranking"];

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
