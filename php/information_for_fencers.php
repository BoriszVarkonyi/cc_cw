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
    <title>Informations</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="preload">
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">Informations for fencers</p>
                    <button onclick="copyContent()" class="stripe_button orange" type="submit" form="needed_equimpment_wrapper" name="submit">
                        <p class="stripe_button_text">Save Information</p>
                        <img class="stripe_button_icon" src="../assets/icons/save-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">

                    <div id="information_for_fencers_wrapper">

                    <div id="needed_equipment_panel" class="info_panel"> 
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/beenhere-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                            <p>Equipment needed to be checked</p>
                        </div>
                        <div class="db_panel_main">
                            <form id="needed_equimpment_wrapper" action="information_for_fencers.php?comp_id=<?php echo $comp_id ?>" method="POST">
                                <div class="table_header">
                                    <div class="table_header_text">EQUIPMENT</div>
                                    <div class="table_header_text">QUANTITY
                                        <button onclick="removeEquipmentValues()" type="button" id="reset_button">
                                            <img src="../assets/icons/cached-black-18dp.svg" alt="">
                                        </button>
                                    </div>
                                </div>

                                <?php
                                $query_get_data = "SELECT comp_equipment FROM competitions WHERE comp_id = $comp_id";
                                $query_get_data_do = mysqli_query($connection, $query_get_data);

                                $assocdataget = mysqli_fetch_assoc($query_get_data_do);
                                $assocdataprocess = implode(",", $assocdataget);
                                $assocdatapost = explode(",", $assocdataprocess);

                                for($i = 0; $i < 13; $i++){?>
                                <div class="table_row" id="<?php echo $i ?>" onclick="takeToField(this)">
                                    <div class="table_item"><?php echo $equipment[$i]?></div>
                                    <div class="table_item"><input id="input_<?php echo $i ?>" name="<?php echo $i ?>" type="number" placeholder="-" value="<?php
                                    
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
                    <div id="additional_info_panel" class="info_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/rule-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                            <p>Additional Information</p>
                        </div>
                        <div class="db_panel_main not_centered" id="">
                            <input name="additional" type="text" class="hidden" id="additional_info_input">
                            <div class="additional_info_wrapper" id="add_info_wrap">
                            <?php
                            
                            $query_get_info = "SELECT comp_info FROM competitions WHERE comp_id = $comp_id";
                                $query_get_info_do = mysqli_query($connection, $query_get_info);

                                $associnfoget = mysqli_fetch_assoc($query_get_info_do);
                                $associnfopost = implode(",", $associnfoget);
                            
                            ?>
                                <div class="additional_info_text" contenteditable placeholder="Start typing here" id="additional"><?php
                                
                                if($associnfopost == ""){

                                        echo "";

                                    }else{

                                        echo $associnfopost;

                                    }
                                
                                ?></div>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/main.js"></script>
<script src="../js/information_for_fencers.js"></script>
</html>