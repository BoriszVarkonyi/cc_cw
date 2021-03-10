<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

//get competitors
$qry_get_data = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
} else {
    $json_table = [];
}

//Sorting fencers by nations(ABC)

function cmp($a, $b) {
    return strcmp($a->nation, $b->nation);
}

usort($json_table, "cmp");

//Count who is ready and who is not 

$ready = 0;
$notready = 0;

foreach($json_table as $object){

    if ($object->reg == true) {
        $ready++;
    }
    else{
        $notready++;
    }

}

echo $ready . "<br>";
echo $notready;

//Counting 

foreach($json_table as $object){

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Statistics</title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>

<body>
    <!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <form id="title_stripe" method="POST" action="">
                <p class="page_title">Weapon Control Statistics</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="button">
                        <p>Print Statistics</p>
                        <img src="../assets/icons/print-black-18dp.svg" />
                    </button>
                </div>
            </form>
            <div id="page_content_panel_main">
                <div class="wrapper">
                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/weapon_control.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
</body>

</html>