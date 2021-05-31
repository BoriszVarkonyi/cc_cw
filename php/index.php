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
    <div class="modal_wrapper hidden" id="modal_2">
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

                <div id="publishcomp" class="stripe_button_wrapper">
                    <button class="stripe_button primary <?php echo $publish_comp_disabled ?>">
                        <p>Publish Competition</p>
                        <img src="../assets/icons/send_black.svg"/>
                    </button>
                </div>
            </div>

            <!-- dashboard body -->
            <div id="page_content_panel_main">
                <div id="db_panel_wrapper">
                    <div class="db_panel main">
                    <button onclick="toggleModal(1)">Example Modal</button>
                    <button onclick="toggleModal(2)">Example Modal 2</button>
                    <button onclick="toggleModal('EULA')">EULA Modal</button>
                    <button onclick="toggleModal('cookies')">Cookies Modal</button>
                    <button onclick="toggleModal('bug')">Bug report Modal</button>
                </div>

                <!-- competition status -->
                <div class="db_panel status">
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/beenhere_black.svg">
                        <p>Competition's status:</p><p id="db_comp_status"><?php echo statusConverter($comp_status) ?></p>
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
                <!-- chat panel -->
                <div class="db_panel chat">
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/chat_black.svg">
                        <p>Chat</p>
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