<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php

    checkComp($connection);

    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);

    if($row = mysqli_fetch_assoc($check_comp_query)){

        $comp_name = $row["comp_name"];
        $comp_is_individual = $row["is_individual"];
        $comp_status = $row['comp_status'];
        $comp_wc_type = $row["comp_wc_type"];
        $is_individual = $row['is_individual'];
    }

    //get logo image
    if (file_exists("../uploads/" . $comp_id . ".png")) {

        $logo = "../uploads/" . $comp_id . ".png";

    } else {

        $logo = "../assets/icons/no_image_black.svg";
    }

    $weapon_control_all = 0;
    $weapon_control_filled = 0;
    $issues_reported = 0;

    function check_array_empty($arr, &$issues_reported) {
        if(is_null($arr))
            return true;

        $flag = true;
        foreach($arr as $item) {
            if($item != 0) {
                $issues_reported += $item;
                $flag = false;
            }
        }
        return $flag;
    }

    $weapon_control_query = "SELECT issues_array, weapons_turned_in FROM weapon_control WHERE assoc_comp_id = $comp_id";
    $do_weapon_control = mysqli_query($connection, $weapon_control_query);
    while($row = mysqli_fetch_assoc($do_weapon_control)) {
        if(!check_array_empty(json_decode($row['issues_array']), $issues_reported)) {
            $weapon_control_filled++;
        }
        $weapon_control_all++;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name; ?></title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- template modals
    4 & 5 are already used for the retractment of competitions

    <div class="modal_wrapper hidden" id="modal_6">
        <div class="modal">
            <div class="modal_header gray">
                <p class="modal_title">Confieramtion</p>
                <p class="modal_subtitle">Szija</p>
            </div>
            <div class="modal_main">
                <img src="../assets/icons/arrow_back_ios_black.svg" class="modal_main_image margin_bottom">
                <p class="modal_main_title margin_bottom primary big">Bruh</p>
                <p class="modal_main_title margin_bottom big">Bruh</p>
                <p class="modal_main_title margin_bottom primary">Bruh</p>
                <p class="modal_main_title margin_bottom margin_top primary">Bruh</p>
                <p class="modal_main_title margin_bottom centered">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph centered">Bruh</p>
                <p class="modal_paragraph margin_top">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph big">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph margin_bottom">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
                <p class="modal_paragraph">Bruh</p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This change cannot be undone.</p>
                <div class="modal_footer_content">
                    <button class="modal_decline_button" onclick="toggleModal(1)">Decline</button>
                    <button class="modal_confirmation_button">Accept</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal_wrapper hidden" id="modal_7">
        <div class="modal">
            <div class="modal_header red">
                <p class="modal_title">Confieramtion</p>
                <p class="modal_subtitle">Szia</p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This change cannot be undone.</p>
                <div class="modal_footer_content">
                    <button class="modal_decline_button" onclick="toggleModal(2)">Cancel</button>
                    <button class="modal_confirmation_button">Okay</button>
                </div>
            </div>
        </div>
    </div>

-->
    <?php include "includes/navigation.php"; ?>
    <main>
        <!-- dashboard header -->
        <div id="title_stripe">
            <button type="button" class="back_button" onclick="location.href='select_tournament.php'">
                <img src="../assets/icons/arrow_back_ios_black.svg"/>
            </button>
            <img src="<?php echo $logo ?>" class="comp_logo" width="50" height="50"/>
            <p class="page_title"><?php echo $comp_name; ?></p>

            <?php include "../cc/competition_version_control_button.php" ?>

        </div>
        <?php
            $num_comps = 0;
            $num_reg = 0;
            $nations = array();
            $clubs = array();

            $comp_query = "SELECT data from competitors WHERE assoc_comp_id = '$comp_id';";
            $comp_result = mysqli_query($connection, $comp_query);
            if($row = mysqli_fetch_assoc($comp_result)) {
                $json_string = $row["data"];
                $json_table = json_decode($json_string);
                $num_comps = count($json_table);

                foreach($json_table as $json_obj) {
                    if(!in_array($json_obj->nation, $nations)) {
                        array_push($nations, $json_obj->nation);
                    }
                    if(!in_array($json_obj->club, $clubs)) {
                        array_push($clubs, $json_obj->club);
                    }
                    if($json_obj->reg) {
                        $num_reg += 1;
                    }
                }
            }

            $teams = array();
            $teams_query = "SELECT data from teams WHERE assoc_comp_id = '$comp_id'";
            $teams_result = mysqli_query($connection, $teams_query);
            if($row = mysqli_fetch_assoc($teams_result)) {
                $json_string = $row["data"];
                $json_table = json_decode($json_string);

                foreach($json_table as $json_obj) {
                    if(!in_array($json_obj->id, $teams)) {
                        array_push($teams, $json_obj->id);
                    }
                }
            }
        ?>
        <!-- dashboard body -->
        <div id="page_content_panel_main">
            <div id="db_panel_wrapper">

                <!-- competition status -->
                <div id="stats_panel" class="db_panel">
                    <div class="db_panel_header">
                        <img src="../assets/icons/bar_chart_black.svg">
                        <p>Competition's Stats:</p>
                        <button class="db_panel_header_extension">
                            <p>Refresh Data</p>
                            <img src="../assets/icons/refresh_black.svg">
                        </button>
                    </div>
                    <div class="db_panel_main small">

                    <?php if($comp_is_individual) { ?>
                        <p class="stat_wrapper_title" onclick="toggleWrapper(this)" >PARTICIPATORS (INDIVIDUAL)<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                        <div class="stats_wrapper">
                            <a class="stat" href="competitors_individual.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/person_black.svg">
                                <p class="stat_title">Competitors</p>
                                <p class="stat_number"><?php echo $num_comps ?></p>
                            </a>
                            <div class="stat">
                                <img src="../assets/icons/language_black.svg">
                                <p class="stat_title">Nations</p>
                                <p class="stat_number"><?php echo count($nations) ?></p>
                            </div>
                            <div class="stat">
                                <img src="../assets/icons/groups_black.svg">
                                <p class="stat_title">Clubs</p>
                                <p class="stat_number"><?php echo count($clubs) ?></p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <p class="stat_wrapper_title" onclick="toggleWrapper(this)" >PARTICIPATORS (TEAM)<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                        <div class="stats_wrapper">
                            <a class="stat" href="competitors_individual.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/person_black.svg">
                                <p class="stat_title">Competitors</p>
                                <p class="stat_number"><?php echo $num_comps ?></p>
                            </a>
                            <a class="stat" href="teams.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/people_black.svg">
                                <p class="stat_title">Teams</p>
                                <p class="stat_number"><?php echo count($teams) ?></p>
                            </a>
                            <div class="stat">
                                <img src="../assets/icons/language_black.svg">
                                <p class="stat_title">Nations</p>
                                <p class="stat_number"><?php echo count($nations) ?></p>
                            </div>
                            <div class="stat">
                                <img src="../assets/icons/groups_black.svg">
                                <p class="stat_title">Clubs</p>
                                <p class="stat_number"><?php echo count($clubs) ?></p>
                            </div>
                        </div>
                    <?php } ?>

                        <p class="stat_wrapper_title" onclick="toggleWrapper(this)" >REGISTARTION<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                        <div class="stats_wrapper">
                            <a class="stat" href="registration.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/how_to_reg_black.svg">
                                <p class="stat_title">Registered in</p>
                                <p class="stat_number"><?php echo $num_reg ?></p>
                            </a>
                            <a class="stat" href="registration.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/how_to_unreg_black.svg">
                                <p class="stat_title">Not registered in</p>
                                <p class="stat_number"><?php echo $num_comps - $num_reg?></p>
                            </a>
                        </div>
                    <!-- WEAPON CONTROL -->
                    <?php if($comp_wc_type == 2) { ?>
                        <p class="stat_wrapper_title" onclick="toggleWrapper(this)" >WEAPON CONTROL (ADMINISTRATED)<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                        <div class="stats_wrapper">
                            <a class="stat" href="weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/check_circle_outline_black.svg">
                                <p class="stat_title">Check-ins</p>
                                <p class="stat_subtitle">READY</p>
                                <p class="stat_number">159 / 159</p>
                            </a>
                            <a class="stat" href="weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/check_circle_black.svg">
                                <p class="stat_title">Check-outs</p>
                                <p class="stat_number">159 / 120</p>
                            </a>
                            <a class="stat" href="weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/weapon_control_black.svg">
                                <p class="stat_title">Weapon Controls</p>
                                <p class="stat_number"><?php echo "$weapon_control_filled / $weapon_control_all" ?></p>
                            </a>
                            <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/report_problem_black.svg">
                                <p class="stat_title">Issues Reported</p>
                                <p class="stat_number"><?php echo $issues_reported ?></p>
                            </a>
                        </div>
                        <?php } else if($comp_wc_type == 1) { ?>
                        <p class="stat_wrapper_title" onclick="toggleWrapper(this)" >WEAPON CONTROL (IMMEDIATE)<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                        <div class="stats_wrapper">
                            <a class="stat" href="weapon_control_immediate.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/weapon_control_black.svg">
                                <p class="stat_title">Weapon Controls</p>
                                <p class="stat_number"><?php echo "$weapon_control_filled / $weapon_control_all" ?></p>
                            </a>
                            <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/report_problem_black.svg">
                                <p class="stat_title">Issues Reported</p>
                                <p class="stat_number"><?php echo $issues_reported ?></p>
                            </a>
                        </div>
                        <?php } ?>
                        <?php
                            $technicians_query = "SELECT COUNT(1) AS num_technicians FROM technicians WHERE assoc_comp_id = '$comp_id';";
                            $technicians_result = mysqli_query($connection, $technicians_query);
                            $num_technicians = mysqli_fetch_assoc($technicians_result)["num_technicians"];

                            $technicians_online_query = "SELECT COUNT(1) AS num_tech_online FROM technicians WHERE assoc_comp_id = '$comp_id' AND online = TRUE";
                            $technicians_online_result = mysqli_query($connection, $technicians_online_query);
                            $num_tech_online = mysqli_fetch_assoc($technicians_online_result)["num_tech_online"];
                        ?>
                        <p class="stat_wrapper_title" onclick="toggleWrapper(this)" >TECHNICIANS<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                        <div class="stats_wrapper">
                            <a class="stat" href="staff.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/badge_black.svg">
                                <p class="stat_title">Total Technicians</p>
                                <p class="stat_number"><?php echo $num_technicians ?></p>
                            </a>
                            <a class="stat" href="staff.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/check_circle_outline_black.svg">
                                <p class="stat_title">Online</p>
                                <p class="stat_number"><?php echo $num_tech_online ?></p>
                            </a>
                            <a class="stat" href="staff.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/highlight_off_black.svg">
                                <p class="stat_title">Offline</p>
                                <p class="stat_number"><?php echo $num_technicians - $num_tech_online ?></p>
                            </a>

                        </div>
                        <?php
                            $referees_query = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id';";
                            $referees_result = mysqli_query($connection, $referees_query);
                            $num_referees = 0;
                            $num_ref_online = 0;

                            if($row = mysqli_fetch_assoc($referees_result)) {
                                $json_string = $row["data"];
                                $json_table = json_decode($json_string);

                                foreach($json_table as $json_obj) {
                                    $num_referees += 1; //don't use count() instead of this
                                    if($json_obj->isOnline) {
                                        $num_ref_online += 1;
                                    }
                                }
                            }
                        ?>
                        <p class="stat_wrapper_title" onclick="toggleWrapper(this)" >REFEREES<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                        <div class="stats_wrapper">
                            <a class="stat" href="referees.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/style_black.svg">
                                <p class="stat_title">Total Referees</p>
                                <p class="stat_number"><?php echo $num_referees ?></p>
                            </a>
                            <a class="stat" href="referees.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/check_circle_outline_black.svg">
                                <p class="stat_title">Online</p>
                                <p class="stat_number"><?php echo $num_ref_online ?></p>
                            </a>
                            <a class="stat" href="referees.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/highlight_off_black.svg">
                                <p class="stat_title">Offline</p>
                                <p class="stat_number"><?php echo $num_referees - $num_ref_online ?></p>
                            </a>
                        </div>
                        <?php
                            $pistes_query = "SELECT data FROM pistes WHERE assoc_comp_id = '$comp_id';";
                            $pistes_result = mysqli_query($connection, $pistes_query);
                            $num_pistes = 0;
                            $num_pistes_available = 0;

                            if($row = mysqli_fetch_assoc($pistes_result)) {
                                $json_string = $row["data"];
                                $json_table = json_decode($json_string);

                                foreach($json_table as $json_obj) {
                                    $num_pistes += 1; //don't use count() instead of this
                                    if($json_obj->available) {
                                        $num_pistes_available += 1;
                                    }
                                }
                            }
                        ?>
                        <p class="stat_wrapper_title" onclick="toggleWrapper(this)" >PISTES<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                        <div class="stats_wrapper">
                            <a class="stat" href="pistes.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/style_black.svg">
                                <p class="stat_title">Total Pistes</p>
                                <p class="stat_number"><?php echo $num_pistes ?></p>
                            </a>
                            <a class="stat" href="pistes.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/style_black.svg">
                                <p class="stat_title">Free to use</p>
                                <p class="stat_number"><?php echo $num_pistes_available ?></p>
                            </a>
                            <a class="stat" href="pistes.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/style_black.svg">
                                <p class="stat_title">In use</p>
                                <p class="stat_number"><?php echo $num_pistes - $num_pistes_available ?></p>
                            </a>
                            <a class="stat" href="pistes.php?comp_id=<?php echo $comp_id ?>">
                                <img src="../assets/icons/style_black.svg">
                                <p class="stat_title">Connected to CCC</p>
                                <p class="stat_number">1</p>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- competition status -->
                <div id="status_panel" class="db_panel">
                    <div class="db_panel_header">
                        <img src="../assets/icons/task_alt_black.svg">
                        <p>Competition's Status:</p>
                        <p class="db_panel_header_extension"><?php echo statusConverter($comp_status) ?></p>
                    </div>

                    <!-- competiton status table -->
                    <div class="db_panel_main list">
                        <div class="to_do_list">
                            <button onclick="toggleToDoSublist()">
                                <p>General</p>
                                <p>(4 / 1)</p>
                                <img src="<?php // echo $assoc_comp_table_elements['general'] ?>../assets/icons/close_black.svg">
                            </button>
                            <div class="to_do_sublist">
                                <div>
                                    <a href="basic_information.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                    <p>Basic Information</p>
                                    <img src="<?php // echo $assoc_comp_table_elements['g_basic_info'] ?>../assets/icons/close_black.svg">
                                </div>
                                <div>
                                    <a href="information_for_fencers.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                    <p>Information for fencers</p>
                                    <img src="<?php // echo $assoc_comp_table_elements['g_info_for_fencers'] ?>../assets/icons/close_black.svg">
                                </div>
                                <div>
                                    <a href="invitation.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                    <p>Invitation</p>
                                    <img src="<?php // echo $assoc_comp_table_elements['g_invitations'] ?>../assets/icons/close_black.svg">
                                </div>
                            </div>

                            <button onclick="toggleToDoSublist()">
                                <p>Technical</p>
                                <p>(4 / 1)</p>
                                <img src="<?php // echo $assoc_comp_table_elements['technical'] ?>../assets/icons/close_black.svg">
                            </button>
                            <div class="to_do_sublist">
                                <div>
                                    <a href="staff.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                    <p>Technicians</p>
                                    <img src="<?php // echo $assoc_comp_table_elements['t_technicians'] ?>../assets/icons/close_black.svg">
                                </div>
                                <div>
                                    <a href="referees.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                    <p>Referees</p>
                                    <img src="<?php // echo $assoc_comp_table_elements['t_referees'] ?>../assets/icons/close_black.svg">
                                </div>
                                <div>
                                    <a href="pistes.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                    <p>Pistes</p>
                                    <img src="<?php // echo $assoc_comp_table_elements['t_referees'] ?>../assets/icons/close_black.svg">
                                </div>
                                <div>
                                    <a href="formula.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                    <p>Formula</p>
                                    <img src="<?php // echo $assoc_comp_table_elements['t_referees'] ?>../assets/icons/close_black.svg">
                                </div>
                            </div>

                            <button class="done">
                                <a href="choose_ranking.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                <p>Ranking</p>
                                <img src="<?php // echo $assoc_comp_table_elements['ranking'] ?>../assets/icons/close_black.svg">
                            </button>
                        </div>
                        <div class="progress_bar">
                            <div class="progress" x-progress="0%"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/dashboard.js"></script>
    <script src="javascript/modal.js"></script>
</body>
</html>