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
                        <button id="close_button" class="round_button" onclick="toggle_add_technician()">
                            <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
                        </button>

                        <div class="overlay_panel_form">
                            <form action="" id="create_piste">
                                <label for="username" class="label_text">TYPE</label></br>
                                <div class="option_container row">
                                    <input type="radio" name="wc_type" id="main" value=""/>
                                    <label for="main">Main</label>

                                    <input type="radio" name="wc_type" id="colored" value=""/>
                                    <label for="colored">Colored</label>

                                    <input type="radio" name="wc_type" id="numbered" value=""/>
                                    <label for="numbered">Numbered</label>
                                </div>

                                <!--Main-->
                                <label for="piste_number" class="label_text">PISTE NUMBER</label></br>
                                <input type="number" class="number_input small" placeholder="e.g. 2" name="piste_number"></br>
                                
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
                        <button type="submit" name="import_tech" class="submit_button" form="create_piste" value="Import">Create</button>
                    </div>
                </div>
                <div id="page_content_panel_main">
                    <div id="pistes_wrapper">
                    <div id="main_pistes_wrapper" class="piste_wrapper">
                        <div id="m_1" class="piste main">
                            <div>M</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                    </div>
                    <div id="colored_pistes_wrapper" class="piste_wrapper">
                        <div id="m_1" class="piste red">
                            <div>R</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div id="m_1" class="piste red">
                            <div>R</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div id="m_1" class="piste green">
                            <div>G</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div id="m_1" class="piste green">
                            <div>M</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div id="m_1" class="piste yellow">
                            <div>M</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div id="m_1" class="piste yellow">
                            <div>M</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div id="m_1" class="piste blue">
                            <div>M</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div id="m_1" class="piste blue">
                            <div>M</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                    </div>
                    <div id="numbered_pistes_wrapper" class="piste_wrapper">
                        <div id="m_1" class="piste numbered">
                            <div>1</div>
                            <div>
                                <p>Main Piste</p>
                                <p>No.: 1</p>
                                <div class="piste_status_indicator"></div>
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