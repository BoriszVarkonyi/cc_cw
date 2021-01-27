<?php include "cw_comp_getdata.php"; ?>
<?php include "../includes/cw_fav_button.php"; ?>
<?php include "../includes/db.php"; ?>
<?php

    $logo_path = "../assets/icons/delete-black-18dp.svg";

    if (file_exists("../uploads/$comp_id.png")) {
        $logo_path = "../uploads/$comp_id.png";
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
<body class="competitions">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="competition">
                <div id="title_stripe" class="big">
                    <img src="<?php echo $logo_path ?>">
                    <form action="../cw/competition.php?comp_id=<?php echo $comp_id ?>" method="POST" class="big_status_item" id="fav_button"></form>
                    <p class="stripe_title"><?php echo $comp_name ?></p>
                    <button form="fav_button" name="submit_button" class="favourite_button" type="submit">
                        <img src=<?php echo $star ?> >
                    </button>
                    <p id="comp_status">ONGOING</p>
                    <!-- <p id="comp_status"><?php echo statusConverter($comp_status) . " \ "; print_r($_COOKIE[$cookie_name]); echo " \ " . $ttest ?></p>-->
                    <div>
                        <p><?php echo sexConverter($comp_sex) . "'s" ?></p>
                        <p><?php echo statusConverter($comp_status) ?></p>
                        <p><?php echo date('Y', strtotime($comp_start)) ?></p>
                    </div>
                </div>
                <div id="competition_info">
                    <div id="announcements" class="column_panel">
                        <p>Announcement Title</p>
                        <p>Needed Quantity Needed Quantity  Needed Quantity Needed Quantity Needed Quantity Needed Quantity Needed Quantity</p>
                        <p>Announcement Title</p>
                        <p>Needed Quantity Needed Quantity  Needed Quantity Needed Quantity Needed Quantity Needed Quantity Needed Quantity</p> 
                    </div>
                    <div id="basic_information_panel" class="column_panel">
                        <p class="column_panel_title">Basic Information:</p>
                        <div>
                            <div class="form_wrapper">
                                <div>
                                    <div>
                                        <p class="data_label">HOST COUNTRY:</p>
                                        <p><?php echo $comp_host ?></p>                                
                                    </div>
                                    <div>
                                        <p class="data_label">LOCATION AND ADDRESS:</p>
                                        <p><?php echo $comp_location ?></p>
                                        <p><?php echo $comp_postal ?></p>                                
                                    </div>
                                    <div>
                                        <p class="data_label">ENTRY-FEE:</p>
                                        <p><?php echo $comp_entry ?></p>
                                    </div>                                
                                </div>
                                <div>
                                    <div>
                                        <p class="data_label">STARTING DATE:</p>
                                        <p><?php echo $comp_start ?></p>                                
                                    </div>
                                    <div>
                                        <p class="data_label">ENDING DATE:</p>
                                        <p><?php echo $comp_end ?></p>                                
                                    </div>
                                    <div>
                                        <p class="data_label pre_reg">END OF PRE-REGISTRTATION:</p>
                                        <p><?php echo $comp_pre_end ?></p>                                
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>

                    <!-- equipment panel -->
                    <div id="equipment_panel" class="column_panel">
                        <p class="column_panel_title">Equipment needed to be checked:</p>
                        <!-- weapons check table rows -->
                        <div class="table no_interaction">
                            <div class="table_header">
                                <div class="table_header_text">Equipment's name</div>
                                <div class="table_header_text">Needed Quantity</div>
                            </div>
                            <div class="table_row_wrapper">
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
                    </div>

                    <!-- additional info panel -->
                    <div id="additional_panel" class="column_panel">
                        <p class="column_panel_title">Additional information for Fencers:</p>
                        <div>
                            <p><?php echo $comp_info ?></p>
                        </div>
                    </div>
                    
                    <!-- weapon control panel -->
                    <div id="weapon_control_panel" class="column_panel">
                        <p class="column_panel_title">Weapon Control appointments and bookings:</p>
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
                
                    <div id="plus_information_panel" class="column_panel">
                        <p class="column_panel_title">Plus Information:</p>
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
                                
                                <p>This competition has no plus information!</p>

                            <?php
                                }
                            ?>

                        </div>
                    </div>
                </div>
                <div id="competition_controls">
                    <div class="column_panel">
                        <p class="column_panel_title">Competition Controls:</p>
                        <div class="competition_controls_wrapper">
                            <button <?php echo $test = ($comp_status  != 2) ? "disabled" : "" ?> onclick="location.href='pre_registration.php?comp_id=<?php echo $comp_id ?>'">Pre-Register</button>
                            <button onclick="location.href='competitors.php?comp_id=<?php echo $comp_id ?>'">Competitors</button>
                            <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='pools.php?comp_id=<?php echo $comp_id ?>'">Pools</button>
                            <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='temporary_ranking.php?comp_id=<?php echo $comp_id ?>'">Temporary Ranking</button>
                            <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='table.php?comp_id=<?php echo $comp_id ?>'">Table</button>
                            <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='final_results.php?comp_id=<?php echo $comp_id ?>'">Final Results</button>
                            <button onclick="printPage()">Print</a>
                            <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href=''">Watch Video / Watch Live</a>                            
                        </div>
                    </div>
                </div>
            </div>
            <?php include "cw_footer.php"; ?>
        </div>
    </div>
<script src="../js/cw_main.js"></script>
<script>
    function printPage() {
        window.print();
    }
</script>
</body>
</html>