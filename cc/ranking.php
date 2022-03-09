<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
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

    if (isset($_POST["id_to_delete"])) {

        $id_to_delete = $_POST['id_to_delete'];

        $delete_fencer_query = "DELETE FROM `$table_name` WHERE id = '$id_to_delete'";
        $delete_fencer_result = mysqli_query($connection, $delete_fencer_query);

        if (!$delete_fencer_result) {
            echo mysqli_error($connection);
        }

        header("Refresh:0");
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ranking</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
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
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Ranking</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button" type="submit" method="post" onclick="toggleRankingInfo()">
                        <p>Ranking Information</p>
                        <img src="../assets/icons/info_black.svg"/>
                    </button>

                    <!-- delete ranking button -->
                    <form action="ranking.php?comp_id=<?php echo $comp_id ?>&rankid=<?php echo $ranking_id ?>" method="post" id="delete_ranking" class="hidden"></form>
                    <button class="stripe_button red" type="submit" name="drop_table" form="delete_ranking">
                        <p>Delete Ranking</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>

                    <button class="stripe_button disabled" id="delete_fencer_button" type="submit" name="delete_fencer" form="delete_fencer_form">
                        <p>Delete fencer</p>
                        <img src="../assets/icons/delete_black.svg"/>
                    </button>

                    <button class="stripe_button primary" type="submit" onclick="toggleAddFencer()">
                        <p>Add fencer</p>
                        <img src="../assets/icons/add_black.svg"/>
                    </button>
                </div>


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

                        header("Location: http://localhost/cc/choose_ranking.php?comp_id=52");
                    }
                ?>
                <form id="delete_fencer_form" class="hidden" method="POST">
                <input class="hidden" id="id_to_delete" type="text" name="id_to_delete">
                </form>
                <div id="add_fencer_panel" class="overlay_panel hidden">
                        <button class="panel_button" name="Close panel" onclick="toggleAddFencer()">
                            <img src="../assets/icons/close_black.svg">
                        </button>
                        <!-- add fencers drop-down -->
                        <form action="ranking.php?comp_id=<?php echo $comp_id ?>&rankid=<?php echo $ranking_id ?>" method="post" id="new_fencer" autocomplete="off" class="overlay_panel_form" autocomplete="off">
                            <label for="fencers_name">NAME</label>
                            <input type="text" placeholder="Type the fencers's name" class="username_input" name="fencer_name">

                            <label for="fencers_nationality">NATION / CLUB</label>
                            <input type="text" class="search" name="fencers_nationality" class="username_input" placeholder="Type the fencers's nationality">

                            <label for="fencers_points">POINTS</label>
                            <input type="number" placeholder="#" id="ranking_points" class="number_input centered" name="fencer_points">

                            <label for="fencers_dob">DATE OF BIRTH</label>
                            <input type="date" name="fencer_dob">
                            <button type="submit" name="submit" class="panel_submit">Save</button>
                        </form>
                </div>
                <!-- ranking info button -->
                <div id="ranking_info_panel" class="overlay_panel hidden">
                    <button class="panel_button" name="Close panel" onclick="toggleRankingInfo()">
                        <img src="../assets/icons/close_black.svg">
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
                    <div class="overlay_panel_form list">
                        <label >NAME</label>
                        <p><?php echo $name ?></p>
                        <label >PASSWORD</label>
                        <div>
                            <p id="password"><?php echo $pass ?></p>
                            <button onclick="hidePasswords(this)" id="visibility_button">
                                <img src="../assets/icons/visibility_black.svg">
                            </button>
                        </div>
                    </div>
                </div>


            </div>
            <div id="page_content_panel_main">

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

                    <table class="wrapper w90">

                        <?php
                            if ($row_cnt == 0) {
                        ?>

                                <!-- you have no fenceers set up div -->
                                <div id="empty_content_notice">
                                    <p>You have no fencers set up!</p>
                                </div>

                        <?php
                            }
                        ?>

                        <?php
                            if ($row_cnt != 0) {
                        ?>
                                <thead>
                                    <tr>
                                        <th>
                                            <p>POSITION</p>
                                        </th>
                                        <th>
                                            <p>POINTS</p>
                                        </th>
                                        <th>
                                            <p>NAME</p>
                                        </th>
                                        <th>
                                            <p>NATION / CLUB</p>
                                        </th>
                                        <th>
                                            <p>DATE OF BIRTH</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
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


                                        <tr id="<?php echo $id ?>" onclick="toDelete(this)">

                                            <td class="bold"><p><?php echo $pos ?></p></td>
                                            <td><p><?php echo $points ?></p></td>
                                            <td><p><?php echo $name ?></p></td>
                                            <td><p><?php echo $nat ?></p></td>
                                            <td><p><?php echo $dob ?></p></td>

                                        </tr>

                                <?php

                                $pos += 1;
                                }
                                ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="javascript/ranking.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/overlay_panel.js"></script>
</body>
</html>