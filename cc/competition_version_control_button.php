<?php

//ADVANCEMENT BRANCH
    $ok_advance = true;
    switch ($comp_status) {
        case 1:
            $qry_get_basic = "SELECT data FROM basic_info WHERE assoc_comp_id = '$comp_id'";
            $do_get_basic = mysqli_query($connection, $qry_get_basic);
            if ($row = mysqli_fetch_assoc($do_get_basic)) {
                $data_string = $row['data'];
                if (!$data_string) {
                    $ok_advance = false;
                }
            } else {
                $ok_advance = false;
            }

            $qry_get_fencer = "SELECT comp_info, comp_equipment FROM competitions WHERE comp_id = '$comp_id'";
            $do_get_fencer =  mysqli_query($connection, $qry_get_fencer);
            if ($row = mysqli_fetch_assoc($do_get_fencer)) {
                $data_string = $row['comp_info'];
                $comp_equipment = $row['comp_equipment'];
                if (!$data_string) {
                    $ok_advance = false;
                }
                    for ($i = 0; $i < $comp_equipment; $i+=2) {
                        $sum = 0;
                        if ($comp_equipment[$i] != 0) {
                            $sum += $comp_equipment[$i];
                        }
                    }
                    if ($sum == 0) {
                        $ok_advance = false;
                    }
                } else {
                    $ok_advance = false;
                }
                break;
        case 2:
            $qry_get_formula = "SELECT data FROM formulas WHERE assoc_comp_id = '$comp_id'";
            if (false === $do_get_formula = mysqli_query($connection, $qry_get_formula)) {
                $ok_advance = false;
                echo mysqli_error($connection);
            }

            $qry_get_competitors = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
            if (false === $do_get_competitors = mysqli_query($connection, $qry_get_competitors)) {
                $ok_advance = false;
                echo 2;
            }

            if (!$is_individual) {
                $qry_get_teams = "SELECT data FROM teams WHERE assoc_comp_id = '$comp_id'";
                if (false === $do_get_teams = mysqli_query($connection, $qry_get_teams)) {
                    $ok_advance = false;
                    echo 3;
                }
            }
        break;
        case 3:
        $qry_get_competitors = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
        $do_get_competitors = mysqli_query($connection, $qry_get_competitors);
        if ($row = mysqli_fetch_assoc($do_get_competitors)) {
                $compet_string = $row['data'];
                $compet_table = json_decode($compet_string);
                if ($compet_table[0] -> final_rank == null) {
                    $ok_advance = false;
                }
        }
        break;
    }

    //advance competition status
    if (isset($_POST['submit_stat'])) {
        $temp_cs = $comp_status + 1;
        $qry_upadte_competition = "UPDATE competitions SET comp_status = '$temp_cs' WHERE comp_id = '$comp_id'";
        if (!$do_update_competition = mysqli_query($connection, $qry_upadte_competition)) {
            echo mysqli_error($connection);
        } else {
            echo "failed to advance the competition";
        }
        header("Refresh: 0");
    }

