<?php

//get data / make new row
$qry_get_data = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $data = $row['data'];

    $ref_table = json_decode($data);
}

//check for existing row
$qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
    $json_string = $row['data'];
    $competitor_table = json_decode($json_string);
}

$allclub = [];

foreach ($ref_table as $key => $value) {

    if (!in_array($value->club, $allclub) && $value->club != "") {

        array_push($allclub, $value->club);
    }
}

foreach ($competitor_table as $key => $value) {

    if (!in_array($value->club, $allclub) && $value->club != "") {

        array_push($allclub, $value->club);
    }
}

foreach ($allclub as $key => $value) {

    echo '<a onclick="setClub(this)">' . $value . '</a>';
}

?>