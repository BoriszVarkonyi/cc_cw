<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php"; ?>
<?php

    checkComp($connection);

    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);

    if($row = mysqli_fetch_assoc($check_comp_query)){

        $comp_name = $row["comp_name"];

        $comp_status = $row['comp_status'];
    }

    //get logo image
    if (file_exists("../uploads/" . $comp_id . ".png")) {

        $logo = "../uploads/" . $comp_id . ".png";

    } else {

        $logo = "../assets/icons/no_image_black.svg";
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
    <div class="modal_wrapper hidden" id="modal_1">
        <div class="modal">
            <div class="modal_header primary">
                <p class="modal_title">Do you want to publish this competition?</p>
                <p class="modal_subtitle">The Competition will be shown on CompetitionView.</p>
            </div>
            <div class="modal_main">
                <p class="modal_main_title margin_bottom big">All public information about the Competition could be accesed by everybody.</p>
                <p class="modal_main_title margin_bottom big">Fencing Federations can now Pre-Register.</p>
                <p class="modal_main_title big">Fencers now can book Weapon Control Appointments.</p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This change cannot be undone.</p>
                <form class="modal_footer_content">
                    <button type="button" class="modal_decline_button" onclick="toggleModal(1)">Cancel</button>
                    <button type="submit" class="modal_confirmation_button">Publish</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal_wrapper hidden" id="modal_2">
        <div class="modal">
            <div class="modal_header primary">
                <p class="modal_title">Do you want to start this competition?</p>
                <p class="modal_subtitle">The Competition will begun.</p>
            </div>
            <div class="modal_main">
                <p class="modal_main_title margin_bottom big">All public information about the Competition could be accesed by everybody.</p>
                <p class="modal_main_title margin_bottom big">Fencing Federations can now Pre-Register.</p>
                <p class="modal_main_title big">Fencers now can book Weapon Control Appointments.</p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This change cannot be undone.</p>
                <form class="modal_footer_content">
                    <button type="button" class="modal_decline_button" onclick="toggleModal(2)">Cancel</button>
                    <button type="submit" class="modal_confirmation_button">Start</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal_wrapper hidden" id="modal_3">
        <div class="modal">
            <div class="modal_header primary">
                <p class="modal_title">Do you want to finish this competition?</p>
                <p class="modal_subtitle">The Competition will be finished.</p>
            </div>
            <div class="modal_main">
                <p class="modal_main_title margin_bottom big">All public information about the Competition could be accesed by everybody.</p>
                <p class="modal_main_title margin_bottom big">Fencing Federations can now Pre-Register.</p>
                <p class="modal_main_title big">Fencers now can book Weapon Control Appointments.</p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This change cannot be undone.</p>
                <form class="modal_footer_content">
                    <button type="button" class="modal_decline_button" onclick="toggleModal(3)">Cancel</button>
                    <button type="submit" class="modal_confirmation_button">Finish</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal_wrapper hidden" id="modal_4">
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
    <div class="modal_wrapper hidden" id="modal_5">
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
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <main>
            <!-- dashboard header -->
            <div id="title_stripe">
                <button type="button" class="back_button" onclick="location.href='choose_tournament.php'">
                    <img src="../assets/icons/arrow_back_ios_black.svg"/>
                </button>
                <img src="<?php echo $logo ?>" class="comp_logo" width="50" height="50"/>
                <p class="page_title"><?php echo $comp_name; ?></p>


                <!-- PUBLISH COMPETITION (1) >> (2) -->
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary <?php echo $publish_comp_disabled ?>" onclick="toggleModal(1)">
                        <p>Publish Competition</p>
                        <img src="../assets/icons/publish_black.svg"/>
                    </button>
                </div>

                <!-- START COMPETITION (2) >> (3) -->
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary <?php echo $publish_comp_disabled ?>" onclick="toggleModal(2)">
                        <p>Start Competition</p>
                        <img src="../assets/icons/flag_black.svg"/>
                    </button>
                </div>

                <!-- FINISH COMPETITION (3) >> (4) -->
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary <?php echo $publish_comp_disabled ?>" onclick="toggleModal(3)">
                        <p>Finish Competition</p>
                        <img src="../assets/icons/outlined_flag_black.svg"/>
                    </button>
                </div>



            </div>

            <!-- dashboard body -->
            <div id="page_content_panel_main">
                <div id="db_panel_wrapper">

                    <!-- competition status -->
                    <div id="stats_panel" class="db_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/bar_chart_black.svg">
                            <p>Competition's Stats:</p>
                        </div>
                        <div class="db_panel_main small">

                            <p class="stat_wrapper_title" onclick="openStatsWrapper()">PARTICIPATORS (INDIVIDUAL)<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                            <div class="stats_wrapper">
                                <a class="stat" href="competitors_individual.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/person_black.svg">
                                    <p class="stat_title">Competitors</p>
                                    <p class="stat_number">159</p>
                                </a>
                                <div class="stat">
                                    <img src="../assets/icons/language_black.svg">
                                    <p class="stat_title">Nations</p>
                                    <p class="stat_number">4</p>
                                </div>
                                <div class="stat">
                                    <img src="../assets/icons/groups_black.svg">
                                    <p class="stat_title">Clubs</p>
                                    <p class="stat_number">7</p>
                                </div>
                            </div>

                            <p class="stat_wrapper_title" onclick="openStatsWrapper()">PARTICIPATORS (TEAM)<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                            <div class="stats_wrapper">
                                <a class="stat" href="competitors_individual.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/person_black.svg">
                                    <p class="stat_title">Competitors</p>
                                    <p class="stat_number">159</p>
                                </a>
                                <a class="stat" href="teams.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/people_black.svg">
                                    <p class="stat_title">Teams</p>
                                    <p class="stat_number">10</p>
                                </a>
                                <div class="stat">
                                    <img src="../assets/icons/language_black.svg">
                                    <p class="stat_title">Nations</p>
                                    <p class="stat_number">4</p>
                                </div>
                                <div class="stat">
                                    <img src="../assets/icons/groups_black.svg">
                                    <p class="stat_title">Clubs</p>
                                    <p class="stat_number">7</p>
                                </div>
                            </div>

                            <p class="stat_wrapper_title" onclick="openStatsWrapper()">REGISTARTION<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                            <div class="stats_wrapper">
                                <a class="stat" href="registartion.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/how_to_reg_black.svg">
                                    <p class="stat_title">Registered in</p>
                                    <p class="stat_number">159 / 19</p>
                                </a>
                                <a class="stat" href="registartion.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/how_to_unreg_black.svg">
                                    <p class="stat_title">Not registered in</p>
                                    <p class="stat_number">159 / 19</p>
                                </a>
                            </div>

                            <p class="stat_wrapper_title" onclick="openStatsWrapper()">WEAPON CONTROL (ADMINISTRATED)<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                            <div class="stats_wrapper">
                                <a class="stat" href="weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/check_circle_outline_black.svg">
                                    <p class="stat_title">Check-ins</p>
                                    <p class="stat_subtitle">33%</p>
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
                                    <p class="stat_number">159 / 138</p>
                                </a>
                                <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/report_problem_black.svg">
                                    <p class="stat_title">Issues Reported</p>
                                    <p class="stat_number">56</p>
                                </a>
                            </div>

                            <p class="stat_wrapper_title" onclick="openStatsWrapper()">WEAPON CONTROL (IMMEDIATE)<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                            <div class="stats_wrapper">
                                <a class="stat" href="weapon_control_immediate.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/weapon_control_black.svg">
                                    <p class="stat_title">Weapon Controls</p>
                                    <p class="stat_number">159 / 138</p>
                                </a>
                                <a class="stat" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/report_problem_black.svg">
                                    <p class="stat_title">Issues Reported</p>
                                    <p class="stat_number">56</p>
                                </a>
                            </div>

                            <p class="stat_wrapper_title" onclick="openStatsWrapper()">TECHNICIANS<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                            <div class="stats_wrapper closed">
                                <a class="stat" href="technicians.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/badge_black.svg">
                                    <p class="stat_title">Total Technicians</p>
                                    <p class="stat_number">19</p>
                                </a>
                                <a class="stat" href="technicians.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/check_circle_outline_black.svg">
                                    <p class="stat_title">Online</p>
                                    <p class="stat_number">10</p>
                                </a>
                                <a class="stat" href="technicians.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/highlight_off_black.svg">
                                    <p class="stat_title">Offline</p>
                                    <p class="stat_number">9</p>
                                </a>

                            </div>

                            <p class="stat_wrapper_title" onclick="openStatsWrapper()">REFEREES<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                            <div class="stats_wrapper">
                                <a class="stat" href="referees.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/style_black.svg">
                                    <p class="stat_title">Total Referees</p>
                                    <p class="stat_number">3</p>
                                </a>
                                <a class="stat" href="referees.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/check_circle_outline_black.svg">
                                    <p class="stat_title">Online</p>
                                    <p class="stat_number">1</p>
                                </a>
                                <a class="stat" href="referees.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/highlight_off_black.svg">
                                    <p class="stat_title">Offline</p>
                                    <p class="stat_number">2</p>
                                </a>
                            </div>

                            <p class="stat_wrapper_title" onclick="openStatsWrapper()">PISTES<button><img src="../assets/icons/arrow_drop_down_black.svg"></button></p>
                            <div class="stats_wrapper">
                                <a class="stat" href="pistes.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/style_black.svg">
                                    <p class="stat_title">Total Pistes</p>
                                    <p class="stat_number">4</p>
                                </a>
                                <a class="stat" href="pistes.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/style_black.svg">
                                    <p class="stat_title">Free to use</p>
                                    <p class="stat_number">3</p>
                                </a>
                                <a class="stat" href="pistes.php?comp_id=<?php echo $comp_id ?>">
                                    <img src="../assets/icons/style_black.svg">
                                    <p class="stat_title">In use</p>
                                    <p class="stat_number">1</p>
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
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/task_alt_black.svg">
                            <p>Competition's Status:</p><p id="db_comp_status"><?php echo statusConverter($comp_status) ?></p>
                        </div>

                        <!-- competiton status table -->
                        <div class="db_panel_main list">
                            <div class="to_do_list">
                                <button onclick="toggleToDoSublist()">
                                    <p>General</p>
                                    <p>(4 / 1)</p>
                                    <img src="<?php echo $assoc_comp_table_elements['general'] ?>">
                                </button>
                                <div class="to_do_sublist">
                                    <div>
                                        <a href="basic_information.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                        <p>Basic Information</p>
                                        <img src="<?php echo $assoc_comp_table_elements['g_basic_info'] ?>">
                                    </div>
                                    <div>
                                        <a href="information_for_fencers.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                        <p>Information for fencers</p>
                                        <img src="<?php echo $assoc_comp_table_elements['g_info_for_fencers'] ?>">
                                    </div>
                                    <div>
                                        <a href="invitation.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                        <p>Invitation</p>
                                        <img src="<?php echo $assoc_comp_table_elements['g_invitations'] ?>">
                                    </div>
                                </div>

                                <button onclick="toggleToDoSublist()">
                                    <p>Technical</p>
                                    <p>(4 / 1)</p>
                                    <img src="<?php echo $assoc_comp_table_elements['technical'] ?>">
                                </button>
                                <div class="to_do_sublist">
                                    <div>
                                        <a href="technicians.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                        <p>Technicians</p>
                                        <img src="<?php echo $assoc_comp_table_elements['t_technicians'] ?>">
                                    </div>
                                    <div>
                                        <a href="referees.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                        <p>Referees</p>
                                        <img src="<?php echo $assoc_comp_table_elements['t_referees'] ?>">
                                    </div>
                                    <div>
                                        <a href="pistes.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                        <p>Pistes</p>
                                        <img src="<?php echo $assoc_comp_table_elements['t_referees'] ?>">
                                    </div>
                                    <div>
                                        <a href="formula.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                        <p>Formula</p>
                                        <img src="<?php echo $assoc_comp_table_elements['t_referees'] ?>">
                                    </div>
                                </div>

                                <button class="done">
                                    <a href="choose_ranking.php?comp_id=<?php echo $comp_id ?>"><img src="../assets/icons/open_in_new_black.svg"></a>
                                    <p>Ranking</p>
                                    <img src="<?php echo $assoc_comp_table_elements['ranking'] ?>">
                                </button>
                            </div>
                            <div class="progress_bar">
                                <div class="progress" x-progress="25"></div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/dashboard.js"></script>
    <script src="../js/modal.js"></script>
</body>
</html>