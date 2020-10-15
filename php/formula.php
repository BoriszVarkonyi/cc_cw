<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formula of {comp name}</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Formula</p>
                <button class="stripe_button orange" type="submit">
                    <p>Save Formula</p>
                    <img src="../assets/icons/save-black-18dp.svg"></img>
                </button>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="wrapper">
                    <form action="" id="basic_information_form" method="POST">
                        <div class="form_column">
                            <label for="points_pools" class="label_text">POINTS IN POOLS</label></br>
                            <input type="number" name="points_pools" id="" class="number_input extra_small" value="5"></br>

                            <label for="points_table" class="label_text">POINTS IN TABLE</label></br>
                            <input type="number" name="points_table" id="" class="number_input extra_small" value="15"></br>
                        
                            <label for="round_number_ranking" class="label_text">NUMBER OF ROUND FOR RANKING</label></br>
                            <input type="number" name="round_number_ranking" id="" class="number_input extra_small" value="1"></br>

                            <label for="elimnation_type" class="label_text">ELIMINATION TYPE</label></br>
                            <div class="option_container">
                                <input type="radio" name="elimnation_type" id="direct_et" value="" checked/>
                                <label for="direct_et">Direct-Elimination Tournament</label>

                                <input type="radio" name="elimnation_type" id="double_et" value=""/>
                                <label for="double_et">Double-Elimination Tournament</label>
                            </div>

                        </div>
                        <div class="form_column">
                            <label for="exempted_fencers_pools" class="label_text">NUMBER OF EXEMPTED FENCERS IN POOLS</label></br>
                            <input type="number" name="exempted_fencers_pools" id="" class="number_input extra_small" value="0"></br>

                            <label for="exempted_fencers_table" class="label_text">NUMBER OF EXEMPTED FENCERS IN TABLE</label></br>
                            <input type="number" name="exempted_fencers_table" id="" class="number_input extra_small" value="0"></br>

                            <label for="third_place" class="label_text">FENCING FOR 3RD PLACE</label></br>
                            <div class="option_container">
                                <input type="radio" name="third_place" id="third_place_yes" value="" checked/>
                                <label for="third_place_no">Yes</label>

                                <input type="radio" name="third_place" id="third_place_no" value=""/>
                                <label for="third_place_no">No</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>