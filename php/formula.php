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
                    <img src="../assets/icons/save-black-18dp.svg" />
                </button>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/build-black-18dp.svg"  class="db_panel_stripe_icon">
                        <p>Set basic information</p>
                    </div>
                    <div class="db_panel_main">

                    <form action="" class="column_form_wrapper" method="POST">
                        <div class="form_column">
                            <label for="points_pools" >POINTS IN POOLS</label>
                            <input type="number" name="points_pools"  class="number_input extra_small" value="5">

                            <label for="points_table" >POINTS IN TABLE</label>
                            <input type="number" name="points_table"  class="number_input extra_small" value="15">
                        
                            <label for="round_number_ranking" >NUMBER OF ROUND FOR RANKING</label>
                            <input type="number" name="round_number_ranking"  class="number_input extra_small" value="1">

                            <label for="elimnation_type" >ELIMINATION TYPE</label>
                            <div class="option_container">
                                <input type="radio" name="elimnation_type" id="direct_et" value="" checked/>
                                <label for="direct_et">Direct-Elimination Tournament</label>

                                <input type="radio" name="elimnation_type" id="double_et" value="" disabled/>
                                <label for="double_et">Double-Elimination Tournament</label>
                            </div>

                        </div>
                        <div class="form_column">
                            <label for="exempted_fencers_pools" >NUMBER OF EXEMPTED FENCERS IN POOLS</label>
                            <input type="number" name="exempted_fencers_pools"  class="number_input extra_small" value="0">

                            <label for="exempted_fencers_table" >NUMBER OF EXEMPTED FENCERS IN TABLE</label>
                            <input type="number" name="exempted_fencers_table"  class="number_input extra_small" value="0">

                            <label for="third_place" >FENCING FOR 3RD PLACE</label>
                            <div class="option_container">
                                <input type="radio" name="third_place" id="third_place_yes" value="" disabled/>
                                <label for="third_place_no">Yes</label>

                                <input type="radio" name="third_place" id="third_place_no" value="" checked/>
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