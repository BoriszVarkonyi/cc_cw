<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
        <div id="content_wrapper">
            <?php include "../includes/navbar.php"; ?>
            <!-- navbar -->
            <main>
            <?php

                //get competitors
                $qry_get_data = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
                $do_get_data = mysqli_query($connection, $qry_get_data);

                if ($row = mysqli_fetch_assoc($do_get_data)) {
                    $json_string = $row['data'];
                    $json_table = json_decode($json_string);
                } else {
                    $json_table = [];
                }

                if(isset($_POST["reg_in"])){
                    $fencer_id = $_POST['fencer_ids'];
                    $id_to_change = findObject($json_table, $fencer_id, "id");

                    $json_table[$id_to_change] -> reg = 1;
                    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
                    $qry_update = "UPDATE `competitors` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
                    if (!$do_update = mysqli_query($connection, $qry_update)) {
                        echo mysqli_error($connection);
                    }
                }

                if(isset($_POST["reg_out"])){
                    $fencer_id = $_POST['fencer_ids'];
                    $id_to_change = findObject($json_table, $fencer_id, "id");

                    $json_table[$id_to_change] -> reg = false;
                    //update database
                    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
                    $qry_update = "UPDATE competitors SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
                    if (!$do_update = mysqli_query($connection, $qry_update)) {
                        echo mysqli_error($connection);
                    }
                }

                if(isset($_POST["add_fencer"])){

                    $n_fname = $_POST["fencer_name"];
                    $f_nat = $_POST["f_nat"];
                    $f_pos = $_POST["fencer_position"];


                    header("Refresh:0");
                }

            ?>
                <form id="title_stripe" method="POST" action="">
                    <p class="page_title">Registration</p>
                    <div class="stripe_button_wrapper">
                        <a class="stripe_button blue" href="registration_statistics.php?comp_id=<?php echo $comp_id; ?>" shortcut="SHIFT+S">
                            <p>Registration Statistics</p>
                            <img src="../assets/icons/pie_chart_black.svg"/>
                        </a>
                        <button type="button" class="stripe_button" id="addFencer" onclick="toggleAddFencerPanel()" shortcut="SHIFT+A">
                            <p>Add Fencer</p>
                            <img src="../assets/icons/person_add_alt_1_black.svg"/>
                        </button>
                        <button class="stripe_button red" onclick="" name="reg_out" id="regOut" type="submit" shortcut="SHIFT+O">
                            <p>Register out</p>
                            <img src="../assets/icons/how_to_unreg_black.svg"/>
                        </button>
                        <button class="stripe_button green" onclick="" name="reg_in" id="regIn" type="submit" shortcut="SHIFT+I">
                            <p>Register in</p>
                            <img src="../assets/icons/how_to_reg_black.svg"/>
                        </button>
                    </div>
                    <input type="text" class="hidden selected_list_item_input" name="fencer_ids" id="fencer_ids" value="">
                </form>
                <div id="add_fencer_panel" class="overlay_panel hidden">
                    <div class="overlay_panel_controls">
                        <button type="button" id="overlayPanelButtonLeft" onclick="leftButton()"><img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button"></button>
                        <p>Identification</p>
                        <button type="button" id="overlayPanelButtonRight" onclick="rightButton()"><img src="../assets/icons/arrow_forward_ios_black.svg"></button>
                        <p class="overlay_panel_controls_counter">3 / 3</p>
                    </div>
                    <button class="panel_button" onclick="toggleAddFencerPanel()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <!-- add fencers drop-down -->
                    <form action="registration.php?comp_id=<?php echo $comp_id ?>" method="post" id="new_fencer" autocomplete="off" class="overlay_panel_form" autocomplete="off">
                        <div class="overlay_panel_division visible" overlay_division_title="Identification">
                            <label for="referee_username">USERNAME</label>
                            <input type="text" placeholder="Type the referees's id" class="username_input" name="id" id="referee_username">
                            <label for="referee_firsname">FIRST NAME</label>
                            <input type="text" placeholder="Type the referees's first name" class="full_name_input" name="prenom" id="referee_firsname">
                            <label for="referee_lastname">LAST NAME</label>
                            <input type="text" placeholder="Type the referees's last name" class="full_name_input" name="nom" id="referee_lastname">
                        </div>
                        <div class="overlay_panel_division" overlay_division_title="Identification 2">
                            <label>SEX</label>
                            <div class="option_container row">
                                <input type="radio" name="sexe" id="male" value="m" />
                                <label for="male">Male</label>
                                <input type="radio" name="sexe" id="female" value="f" />
                                <label for="female">Female</label>
                            </div>
                            <label for="referee_dob">Date of Birth</label>
                            <input type="date" class="date_input" name="date_naissance" id="referee_dob">
                            <label for="referee_licence">License</label>
                            <input type="text" placeholder="Type the referees's license number" class="full_name_input" name="licence" id="referee_licence">
                            <label for="referee_image">Image link</label>
                            <input type="text" placeholder="Type in the link to the referee's image" class="full_name_input" name="image" id="referee_image">
                        </div>
                        <div class="overlay_panel_division" overlay_division_title="Categoriaztion">
                            <label for="set_club_input">Club</label>
                            <div class="search_wrapper wide higher">
                                <input type="text" name="nation" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="set_club_input" placeholder="Search Club by Name" class="search input">
                                <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close_black.svg"></button>
                                <div class="search_results">
                                <?php include "../includes/nations.php"; ?>
                                </div>
                            </div>
                            <label for="referee_categorie">Categorie</label>
                            <input type="text" placeholder="Type the referees's categorie" class="full_name_input" name="categorie" id="referee_categorie">
                            <label>Lateralite</label>
                            <div class="option_container row">
                                <input type="radio" name="lateralite" id="g" value="g"/>
                                <label for="g">Left</label>
                                <input type="radio" name="lateralite" id="d" value="d"/>
                                <label for="d">Right</label>
                            </div>
                            <label for="set_nation_input">NATION</label>
                            <div class="search_wrapper wide">
                                <input type="text" name="nation" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="set_nation_input" placeholder="Search Country by Name" class="search input">
                                <button type="button" class="clear_search_button" onclick=""><img src="../assets/icons/close_black.svg"></button>
                                <div class="search_results">
                                <?php include "../includes/nations.php"; ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="add_fencer" class="panel_submit">Save</button>
                    </form>
                </div>
                <div id="page_content_panel_main">

                    <div class="table wrapper">
                        <div class="table_header">
                            <div class="table_header_text">
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="serachInLists()" placeholder="Search by Name" class="search page">
                                        <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                NAME
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                            <div class="table_header_text">
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="serachInLists()" placeholder="Search by Nation" class="search page">
                                        <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                NATION
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                            <div class="table_header_text">
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="serachInLists()" placeholder="Search by Club" class="search page">
                                        <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                CLUB
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                            <div class="table_header_text">
                                <div class="search_panel option">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="serachInLists()" class="search page hidden">
                                        <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                    <div class="option_container">
                                        <input type="radio" name="status" id="a" value="Not registered"/>
                                        <label for="a">Not registered</label>
                                        <input type="radio" name="status" id="b" value="Registered"/>
                                        <label for="b">Registered</label>
                                        <button type="button" onclick="searchDelete(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                STATUS
                                <button type="button" onclick="searchButton(this)">
                                    <img src="../assets/icons/search_black.svg">
                                </button>
                            </div>
                            <div class="big_status_header"></div>
                        </div>
                        <div class="table_row_wrapper">
                        <?php

                        if (isset($json_table[0])) {

                            function cmp($a, $b) {
                                return strcmp($a->nation, $b->nation);
                            }

                            usort($json_table, "cmp");

                            foreach ($json_table as $json_object) {
                                $name = $json_object -> nom . " " . $json_object -> prenom;
                                $nat = $json_object -> nation;
                                $club = $json_object -> club;
                                $stat = $json_object -> reg;
                                $id = $json_object -> id;

                            ?>

                            <div class="table_row" id="<?php echo $id ?>" onclick="selectRow(this)" tabindex="0">
                                <div class="table_item"><p><?php echo $name ?></p></div>
                                <div class="table_item"><p><?php echo $nat ?></p></div>
                                <div class="table_item"><p><?php echo $club ?></p></div>
                                <div class="table_item"><p><?php if($stat == 0){echo "Not registered";}else{echo "Registered";} ?></p></div>
                                <div class="big_status_item <?php if($stat == 0){echo "red";}else{echo "green";} ?>"></div>
                            </div>
                            <?php
                            }
                        } else {
                            ?><p>No fencers set-up yet!</p><?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/registration.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/list_search.js"></script>
    <script src="../js/overlay_panel.js"></script>
</body>
</html>