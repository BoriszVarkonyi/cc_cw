<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$year = $_COOKIE["year"];
$month = $_COOKIE["month"];

if(strlen($month) == 2){

    $monthid = $month;

}else{

    $monthid = "0" . "$month";

}

buildCalendar($month, $year);

function buildCalendar($monthin, $yearin){

    $firstdayofmonth = mktime(0,0,0,$monthin,1,$yearin);
    global $numberdays;
    $numberdays = date("t",$firstdayofmonth);
    $datecomponents = getdate($firstdayofmonth);
    global $monthname;
    $monthname = $datecomponents["month"];
    global $dayofweek;
    $dayofweek = $datecomponents["wday"];
    
    
    }


$query = "SELECT * FROM competitions WHERE comp_id = $comp_id";
$query_do = mysqli_query($connection, $query);

if($row = mysqli_fetch_assoc($query_do)){

$startdate = $row["comp_start"];
$enddate = $row["comp_end"];

}
setcookie("comp_start",$startdate,time()+31556926);
setcookie("comp_end",$enddate,time()+31556926);

if(isset($_POST["back"])){


    if($month == 1){

        $year--;
        $month = 13;

        }

    $monthnew = $month - 1;
    setcookie("month",$monthnew,time()+31556926);
    setcookie("year",$year,time()+31556926);

    header("Location: timetable.php?comp_id=$comp_id");
}
if(isset($_POST["next"])){

    if($month == 12){

        $year++;
        $month = 0;

        }

    $monthnew = $month + 1;
    setcookie("month",$monthnew,time()+31556926);
    setcookie("year",$year,time()+31556926);

    header("Location: timetable.php?comp_id=$comp_id");


}

$get_wc_days_query = "SELECT comp_wc_info FROM competitions WHERE comp_id=$comp_id";
$get_wc_days_query_do = mysqli_query($connection, $get_wc_days_query);

if($row = mysqli_fetch_assoc($get_wc_days_query_do)){

$string = $row["comp_wc_info"];

$array = explode("//", $string);

}

$datestoshow = "";

for ($i=0; $i < count($array); $i++) { 

$secondplode = explode(";", $array[$i]);

if($datestoshow != ""){

    $datestoshow .= "," . $secondplode[0];
    
}
else{
    $datestoshow .= $secondplode[0];

}
}
echo $datestoshow;

if(isset($_POST["add_period"])){

$save_date = $_POST["save_date"];
$ten_min = $_POST["wc_per_ten_min"];

$start_1 = $_POST["wc_period_start_1"];
$end_1 = $_POST["wc_period_end_1"];

if(isset($_POST["wc_period_start_2"])){

$start_2 = $_POST["wc_period_start_2"];
$end_2 = $_POST["wc_period_end_2"];

}
else{
    $start_2 = "";
    $end_2 = "";
}
if(isset($_POST["wc_period_start_3"])){

$start_3 = $_POST["wc_period_start_3"];
$end_3 = $_POST["wc_period_end_3"];

}
else{
    $start_3 = "";
    $end_3 = "";
}
if($string != ""){
    $separate = "//";
}
else{
    $separate = "";
}
$test = $separate . $save_date . ";" . $ten_min . ";" . $start_1 . "=>" . $end_1;
if($start_2 != ""){
    $test .= ";" . $start_2 . "=>" . $end_2;
}
if($start_3 != ""){
    $test .= ";" . $start_3 . "=>" . $end_3;
}

echo $test;

$upload_query = "UPDATE competitions SET comp_wc_info = CONCAT(comp_wc_info,'$test') WHERE comp_id = $comp_id";
$upload_query_do = mysqli_query($connection, $upload_query);
header("Location: timetable.php?comp_id=$comp_id");
}

