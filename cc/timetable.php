<?php include "includes/db.php" ?>
<?php session_start();?>
<?php ob_start();?>

<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timetable</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Timetable</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="submit">
                        <p>Save Timetable</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main" class="no_scroll">
                <div id="set_wc_panel" class="overlay_panel_single hidden">
                    <button class="panel_button drag">
                        <img src="../assets/icons/drag_indicator_black.svg">
                    </button>
                    <button class="panel_button" onclick="closeWcPanel()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form class="overlay_panel_form table_row_wrapper" action="" method="POST" id="new_wc_day" autocomplete="off">
                        <p id="panel_text" class="panel_title"></p>
                        <input type="text" id="save_date" name="save_date" class="hidden">
                        <label for="wc_per_ten_min" class="centered">Estimated number of weapon controls done in 10 minutes</label>
                        <input type="number" class="number_input centered" placeholder="e.g. 8" id="wc_input" class="wc_input" name="wc_per_ten_min">

                        <div class="table_header">
                            <div class="table_header_text">STARTING TIME</div>
                            <div class="table_header_text">ENDING TIME</div>
                        </div>
                        <div class="table_row" id="table_row_1">
                            <div class="table_item" id="start_1"> <input type="number" name="wc_period_start_1"> <p>:00</p></div>
                            <div class="table_item" id="end_1"> <input type="number" name="wc_period_end_1"> <p>:00</p></div>
                        </div>
                        <input type="submit" name="add_period" value="Save" class="panel_submit">
                    </form>
                </div>
                <input type="text" id="dates_control_on" name="dates_control_on" class="hidden" value="">
                <div id="timetable_wrapper">
                    <div id="time_stripe">
                    <form action="" method="POST" id="calendar">
                    </form>
                        <button name="back" type="submit" form="calendar">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </button>
                        <div> <p></p> </div>
                        <button name="next" type="submit" form="calendar">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </button>
                    </div>
                    <div id="timetable_container">
                        <div id="timetable_header">
                            <div>Monday</div>
                            <div>Tuesday</div>
                            <div>Wednesday</div>
                            <div>Thursday</div>
                            <div>Friday</div>
                            <div>Saturday</div>
                            <div>Sunday</div>
                        </div>
                        <div id="timetable">
                        <div class="day">1</div>
                        <div class="day">2</div>
                        <div class="day">3</div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/overlay_panel.js"></script>
</body>
</html>