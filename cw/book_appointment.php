<?php include "includes/get_comp_data.php"; ?>
<?php include "./controllers/CompetitorController.php" ?>

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

if(isset($_POST['submit_form']) ) {
    var_dump($_POST);

    //for some reason I cannot get the selected start time from $_POST
    $start_time = '12:00';

    //loop through every day because it's not in $_POST
    foreach($appointments as $key => $date) {
        //if start date is found flag is raised to start changing values
        $flag = false;
        //number of values changed (CURRENTLY REPLACES EVERY VALUE WHICH IS NOT ACCEPTABLE)
        $n = 0;
        foreach($date as $time => $item) {
            if($n == $_POST['num_fencers']) break;
            if($time == $start_time) $flag = true;

            if($flag === true) {
                $appointments->$key->$time = $_POST['f_nat'];
                $n++;
            }
        }
        if($n == $_POST['num_fencers']) break;
    }

    foreach($appointments as $date) {
        foreach($date as $value) {
            var_dump($value);
            echo "<br>";
        }
    }
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Weapon Control Appointemnts</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
</head>

<body class="competitions">
    <div class="modal_wrapper hidden" id="modal_1">
        <div class="modal">
            <div class="modal_header primary">
                <p class="modal_title">Are you sure you want to send Weapon Control appointment booking with the following information?</p>
                <p class="modal_subtitle">Please recheck the informations you given before submitting!</p>
            </div>
            <div class="modal_main">
                <p class="modal_main_title big primary margin_bottom">Competition you selected:</p>
                <p class="modal_paragraph">compname</p>
                <p class="modal_paragraph">comp date</p>
                <p class="modal_paragraph">w type</p>
                <p class="modal_paragraph">w type</p>
                <p class="modal_main_title big primary margin_bottom">Information you given:</p>
                <p class="modal_main_title">FEDERATION'S NAME</p>
                <p class="modal_paragraph">FED NAME</p>
                <p class="modal_main_title">FEDERATION'S OFFICAL EMAIL ADDRESS</p>
                <p class="modal_paragraph">g</p>
                <p class="modal_main_title">NUMBER OF FENCERS</p>
                <p class="modal_paragraph">grg</p>
            </div>
            <div class="modal_footer">
                <p class="modal_footer_text">This change cannot be undone.</p>
                <div class="modal_footer_content">
                    <button class="modal_decline_button" onclick="toggleModal(1)">Go back</button>
                    <button type="submit" form="" class="">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href="competition.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    Book Weapon Control Appointments for <?php echo $comp_name ?>
                </h1>
            </div>
            <form id="content_wrapper" method="POST" action="">
                <p class="column_title centered">Needed Information: (STEP 1 / 2)</p>
                <div id="step1" class="column_panel no_top">
                    <div>
                        <div class="form_wrapper">
                            <div>
                                <div>
                                    <label>COUNTRY / FENCING CLUB</label>
                                    <div class="search_wrapper wide">
                                        <input type="text" name="f_nat" onblur="isClosed(this)" onkeyup="searchEngine(this)" placeholder="Search Country by Name" class="search input alt">
                                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close search"></button>
                                        <div class="search_results">
                                            <?php include "../cc/includes/nations.php"; ?>
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
                                    <input type="number" name="num_fencers" class="number_input centered alt" placeholder="#" id="fencerNumber">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button>Go back</button>
                <button>Next step</button>
                <p class="column_title centered">SELECT A SUITABLE APPOINTMENT (STEP 2 / 2)</p>
                <div class="column_panel no_top collapsed" id="step2">
                    <div class="column">
                        <b>Available times:</b>
                        <div id="availabe_times_wrapper">

                            <!-- min taken up by selexcted -->
                            <input type="hidden" id="minperfencer" value="">

                            <!-- ONE DAY -->
                            <div>
                                <p>2022/04/20</p>

                                <!-- ONE APPOINTMENT -->
                                <div class="appointment_wrapper">
                                    <input type="radio" name="appointments" id="appointment" value=""/>
                                    <label for="appointment">
                                        <div class="appointment" onclick="selectAppointment(this)">
                                            <p>12:00 - 17:00</p>
                                            <div>Choose</div>
                                        </div>
                                    </label>
                                    <div class="appointment_details hidden">
                                        <input type="time" name="time">
                                        <p> - 17:00</p>
                                        <p>ERROR</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="send_panel">
                    <button type="submit" name="submit_form">Submit button working</button>
                    <button type="button" onclick="toggleModal(1)" class="send_button">Send Appointment Booking</button>
                </div>
            </form>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/book_appointment_2.js"></script>
    <script src="../cc/javascript/search.js"></script>
    <script src="../cc/javascript/modal.js"></script>
</body>
</html>