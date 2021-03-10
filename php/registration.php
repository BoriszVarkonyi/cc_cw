<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>
<body>
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
        <div id="flexbox_container">
            <?php include "../includes/navbar.php"; ?>
            <!-- navbar -->
        <div class="page_content_flex">
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

            $json_table[$id_to_change] -> reg = 0;
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
                        <button type="button" class="stripe_button" id="addFencer" onclick="toggleAddFencerPanel()" shortcut="SHIFT+A">
                            <p>Add Fencer</p>
                            <img src="../assets/icons/person_add_alt_1-black-18dp.svg"/>
                        </button>
                        <button class="stripe_button red" onclick="" name="reg_out" id="regOut" type="submit" shortcut="SHIFT+O">
                            <p>Register out</p>
                            <img src="../assets/icons/how_to_unreg-black-18dp.svg"/>
                        </button>
                        <button class="stripe_button green" onclick="" name="reg_in" id="regIn" type="submit" shortcut="SHIFT+I">
                            <p>Register in</p>
                            <img src="../assets/icons/how_to_reg-black-18dp.svg"/>
                        </button>
                    </div>
                    <input type="text" class="hidden selected_list_item_input" name="fencer_ids" id="fencer_ids" value="">
                    <div class="search_wrapper">
                        <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" placeholder="Search by Name" class="search page" id="inputs">
                        <button type="button"><img src="../assets/icons/close-black-18dp.svg"></button>
                        <div class="search_results">
                            <?php
                            foreach ($json_table as $json_object) {
                                $name = $json_object -> nom . " " .  $json_object -> prenom;
                                $id = $json_object -> id;

                                ?>
                                <a id="<?php echo $id ?>A" href="#<?php echo $id ?>" onclick="selectSearch(this), autoFill(this)" tabindex="1"><?php echo $name ?></a>
                                <?php
                            }
                                ?>
                        </div>
                    </div>

                </form>
                <div id="add_fencer_panel" class="overlay_panel hidden">
                            <button class="panel_button" onclick="toggleAddFencerPanel()">
                                <img src="../assets/icons/close-black-18dp.svg">
                            </button>
                            <!-- add fencers drop-down -->
                            <form action="registration.php?comp_id=<?php echo $comp_id ?>" method="post" id="new_fencer" autocomplete="off" class="overlay_panel_form" autocomplete="off">
                                <label for="fencers_name">NAME</label>
                                <input type="text" placeholder="Type the fencers's name" class="username_input" name="fencer_name">
                                <label for="fencers_nationality">NATION / CLUB</label>
                                <div class="search_wrapper wide">
                                    <input type="text" name="f_nat" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" placeholder="Search Country by Name" class="search input" id="nationInput">
                                    <button type="button" onclick=""><img src="../assets/icons/close-black-18dp.svg"></button>
                                    <div class="search_results">
                                        <?php include "../includes/nations.php"; ?>
                                    </div>
                                </div>
                                <label for="fencers_points">POSITION</label>
                                <input type="number" placeholder="##" id="ranking_points" class="number_input centered" name="fencer_position">
                                <button type="submit" name="add_fencer" class="panel_submit">Save</button>
                            </form>
                        </div>
                <div id="page_content_panel_main">

                    <div class="table wrapper">
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)"></button>
                            <div class="table_header_text">NATION / CLUB</div>
                            <button class="resizer"></button>
                            <div class="table_header_text">STATUS</div>
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
                                $stat = $json_object -> reg;
                                $id = $json_object -> id;

                            ?>

                            <div class="table_row" id="<?php echo $id ?>" onclick="selectRow(this)" tabindex="0">
                                <div class="table_item"><p><?php echo $name ?></p></div>
                                <div class="table_item"><p><?php echo $nat ?></p></div>
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
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/registration.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/overlay_panel.js"></script>
</body>
</html>