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
    <title>Ranking</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>





    <div id="confirmation" class="" autocomplete="off">
        <form id="create_ranking_form" action="timetable.php?comp_id=<?php echo $comp_id ?>" method="POST">
            <p>This ranking will be avalible to alter for anybody who has the password!</p>
            <div id="confirmation_button_section">
                <input class="hidden" type="text" id="remove_date" name="remove_date">
                <button onclick="" type="button" value="Cancel">Cancel</button>
                <button onclick="" name="create" type="submit" value="{Action}" class="action">Create</button>
            </div>
        </form>
    </div>






<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">Ranking</p>
                    <button class="stripe_button first_stripe_item" type="submit" form="needed_equimpment_wrapper" onclick="toggleRankingInfo()">
                        <p class="stripe_button_text">Ranking Information</p>
                        <img class="stripe_button_icon" src="../assets/icons/info-black-18dp.svg"></img>
                    </button>
                    <button class="stripe_button orange red" type="submit" form="needed_equimpment_wrapper">
                        <p class="stripe_button_text">Delete Ranking</p>
                        <img class="stripe_button_icon" src="../assets/icons/delete-black-18dp.svg"></img>
                    </button>
                    <button class="stripe_button last_stripe_item" type="submit" form="needed_equimpment_wrapper" onclick="toggleAddFencer()">
                        <p class="stripe_button_text">Add fencer</p>
                        <img class="stripe_button_icon" src="../assets/icons/add-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">

                    <div id="add_fencer_panel" class="big_overlay_panel overlay_panel hidden">
                            <button id="close_button" class="round_button" onclick="toggleAddFencer()">
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

                                <label for="fencers_points" class="label_text">POINTS</label></br>
                                <input type="number" placeholder="-" class="number_input extra_small" name="fencer_points"><br>

                                <label for="fencers_dob" class="label_text">DATE OF BIRTH</label></br>
                                <input type="date" name="fencer_dob"><br>
                                <button type="submit" name="submit" class="submit_button" value="Save">Save</button>
                            </form>
                        </div>
                    </div>

                    <div id="ranking_info_panel" class="thin_overlay_panel overlay_panel hidden">
                        <button id="close_button" class="round_button" onclick="toggleRankingInfo()">
                            <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
                        </button>


                        <?php
                        
                        $get_ranking_info = "SELECT * FROM ranking WHERE ass_comp_id = $comp_id";
                        $get_ranking_info_do = mysqli_query($connection, $get_ranking_info);
                        
                        if($row = mysqli_fetch_assoc($get_ranking_info_do)){

                           $name = $row["name"];
                           $pass = $row["password"];

                        }

                        ?>

                        <label class="label_text">NAME</label>
                        <p><?php echo $name ?></p>
                        <label class="label_text">PASSWORD</label>
                        <div>
                            <p><?php echo $pass ?></p>
                            <button onclick="hidePasswords(this)" id="visibility_button">
                                <img src="../assets/icons/visibility-black-18dp.svg" alt="">
                            </button>
                        </div>
                    </div>

                    <div id="ranking_wrapper">
                        <div class="table_header">
                            <div class="table_header_text">POSITION</div>
                            <div class="table_header_text">POINTS</div>
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">NATIONALITY</div>
                            <div class="table_header_text">DATE OF BIRTH</div>
                        </div>
                        <?php/*
                    
                    $query = "SELECT * FROM fencers_$comp_org WHERE competition = $comp_id";
                    $query_do = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($query_do)){

                    $position = $row["position"];
                    $name = $row["name"];
                    $nationality = $row["nationality"];?>


                        <div class="table_row">
                            <div class="table_item"> <input type="number" name="" id="" value="<?php echo $position ?>"> </div>
                            <div class="table_item"></div>
                            <div class="table_item"><?php echo $name ?></div>
                            <div class="table_item"><?php echo $nationality ?></div>
                            <div class="table_item"></div>
                        </div>

                   <?php*/ } ?> 
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/ranking.js"></script>
<script src="../js/main.js"></script>
</html>