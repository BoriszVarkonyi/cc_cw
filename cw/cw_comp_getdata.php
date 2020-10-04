<?php include "cw_header.php"; ?>
<?php include "../cw/db.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php
$comp_id = $_GET['comp_id'];

//query for selecting relevant competition for display
$query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $comp_wc = $row['comp_wc_type'];
    $comp_sex = $row['comp_sex'];
    $comp_weapon = $row['comp_weapon'];
    $comp_equipment = $row['comp_equipment'];
    $comp_info = $row['comp_info'];
    $comp_status = $row['comp_status'];
    $comp_organiser_id = $row['comp_organiser_id'];
    $comp_ranking_id = $row['comp_ranking_id'];
    $comp_host = $row['comp_host'];
    $comp_location = $row['comp_location'];
    $comp_postal = $row['comp_postal'];
    $comp_start = $row['comp_start'];
    $comp_entry = $row['comp_entry'];
    $comp_end = $row['comp_end'];
    $comp_pre_end = $row['comp_pre_end'];
    $comp_wc_info = $row['comp_wc_info'];
    $comp_name = $row['comp_name'];
} else {
    echo mysqli_error($connection);
}
?>
