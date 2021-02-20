<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

$comp_id = $_GET["comp_id"];

$get_tourn_id = "SELECT * FROM competitions WHERE comp_id = $comp_id";
$get_tourn_id_do = mysqli_query($connection, $get_tourn_id);

if ($row = mysqli_fetch_assoc($get_tourn_id_do)) {

    $t_id = $row["ass_tournament_id"];
}

$get_appointment_data = "SELECT * FROM tournaments WHERE id = $t_id";
$get_appointment_data_do = mysqli_query($connection, $get_appointment_data);

if ($row = mysqli_fetch_assoc($get_appointment_data_do)) {

    $appointments = json_decode($row["appointments"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pre-Register for <?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>

<body class="competitions">
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">
                    <button type="button" class="back_button" onclick="window.history.back();">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                    </button>
                    Book Appointment for Weapon Control of {Comp's name}
                </p>
            </div>
            <div id="confirmation" class="disabled">
                <div>
                    <button class="panel_button" onclick="toggle_add_technician()">
                        <img src="../assets/icons/close-black-18dp.svg" onclick="closeConf()">
                    </button>
                    <p>Are you sure you want to send this Pre-Registration with these informations?</p>
                    <label>COUNTRY / FENCING CLUB:</label>
                    <p>BEBGUWE</p>
                    <label>FEDERATION'S OFFICAL EMAIL ADDRESS:</label>
                    <p>BEBGUWE</p>
                    <label>NUMBER OF FENCERS:</label>
                    <p>7</p>
                    <label>SELECTED APPOINTMENT:</label>
                    <p>2014.05.07 14:20</p>
                    <button type="submit" name="send_pre" class="send_button" form="content_wrapper" value="Send">Send</button>
                </div>
            </div>
            <form id="content_wrapper" method="POST" action="process_pre.php">
                <p class="column_title centered">Needed Information: (STEP 1 / 2)</p>
                <div id="step1" class="column_panel no_top">
                    <div>
                        <div class="form_wrapper">
                            <div>
                                <div>
                                    <label>COUNTRY / FENCING CLUB:</label>
                                    <div class="search_wrapper wide">
                                        <input type="text" name="f_nat" onfocus="resultChecker(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search Country by Name" class="search input alt">
                                        <button type="button" onclick=""><img src="../assets/icons/close-black-18dp.svg"></button>
                                        <div class="search_results">
                                            <?php include "../includes/nations.php"; ?>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label>FEDERATION'S OFFICAL EMAIL ADDRESS:</label>
                                    <input type="email" name="f_email" placeholder="Type in the email address" class="email_input alt">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label>NUMBER OF FENCERS:</label>
                                    <input type="number" name="c_phone" class="number_input centered alt" placeholder="#" id="fencerNumber">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="column_title centered">SELECT A SUITABLE APPOINTMENT (STEP 2 / 2)</p>
                <div class="column_panel no_top collapsed" id="step2">
                    <div class="column">
                        <b>Available times:</b>
                        <div id="availabe_times_wrapper">
                            <?php

                            if ($appointments != "") {
                                foreach ($appointments as $datekey => $dates) {

                            ?>
                                    <div>
                                        <p minperfencer="<?php echo $dates->min_fencer ?>"><?php echo str_replace("-", " ", $datekey)  ?></p>

                                        <?php



                                        foreach ($dates as $hourkeys => $hours) {

                                            if ($hourkeys == "min_fencer") {
                                                continue;
                                            }

                                            $allfencersin = 0;

                                            foreach ($hours as $innerdata) {

                                                $allfencersin += $innerdata->fencer;
                                            }

                                            $talkentime = $allfencersin * $dates->min_fencer;
                                            $minsleft = 60 - $talkentime;

                                            $starttime = $hourkeys;
                                            $availtime = strtotime("+$talkentime minutes", strtotime($starttime));

                                            $selectedTime = $hourkeys;
                                            $endTime = strtotime("+1 hours", strtotime($selectedTime));


                                        ?>
                                            <div class="appointment_wrapper" minsleft="<?php echo $minsleft ?>">
                                                <input type="radio" name="appointments" id="appointment1" value="" />
                                                <label for="appointment1">
                                                    <div class="appointment" onclick="selectAppointment(this)">
                                                        <p><?php echo date('H:i', $availtime); ?> - lasts approximately &nbsp</p>
                                                        <p class="minute"></p>
                                                        <p>&nbsp minutes</p>
                                                        <div>Choose</div>
                                                    </div>
                                                </label>
                                            </div>
                                        <?php
                                        }

                                        ?>
                                    </div>

                            <?php
                                }
                            }
                            ?>






                            <!-- <input type="radio" name="appointments" id="appointment2" value="" />
                            <label for="appointment2">
                                <div class="appointment" onclick="selectAppointment(this)">
                                    <p>11:00 - 12:00</p>
                                    <div>Choose</div>
                                </div>
                            </label>


                            <input type="radio" name="appointments" id="appointment3" value="" />
                            <label for="appointment3">
                                <div class="appointment" onclick="selectAppointment(this)">
                                    <p>11:00 - 12:00</p>
                                    <div>Choose</div>
                                </div>
                            </label>
                            <input type="radio" name="appointments" id="appointment4" value="" />
                            <label for="appointment4">
                                <div class="appointment" onclick="selectAppointment(this)">
                                    <p>11:00 - 12:00</p>
                                    <div>Choose</div>
                                </div>
                            </label>



                            <p>DATE 2</p>
                            <input type="radio" name="appointments" id="appointment5" value="" />
                            <label for="appointment5">
                                <div class="appointment" onclick="selectAppointment(this)">
                                    <p>11:00 - 12:00</p>
                                    <div>Choose</div>
                                </div>
                            </label>
 -->


                        </div>
                    </div>
                </div>
                <div class="send_panel">
                    <button type="button" onclick="openConf()" class="send_button">Send Appointment Booking</button>
                </div>
            </form>
        </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/cw_book_appointment.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>