<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php session_start();?>
<?php ob_start();?>

<?php

$lastlogin = $_COOKIE["lastlogin"];

if($lastlogin == 1){

$org_id = $_COOKIE["org_id"];

$query = "SELECT * FROM competitions WHERE comp_organiser_id = '$org_id'";
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
    <title>CC Competitions</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body id="illustration_bg">

    <?php include "../includes/headernoburger.php" ?>

    <div id="your_competitions_panel" class="panel">
        <div id="title_stripe">
            <p class="page_title">Your competitions</p>
            <button class="stripe_button orange" onclick="location.href='create_competition.php'">
                <p>Create Competition</p>
                <img src="../assets/icons/add-black-18dp.svg" />
            </button>
        </div>
        <div id="panel_main">
            <div class="table wrapper">
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
                <div class="table_row" onclick="location.href='index.php?comp_id=<?php echo $comp_id ?>'">
                    <div class="table_item"><?php echo $comp_name; ?></div>
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