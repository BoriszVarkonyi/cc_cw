<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$query = "SELECT *
FROM `information_schema`.`tables`
WHERE table_schema = 'ccdatabase'
    AND table_name = 'pistes_$comp_id'
LIMIT 1;";
$query_do = mysqli_query($connection, $query);

if(mysqli_num_rows($query_do) == 0){

$query_create_table = "CREATE TABLE `pistes_$comp_id` ( id INT(11) NOT NULL AUTO_INCREMENT , piste_number INT(11) NOT NULL , piste_type INT(11) NOT NULL , piste_color INT(11) NOT NULL , piste_live VARCHAR(255) NOT NULL , piste_control_type INT(11) NOT NULL , piste_activity INT(11) NOT NULL, PRIMARY KEY (`id`) ) ENGINE = InnoDB;";
$query_create_table_do = mysqli_query($connection, $query_create_table);

if(!$query_create_table_do){
echo mysqli_error($connection);
}

}else {

echo "ALREADY";


}


if(isset($_POST["create_piste"])){

    print_r($_POST);

    $piste_type = $_POST["piste_type"];

    if($piste_type == "main"){

        $pistenum = $_POST["piste_number_main"];

    $query = "SELECT * FROM pistes_$comp_id WHERE piste_number = $pistenum OR piste_type = 1";
    $query_do = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_do) == 0){

        $query_add_main = "INSERT INTO pistes_$comp_id(`piste_number`, `piste_type`) VALUES ($pistenum, 1)";
        $query_add_main_do = mysqli_query($connection, $query_add_main);

        header("Location: pistes.php?comp_id=$comp_id");

    }

    }
    if($piste_type == "colored"){

        $colored_pistenum = $_POST["colored_piste_number"];
        $piste_add_color = $_POST["piste_color"];

        $query = "SELECT * FROM pistes_$comp_id WHERE piste_number = $colored_pistenum";
        $query_do = mysqli_query($connection,$query);

        if(mysqli_num_rows($query_do) == 0){

            $query_add_colored = "INSERT INTO `pistes_$comp_id`(`piste_number`, `piste_type`, `piste_color`) VALUES ($colored_pistenum,2,$piste_add_color)";
            $query_add_colored_do = mysqli_query($connection, $query_add_colored);

            header("Location: pistes.php?comp_id=$comp_id");

        }
    }
    if($piste_type == "numbered"){

        $piste_start_num = $_POST["start_num"];
        $piste_quantity_to_add = $_POST["quantity"];

        $sn = $piste_start_num;

        $okay = 0;


        for ($i=0; $i < $piste_quantity_to_add ; $i++) {

            if($okay == 0){

            $query_get_pistes = "SELECT * FROM pistes_$comp_id WHERE piste_number = $sn";
            $query_get_pistes_do = mysqli_query($connection, $query_get_pistes);

            if(mysqli_num_rows($query_get_pistes_do) > 0){

                $okay++;

            }

            $sn++;
            }
        }

        if($okay == 0){

            $sn = $piste_start_num;

            $query_add_numbered_piste = "INSERT INTO `pistes_$comp_id`(`piste_number`, `piste_type`) VALUES";

            $query_add_numbered_piste .= " ($sn,3)";

            for ($i=1; $i < $piste_quantity_to_add; $i++) {

                $sn++;

                $query_add_numbered_piste .= ",($sn,3)";
            }

            $query_add_numbered_piste_do = mysqli_query($connection, $query_add_numbered_piste);

            header("Location: pistes.php?comp_id=$comp_id");

        }
    }
}


    if (isset($_POST['delete_piste'])) {
        $id_to_delete = $_POST['id_to_change'];

        //delete piste from db

        $qry_delete = "DELETE FROM `pistes_$comp_id` WHERE `id` = '$id_to_delete'";
        $do_delete = mysqli_query($connection, $qry_delete);
        echo mysqli_error($connection);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s pistes</title>
    <link rel="stylesheet" href="../css/basestyle.css">
    <link rel="stylesheet" href="../css/mainstyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Pistes</p>
                    <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" onclick="toggleAddPistePanel()">
                            <p>Add Piste</p>
                            <img src="../assets/icons/add-black-18dp.svg"/>
                        </button>
                    </div>

                    <div class="overlay_panel hidden" id="add_piste_panel">
                        <button class="panel_button" onclick="toggleAddPistePanel()">
                            <img src="../assets/icons/close-black-18dp.svg" >
                        </button>

                            <form action="pistes.php?comp_id=<?php echo $comp_id ?>" id="create_piste" class="overlay_panel_form flex" method="POST">
                                <label for="username" >TYPE</label>
                                <div class="option_container row">
                                    <input type="radio" onclick="mainPiste()" name="piste_type" id="main" value="main"/>
                                    <label for="main">Main</label>

                                    <input type="radio" onclick="coloredPiste()" name="piste_type" id="colored" value="colored"/>
                                    <label for="colored">Colored</label>

                                    <input type="radio" onclick="numberedPiste()" name="piste_type" id="numbered" value="numbered"/>
                                    <label for="numbered">Numbered</label>
                                </div>

                                <!--Main-->
                                <label for="piste_number" id="mainpiste_num_label" class="label_text hidden main_group">PISTE NUMBER</label>
                                <input type="number" id="mainpiste_num_input" class="number_input small hidden main_group" placeholder="e.g. 2" name="piste_number_main">

                                <!--Colored-->
                                <label for="piste_number" class="label_text hidden colored_group">PISTE COLOR</label>
                                <div class="color_select hidden colored_group" id="colored_color_select">

                                    <input type="radio" class="blue" id="blue" name="piste_color" value="1">
                                    <label for="blue"></label>
                                    <input type="radio" class="yellow" id="yellow" name="piste_color" value="2">
                                    <label for="yellow"></label>
                                    <input type="radio" class="green" id="green" name="piste_color" value="3">
                                    <label for="green"></label>
                                    <input type="radio" class="red" id="red" name="piste_color" value="4">
                                    <label for="red"></label>
                                </div>

                                <label for="piste_number" class="label_text hidden colored_group">PISTE NUMBER</label>
                                <input type="number" class="number_input small hidden colored_group" placeholder="e.g. 2" name="colored_piste_number">

                                <!--Numbered-->
                                <label for="piste_quanitity" class="label_text hidden numbered_group">PISTE QUANTITY</label>
                                <input type="number" class="number_input small hidden numbered_group" placeholder="e.g. 2" name="quantity">

                                <label for="piste_quanitity" class="label_text hidden numbered_group">PISTE START NUMBER</label>
                                <input type="number" class="number_input small hidden numbered_group" placeholder="e.g. 2" name="start_num">

                            </form>
                        <button type="submit" name="create_piste" class="panel_submit" form="create_piste" value="Import">Create</button>
                    </div>
                </div>
                <div id="page_content_panel_main">
                    <div id="pistes_wrapper">

                    <div id="main_pistes_wrapper" class="piste_wrapper">

                        <?php

                        $query_main = "SELECT * FROM pistes_$comp_id WHERE piste_type = 1";
                        $query_main_do = mysqli_query($connection, $query_main);

                        while($row = mysqli_fetch_assoc($query_main_do)){

                            $piste_id = $row["id"];
                            $piste_number = $row["piste_number"];
                            $piste_activity = $row["piste_activity"];

                            ?>

                            <div id="<?php echo $piste_id ?>" class="piste main">
                            <div>M</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: <?php echo $piste_number ?></p>
                                <div class="piste_status_indicator <?php

                                if($piste_activity == 0){

                                    echo "green";

                                }else{

                                    echo "red";

                                }

                                ?>"></div>
                            </div>
                            <div>
                                <button class="piste_config_button" onclick="togglePisteSettings(this)">
                                    <img src="../assets/icons/settings-black-18dp.svg" >
                                </button>
                            </div>
                            <form  method="POST" class="piste_settings_panel">
                                <div class="link_wrapper hidden">
                                    <input name="id_to_change" class="hidden" value="<?php echo $piste_id ?>"/>
                                    <input type="text" class="link_input">
                                    <button type="button" onclick="closeLinkWrapper(this)">
                                        <img src="../assets/icons/close-black-18dp.svg">
                                    </button>
                                </div>
                                <div class="settings_wrapper">
                                    <div>
                                        <p>Control</p>
                                        <button class="selected">
                                            <img src="../assets/icons/smartphone-black-18dp.svg" >
                                        </button>
                                        <button>
                                            <img src="../assets/icons/laptop-black-18dp.svg" >
                                        </button>
                                    </div>
                                    <div>
                                        <p>Live</p>
                                        <button type="button" onclick="liveButton(this)">
                                            <img src="../assets/icons/live_tv-black-18dp.svg" >
                                        </button>
                                    </div>
                                    <div>
                                        <p>Delete</p>
                                        <button name="delete_piste" id="delete_piste" type="submit">
                                            <img src="../assets/icons/delete-black-18dp.svg" >
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>



                        <?php
                        }
                        ?>

                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>

                    </div>

                    <div id="colored_pistes_wrapper" class="piste_wrapper">

                        <?php

                        $query_colored = "SELECT * FROM pistes_$comp_id WHERE piste_type = 2 ORDER BY piste_number";
                        $query_colored_do = mysqli_query($connection, $query_colored);

                        while($row = mysqli_fetch_assoc($query_colored_do)){

                            $piste_id = $row["id"];
                            $piste_number = $row["piste_number"];
                            $piste_activity = $row["piste_activity"];
                            $piste_color = $row["piste_color"];



                            ?>

                        <div id="<?php echo $piste_id ?>" class="piste <?php echo pisteColor($piste_color); ?>">
                            <div><?php echo pisteColorLetter($piste_color); ?></div>
                            <div>
                                <p>Piste</p>
                                <p>No.: <?php echo $piste_number ?></p>
                                <div class="piste_status_indicator <?php

                                if($piste_activity == 0){

                                    echo "green";

                                }else{

                                    echo "red";

                                }


                                ?>"></div>
                            </div>
                            <div>
                                <button class="piste_config_button" onclick="togglePisteSettings(this)">
                                    <img src="../assets/icons/settings-black-18dp.svg" >
                                </button>
                            </div>
                            <form method="POST" class="piste_settings_panel">
                                <div class="link_wrapper hidden">
                                    <input name="id_to_change" class="hidden" value="<?php echo $piste_id ?>"/>
                                    <input type="text" class="link_input">
                                    <button type="button" onclick="closeLinkWrapper(this)">
                                        <img src="../assets/icons/close-black-18dp.svg">
                                    </button>
                                </div>
                                <div class="settings_wrapper">
                                    <div>
                                        <p>Control</p>
                                        <button class="selected">
                                            <img src="../assets/icons/smartphone-black-18dp.svg" >
                                        </button>
                                        <button>
                                            <img src="../assets/icons/laptop-black-18dp.svg" >
                                        </button>
                                    </div>
                                    <div>
                                        <p>Live</p>
                                        <button type="button" onclick="liveButton(this)">
                                            <img src="../assets/icons/live_tv-black-18dp.svg" >
                                        </button>
                                    </div>
                                    <div>
                                        <p>Delete</p>
                                        <button name="delete_piste" id="delete_piste" type="submit">
                                            <img src="../assets/icons/delete-black-18dp.svg" >
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <?php
                        }
                        ?>

                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                    </div>



                    <div id="numbered_pistes_wrapper" class="piste_wrapper">


                    <?php

                    $query_numbered = "SELECT * FROM pistes_$comp_id WHERE piste_type = 3 ORDER BY piste_number";
                    $query_numbered_do = mysqli_query($connection, $query_numbered);

                    while($row = mysqli_fetch_assoc($query_numbered_do)){

                            $piste_id = $row["id"];
                            $piste_number = $row["piste_number"];
                            $piste_activity = $row["piste_activity"];
                        ?>


                        <div id="<?php echo $piste_id ?>" class="piste numbered">
                            <div><?php echo $piste_number ?></div>
                            <div>
                                <p>Piste</p>
                                <p>No.: <?php echo $piste_number ?></p>
                                <div class="piste_status_indicator <?php

                                if($piste_activity == 0){

                                    echo "green";

                                }else{

                                    echo "red";

                                }


                                ?>"></div>
                            </div>
                            <div>
                                <button class="piste_config_button" onclick="togglePisteSettings(this)">
                                    <img src="../assets/icons/settings-black-18dp.svg" >
                                </button>
                            </div>
                            <form method="POST" class="piste_settings_panel">
                                <div class="link_wrapper hidden">
                                    <input name="id_to_change" class="hidden" value="<?php echo $piste_id ?>"/>
                                    <input type="text" class="link_input">
                                    <button type="button" onclick="closeLinkWrapper(this)">
                                        <img src="../assets/icons/close-black-18dp.svg">
                                    </button>
                                </div>
                                <div class="settings_wrapper">
                                    <div>
                                        <p>Control</p>
                                        <button class="selected">
                                            <img src="../assets/icons/smartphone-black-18dp.svg" >
                                        </button>
                                        <button>
                                            <img src="../assets/icons/laptop-black-18dp.svg" >
                                        </button>
                                    </div>
                                    <div>
                                        <p>Live</p>
                                        <button type="button" onclick="liveButton(this)">
                                            <img src="../assets/icons/live_tv-black-18dp.svg" >
                                        </button>
                                    </div>
                                    <div>
                                        <p>Delete</p>
                                        <button name="delete_piste" id="delete_piste" type="submit">
                                            <img src="../assets/icons/delete-black-18dp.svg" >
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php
                    }
                    ?>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                    </div>
                </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/pistes.js"></script>
</html>