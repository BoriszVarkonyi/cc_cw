<?php include "includes/get_comp_data.php"; ?>
<?php //include "./controllers/CompetitorController.php" ?>

<?php

$comp_id = $_GET["comp_id"];

$get_tourn_id = "SELECT ass_tournament_id FROM competitions WHERE comp_id = $comp_id";
$get_tourn_id_do = mysqli_query($connection, $get_tourn_id);

if ($row = mysqli_fetch_assoc($get_tourn_id_do)) {

    $t_id = $row["ass_tournament_id"];
}

$get_appointment_data = "SELECT * FROM tournaments WHERE id = $t_id";
$get_appointment_data_do = mysqli_query($connection, $get_appointment_data);

if ($row = mysqli_fetch_assoc($get_appointment_data_do)) {
    //json_decode($row['appointments']);
    $appointments = json_decode($row["appointments"]);
    $timetable_obj = json_decode($row['timetable']);
}
//var_dump($appointments->{'2022-02-24'}->{'10:00'});
if (isset($_POST['submit_form'])) {
    $day_flag = false;
	$go = true;
    foreach ($appointments as $key => $date) {

        if (isset($_POST["time_$key"])) {
			$day_flag = true;
			$start_time = $_POST["time_" . $key];
		}

        if (!$day_flag) continue;
        //if start date is found flag is raised to start changing values
        $flag = false;

        //number of values changed
        $n = 0;
        foreach ($date as $time => $item) {
            if ($n == $_POST['num_fencers']) break;
            if ($time == $start_time) $flag = true;
			if ($time == "min_fencer") $go = false;
			if ($flag) {
				if (is_array($item)) {
					echo "faszkivan";
					$go = false;
				}
			}

            if ($flag === true) {
                $appointments->$key->$time = array($_POST['f_nat'], $_POST['f_email'], false);
                $n++;
            }
        }
        if ($n == $_POST['num_fencers']) break;
    }


	if ($go) {
		$json_data = json_encode($appointments);
		$update_qry = "UPDATE `tournaments` SET `appointments` = '$json_data' WHERE `id` = $t_id";
		if (mysqli_query($connection, $update_qry)) {

		}
	} else {
		echo "szar van a palacsinatban";
		header("Location: /cw/book_appointment.php?comp_id=$comp_id&error=1");
		//header("Refresh: 0");
	}

    /*
    foreach($appointments as $date) {
        foreach($date as $value) {
            var_dump($value);
            echo "<br>";
        }
    }
    die();
    */
}
function dealWithTime($string, $whattogive)
{
    $array = explode(':', $string);

    if ($whattogive == "h") {
        return $array[0];
    } else if ($whattogive == "m") {
        return $array[1];
    } else {
        return null;
    }
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
                                        <input type="text" name="f_nat" onfocus="isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" placeholder="Search Country by Name" class="search input alt">
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

                            <?php
                            foreach ($appointments as $day => $value) {
                            ?>
                                <!-- ONE DAY -->
                                <div class="appointment_day" id="day_<?php echo $day ?>">
                                    <p><?php echo $day ?></p>
                                    <input type="date" name="current_day" value="<?php echo $day ?>" hidden readonly>
                                    <div class="search_wrapper wide">
                                        <input type="text" name="time_<?php echo $day ?>" onfocus="openTimes(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" placeholder="Select Time" class="search input alt selected_start_time_input">
                                        <button type="button" autocomplete="off" onclick=""><img src="../assets/icons/close_black.svg" alt="Close search"></button>
                                        <div class="search_results">
											<?php
												foreach ($value as $time => $array) {
													if ($time != "min_fencer" && !is_array($array)) {
											?>
                                            <a onclick="selectTime(this)"><?php echo $time ?></a>
											<?php
												}}
											?>
                                        </div>
                                    </div>
                                    <!-- min taken up by selexcted -->
                                    <input type="input" id="minferncer_<?php echo $day ?>" value="<?php echo $value->min_fencer ?>" class="minfencer_input" hidden readonly>
                                    <?php /*
                                    foreach ($appointments->$day as $time => $foo) {
                                        if (is_array($foo)) {
                                            if (isset($start)) {
                                                $end = $time;
                                                ?>

                                                <?php
                                                unset($start);
                                                unset($end);
                                            }
                                        } else {
                                            $start = $time;
                                        }
                                    } */ ?>
                                    <!-- ONE APPOINTMENT-->


                                    <div class="appointment_table">
                                        <?php
                                        $c = 0;
                                        foreach ($appointments->$day as $time => $foo) {
                                            $c++;
                                        }
                                        $c = $c - 1;
                                        reset($appointments->$day);
                                        $start_hour = dealWithTime($timetable_obj->{$day . "_st"}, "h");
                                        $end_hour = dealWithTime($timetable_obj->{$day . "_ed"}, "h");
                                        for ($hour = $start_hour; $hour < $end_hour; $hour++) {
                                        ?>
                                            <div class="appointment_row">
                                                <?php

                                                for ($minute = 0; $minute < 60; $minute += $value->min_fencer) {
                                                    if (strlen($minute) == 1) {
                                                        $foo = $minute;
                                                        $minute = 0 . $minute;
                                                    }
                                                    if (is_array($appointments->$day->{$hour . ":" . $minute})) {
                                                        $class = "red";
                                                    } else {
                                                        $class = "green";
                                                    }
                                                ?>
                                                    <div class="appointment <?php echo $class ?>">
                                                        <p><?php echo $hour . ":" . $minute ?></p>
                                                    </div>
                                                <?php
                                                }

                                                ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <!--
                                    <div class="appointment_wrapper">
                                        <input type="radio" name="appointments" id="appointment_1" value=""/>
                                        <label for="appointment_1">
                                            <div class="appointment" onclick="selectAppointment(this)">
                                                <p></p>
                                                <div>Choose</div>
                                            </div>
                                        </label>
                                        <div class="appointment_details hidden">
                                            <input type="time" name="time">
                                            <p> - 17:00</p>
                                            <p>ERROR</p>
                                        </div>
                                    </div>
                                -->


                                </div>
                            <?php } ?>
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