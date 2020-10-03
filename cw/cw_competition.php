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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">


        <!-- cw title panel top  -->
        <p class="cw_panel_title"><?php echo $comp_name ?></p>
        <p id="comp_status"><?php echo statusConverter($comp_status) ?></p>
        <div id="comp_data">
            <p><?php echo sexConverter($comp_sex) . "'s" ?></p>
            <p><?php echo weaponConverter($comp_weapon) ?></p>
            <p><?php echo date('Y', strtotime($comp_start)) ?></p>
        </div>
        <div id="competition_wrapper">
            <div>


                <!-- basic info panel -->
                <div id="basic_information_panel">
                    <div>
                        <p class="data_label">HOST COUNTRY:</p>
                        <p><?php echo $comp_host ?></p>
                        <p class="data_label">LOCATION AND ADDRESS:</p>
                        <p><?php echo $comp_location ?></p>
                        <p><?php echo $comp_postal ?></p>
                        <p class="data_label">ENTRY-FEE:</p>
                        <p><?php echo $comp_entry ?></p>
                    </div>
                    <div>
                        <p class="data_label">STARTING DATE:</p>
                        <p><?php echo $comp_start ?></p>
                        <p class="data_label">ENDING DATE:</p>
                        <p><?php echo $comp_end ?></p>
                        <p class="data_label pre_reg">END OF PRE-REGISTRTATION:</p>
                        <p><?php echo $comp_pre_end ?></p>
                    </div>
                </div>


                <!-- equipment panel -->
                <div id="equipment_panel">
                    <p class="data_label panel_title">EQUIPMENT NEEDED TO BE CHECKED</p>

                    <!-- weapons check table rows -->
                    <div>
                        <?php 
                            $equipment = array("Epee","Foil","Sabre","Electric Jacket","Plastron","Under-Plastron","Socks","Mask","Gloves","Bodywire","Maskwire","Chest protector","Metallic glove");

                            $array_equipment = explode(",", $comp_equipment);

                            for ($i = 0; $i < count($equipment); $i++) {
                                
                                if ($array_equipment[$i] != 0) {
                                    ?>
                                        <div class="table_row">
                                            <div class="table_item"><?php echo $equipment[$i] ?></div>
                                            <div class="table_item"><?php echo $array_equipment[$i] ?></div>
                                    
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>

                <!-- additional info panel -->
                <div id="additional_panel">
                    <p class="data_label panel_title">ADDITIONAL INFORMATION</p>
                    <div>
                        <p><?php echo $comp_info ?></p>
                    </div>
                </div>
                
                <!-- weapon control panel -->
                <div id="weapon_control_panel">
                    <p class="data_label panel_title">WEAPON CONTROL</p>
                    <div>
                        <div class="weapon_control_day">
                            <p>{Weapon Control Date}</p>
                            <a>Book appointment</a>
                        </div>

                        <div class="weapon_control_day">
                            <p>{Weapon Control Date}</p>
                            <a>Book appointment</a>
                        </div>
                    </div>
                </div>

            </div>
        
            <div>
                <a href="cw_pre_registration.php" class="disabled">Pre-Register</a>
                <a href="cw_competitors.php">Competitors</a>
                <a href="cw_pools.php">Pools</a>
                <a href="cw_temporary_ranking.php">Temporary Ranking</a>
                <a href="cw_tableu.php">Table</a>
                <a href="cw_final_results.php">Final Results</a>

                <a href="">Watch Video / Watch Live</a>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>