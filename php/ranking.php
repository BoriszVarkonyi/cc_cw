<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

$ranking_id = $_GET["rankid"]; 
$drop_row_feedback = "";
$drop_table_feedback = "";
$insert_feedback = "";
$last_row_fencer_dob = NULL;
$last_row_fencer_name = NULL;
//jelenlegi tábla neve 
$table_name = "rk_" . $ranking_id;


if(isset($_POST["create"])){

$create_query = "CREATE TABLE `ccdatabase`.`rk_$ranking_id` ( id INT(11) NOT NULL AUTO_INCREMENT , name VARCHAR(255) NOT NULL , nationality VARCHAR(255) NOT NULL , position INT(11) NOT NULL , points INT(20) NOT NULL , dob DATE NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB;";
$create_query_do = mysqli_query($connection, $create_query);

header("Location: choose_ranking.php?comp_id=$comp_id&rankid=$ranking_id");


}

if(isset($_POST["undo"])){

$query = "DELETE FROM `ranking` WHERE ass_comp_id = $comp_id";
$query_do = mysqli_query($connection, $query);

header("Location: choose_ranking.php?comp_id=$comp_id&rankid=$ranking_id");

}

$chck_for_rows = "SELECT * FROM $table_name";

if ($result = mysqli_query($connection, $chck_for_rows)) {

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);
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

<?php 

$query = "SELECT * 
FROM `information_schema`.`tables`
WHERE table_schema = 'ccdatabase' 
    AND table_name = 'rk_$ranking_id'
LIMIT 1;";
$query_do = mysqli_query($connection, $query);

if(mysqli_num_rows($query_do) == 0){
?>

<div id="confirmation" autocomplete="off">
        <form id="create_ranking_form" action="" method="POST">
            <p>Are you sure you want to create a new ranking?</p>
            <div id="confirmation_button_section">
                <input class="hidden" type="text" id="remove_date" name="remove_date">
                <button onclick="" name="undo" type="submit" value="Cancel">Cancel</button>
                <button onclick="" name="create" type="submit" class="action">Create</button>
            </div>
        </form>
    </div>

<?php
}
?>

    



