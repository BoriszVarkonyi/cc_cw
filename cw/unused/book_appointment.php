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
    <title>Book Appointment for Weapon Control of</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>

<body class="competitions">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href="competition.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    Book Appointment for Weapon Control of
                </h1>
            </div>
            <div class="modal_wrapper hidden" id="modal_1">
                <div class="modal">
                    <div class="modal_header primary">
                        <p class="modal_title">Are you sure you want to send Weapon Control appointment booking with the following information?</p>
                        <p class="modal_subtitle">Please recheck the informations you given before submitting!</p>
                    </div>
                    <div class="modal_main">
                        <p class="modal_main_title big primary margin_bottom">Competition you selected:</p>
                        <p class="modal_paragraph">compname</p>
                        <p class="modal_paragraph">compname</p>
                        <p class="modal_main_title big primary margin_bottom">Information you given:</p>
                        <p class="modal_main_title">FEDERATION'S NAME</p>
                        <p class="modal_paragraph">FED NAME</p>
                        <p class="modal_main_title">COUNTRY / FENCING CLUB</p>
                        <p class="modal_paragraph">GER</P>
                        <p class="modal_main_title">FEDERATION'S OFFICAL EMAIL ADDRESS</p>
                        <p class="modal_paragraph">g</p>
                        <p class="modal_main_title">FEDERATION'S PHONE NUMBER</p>
                        <p class="modal_paragraph">grg</p>
                        <p class="modal_main_title">CONTACT KEEPER'S FULL NAME</p>
                        <p class="modal_paragraph">grg</p>
                        <p class="modal_main_title">CONTACT KEEPER'S EMAIL ADDRESS</p>
                        <p class="modal_paragraph">grg</p>
                        <p class="modal_main_title">CONTACT KEEPER'S PHONE NUMBER</p>
                        <p class="modal_paragraph">grg</p>
                        <p class="modal_main_title big primary margin_bottom">Fencers you selected:</p>
                        <p class="modal_paragraph">grg</p>
                        <p class="modal_paragraph">grg</p>
                        <p class="modal_paragraph">grg</p>
                        <p class="modal_paragraph">grg</p>
                    </div>
                    <div class="modal_footer">
                        <p class="modal_footer_text">This change cannot be undone.</p>
                        <div class="modal_footer_content">
                            <button class="modal_decline_button" onclick="toggleModal(1)">Go back</button>
                            <button type="submit" form="" class="modal_confirmation_button">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <form id="content_wrapper" method="POST" action="process_pre.php">
                <p class="column_title centered">Needed Information: (STEP 1 / 2)</p>
                <div id="step1" class="column_panel no_top">
                    <div>
                        <div class="form_wrapper">
                            <div>
                                <div>
                                    <label>COUNTRY / FENCING CLUB</label>
                                    <div class="search_wrapper wide">
                                        <input type="text" name="f_nat" onblur="isClosed(this)" onkeyup="searchEngine(this)" id="inputs" placeholder="Search Country by Name" class="search input alt">
                                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close search"></button>
                                        <div class="search_results">
                                            <?php include "../includes/nations.php"; ?>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label>FEDERATION'S OFFICAL EMAIL ADDRESS</label>
                                    <input type="email" name="f_email" placeholder="Type in the email address" class="email_input alt">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label>NUMBER OF FENCERS</label>
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
                                                <input type="radio" name="appointments" id="appointment1" value=""/>
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
                        </div>
                    </div>
                </div>
                <div class="send_panel">
                    <button type="button" onclick="toggleModal(1)" class="send_button">Send Appointment Booking</button>
                </div>
            </form>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/cw_book_appointment.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/controls.js"></script>
</body>
</html>