<?php include "includes/db.php" ?>
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
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body class="fencers">
    <?php include "includes/headerburger.php" ?>
    <div class="panel">
        <div id="title_stripe">
            <p class="page_title">T: Your Competitions O: Competitions of {Tournamnet's name}</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button" onclick="location.href='manage_bookings.php?t_id=<?php echo $ass_tourn_id ?>'">
                    <p>Manage Bookings</p>
                    <img src="../assets/icons/calendar_today_black.svg"/>
                </button>
                <button class="stripe_button" onclick="location.href='tournament_timetable.php?t_id=<?php echo $ass_tourn_id ?>'">
                    <p>Manage Timetable</p>
                    <img src="../assets/icons/calendar_today_black.svg"/>
                </button>
                <button class="stripe_button primary" onclick="location.href='create_competition.php?t_id=<?php echo $ass_tourn_id ?>'">
                    <p>Create Competition</p>
                    <img src="../assets/icons/add_black.svg"/>
                </button>
            </div>
        </div>
        <div id="panel_main">
            <table class="wrapper">
                <thead>
                    <tr>
                        <th><p>NAME</p></th>
                        <th><p>STATUS</p></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($query_comps)) {
                        $comp_id = $row["comp_id"];
                        $comp_name = $row["comp_name"];
                        $comp_status = $row["comp_status"];
                        //Fetches the data into the row array
                        //Saves the data separately to variables from the row array
                        ?>
                        <?php   ?>
                        <tr onclick="location.href='index.php?comp_id=<?php echo $comp_id ?>'" title="<?php echo $comp_name; ?>">
                            <td><p><?php echo $comp_name; ?></p></td>
                            <td><p><?php echo statusConverter($comp_status); ?></p></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <?php

                    if(mysqli_num_rows($query_comps) == 0){
                        //If there is no row in competitions table, shows the message below.
                        ?>
                        <tr>
                            <td colspan="2">
                                <p>This tournament has no competitions yet.</p>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
</body>
</html>