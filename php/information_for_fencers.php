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
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body class="preload">
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Informations for Fencers</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="submit" form="information_for_fencers_form" name="submit">
                        <p>Save Information</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <form class="wrapper" class="db_panel other" id="information_for_fencers_form" action="information_for_fencers.php?comp_id=<?php echo $comp_id ?>" method="POST">
                    <div class="db_panel other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/beenhere_black.svg">
                            <p>Equipment needed to be checked</p>
                        </div>
                        <div class="db_panel_main small">
                            <div class="table">
                                <div class="table_header">
                                    <div class="table_header_text">EQUIPMENT</div>
                                    <div class="table_header_text">QUANTITY
                                        <button onclick="removeEquipmentValues()" type="button" id="reset_button">
                                            <img src="../assets/icons/cached_black.svg">
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
                                    <div class="table_row" id="<?php echo $i ?>">
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
                    </div>
                    <div class="db_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/edit_black.svg">
                            <p>Set Additional Information</p>
                        </div>
                        <div class="db_panel_main column">
                            <textarea name="text_body" class="standalone" placeholder="Type the information's body text here">SZÖVEGEGEGEE</textarea>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/information_for_fencers.js"></script>
</body>
</html>