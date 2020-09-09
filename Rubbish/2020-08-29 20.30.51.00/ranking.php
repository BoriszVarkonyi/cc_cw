<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

$comp_org = $_COOKIE["org_id"];

if(isset($_POST["create"])){

    $create_table = "CREATE TABLE `ccdatabase`.`fencers_$comp_org` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `position` INT(11) NOT NULL , `name` VARCHAR(255) NOT NULL , `dob` DATE NOT NULL  , `nationality` VARCHAR(255) NOT NULL , `licence` INT(11) NOT NULL , `pre_registered` INT(11) NOT NULL DEFAULT '0' , `competition` INT(11) NOT NULL, `allowed` INT NOT NULL , `registered` INT NOT NULL , `weapon_control` INT NOT NULL , `temp_position` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $create_table_do = mysqli_query($connection, $create_table);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ranking</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="confirmation" class="hidden">
        <form id="confirmation_form" action="timetable.php?comp_id=<?php echo $comp_id ?>" method="POST">
            <button id="close_button" class="round_button" type="button" onclick="closeConf()">
                <img src="../assets/icons/close-black-18dp.svg" class="round_button_icon">
            </button>
            <p id="remove_warning"></p>
            <p>You cannot withdraw this action!</p>
            <div id="confirmation_button_section">
            <input class="hidden" type="text" id="remove_date" name="remove_date">
                <button onclick="closeConf()" type="button" value="Cancel">Cancel</button>
                <button onclick="" name="sure_delete" type="submit" value="{Action}" class="action">Remove</button>
            </div>
        </
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">Ranking</p>
                    <button class="stripe_button orange first_stripe_item red" type="submit" form="needed_equimpment_wrapper">
                        <p class="stripe_button_text">Delete Ranking</p>
                        <img class="stripe_button_icon" src="../assets/icons/delete-black-18dp.svg"></img>
                    </button>
                    <button class="stripe_button last_stripe_item" type="submit" form="needed_equimpment_wrapper">
                        <p class="stripe_button_text">Add fencer</p>
                        <img class="stripe_button_icon" src="../assets/icons/add-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">

                    <div id="add_fencer_panel" class="big_overlay_panel overlay_panel" >
                            <button id="close_button" class="round_button" onclick="toggle_add_technician()">
                                <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
                            </button>
                            <div class="form_wrapper_small">
                            <form action="" method="" id="new_fencer" autocomplete="off">
                                <label for="fencers_name" class="label_text">NAME</label></br>
                                <input type="text" placeholder="Type the fencers's name" id="username_input" name="fencer_name"><br>

                                <label for="fencers_nationality" class="label_text">NATIONALITY</label></br>
                                <input type="search" name="fencers_nationality" id="" placeholder="idk">
                    
                                <label for="fencers_position" class="label_text">POSITION</label></br>
                                <input type="number" placeholder="-" class="number_input extra_small" name="fencer_position"><br>

                                <button type="submit" name="submit" class="submit_button">
                                    <span class="submit_button_text">Save</span>
                                </button>
                            </form>
                            </div>
                        </div>






















                    <div id="ranking_wrapper">
                        <div class="table_header">
                            <div class="table_header_text">POSITION</div>
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">NATIONALITY</div>
                        </div>
                        <?php
                    
                    $query = "SELECT * FROM fencers_$comp_org WHERE competition = $comp_id";
                    $query_do = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($query_do)){

                    $position = $row["position"];
                    $name = $row["name"];
                    $nationality = $row["nationality"];?>


                        <div class="table_row">
                            <div class="table_item"> <input type="number" name="" id="" value="<?php echo $position ?>"> </div>
                            <div class="table_item"><?php echo $name ?></div>
                            <div class="table_item"><?php echo $nationality ?></div>
                        </div>


                   <?php } ?> 
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>