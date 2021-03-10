<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

error_reporting(E_ERROR | E_PARSE);

//get competitors
$qry_get_data = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
} else {
    $json_table = [];
}


$tablearray = json_decode(json_encode($json_table), true);;

//Sorting fencers by nations(ABC)

//usage

function arrayOrderBy(array &$arr, $order = null)
{
    if (is_null($order)) {
        return $arr;
    }
    $orders = explode(',', $order);
    usort($arr, function ($a, $b) use ($orders) {
        $result = array();
        foreach ($orders as $value) {
            list($field, $sort) = array_map('trim', explode(' ', trim($value)));
            if (!(isset($a[$field]) && isset($b[$field]))) {
                continue;
            }
            if (strcasecmp($sort, 'desc') === 0) {
                $tmp = $a;
                $a = $b;
                $b = $tmp;
            }
            if (is_numeric($a[$field]) && is_numeric($b[$field])) {
                $result[] = $a[$field] - $b[$field];
            } else {
                $result[] = strcmp($a[$field], $b[$field]);
            }
        }
        return implode('', $result);
    });
    return $arr;
}

arrayOrderBy($tablearray, 'reg asc,nation asc');

foreach($tablearray as $fencer){

    echo $fencer["nation"] . " " . $fencer["reg"] . "<br>";

}

// function cmp($a, $b) {

//     return strcmp($a->nation, $b->nation);
// }
//usort($json_table, amp);
//usort($json_table, "cmp");

foreach ($json_table as $object) {

    echo $object->nom . " ";
    echo $object->nation  . " ";
    echo $object->reg  . "<br>";
}

//Count who is ready and who is not 

$ready = 0;
$notready = 0;

foreach ($json_table as $object) {

    if ($object->reg == true) {
        $ready++;
    } else {
        $notready++;
    }
}

echo $ready . "<br>";
echo $notready . "<br>";

//Counting each country's registered and not registered fencers

$ccode = "";

$nations = new stdClass;

foreach ($json_table as $object) {

    $actualNation = $object->nation;

    $nations->$actualNation->ready = 0;
    $nations->$actualNation->notready = 0;
}

foreach ($json_table as $object) {

    $actualNation = $object->nation;

    if ($object->reg == true) {
        $nations->$actualNation->ready += 1;
    } else {
        $nations->$actualNation->notready += 1;
    }
}

foreach ($nations as $country_code => $country_value) {

    echo $country_code . " registered: " . $country_value->ready . " not registered: " . $country_value->notready . "<br>";
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