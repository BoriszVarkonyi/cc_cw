<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$equipment = array("Epee","Foil","Sabre","Electric Jacket","Plastron","Under-Plastron","Socks","Mask","Gloves","Bodywire","Maskwire","Chest protector","Metallic glove");
$hasequipment = array();

if(isset($_POST["submit"])) {

$i = 0;

for($i = 0; $i < 13; $i++){

${'item' . $i} = $_POST[$i];

$checkitem = ${'item' . $i};

if($checkitem != 0){

    $hasequipment[$equipment[$i]] = $checkitem;
}
elseif($checkitem == NULL){

    $hasequipment[$equipment[$i]] = 0;

}
}

$hasstring = implode(",", $hasequipment);


$addinfo = $_POST["additional"];

$query_upload_equipment = "UPDATE competitions SET comp_equipment = '$hasstring', comp_info = '$addinfo' WHERE comp_id = $comp_id";
$query_upload_equipment_do = mysqli_query($connection, $query_upload_equipment);


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informations for Fencers</title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>
<body class="preload">
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Informations for Fencers</p>
                    <div class="stripe_button_wrapper">
                        <button onclick="copyContent()" class="stripe_button primary" type="submit" form="information_for_fencers_form" name="submit">
                            <p>Save Information</p>
                            <img src="../assets/icons/save-black-18dp.svg"/>
                        </button>
                    </div>
                </div>
                <div id="page_content_panel_main">
                    <div class="wrapper">
                        <form class="db_panel other" id="information_for_fencers_form" action="information_for_fencers.php?comp_id=<?php echo $comp_id ?>" method="POST" >
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/beenhere-black-18dp.svg">
                                <p>Equipment needed to be checked</p>
                            </div>
                            <div class="db_panel_main small">
                                <div class="table">
                                    <div class="table_header">
                                        <div class="table_header_text">EQUIPMENT</div>
                                        <div class="table_header_text">QUANTITY
                                            <button onclick="removeEquipmentValues()" type="button" id="reset_button">
                                                <img src="../assets/icons/cached-black-18dp.svg">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table_row_wrapper alt">
                                        <?php
                                        $query_get_data = "SELECT comp_equipment FROM competitions WHERE comp_id = $comp_id";
                                        $query_get_data_do = mysqli_query($connection, $query_get_data);

                                        $assocdataget = mysqli_fetch_assoc($query_get_data_do);
                                        $assocdataprocess = implode(",", $assocdataget);
                                        $assocdatapost = explode(",", $assocdataprocess);

                                        for($i = 0; $i < 13; $i++){?>
                                        <div class="table_row" id="<?php echo $i ?>" onclick="takeToField(this)">
                                            <div class="table_item"><?php echo $equipment[$i]?></div>
                                            <div class="table_item"><input id="input_<?php echo $i ?>" name="<?php echo $i ?>" type="number" placeholder="#" value="<?php

                                            if($assocdatapost[$i] == 0){

                                                echo "";

                                            }else{

                                                echo $assocdatapost[$i];

                                            }
                                            ?>"></div>
                                        </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="db_panel">
                            <div class="db_panel_title_stripe">
                                <img src="../assets/icons/build-black-18dp.svg">
                                <p>Manage Addition Informations</p>
                            </div>
                            <div class="db_panel_main table">
                                <div class="table t_c_0">
                                    <div class="table_header">
                                        <div class="table_header_text">TITLE</div>
                                    </div>
                                    <div class="table_row_wrapper alt">

                                        <!-- ezt kell whileozni csorom -->
                                        <div class="entry">

                                            <!-- csak a cim kell -->
                                            <div class="table_row" onclick="toggleEntry(this)">
                                                <div class="table_item invitation"><p>CÍM</p></div>
                                            </div>

                                            <!-- updateing entry -->
                                            <form class="entry_panel collapsed" id="update" method="POST" action="">
                                                <button class="panel_button" type="submit" name="submit_delete" id="update">
                                                    <img src="../assets/icons/delete-black-18dp.svg">
                                                </button>
                                                <textarea id="update" name="text_body" placeholder="Type the Announcement's body text here">SZÖVEGEGEGEE</textarea>
                                                <input id="update" name="text_title_to_change" type="text" value="" class="hidden">
                                                <input id="update" name="submit_body" type="submit" value="Save" class="panel_submit">
                                            </form>

                                        </div>
                                        <!-- eddig mondjuk -->

                                        <!-- adding entry by title -->
                                        <div id="add_entry" onclick="hideNshow()">
                                            <div class="table_row" onclick="">
                                                <div class="table_item">
                                                    Add information
                                                    <img src="../assets/icons/add-black-18dp.svg">
                                                </div>
                                            </div>
                                        </div>
                                        <form action="" id="adding_entry" class="hidden" method="POST">
                                            <div class="table_row">
                                                <div class="table_item">
                                                    <input name="input_title" type="text" class="title_input" placeholder="Type in the title">
                                                    <input name="input_submit" type="submit" class="save_entry" value="Create">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/information_for_fencers.js"></script>
</body>
</html>