if(isset($_POST["sure_delete"])){

    $datetoremove = $_POST["remove_date"];

    for ($i=0; $i < count($array); $i++) { 

        $secondplode = explode(";", $array[$i]);

        if(in_array($datetoremove, $secondplode))

        $finaldelete = implode(";", $secondplode);

        }

if(strpos($string, "//" . $finaldelete)){
    $upload_deleted = str_replace("//" . $finaldelete, "", $string);
}
else{
    $upload_deleted = str_replace($finaldelete, "", $string);
}

$query = "UPDATE competitions SET comp_wc_info = '$upload_deleted' WHERE comp_id = $comp_id";
$query_do = mysqli_query($connection, $query);
if($query_do){
    header("Location: timetable.php?comp_id=$comp_id");
}
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timetable</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
</head>
<body>
<!-- header -->
    <div id="confirmation" class="hidden">
        <form id="confirmation_form" action="timetable.php?comp_id=<?php echo $comp_id ?>" method="POST">
            <button id="close_button" class="round_button" type="button" onclick="closeConf()">
                <img src="../assets/icons/close-black-18dp.svg" class="round_button_icon">
            </button>
            <p id="remove_warning"></p>
            <p>You cannot withdraw this action!</p>
            <div id="confirmation_button_section">
            <input class="hidden" type="text" id="remove_date" name="remove_date">
                <button onclick="closeConf()" type="button" value="Cancel">Cancel</button>
                <button onclick="" name="sure_delete" type="submit" value="{Action}" class="action">Remove</button>
            </div>
        </form>
    </div>
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">Timetable</p>
                    <button class="stripe_button orange only_stripe_item" type="submit" form="needed_equimpment_wrapper">
                        <p class="stripe_button_text">Save Timetable</p>
                        <img class="stripe_button_icon" src="../assets/icons/save-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">

                    <div id="set_wc_panel" class="overlay_panel big_overlay_panel">
                        <div class="form_wrapper">
                            <button id="close_button" class="round_button" onclick="closeWcPanel()">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>

                            <form action="" method="POST" id="new_wc_day" autocomplete="off">
                                <p id="panel_text" class="panel_title"></p></br>
                                <input type="text" id="save_date" name="save_date" class="hidden">
                                <label for="wc_per_ten_min" class="label_text_small">Estimated number of weapon controls done in 10 minutes: controls done in 10 minutes:</label></br>
                                <input type="number" class="number_input small" placeholder="e.g. 8" id="wc_input" name="wc_per_ten_min">

                                <div class="table_header">
                                    <div class="table_header_text">STARTING TIME</div>
                                    <div class="table_header_text">ENDING TIME</div>
                                </div>
                                <div class="table_row" id="table_row_1">
                                    <div class="table_item" id="start_1"> <input type="time" class="number_input big" name="wc_period_start_1"> </div>
                                    <div class="table_item" id="end_1"> <input type="time" class="number_input big" name="wc_period_end_1"> </div>
                                  <!-- <button type="button" onclick="" class="close_add_peroid">
                                        <img src="../assets/icons/close-black-18dp.svg" alt="">
                                    </button> -->
                                </div>
                                        
                                <div class="add_peroid_container">
                                    <button type="button" class="round_button" onclick="addPeriod()">
                                        <img src="../assets/icons/more_time-black-18dp.svg" alt="">
                                    </button>
                                    
                                </div>
                                <button type="submit" name="add_period" class="round_button" onclick="">
                                        <img src="..\assets\icons\644705-200.png" alt="">
                                    </button>
                            </form>
                        </div>
                    </div>
                    <input type="text" id="dates_control_on" name="dates_control_on" class="hidden" value="<?php echo $datestoshow ?>">
                    <div id="timetable_wrapper">
                        <div id="time_stripe">
                        <form action="" method="POST" id="calendar">
                        </form>
                            <button id="back_month_button" name="back" type="submit" form="calendar"></button>
                            <div> <p><?php echo $monthname . " " . $year?></p> </div>
                            <button id="next_month_button" name="next" type="submit" form="calendar"></button>
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
                                <?php
                                $emptydivs = $dayofweek - 1;

                                for ($i=0; $i < $emptydivs; $i++) { 
                                    echo "<div><p></p></div>";
                                }
                                for ($i=1; $i <= $numberdays; $i++) { 

                                    if(strlen($i) == 2){

                                        $ione = $i;
                                    
                                    }else{
                                    
                                        $ione = "0" . "$i";
                                    
                                    }

                                    echo "<div id='$year-$monthid-$ione' onclick='toggleWcPanel(this)'><p>$i</p> <button onclick='removeWcDay(this)'> <img src='..\assets\icons\alarm_off-black-18dp.svg'> </button> </div>";

                                }
                                
                                
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/main.js"></script>
<script src="../js/timetable.js"></script>
</html>