//RETRACTION BRANCH

    //DELETE COMPETITION
    if (isset($_POST['submit_stat_delete'])) {

        $qry_delete["announcements"] = "DELETE FROM announcements WHERE assoc_comp_id = $comp_id";
        $qry_delete["basic_info"] = "DELETE FROM basic_info WHERE assoc_comp_id = $comp_id";
        $qry_delete["call_room_wc"] = "DELETE FROM call_room_wc WHERE assoc_comp_id = $comp_id";
        $qry_delete["competitions"] = "DELETE FROM competitions WHERE comp_id = $comp_id";
        $qry_delete["competitors"] = "DELETE FROM competitors WHERE assoc_comp_id = $comp_id";
        $qry_delete["formula"] = "DELETE FROM formula WHERE assoc_comp_id = $comp_id";
        $qry_delete["pistes"] = "DELETE FROM pistes WHERE assoc_comp_id = $comp_id";
        $qry_delete["plus_info"] = "DELETE FROM plus_info WHERE assoc_comp_id = $comp_id";
        $qry_delete["pools"] = "DELETE FROM pools WHERE assoc_comp_id = $comp_id";
        $qry_delete["referees"] = "DELETE FROM referees WHERE assoc_comp_id = $comp_id";
        $qry_delete["tables"] = "DELETE FROM tables WHERE assoc_comp_id = $comp_id";
        $qry_delete["teams"] = "DELETE FROM teams WHERE assoc_comp_id = $comp_id";
        $qry_delete["technicians"] = "DELETE FROM technicians WHERE assoc_comp_id = $comp_id";
        $qry_delete["weapon_control"] = "DELETE FROM weapon_control WHERE assoc_comp_id = $comp_id";

        $flag = false;
        foreach ($qry_delete as $table_name => $qry) {
            $qry_do = mysqli_query($connection, $qry);
            if ($qry_do === false) {
                $flag = true;
                echo "<br><br> <b>problem with deleting from: " . $table_name . " ERROR: " . mysqli_error($connection) . "</b><br><br>";
            } else {
                echo "Deleted all rows associated with competition from:    " . $table_name . "<br>";
            }
        }
        /*
        if ($flag) {
            echo "Deletion was <b>NOT</b> successful, check log or contact support!";
        } else {
            echo "Deletion was successful!";
            header("Refresh: 0");
        }
        */
        header("Refresh: 0");
    }

    //2 >> 1
    if (isset($_POST['retract_to_scheduled'])) {
        $qry_delete["competitors"] = "DELETE FROM competitors WHERE assoc_comp_id = $comp_id";
        $qry_delete["pools"] = "DELETE FROM pools WHERE assoc_comp_id = $comp_id";
        $qry_delete["tables"] = "DELETE FROM tables WHERE assoc_comp_id = $comp_id";
        $qry_delete["teams"] = "DELETE FROM teams WHERE assoc_comp_id = $comp_id";
        $flag = false;
        foreach ($qry_delete as $table_name => $qry) {
            $qry_do = mysqli_query($connection, $qry);
            if ($qry_do === false) {
                $flag = true;
                echo "<br><br> <b>problem with deleting from: " . $table_name . " ERROR: " . mysqli_error($connection) . "</b><br><br>";
            } else {
                echo "Deleted all rows associated with competition from:    " . $table_name . "<br>";
            }
        }
        //change competition status
        $temp_cs = $comp_status - 1;
        $qry_change_status = "UPDATE competitions SET comp_status = '$temp_cs' WHERE comp_id = '$comp_id'";
        if (!$do_change_status = mysqli_query($connection, $qry_change_status)) {
            echo mysqli_error($connection);
            $flag = true;
        }
        /*
        if ($flag) {
            echo "Deletion was <b>NOT</b> successful, check log or contact support!";
        } else {
            echo "Deletion was successful!";
            header("Refresh: 0");
        }
        */

        header("Refresh: 0");
    }

    // 3 >> 2
    if (isset($_POST['retract_to_published'])) {
        //null info for fencers
        $qry_null_info = "UPDATE competitions SET comp_info = '', comp_equipment = '' WHERE comp_id = '$comp_id'";
        $do_null_info = mysqli_query($connection, $qry_null_info);
        //null pool mathces
        $qry_null_pool_matches = "UPDATE pools SET matches = null WHERE assoc_comp_id = '$comp_id'";
        $do_null_pool_matches = mysqli_query($connection, $qry_null_pool_matches);
        //change competition status
        $temp_cs = $comp_status - 1;
        $qry_change_status = "UPDATE competitions SET comp_status = '$temp_cs' WHERE comp_id = '$comp_id'";
        if (!$do_change_status = mysqli_query($connection, $qry_change_status)) {
            echo mysqli_error($connection);
        }
        header("Refresh: 0");
    }
?>

<!-- Pop-up Modals Advancement -->
    <form method="POST" id="submit_next"></form>
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
                    <button form="submit_next" name="submit_stat" type="submit" class="modal_confirmation_button">Publish</button>
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
                    <button form="submit_next" name="submit_stat" type="submit" class="modal_confirmation_button">Start</button>
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
                    <button form="submit_next" name="submit_stat" type="submit" class="modal_confirmation_button">Finish</button>
                </form>
            </div>
        </div>
    </div>
