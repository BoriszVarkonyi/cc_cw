<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php

    class basic_info {
        public $host_country;
        public $city_street;
        public $zip_code;
        public $entry_fee;
        public $starting_date;
        public $ending_date;
        public $end_of_pre_reg;

        function __construct($host_country, $location, $zip_code, $entry_fee, $starting_date, $ending_date, $end_of_pre_reg) {
            $this -> host_country = $host_country;
            $this -> city_street = $location;
            $this -> zip_code = $zip_code;
            $this -> entry_fee = $entry_fee;
            $this -> starting_date = $starting_date;
            $this -> ending_date = $ending_date;
            $this -> end_of_pre_reg = $end_of_pre_reg;
        }

        function get_somethin($something) {
            return $this -> $something;
        }


    }


    //make table "basic_info";
    $qry_make_table = "CREATE TABLE `ccdatabase`.`basic_info` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_make_table = mysqli_query($connection, $qry_make_table);

    //get data from table
    $qry_get_data = "SELECT `data` FROM `basic_info` WHERE `assoc_comp_id` = '$comp_id';";
    $do_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $json_string = $row['data'];

        $json_table = json_decode($json_string);
        echo "fasz";
    } else {
        $json_table = "";

        $qry_new_row = "INSERT INTO `basic_info` (`assoc_comp_id`) VALUES ('$comp_id')";
        $do_new_row = mysqli_query($connection, $qry_new_row);
        echo mysqli_error($connection);
    }

    //upload data
    if (isset($_POST['submit'])) {
        $host_country = $_POST['host_country'];
        $city_street = $_POST['location'];
        $zip_code = $_POST['postal'];
        $entry_fee = $_POST['entry_fee'];
        $starting_date = $_POST['start_date'];
        $ending_date = $_POST['end_date'];
        $end_of_pre_reg = $_POST['end_pre_reg'];

        $json_table = new basic_info($host_country, $city_street, $zip_code, $entry_fee, $starting_date, $ending_date, $end_of_pre_reg);
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        $qry_update_row = "UPDATE basic_info SET  data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        $do_update_row = mysqli_query($connection, $qry_update_row);
        echo mysqli_error($connection);
        header("Refresh:0");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Information</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Basic Information</p>
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
<script src="javascript/cookie_monster.js"></script>
<script src="javascript/main.js"></script>
<script src="javascript/basic_information.js"></script>
</body>
</html>