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

$query_create_table = "CREATE TABLE `pistes_$comp_id` ( id INT(11) NOT NULL , piste_number INT(11) NOT NULL , piste_type INT(11) NOT NULL , piste_color INT(11) NOT NULL , piste_live VARCHAR(255) NOT NULL , piste_control_type INT(11) NOT NULL , piste_activity INT(11) NOT NULL ) ENGINE = InnoDB;";
$query_create_table_do = mysqli_query($connection, $query_create_table);

if(!$query_create_table_do){
echo mysqli_error($connection);
}

}else {

echo "ALREADY";

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp's name}'s pistes</title>
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
                    <button class="stripe_button" type="submit">
                        <p>Configure match control</p>
                        <img src="../assets/icons/settings_applications-black-18dp.svg"></img>
                    </button>
                    <button class="stripe_button orange" onclick="toggleAddPistePanel()">
                        <p>Add Piste</p>
                        <img src="../assets/icons/add-black-18dp.svg"></img>
                    </button>

                    <div class="overlay_panel hidden" id="add_piste_panel">
                        <button class="panel_button" onclick="">
                            <img src="../assets/icons/close-black-18dp.svg" alt="">
                        </button>

                        <div class="overlay_panel_form">
                            <form action="" id="create_piste">
                                <label for="username" class="label_text">TYPE</label></br>
                                <div class="option_container row">
                                    <input type="radio" onclick="mainPiste()" name="wc_type" id="main" value=""/>
                                    <label for="main">Main</label>

                                    <input type="radio" onclick="coloredPiste()" name="wc_type" id="colored" value=""/>
                                    <label for="colored">Colored</label>

                                    <input type="radio" onclick="numberedPiste()" name="wc_type" id="numbered" value=""/>
                                    <label for="numbered">Numbered</label>
                                </div>

                                <!--Main-->
                                <label for="piste_number" id="mainpiste_num_label" class="label_text hidden">PISTE NUMBER</label></br>
                                <input type="number" id="mainpiste_num_input" class="number_input small hidden" placeholder="e.g. 2" name="piste_number"></br>
                                
                                <!--Colored-->
                                <label for="piste_number" class="label_text">PISTE COLOR</label></br>
                                <input type="number" class="hidden">
                                <div class="color_select" id="colored_color_select">
                                    <button type="button" class="red" onclick="coloredPisteCreateButton(this)"></button>
                                    <button type="button" class="blue" onclick="coloredPisteCreateButton(this)"></button>
                                    <button type="button" class="green" onclick="coloredPisteCreateButton(this)"></button>
                                    <button type="button" class="yellow" onclick="coloredPisteCreateButton(this)"></button>
                                </div>

                                <label for="piste_number" class="label_text">PISTE NUMBER</label></br>
                                <input type="number" class="number_input small" placeholder="e.g. 2"></br>

                                <!--Numbered-->




                                <label for="piste_quanitity" class="label_text">PISTE QUANTITY</label></br>
                                <input type="number" class="number_input small" placeholder="e.g. 2"></br>

                                <label for="piste_quanitity" class="label_text">PISTE START NUMBER</label></br>
                                <input type="number" class="number_input small" placeholder="e.g. 2"></br>



                            </form>
                            
                        </div>
                        <button type="submit" name="import_tech" class="panel_submit" form="create_piste" value="Import">Create</button>
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
                                    <img src="../assets/icons/settings-black-18dp.svg" alt="">
                                </button>
                            </div>
                            <form class="piste_settings_panel collapsed">
                                <div>
                                    <p>Control</p>
                                    <button class="selected">
                                        <img src="../assets/icons/smartphone-black-18dp.svg" alt="">
                                    </button>
                                    <button>
                                        <img src="../assets/icons/laptop-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Live</p>
                                    <button>
                                        <img src="../assets/icons/live_tv-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Delete</p>
                                    <button>
                                        <img src="../assets/icons/delete-black-18dp.svg" alt="">
                                    </button>
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
                                    <img src="../assets/icons/settings-black-18dp.svg" alt="">
                                </button>
                            </div>
                            <form class="piste_settings_panel collapsed">
                                <div>
                                    <p>Control</p>
                                    <button class="selected">
                                        <img src="../assets/icons/smartphone-black-18dp.svg" alt="">
                                    </button>
                                    <button>
                                        <img src="../assets/icons/laptop-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Live</p>
                                    <button>
                                        <img src="../assets/icons/live_tv-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Delete</p>
                                    <button>
                                        <img src="../assets/icons/delete-black-18dp.svg" alt="">
                                    </button>
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
                                    <img src="../assets/icons/settings-black-18dp.svg" alt="">
                                </button>
                            </div>
                            <form class="piste_settings_panel collapsed">
                                <div>
                                    <p>Control</p>
                                    <button class="selected">
                                        <img src="../assets/icons/smartphone-black-18dp.svg" alt="">
                                    </button>
                                    <button>
                                        <img src="../assets/icons/laptop-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Live</p>
                                    <button>
                                        <img src="../assets/icons/live_tv-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Delete</p>
                                    <button>
                                        <img src="../assets/icons/delete-black-18dp.svg" alt="">
                                    </button>
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