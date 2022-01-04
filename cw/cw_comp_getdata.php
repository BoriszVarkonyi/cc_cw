<?php include "db.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php
$comp_id = filter_input(INPUT_GET, 'comp_id', FILTER_SANITIZE_NUMBER_INT);

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
    //$comp_wc_info = $row['comp_wc_info'];
    $comp_name = $row['comp_name'];
    $is_individual = $row['is_individual'];
} else {
    echo mysqli_error($connection);
    header("location: index.php");
}
?>
