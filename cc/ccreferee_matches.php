<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Matches</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<!DOCTYPE html>
<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Matches</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="submit" name="submit" form="basic_information_form">
                        <p id="save_text">Save Information</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_header">
                        <img src="../assets/icons/build_black.svg">
                        <p>Set basic information</p>
                    </div>
                    <form class="db_panel_main" action="" id="basic_information_form" method="POST">
                        <?php



                            if ($json_table != "") {
                                $host_country = $json_table -> host_country;
                                $city_street = $json_table -> city_street;
                                $zip_code = $json_table -> zip_code;
                                $entry_fee = $json_table -> entry_fee;
                                $starting_date = $json_table -> starting_date;
                                $ending_date = $json_table -> ending_date;
                                $end_of_pre_reg = $json_table -> end_of_pre_reg;

                            } else {
                                $host_country = "";
                                $city_street = "";
                                $zip_code = "";
                                $entry_fee = "";
                                $starting_date = "";
                                $ending_date = "";
                                $end_of_pre_reg = "";
                            }




                        ?>
                        <div class="form_wrapper">
                            <div>
                                <div>
                                    <label for="host_country">HOST COUNTRY</label>
                                    <input type="text" placeholder="Type the name of the country" name="host_country" class="country_input" id="country_input" value="<?php
                                        echo $host_country;

                                    ?>">
                                </div>
                                <div>
                                    <label for="location">LOCATION AND ADDRESS</label>
                                    <input type="text" placeholder="Street, District, City, Region" name="location" class="no_bottom_margin location_input" id="location_input" value="<?php
                                        echo $city_street;


                                    ?>">
                                    <input type="number" placeholder="Zip Code" name="postal" class="number_input centered" id="postal_input" value="<?php
                                        echo $zip_code;

                                    ?>">
                                </div>
                                <div>
                                    <label for="entry_fee">ENTRY-FEE</label>
                                    <input type="text" placeholder="Type in the amount and currency" name="entry_fee" class="number_input money_input" value="<?php

                                    echo $entry_fee;

                                    ?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="start_date">STARTING DATE</label>
                                    <input type="date" name="start_date" class="start_date_input" id="start_date_input" value="<?php

                                        echo $starting_date;

                                    ?>">
                                </div>
                                <div>
                                    <label for="end_date">ENDING DATE</label>
                                    <input type="date" name="end_date" class="end_date_input" value="<?php

                                        echo $ending_date;

                                    ?>">
                                </div>
                                <div>
                                    <label for="end_pre_reg">END OF PRE-REGISTRATION</label>
                                    <input type="date" name="end_pre_reg" class="end_date_pre_reg" value="<?php

                                    echo $end_of_pre_reg;

                                    ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/basic_information.js"></script>
</body>
</html>