<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Ranking</p>

                    <button class="stripe_button" type="submit" method="post" form="needed_equimpment_wrapper" onclick="toggleRankingInfo()">
                        <p>Ranking Information</p>
                        <img src="../assets/icons/info-black-18dp.svg"></img>
                    </button>
                
                    <!-- delete ranking button -->
                    <form action="ranking.php?comp_id=<?php echo $comp_id ?>&rankid=<?php echo $ranking_id ?>" method="post" id="delete_ranking" class="hidden"></form>
                    <button class="stripe_button red" type="submit" name="drop_table" form="delete_ranking">
                        <p>Delete Ranking</p>
                        <img src="../assets/icons/delete-black-18dp.svg"></img>
                    </button>
                
                    <?php

                        if (isset($_POST['drop_table'])) {

                            //queryes
                            $change_comp_rank_id = "UPDATE competitions SET comp_ranking_id = 0";
                            $drop_table = "DROP TABLE $table_name";
                            $drop_row = "DELETE FROM ranking WHERE id = '$ranking_id'";
                            
                            //drop table feedback
                            if (mysqli_query($connection, $drop_table)) {
                                $drop_table_feedback = $table_name . " has been dropped!";
                            } else {
                                $drop_table_feedback = mysqli_error($connection) . " :You had a problem with the TABLE dropping!";
                            }

                            //drop row feedback
                            if (mysqli_query($connection, $drop_row)) {
                                $drop_row_feedback = $table_name . " has been dropped!";
                            } else {
                                $drop_row_feedback = mysqli_error($connection) . " :You had a problem with the ROW dropping!";
                            }

                            //change comp_ranking_id in comp to 0 back
                            if (mysqli_query($connection, $change_comp_rank_id)) {
                                $rank_id_change_feedback = "comp_rank_id has been changed has been changed!";
                            } else {
                                $rank_id_change_feedback = mysqli_error($connection) . " :You had a problem with changing rank id in compteititons table!";
                            }

                            header("Location: http://localhost/php/choose_ranking.php?comp_id=52");
                        }  
                    ?>
                
                    <button class="stripe_button disabled" type="submit" form="needed_equimpment_wrapper" onclick="toggleAddFencer()">
                        <p>Delete fencer</p>
                        <img src="../assets/icons/delete-black-18dp.svg"></img>
                    </button>

                    <button class="stripe_button bold" type="submit" form="needed_equimpment_wrapper" onclick="toggleAddFencer()">
                        <p>Add fencer</p>
                        <img src="../assets/icons/add-black-18dp.svg"></img>
                    </button>

                    <div id="add_fencer_panel" class="big_overlay_panel overlay_panel hidden">
                            <button id="close_button" class="round_button" onclick="toggleAddFencer()">
                                <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
                            </button>
                            <!-- add fencers drop-down -->
                            <div class="form_wrapper_small">
                                <form action="ranking.php?comp_id=<?php echo $comp_id ?>&rankid=<?php echo $ranking_id ?>" method="post" id="new_fencer" autocomplete="off">
                                    <label for="fencers_name" class="label_text">NAME</label></br>
                                    <input type="text" placeholder="Type the fencers's name" id="username_input" name="fencer_name"><br>

                                    <label for="fencers_nationality" class="label_text">NATIONALITY</label></br>
                                    <input type="search" name="fencers_nationality" id="username_input" placeholder="Type the fencers's nationality">

                                    <label for="fencers_points" class="label_text">POINTS</label></br>
                                    <input type="number" placeholder="-" class="number_input extra_small" name="fencer_points"><br>

                                    <label for="fencers_dob" class="label_text">DATE OF BIRTH</label></br>
                                    <input type="date" name="fencer_dob"><br>
                                    <button type="submit" name="submit" class="submit_button" value="Save">Save</button>
                                </form>
                            </div>
                    </div>
                                        <!-- ranking info button -->
                                        <div id="ranking_info_panel" class="thin_overlay_panel overlay_panel hidden">
                        <button id="close_button" class="round_button" onclick="toggleRankingInfo()">
                            <img src="../assets/icons/close-black-18dp.svg" alt="" class="round_button_icon">
                        </button>

                        
                        <?php
                        //ranking info hidden box
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
                        
                </div>
                <div id="page_content_panel_main">




                <?php 
                    if ($row_cnt == 0) {
                ?>

                        <!-- you have no fenceers set up div -->
                        <div id="no_something_panel">
                            <p>You have no fencers set up!</p>
                        </div>

                <?php 
                    }
                ?>
                    <?php

                        echo $drop_row_feedback . $drop_table_feedback;

                        //getting last row of $table_name
                        $query_get_last_row = "SELECT * FROM $table_name  ORDER BY id DESC LIMIT 1;";
                        $result = mysqli_query($connection, $query_get_last_row);

                        if($row = mysqli_fetch_assoc($result)){
                            
                            $last_row_fencer_name = $row["name"];
                            $last_row_fencer_nationality = $row["nationality"];
                            $last_row_fencer_points = $row["points"];
                            $last_row_fencer_dob = $row["dob"];
                        }
                        

                        //testing for duplicate lines & insertin new fencer to DB
                        if (isset($_POST['submit'])) {

                            $fencer_name = $_POST['fencer_name'];
                            $fencers_nationality = $_POST['fencers_nationality'];
                            $fencer_points = $_POST['fencer_points'];
                            $fencer_dob = $_POST['fencer_dob'];

                            $query_insert_data = "INSERT INTO $table_name (name, nationality, points, dob) VALUES ('$fencer_name', '$fencers_nationality', '$fencer_points', '$fencer_dob')";

                            if ($last_row_fencer_name != $fencer_name && $last_row_fencer_dob != $fencer_dob || $row_cnt == 0) {
                                
                                if (mysqli_query($connection, $query_insert_data)) {
                                    $insert_feedback = "New record created successfully";

                                } else {
                                    $insert_feedback = "Error: " . $query_insert_data . "<br>" . $connection->error;
                                }
                                header("Refresh:0");

                            }
                            else {

                                $insert_feedback = "You allready added this fencer!";

                            }
                        }
                    ?>

                    <div id="ranking_wrapper">

                        <?php
                            if ($row_cnt != 0) {
                        ?>
                                <div class="table_header">
                                    <div class="table_header_text">POSITION</div>
                                    <div class="table_header_text">POINTS</div>
                                    <div class="table_header_text">NAME</div>
                                    <div class="table_header_text">NATIONALITY</div>
                                    <div class="table_header_text">DATE OF BIRTH</div>
                                </div>
                        <?php

                            } 
                    
                    $query = "SELECT * FROM $table_name ORDER BY points DESC";
                    $query_do = mysqli_query($connection, $query);
                    $pos = 1;
                
                // fencers dinamic table
                while($row = mysqli_fetch_assoc($query_do)) {

                    $id = $row['id'];
                    $name = $row["name"];
                    $nat = $row["nationality"];
                    $points = $row["points"];
                    $dob = $row["dob"];


                    //postion changing in database and dinamic table
                    $query_pos = "UPDATE $table_name SET position = $pos WHERE id = $id";

                    if (mysqli_query($connection, $query_pos)) {
                        $pos_feedback = "position has been changed in" . $table_name;
                    } else {
                        $pos_feedback = mysqli_error($connection);
                    }

                    ?>


                        <div class="table_row">

                            <div class="table_item"><?php echo $pos ?></div>
                            <div class="table_item"><?php echo $points ?></div>
                            <div class="table_item"><?php echo $name ?></div>
                            <div class="table_item"><?php echo $nat ?></div>
                            <div class="table_item"><?php echo $dob ?></div>

                        </div>
                                            
                   <?php 

                   $pos += 1;
                }
                   ?> 
                    </div>
                </div>
        </div>
    </body>
<script src="../js/ranking.js"></script>
<script src="../js/main.js"></script>
</html>