<!-- Pop-up Modals Retracment -->

        <!-- 1 >> x -->
        <div class="modal_wrapper hidden" id="modal_4">
        <div class="modal">
            <div class="modal_header primary">
                <p class="modal_title">Do you want to DELETE this competition?</p>
                <p class="modal_subtitle">The Competition will be irretrievably lost!</p>
            </div>
            <div class="modal_main">
                <p class="modal_main_title margin_bottom big">All information about the Competition will be lost!</p>
                <p class="modal_main_title margin_bottom big">All setting will be lost!</p>
                <p class="modal_main_title big"></p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This change cannot be undone.</p>
                <form class="modal_footer_content">
                    <button type="button" class="modal_decline_button" onclick="toggleModal(4)">Cancel</button>
                    <button form="submit_next" name="submit_stat_delete" type="submit" class="modal_confirmation_button">Delete Competition</button>
                </form>
            </div>
        </div>
    </div>

    <!-- 2 >> 1 -->
    <div class="modal_wrapper hidden" id="modal_5">
            <div class="modal">
                <div class="modal_header primary">
                    <p class="modal_title">Do you want to retract this competition to a previous phase? (Scheduled)</p>
                    <p class="modal_subtitle">Changes made in the current status will be deleted!</p>
                </div>
                <div class="modal_main">
                    <p class="modal_main_title margin_bottom big">Data associated with Competitors, Pools, Temporary Ranking, Table, Overview will be deleted!</p>
                    <p class="modal_main_title margin_bottom big">You will be able to rewrite data in: Basic information, Information for fencers, and Invitation.</p>
                    <p class="modal_main_title big">Fencers can no longer use pre-Registration, and Weapon Control!</p>
                </div>
                <div class="modal_footer">
                    <p class="modal_footer_text">This change cannot be undone.</p>
                    <form class="modal_footer_content">
                        <button type="button" class="modal_decline_button" onclick="toggleModal(5)">Cancel</button>
                        <button form="submit_next" name="retract_to_scheduled" type="submit" class="modal_confirmation_button">Retract to Scheduled!</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3 >> 2 -->
        <div class="modal_wrapper hidden" id="modal_6">
            <div class="modal">
                <div class="modal_header primary">
                    <p class="modal_title">Do you want to retract this competition to a previous phase? (Published)</p>
                    <p class="modal_subtitle">Changes made in the current status will be deleted!</p>
                </div>
                <div class="modal_main">
                    <p class="modal_main_title margin_bottom big">Information set in: Information for Fencers, and Pool matches will be deleted.</p>
                    <p class="modal_main_title margin_bottom big">You will no longer be able to change info. for Fencers and pool matches data.</p>
                </div>
                <div class="modal_footer">
                    <p class="modal_footer_text">This change cannot be undone.</p>
                    <form class="modal_footer_content">
                        <button type="button" class="modal_decline_button" onclick="toggleModal(6)">Cancel</button>
                        <button form="submit_next" name="retract_to_published" type="submit" class="modal_confirmation_button">Retract to Published</button>
                    </form>
                </div>
            </div>
        </div>
<!-- BUTTONS Retractment -->

<?php
        switch ($comp_status) {
            case 1:
    ?>

    <!-- DELETE COMPETITION (1) >> (x) -->
    <div class="stripe_button_wrapper ">
        <button name="submit_stat1" class="stripe_button primary" onclick="toggleModal(4)">
            <p>Delete Competition</p>
            <img src="../assets/icons/publish_black.svg"/>
        </button>
    </div>
    <?php
                break;
            case 2:
    ?>

    <!-- RETRACT TO SCHEDULED COMPETITION (2) >> (1) -->
    <div class="stripe_button_wrapper">
        <button name="submit_stat2" class="stripe_button primary" onclick="toggleModal(5)">
            <p>Retract Competition to Scheduled</p>
            <img src="../assets/icons/flag_black.svg"/>
        </button>
    </div>
    <?php
                break;
            case 3:
    ?>

    <!-- RETRACT TO PUBLISHED COMPETITION (3) >> (2) -->
    <div class="stripe_button_wrapper">
        <button name="submit_stat3" class="stripe_button primary" onclick="toggleModal(6)">
            <p>Retract Competition to Published</p>
            <img src="../assets/icons/outlined_flag_black.svg"/>
        </button>
    </div>
    <?php
            break;
        }
    ?>


<!-- BUTTONS Advancement -->

    <?php
        switch ($comp_status) {
            case 1:
    ?>

    <!-- PUBLISH COMPETITION (1) >> (2) -->
    <div class="stripe_button_wrapper ">
        <button name="submit_stat1" class="stripe_button primary <?php echo $ok_advance ? "" : "disabled"; ?>" onclick="toggleModal(1)">
            <p>Publish Competition</p>
            <img src="../assets/icons/publish_black.svg"/>
        </button>
    </div>
    <?php
                break;
            case 2:
    ?>

    <!-- START COMPETITION (2) >> (3) -->
    <div class="stripe_button_wrapper">
        <button name="submit_stat2" class="stripe_button primary <?php echo $ok_advance ? "" : "disabled"; ?>" onclick="toggleModal(2)">
            <p>Start Competition</p>
            <img src="../assets/icons/flag_black.svg"/>
        </button>
    </div>
    <?php
                break;
            case 3:
    ?>

    <!-- FINISH COMPETITION (3) >> (4) -->
    <div class="stripe_button_wrapper">
        <button name="submit_stat3" class="stripe_button primary <?php echo $ok_advance ? "" : ""; ?>" onclick="toggleModal(3)">
            <p>Finish Competition</p>
            <img src="../assets/icons/outlined_flag_black.svg"/>
        </button>
    </div>
    <?php
            break;
        }
    ?>