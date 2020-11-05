<?php include "cw_comp_getdata.php"; ?>
<?php include "../includes/cw_fav_button.php"; ?>
<?php include "../includes/db.php"; ?>
<?php

    $logo_path = "../assets/icons/delete-black-18dp.svg";

    if (file_exists("../uploads/$comp_id.png")) {
        $logo_path = "../uploads/$comp_id.png";
    } else {
        $logo_path = "../assets/icons/delete-black-18dp.svg";
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
        <div id="comp_data">
            <img src="<?php echo $logo_path ?>" alt="">
            <form method="POST" class="big_status_item" id="fav_button"></form>
            <p class="cw_panel_title"><?php echo $comp_name ?>
                <input name="fav_comp_id" form="fav_button" type="text" class="hidden" value=<?php echo $comp_id ?>>
                <button name="submit_button" class="favourite_button" form="fav_button" type="submit">
                    <img src=<?php echo $star ?> alt="">
                </button> 
            </p>
            <p id="comp_status"><?php echo statusConverter($comp_status). "_______ " ;var_dump($_COOKIE[$cookie_name])?></p>
            <div>
                <p><?php echo sexConverter($comp_sex) . "'s" ?></p>
                <p><?php echo statusConverter($comp_status) ?></p>
                <p><?php echo date('Y', strtotime($comp_start)) ?></p>
            </div>
        </div>
        <div id="competition_wrapper">
            <div id="invitation_cw">


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
                                        <div class="table_row table_row_wrapper">
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
                    <p class="data_label panel_title">ADDITIONAL INFORMATION FOR FENCERS</p>
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
            
                <div id="plus_information_panel">
                    <p class="data_label panel_title">PLUS INFORMATION</p>
                    <div>
                        <?php
                        
                            //display plus info from DB
                            
                            $get_plsuinfo_qry = "SELECT * FROM info_$comp_id";
                            if (!$get_plsuinfo_do = mysqli_query($connection, $get_plsuinfo_qry)) {
                                $feedback = "ERROR: " . mysqli_error($connection);
                            }

                            if ($get_plsuinfo_do !== FALSE) {//checks whether table exists
                                while ($row = mysqli_fetch_assoc($get_plsuinfo_do)) {

                                    $info_title = $row['info_title'];
                                    $info_body = $row['info_body'];
                        ?>

                                <p><?php echo $info_title ?></p>
                                <p><?php echo $info_body ?></p>

                        <?php
                                }
                            } else  { // displayed when there are no plus infos for comp_id
                        ?>
                            
                            <p>You have not added any plus information yet!</p>

                        <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        
            <div id="competition_controls">
                <a href="cw_pre_registration.php?comp_id=<?php echo $comp_id ?>" class="disabled">Pre-Register</a>
                <a href="cw_competitors.php?comp_id=<?php echo $comp_id ?>">Competitors</a>
                <a href="cw_pools.php?comp_id=<?php echo $comp_id ?>">Pools</a>
                <a href="cw_temporary_ranking.php?comp_id=<?php echo $comp_id ?>">Temporary Ranking</a>
                <a href="cw_table.php?comp_id=<?php echo $comp_id ?>">Table</a>
                <a href="cw_final_results.php?comp_id=<?php echo $comp_id ?>">Final Results</a>
                <a onclick="printPage()">Print</a>

                <a href="">Watch Video / Watch Live</a>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>