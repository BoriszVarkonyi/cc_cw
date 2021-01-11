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
$comp_status = $row["comp_status"];

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

$start_1 = $_POST["wc_period_start_1"] . ":00";
$end_1 = $_POST["wc_period_end_1"] . ":00";

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
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="confirmation" class="hidden">
        <form id="confirmation_form" action="timetable.php?comp_id=<?php echo $comp_id ?>" method="POST">
            <button class="panel_button" type="button" onclick="removeWcDay(this)">
                <img src="../assets/icons/close-black-18dp.svg">
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
                <div id="title_stripe">
                    <p class="page_title">Timetable</p>
                    <button class="stripe_button orange" type="submit">
                        <p>Save Timetable</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>
                </div>
                <div id="page_content_panel_main" class="no_scroll">
                    <div id="set_wc_panel" class="overlay_panel_single hidden">
                        <button class="panel_button drag">
                            <img src="../assets/icons/drag_indicator-black-18dp.svg" >
                        </button>
                        <button class="panel_button" onclick="closeWcPanel()">
                            <img src="../assets/icons/close-black-18dp.svg" >
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
                                    <div class="table_item" id="start_1"> <input type="number" class="wc_time" name="wc_period_start_1"> <p>:00</p></div>
                                    <div class="table_item" id="end_1"> <input type="number" class="wc_time" name="wc_period_end_1"> <p>:00</p></div>
                                </div>
                                <!--
                                <div class="table_row hidden" id="table_row_2">
                                    <div class="table_item" id="start_1"> <input type="number" class="wc_time" name="wc_period_start_1"> <p>:00</p></div>
                                    <div class="table_item" id="end_1"> <input type="number" class="wc_time" name="wc_period_end_1"> <p>:00</p></div>
                                     <button type="button" onclick="removePeriod()" class="close_add_peroid">
                                        <img src="../assets/icons/close-black-18dp.svg" >
                                    </button>
                                </div>
                                <div class="table_row hidden" id="table_row_3">
                                    <div class="table_item" id="start_1"> <input type="number" class="wc_time" name="wc_period_start_1"> <p>:00</p></div>
                                    <div class="table_item" id="end_1"> <input type="number" class="wc_time" name="wc_period_end_1"> <p>:00</p></div>
                                     <button type="button" onclick="removePeriod()" class="close_add_peroid">
                                        <img src="../assets/icons/close-black-18dp.svg" >
                                    </button>
                                </div>

                                        
                                <div class="add_peroid_container">
                                    <button type="button" id="add_period" onclick="addPeriod()">
                                        <img src="../assets/icons/more_time-black-18dp.svg" >
                                    </button>
                                </div>
                                -->
                                <input type="submit" name="add_period" value="Save" class="panel_submit">
                            </form>

                    </div>
                    <input type="text" id="dates_control_on" name="dates_control_on" class="hidden" value="<?php echo $datestoshow ?>">
                    <div id="timetable_wrapper">
                        <div id="time_stripe">
                        <form action="" method="POST" id="calendar">
                        </form>
                            <button name="back" type="submit" form="calendar">
                                <img src="../assets/icons/arrow_back_ios-black-18dp.svg" >
                            </button>
                            <div> <p><?php echo $monthname . " " . $year?></p> </div>
                            <button name="next" type="submit" form="calendar">
                                <img src="../assets/icons/arrow_forward_ios-black-18dp.svg" >
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
                                <?php
                                $emptydivs = $dayofweek - 1;
                                if($comp_status == 1){
                                    $toonclick = "toggleWcPanel(this)";
                                }
                                else{

                                    $toonclick = "";

                                }
                                if($comp_status == 1){
                                    $toinneronclick = "<button onclick='removeWcDay(this)'> <img src='..\assets\icons\alarm_off-black-18dp.svg'> </button> ";
                                }
                                else{

                                    $toinneronclick = "";

                                }

                                for ($i=0; $i < $emptydivs; $i++) { 
                                    echo "<div><p></p></div>";
                                }
                                for ($i=1; $i <= $numberdays; $i++) { 

                                    if(strlen($i) == 2){

                                        $ione = $i;
                                    
                                    }else{
                                    
                                        $ione = "0" . "$i";
                                    
                                    }
                                    if($comp_status == 1){
                                        $href = "";
                                    }
                                    else{
    
                                        $href = "href='dates_weapon_control.php?comp_id=$comp_id&date=$year-$monthid-$ione'";
    
                                    }

                                    echo "<div id='$year-$monthid-$ione' onclick='$toonclick'><a $href><p>$i</p>$toinneronclick</a></div>";

                                }
                                
                                ?>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </body>
    <script src="../js/main.js"></script>
<script src="../js/timetable.js"></script>
</html>