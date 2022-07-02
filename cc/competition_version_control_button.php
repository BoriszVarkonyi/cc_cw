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

    function moveAheadCompetition($conn, $comp_id, $comp_status) {
        $temp = $comp_status + 1;
        $qry_upadte_competition = "UPDATE competitions SET comp_status = '$temp' WHERE comp_id = '$comp_id'";
        if (!$do_update_competition = mysqli_query($conn, $qry_upadte_competition)) {
            echo mysqli_error($conn);
        } else {
            echo "miafasz";
        }
        header("Refresh: 0");
    }

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



?>
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

    <!-- HTML CONTENT -->


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