<?php include "../includes/headerburger.php"; ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

$feedback = "";
//array of colums I need from database
$array_getdata = array ("comp_name", "comp_sex", "comp_weapon", "comp_equipment", "comp_info", "comp_host", "comp_location", "comp_postal", "comp_start", "comp_end", "comp_pre_end", "comp_wc_info", "comp_entry");

//connecting to database
$qry_getdata = "SELECT * FROM competitions WHERE comp_id = $comp_id";
$getdata_do = mysqli_query($connection, $qry_getdata);

    if($row = mysqli_fetch_assoc($getdata_do)) {

        //putting the data from database into an assoc array with $array_getdata[] indexes
        for ($i = 0; $i <  count($array_getdata); ++$i) {

            if ($i == 0) {
                $assoc_array_data = [$array_getdata[$i] => $row[$array_getdata[$i]]];
            } else {
                $assoc_array_data[$array_getdata[$i]] = $row[$array_getdata[$i]];
                
            }
        }

    } else { //error branch
       $feedback = "ERROR: " . mysqli($connection); 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invitation</title>
    <link rel="stylesheet" media="screen" href="../css/mainstyle.css">
    <link rel="stylesheet" media="screen" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Plus Information</p>
                    <button class="stripe_button orange" type="button" onclick="printDiv('cw_preview')" form="needed_equimpment_wrapper">
                        <p>Print Invitation</p>
                        <img src="../assets/icons/print-black-18dp.svg"></img>
                    </button>
                </div>

                <p><?php echo $feedback ?></p>

                <div id="page_content_panel_main">
                    <div id="invitation_wrapper">

                        <div id="plus_information">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Plus information</p>
                            </div>
                            <div class="db_panel_main">
                                <div id="plus_info_wrapper">

                                    <div class="entry" id="">
                                        <div class="table_row" onclick="toggleEntry(this)">
                                            <div class="table_item invitation">Hungarian Fencing Federation</div>
                                        </div>
                                        <div class="entry_panel collapsed">
                                            <textarea name="" id=""></textarea>
                                            <input type="text" class="hidden">
                                        </div>
                                    </div>

                                    <div id="add_entry">
                                        <div class="table_row" onclick="">
                                            <div class="table_item">
                                                Add information
                                                <img src="../assets/icons/add-black-18dp.svg" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <form id="adding_entry">
                                        <div class="table_row" onclick="">
                                            <div class="table_item">
                                                <input type="text" placeholder="Type in the title">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="inv_panel" id="">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                <p>Add competition logo</p>
                            </div>
                            <div class="db_panel_main">
                                <!--Only visible when file is uploaded-->
                                <button class="round_button close_button">
                                    <img src="../assets/icons/delete-black-18dp.svg" alt="">
                                </button>
                                <div class="invitation_file_wrapper">  
                                    <input type="file" id="header_img">
                                    <label for="header_img">Upload picture</label> <!--Has to rewritten to file's name after uploading-->
                                </div>
                            </div>
                        </div>

                        <div id="cw_preview">
                            <div id="comp_data">
                                <img src="../assets/icons/delete-black-18dp.svg" alt="">

                                <p class="cw_panel_title"><?php echo $comp_name ?></p>
                                <p id="comp_status">Ongoing</p>

                                <div>
                                    <p><?php echo sexConverter($assoc_array_data['comp_name']) . "'s" ?></p>
                                    <p><?php echo weaponConverter($assoc_array_data['comp_weapon']) ?></p>
                                    <p><?php echo date('Y', strtotime($assoc_array_data['comp_start'])) ?></p>
                                </div>
                            </div>

<!-- basic info panel -->
<div id="basic_information_panel">
    <div>
        <p class="data_label">HOST COUNTRY:</p>
        <p><?php echo $assoc_array_data['comp_host'] ?></p>
        <p class="data_label">LOCATION AND ADDRESS:</p>
        <p><?php echo $assoc_array_data['comp_location'] ?></p>
        <p class="data_label">ENTRY-FEE:</p>
        <p><?php echo $assoc_array_data['comp_entry'] . " Ft"; ?></p>
    </div>
    <div>
        <p class="data_label">STARTING DATE:</p>
        <p><?php echo $assoc_array_data['comp_start'] ?></p>
        <p class="data_label">ENDING DATE:</p>
        <p><?php echo $assoc_array_data['comp_end'] ?></p>
        <p class="data_label pre_reg">END OF PRE-REGISTRTATION:</p>
        <p><?php echo $assoc_array_data['comp_pre_end'] ?></p>
    </div>
</div>


<!-- equipment panel -->
<div id="equipment_panel">
    <p class="data_label panel_title">EQUIPMENT NEEDED TO BE CHECKED</p>

    <!-- weapons check table rows -->
    <div>
        <?php 
            $equipment = array("Epee","Foil","Sabre","Electric Jacket","Plastron","Under-Plastron","Socks","Mask","Gloves","Bodywire","Maskwire","Chest protector","Metallic glove");

            $array_equipment = explode(",", $assoc_array_data['comp_equipment']);

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
        <p><?php echo $assoc_array_data['comp_info'] ?></p>
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
                    </div>
                </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/invitation.js"></script>
</html>