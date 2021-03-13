<?php include "../includes/db.php" ?>
<?php ob_start(); ?>

<?php

$t_id = $_GET["t_id"];

if (isset($_POST["save"])) {

    $get_timet_info = "SELECT * FROM tournaments WHERE id = $t_id";
    $get_timet_info_do = mysqli_query($connection, $get_timet_info);

    if ($row = mysqli_fetch_assoc($get_timet_info_do)) {

        $dates = json_decode($row["timetable"]);
    }

    $start_date = $_POST["start_date_input"];
    $end_date = $_POST["end_date_input"];
    $type_of_booking = $_POST["type_of_booking"];

    $dates->start_date = $start_date;
    $dates->end_date = $end_date;
    $dates->type_of_booking = $type_of_booking;

    $dates = json_encode($dates);

    $qry_update_dates = "UPDATE tournaments SET timetable = '$dates' WHERE id = $t_id";
    $qry_update_dates_do = mysqli_query($connection, $qry_update_dates);

    header("Location: tournament_timetable.php?t_id=$t_id");
}

if (isset($_POST["new_weapon_control"])) {

    $get_timet_info = "SELECT * FROM tournaments WHERE id = $t_id";
    $get_timet_info_do = mysqli_query($connection, $get_timet_info);

    if ($row = mysqli_fetch_assoc($get_timet_info_do)) {

        $appointments = json_decode($row["appointments"]);
    }

    $st = $_POST["st_t"];
    $ed = $_POST["ed_t"];
    $exact_date = $_POST["date_to_select"];
    $min_fencer = $_POST["min_fencer"];


    $period = new DatePeriod(

        new DateTime($st . ':00'),
        new DateInterval('PT1H'),
        new DateTime(date('H:i', strtotime($ed . ':00' . "+1 hours")))


    );

    foreach ($period as $key => $value) {

        $hourmin = $value->format('H:i');
        $appointments->$exact_date->$hourmin = new stdClass;

        //echo $value->format('H:i') . "<br>";
    }

    $appointments->$exact_date->min_fencer = $min_fencer;

    $appointments = json_encode($appointments);

    $qry_update_appointments = "UPDATE tournaments SET appointments = '$appointments' WHERE id = $t_id";
    $qry_update_appointments_do = mysqli_query($connection, $qry_update_appointments);

    header("Location: tournament_timetable.php?t_id=$t_id");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC Create Competition</title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/modal_style.min.css">
</head>
<body class="bg_fencers">
    <div class="modal_wrapper hidden" id="modal_1">
        <div class="modal simple">
            <div class="modal_header red">
                <p class="modal_title">Editing Tournament's starting date and ending date will remove all weapon control phrases</p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This change cannot be reverted.</p>
                <div class="modal_footer_content">
                    <button type="button" class="modal_decline_button" onclick="toggleModal(1)">Cancel</button>
                    <button type="submit" class="modal_confirmation_button">Okay</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
    <div id="create_competition_panel" class="panel">
        <div id="title_stripe">
            <p class="page_title">Tournament's Timetable</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button" onclick="location.href='choose_tournament.php'">
                    <p>Cancel</p>
                    <img src="../assets/icons/close-black-18dp.svg"/>
                </button>
                <button type="submit" name="save" form="tournament_timetable" class="stripe_button primary">
                    <p>Save</p>
                    <img src="../assets/icons/save-black-18dp.svg"/>
                </button>
                <button onclick="deployModal(, 'Cancel', 'Okay')">Modal</button>
            </div>
        </div>
        <div id="panel_main">
            <form id="tournament_timetable" class="form_wrapper" action="" method="POST">

                <?php

                $get_timet_info = "SELECT * FROM tournaments WHERE id = $t_id";
                $get_timet_info_do = mysqli_query($connection, $get_timet_info);


                if ($row = mysqli_fetch_assoc($get_timet_info_do)) {

                    $dates = json_decode($row["timetable"]);
                }

                $get_app_info = "SELECT * FROM tournaments WHERE id = $t_id";
                $get_app_info_do = mysqli_query($connection, $get_app_info);


                if ($row = mysqli_fetch_assoc($get_app_info_do)) {

                    $appointments = json_decode($row["appointments"]);
                }

                ?>

                <div>
                    <div>
                        <label for="">STARTING DATE</label>
                        <input type="date" class="start_date_input" name="start_date_input" value="<?php echo $dates->start_date; ?>">
                    </div>
                    <div>
                        <label for="">ENDING DATE</label>
                        <input type="date" class="end_date_input" name="end_date_input" value="<?php echo $dates->end_date; ?>">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="">TYPE OF APPOINTMENT BOOKING</label>
                        <div class="option_container">
                            <input type="radio" <?php if (isset($dates->type_of_booking) && $dates->type_of_booking == 'team') {
                                                    echo "checked";
                                                } ?> class="option_button" name="type_of_booking" id="teams" value="team"/>
                            <label for="teams">Book appointment as teams</label>
                            <input type="radio" <?php if (isset($dates->type_of_booking) && $dates->type_of_booking == 'fencer') {
                                                    echo "checked";
                                                } ?> class="option_button" name="type_of_booking" id="fencers" value="fencer"/>
                            <label for="fencers">Book appointment as fencers</label>
                        </div>
                    </div>
                    <div>
                        <button type="button" onclick="toggleWcPhase()" id="add_new_wc_button">Add New Weapon Control Phase</button>
                    </div>
                </div>
            </form>

            <form id="tournament_weapon_control" class="form_wrapper hidden" action="" method="POST">
                <div>
                    <div>
                        <label for="">DATE</label>
                        <div class="search_wrapper narrow">
                            <button type="button" class="search select input" tabindex="3">
                                <input type="text" name="date_to_select" placeholder="Select Date">
                            </button>
                            <button type="button"><img src="../assets/icons/arrow_drop_down-black-18dp.svg"></button>
                            <div class="search_results">

                                <?php

                                $period = new DatePeriod(

                                    new DateTime($dates->start_date),
                                    new DateInterval('P1D'),
                                    new DateTime(date('Y-m-d', strtotime($dates->end_date . "+1 days")))
                                );

                                foreach ($period as $key => $value) {

                                    if ($key == "min_fencer") {
                                        continue;
                                    }

                                    $checker = 0;

                                    $dateshow = $value->format('Y-m-d');

                                    if ($appointments != "") {

                                        foreach ($appointments as $keydate => $timevalue) {

                                            if ($keydate == $dateshow) {

                                                $checker++;
                                            }
                                        }
                                    }

                                    if ($checker == 0) {
                                ?>

                                        <button type="button" onclick="selectSystem(this)"><?php echo $dateshow; ?></button>

                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="">STARTING TIME</label>
                        <input type="time" class="" name="st_t" step="3600">
                    </div>
                    <div>
                        <label for="">ENDING TIME</label>
                        <input type="time" class="" name="ed_t" step="3600">
                    </div>
                    <div>
                        <label for="">MINUTE / FENCER</label>
                        <input type="number" class="number_input centered" placeholder="#" name="min_fencer" step="1" min="1">
                    </div>
                    <div class="row">
                        <button class="panel_submit secondary relative" type="button" onclick="toggleWcPhase()">Cancel</button>
                        <input type="submit" value="Add" class="panel_submit relative" name="new_weapon_control">
                    </div>
                </div>
            </form>
            <div class="table_wrapper" id="wc_phases_table">
                <label for="">WEAPON CONTROL PHASES</label>
                <div class="table full" id="wc_phrases_table">
                    <div class="table_header">
                        <div class="table_header_text">DATE</div>
                        <div class="table_header_text">STARTING TIME</div>
                        <div class="table_header_text">ENDING TIME</div>
                        <div class="table_header_text">MIN. / FENCER</div>
                    </div>
                    <div class="table_row_wrapper">

                        <?php

                        if ($appointments != "") {

                            foreach ($appointments as $keydate => $timevalue) {

                                if ($keydate == "min_fencer") {
                                    continue;
                                }

                        ?>
                                <div class="table_row">
                                    <div class="table_item"><?php echo $keydate ?></div>

                                    <?php

                                    $timearray = [];
                                    $valuearray = [];

                                    foreach ($timevalue as $keyvalue => $empty) {

                                        array_push($timearray, $keyvalue);
                                        array_push($valuearray, $empty);
                                    }
                                    ?>
                                    <div class="table_item"><?php echo $timearray[0]; ?></div>
                                    <div class="table_item"><?php echo $timearray[count($timearray) - 2]; ?></div>

                                    <div class="table_item"><?php echo end($valuearray) ?></div>
                                </div>
                        <?php
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>



            <?php

            if (isset($dates->start_date) && isset($dates->end_date) && isset($dates->type_of_booking)) {

            ?>
                <!--
                <form id="tournament_weapon_control" class="form_wrapper" action="" method="POST">
                    <div>
                        <div>
                            <label for="">DATE</label>
                            <div class="search_wrapper narrow">
                                <button type="button" class="search select input" tabindex="3">
                                    <input type="text" name="date_to_select" placeholder="Select Date">
                                </button>
                                <button type="button"><img src="../assets/icons/arrow_drop_down-black-18dp.svg"></button>
                                <div class="search_results">

                                    <?php

                                    $period = new DatePeriod(

                                        new DateTime($dates->start_date),
                                        new DateInterval('P1D'),
                                        new DateTime(date('Y-m-d', strtotime($dates->end_date . "+1 days")))
                                    );

                                    foreach ($period as $key => $value) {

                                        if ($key == "min_fencer") {
                                            continue;
                                        }

                                        $checker = 0;

                                        $dateshow = $value->format('Y-m-d');

                                        if ($appointments != "") {

                                            foreach ($appointments as $keydate => $timevalue) {

                                                if ($keydate == $dateshow) {

                                                    $checker++;
                                                }
                                            }
                                        }

                                        if ($checker == 0) {
                                    ?>

                                            <button type="button" onclick="selectSystem(this)"><?php echo $dateshow; ?></button>

                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="">STARTING TIME</label>
                            <input type="time" class="" name="st_t" step="">
                        </div>
                        <div>
                            <label for="">ENDING TIME</label>
                            <input type="time" class="" name="ed_t" step="">
                        </div>
                        <div>
                            <label for="">MINUTE / FENCER</label>
                            <input type="number" class="number_input centered" placeholder="#" name="min_fencer" step="">
                        </div>
                        <input type="submit" value="Add" class="panel_submit" name="new_weapon_control">
                    </div>
                </form>
                                -->
            <?php } ?>

        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/tournament_timetable.js"></script>
    <script src="../js/modal.js"></script>
</body>
</html>