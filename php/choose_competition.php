<?php include "../includes/db.php" ?>
<?php session_start();?>
<?php ob_start();?>

<?php

$lastlogin = $_COOKIE["lastlogin"];

$ass_tourn_id = $_GET["t_id"];

if($lastlogin == 1){

$query = "SELECT * FROM competitions WHERE ass_tournament_id = $ass_tourn_id";
$query_comps = mysqli_query($connection, $query);
}
elseif($lastlogin == 2){

$tech_id = $_COOKIE["tech_id"];

$query = "SELECT * FROM technicians WHERE id = $tech_id";
$query_tech_ass_id = mysqli_query($connection, $query);

if($row = mysqli_fetch_assoc($query_tech_ass_id)){

    $comps_list = str_replace(" ", ",", $row["ass_comp_id"]);

}

$query = "SELECT * FROM competitions WHERE comp_id in ($comps_list)";
$query_comps = mysqli_query($connection, $query);



}

//Fetches all competitions in a variable

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>T: Your Competitions O: Competitions of {Tournamnet's name}</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="bg_fencers">
    <?php include "../includes/headerburger.php" ?>
    <div id="your_competitions_panel" class="panel">
        <div id="title_stripe">
            <p class="page_title">T: Your Competitions O: Competitions of {Tournamnet's name}</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button" onclick="location.href='create_competition.php?t_id=<?php echo $ass_tourn_id ?>'">
                    <p>Manage Timetable</p>
                    <img src="../assets/icons/timetable-black-18dp.svg"/>
                </button>
                <button class="stripe_button primary" onclick="location.href='create_competition.php?t_id=<?php echo $ass_tourn_id ?>'">
                    <p>Create Competition</p>
                    <img src="../assets/icons/add-black-18dp.svg"/>
                </button>
            </div>
        </div>
        <div id="panel_main">
            <div class="table wrapper t_c_2">
                <div class="table_header">
                    <div class="table_header_text">NAME</div>
                    <div class="table_header_text">STATUS</div>
                </div>
                <div class="table_row_wrapper">
                <?php
                while($row = mysqli_fetch_assoc($query_comps)) {
                    $comp_id = $row["comp_id"];
                    $comp_name = $row["comp_name"];
                    $comp_status = $row["comp_status"];
                    //Fetches the data into the row array
                    //Saves the data separately to variables from the row array
                ?>
                <?php   ?>
                <div class="table_row" onclick="location.href='index.php?comp_id=<?php echo $comp_id ?>'" title="<?php echo $comp_name; ?>">
                    <div class="table_item"><p><?php echo $comp_name; ?></p></div>
                    <div class="table_item"><?php echo statusConverter($comp_status); ?></div>
                </div>
                <?php
                }
                ?>
                <?php
                if(mysqli_num_rows($query_comps) == 0){
                //If there is no row in competitions table, shows the message below.
                ?>
                <div id="no_something_panel">
                    <p>You have no competitions yet!</p>
                </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>