<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php"; ?>
<?php

checkComp($connection);

    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);

    if($row = mysqli_fetch_assoc($check_comp_query)){

    $comp_name = $row["comp_name"];

    }



    //comp_status_table

    define("TICK", "../assets/icons/done-black-18dp.svg");
    define("CROSS", "../assets/icons/close-black-18dp.svg");

    //még nincsenek

    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);

     if($row = mysqli_fetch_assoc($check_comp_query)){

        $comp_host = $row["comp_host"];
        $comp_info = $row["comp_info"];
        $comp_wc_info = $row["comp_wc_info"];
    }
    $assoc_comp_table_elements = [
        "g_invitations" => "",
        "g_basic_info" => "",
        "g_info_for_fencers" => "",
        "g_timetable" => "",
        "general" => "",
        "t_referees" => "",
        "t_technicians" => "",
        "technical" => "",
        "ranking" => "",
        "pre_entries" => "",
    ];

    $assoc_comp_table_elements['g_invitations'] = CROSS;
    $assoc_comp_table_elements['pre_entries'] = CROSS;

    //testing basic info
    if ($comp_host != "") {
        $assoc_comp_table_elements['g_basic_info'] = TICK;
    } else {
        $assoc_comp_table_elements['g_basic_info'] = CROSS;
    }

    //testing info for fencers
    if ($comp_info != "") {
        $assoc_comp_table_elements['g_info_for_fencers'] = TICK;
    } else {
        $assoc_comp_table_elements['g_info_for_fencers'] = CROSS;
    }

    //testing timetable
    if ($comp_wc_info != "") {
        $assoc_comp_table_elements['g_timetable'] = TICK;
    } else {
        $assoc_comp_table_elements['g_timetable'] = CROSS;
    }

    //TESTING GENERAL___________________________________________________________________________________________

    if ($assoc_comp_table_elements['g_basic_info'] == TICK && $assoc_comp_table_elements['g_basic_info'] == TICK && $assoc_comp_table_elements['g_timetable'] == TICK && $assoc_comp_table_elements['g_invitations'] == TICK) {
        $assoc_comp_table_elements['general'] = TICK;
    } else {
        $assoc_comp_table_elements['general'] = CROSS;
    }



    //tesing refrees
    $query_ref = "SELECT * FROM referees WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)'";
    $refnum = mysqli_query($connection, $query_ref);

    if (mysqli_num_rows($refnum) != 0){
        $assoc_comp_table_elements['t_referees'] = TICK;
    } else {
        $assoc_comp_table_elements['t_referees'] = CROSS;
    }



    //tesing technicians
    $query_techn = "SELECT * FROM technicians WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)'";
    $technnum = mysqli_query($connection, $query_techn);

    if (mysqli_num_rows($technnum) != 0){
        $assoc_comp_table_elements['t_technicians'] = TICK;
    } else {
        $assoc_comp_table_elements['t_technicians'] = CROSS;
    }

    //TESTING TECHICAL__________________________________________________________________________________________

    if ($assoc_comp_table_elements['t_referees'] == TICK && $assoc_comp_table_elements['t_technicians'] == TICK) {
        $assoc_comp_table_elements['technical'] = TICK;
    } else {
        $assoc_comp_table_elements['technical'] = CROSS;
    }

    //tesing ranking
    $query_techn = "SELECT * FROM ranking WHERE ass_comp_id regexp '(^|[[:space:]])$comp_id([[:space:]]|$)'";
    $ranknum = mysqli_query($connection, $query_techn);

    if (mysqli_num_rows($ranknum) != 0){
        $assoc_comp_table_elements['ranking'] = TICK;
    } else {
        $assoc_comp_table_elements['ranking'] = CROSS;
    }

    //majd testing pre-entries ha kész lesz

    //if all of the above are TICK then the publish competition button will NOT be disabled
    $publish_comp_disabled = "";
    if (array_search(CROSS, $assoc_comp_table_elements, FALSE) !== FALSE) {
        $publish_comp_disabled = " disabled";
    }

    //get logo image
    if (file_exists("../uploads/" . $comp_id . ".png")) {

        $logo = "../uploads/" . $comp_id . ".png";

    } else {

        $logo = "../assets/icons/no_image-black-18dp.svg";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name; ?></title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">

        <!-- left navigation bar -->
        <?php include "../includes/navbar.php"; ?>

        <div class="page_content_flex">

                <!-- dashboard header -->
                <div id="title_stripe">
                    <button type="button" class="back_button" onclick="location.href='choose_tournament.php'">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg"/>
                    </button>
                    <img src="<?php echo $logo ?>" class="comp_logo" width="50" height="50"/>
                    <p class="comp_title"><?php echo $comp_name; ?></p>

                    <div id="publishcomp" class="stripe_button_wrapper">
                        <button class="stripe_button primary <?php echo $publish_comp_disabled ?>">
                            <p>Publish Competition</p>
                            <img src="../assets/icons/send-black-18dp.svg"/>
                        </button>
                    </div>
                </div>

                <!-- dashboard body -->
                <div id="page_content_panel_main">
                    <div id="db_panel_wrapper">
                        <div class="db_panel main">
                        </div>

                        <!-- competition status -->
                        <div class="db_panel status">

                            <!-- competition status panel header -->

                            <?php //egyan az mint index.php elejen a comp_name lekérés
                                $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
                                $check_comp_query = mysqli_query($connection, $query);

                                if($row = mysqli_fetch_assoc($check_comp_query)){

                                    $comp_status = $row["comp_status"];

                                }
                            ?>

                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/beenhere-black-18dp.svg">
                                <p>Competition's status:</p><p id="db_comp_status"><?php echo statusConverter($comp_status) ?></p>
                            </div>

                            <!-- competiton status table -->
                            <div class="db_panel_main">

                                <div class="to_do_list">

                                    <a class="sublist_title" onclick="toggleToDoSublist()">General<img src="<?php echo $assoc_comp_table_elements['general'] ?>"></a>

                                    <div class="to_do_list">

                                        <div>Basic Information<img src="<?php echo $assoc_comp_table_elements['g_basic_info'] ?>"></div>
                                        <div>Information for fencers<img src="<?php echo $assoc_comp_table_elements['g_info_for_fencers'] ?>"></div>
                                        <div>Timetable<img src="<?php echo $assoc_comp_table_elements['g_timetable'] ?>"></div>
                                        <div>Invitation<img src="<?php echo $assoc_comp_table_elements['g_invitations'] ?>"></div>

                                    </div>

                                    <a class="sublist_title" onclick="toggleToDoSublist()">Technical<img src="<?php echo $assoc_comp_table_elements['technical'] ?>"></a>

                                        <div id="technical_to_do" class="to_do_list">

                                            <div>Technicians<img src="<?php echo $assoc_comp_table_elements['t_technicians'] ?>"></div>
                                            <div>Referees<img src="<?php echo $assoc_comp_table_elements['t_referees'] ?>"></div>

                                        </div>

                                    <a>Ranking<img src="<?php echo $assoc_comp_table_elements['ranking'] ?>"></a>

                                    <a>Pre-entries<img src="<?php echo $assoc_comp_table_elements['pre_entries'] ?>"></
                                </div>
                            </div>
                        </div>
                    <!-- chat panel -->
                        <div class="db_panel chat">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/chat-black-18dp.svg">
                                <p>Chat</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/dashboard.js"></script>
</body>
</html>