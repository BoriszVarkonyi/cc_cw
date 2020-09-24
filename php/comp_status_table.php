<?php

    //INVITATION; PISTES, FORMULA; PRE-ENTRIES MÉG NEM LÉTEZIK HA KÉSZ LESZ MEG KELL MÉG CSINÁLNI

    define("TICK", "../assets/icons/done-black-18dp.svg");
    define("CROSS", "../assets/icons/close-black-18dp.svg");

    //még nincsenek
    $g_invitations = CROSS;
    $t_pistes = CROSS;
    $t_formula = CROSS;
    $pre_entries = CROSS;
    
    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);
        
     if($row = mysqli_fetch_assoc($check_comp_query)){
        
        $comp_host = $row["comp_host"];
        $comp_info = $row["comp_info"];
        $comp_wc_info = $row["comp_wc_info"];
    }

    //testing basic info
    if ($comp_host != "") {
        $g_basic_info = TICK;
    } else {
        $g_basic_info = CROSS;
    }

    //testing info for fencers
    if ($comp_info != "") {
        $g_info_for_fencers = TICK;
    } else {
        $g_info_for_fencers = CROSS;
    }

    //testing timetable
    if ($comp_wc_info != "") {
        $g_timetable = TICK;
    } else {
        $g_timetable = CROSS;
    }
    
    //TESTING GENERAL___________________________________________________________________________________________

    if ($g_basic_info == TICK && $g_info_for_fencers == TICK && $g_timetable == TICK && $g_invitations == TICK) {
        $general = TICK;
    } else {
        $general = CROSS;
    }



    //tesing refrees
    $query_ref = "SELECT * FROM referees WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)'";
    $refnum = mysqli_query($connection, $query_ref);

    if (mysqli_num_rows($refnum) != 0){
        $t_referees = TICK;
    } else {
        $t_referees = CROSS;
    }

    //tesing technicians
    $query_techn = "SELECT * FROM technicians WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)'";
    $technnum = mysqli_query($connection, $query_techn);

    if (mysqli_num_rows($technnum) != 0){
        $t_technicians = TICK;
    } else {
        $t_technicians = CROSS;
    }

    //TESTING TECHICAL__________________________________________________________________________________________

    if ($t_formula == TICK && $t_pistes == TICK && $t_referees == TICK && $t_technicians == TICK) {
        $technical = TICK;
    } else {
        $technical = CROSS;
    }

    //tesing ranking
    $query_techn = "SELECT * FROM ranking WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)'";
    $ranknum = mysqli_query($connection, $query_techn);

    if (mysqli_num_rows($ranknum) != 0){
        $ranking = TICK;
    } else {
        $ranking = CROSS;
    }

    //majd testing pre-entries ha kész lesz
?>



<div class="db_panel_main">

    <div id="sheduled_to_do_list">

        <a class="sublist_title" onclick="toggle_general_to_do()">General<img src="<?php echo $general ?>" alt=""></a>
            
            <ul id="general_to_do" class="sheduled_to_do_sublist">

                <li>Basic Information<img src="<?php echo $g_basic_info ?>" alt=""></li>
                <li>Information for fencers<img src="<?php echo $g_info_for_fencers ?>" alt=""></li>
                <li>Timetable<img src="<?php echo $g_timetable ?>" alt=""></li>
                <li>Invitations<img src="<?php echo $g_invitations ?>" alt=""></li>

            </ul>

        <a class="sublist_title" onclick="toggle_technical_to_do()">Technical<img src="<?php echo $technical ?>" alt=""></a>
           
            <ul id="technical_to_do" class="sheduled_to_do_sublist">
                
                <li>Technicians<img src="<?php echo $t_technicians ?>" alt=""></li>
                <li>Referees<img src="<?php echo $t_referees ?>" alt=""></li>
                <li>Pistes<img src="<?php echo $t_pistes ?>" alt=""></li>
                <li>Formula<img src="<?php echo $t_formula ?>" alt=""></li>
            
            </ul>

        <a>Ranking<img src="<?php echo $ranking ?>" alt=""></a>

        <a>Pre-entries<img src="<?php echo $pre_entries ?>" alt=""></a>

    </div>
</div>