<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

    $feedback = array(
        "delete" => "",
        "update" => "",
        "getnumrows" => "",
        "getdata" => "",
        "insert_info" => "",
        "ttest" => "",
        "create" => "",
        "update" => ""
    );

    $table_name = "announcement_" . $comp_id;

    
    //update announcement_$comp_id table with new title from form
    if (isset($_POST['input_submit']) && strlen($_POST['input_title']) > 0) {


        //creating table
        $check_d_table_qry = "SELECT COUNT(*)
                                FROM information_schema.tables 
                                WHERE table_schema = 'ccdatabase' 
                                AND table_name = '$table_name';";

        if ($check_d_table_do = mysqli_query($connection, $check_d_table_qry)) {
            if ($check_d_table_do) {

                $create_table_qry = "CREATE TABLE $table_name ( `id` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `body` TEXT NOT NULL, PRIMARY KEY (id)) ENGINE = InnoDB";
    
                
                if (mysqli_query($connection, $create_table_qry)){
                    $feedback['create'] = "Minden ok!";
                } else {
                    $feedback['create'] = "ERROR " . mysqli_error($connection);
                }
    
            }
        } else {
            $feedback['ttest'] = "ERROR " . mysqli_error($connection);
        }

        
        

        //get title from post
        $title = $_POST['input_title'];


        //check for row with same title
        $dupli_rows_qry = "SELECT * FROM $table_name WHERE title = '$title'";
        if ($dupli_rows_do = mysqli_query($connection, $dupli_rows_qry)) {

            $numrows = mysqli_num_rows($dupli_rows_do);

        } else {
            $feedback['getnumrows'] = "ERROR: " . mysqli_error($connection);
        }


        //create new ann row with name
        if ($numrows == 0) {

            $insert_info_qry = "INSERT INTO $table_name (title) VALUE ('$title')";
            $inser_indo_do = mysqli_query($connection, $insert_info_qry);

            if ($inser_indo_do) {
                $feedback['insert_info'] = "minden OK!";
            } else { //error branch
                $feedback['insert_info'] =  "ERROR:" . mysqli_error($connection);
            }

        } else {
            $feedback['insert_info'] = "You already have info with the same title!";
        }
    }

    //updateing announcement from text areas
    if (isset($_POST['submit_body'])) {

        $new_body = $_POST['text_body'];
        $change_title = $_POST['text_title_to_change'];

        $update_qry = "UPDATE $table_name SET body = '$new_body' WHERE title = '$change_title'";
        if (mysqli_query($connection, $update_qry)) {
            $feedback['update'] = "Minden ok!";
        } else {
            $feedback['update'] = "ERROR:" . mysqli_error($connection);
        }
    }


    //deleteing info_$comp_id row
    if (isset($_POST['submit_delete'])) {

        $change_title = $_POST['text_title_to_change'];

        $delete_qry = "DELETE FROM $table_name WHERE title = '$change_title'";
        if (mysqli_query($connection, $delete_qry)) {
            $feedback['delete'] = "Minden ok delete!";
        } else {
            $feedback['delete'] = "ERROR:" . mysqli_error($connection);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Announcements</title>
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
                <p class="page_title">Announcements</p>

                <!-- new announcement button top -->
                <button class="stripe_button orange" id="new_announcement_top" type="button" onclick="hideNshow()">
                    <p>New Announcement</p>
                    <img src="../assets/icons/add-black-18dp.svg"></img>
                </button>

            </div>
            <?php print_r($feedback); echo $numrows ?>
            <div id="page_content_panel_main">
                <div id="announcements_wrapper" class="wrapper">
                    <div class="db_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/build-black-18dp.svg"  class="db_panel_stripe_icon">
                            <p>Manage Announcements</p>
                        </div>
                        <div class="db_panel_main ">
                            <div id="plus_info_wrapper" class="entry_table_row_wrapper">

                                <?php
                                    //displaying plsu infos from db in table rows
                                    $get_data_plusinfo_qry = "SELECT * FROM $table_name";
                                    $get_data_plusinfo_do = mysqli_query($connection, $get_data_plusinfo_qry);
                                    if ($get_data_plusinfo_do !== FALSE) {
                                        while ($row = mysqli_fetch_assoc($get_data_plusinfo_do)) {

                                            $title = $row['title'];
                                            $body = $row['body'];

                                ?>

                                        <!-- ezt kell whileozni csorom -->
                                        <div class="entry" >

                                            <!-- csak a cim kell -->
                                            <div class="table_row" onclick="toggleEntry(this)">
                                                <div class="table_item invitation"><?php echo $title ?></div>
                                            </div>

                                            <!-- updateing entry -->
                                            <form class="entry_panel collapsed" id="update" method="POST" action="../php/announcements.php?comp_id=<?php echo $comp_id ?>">
                                                <button class="panel_button" type="submit" name="submit_delete" id="update" >
                                                    <img src="../assets/icons/delete-black-18dp.svg">
                                                </button>
                                                <textarea id="update" name="text_body" ><?php echo $body ?></textarea>
                                                <input id="update" name="text_title_to_change" type="text" value="<?php echo $title ?>" class="hidden">
                                                <input id="update" name="submit_body" type="submit" value="Save" class="panel_submit">
                                            </form>

                                        </div>
                                        <!-- eddig mondjuk -->
                            <?php 
                                        }    
                                    }                             
                            ?>

                                <!-- adding entry by title -->
                                <form action="../php/announcements.php?comp_id=<?php echo $comp_id ?>" id="adding_entry" class="hidden" method="POST">
                                    <div class="table_row">
                                        <div class="table_item">
                                            <input name="input_title" type="text" class="title_input" placeholder="Type in the title">
                                            <input name="input_submit" type="submit" class="save_entry" value="Create">
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/announcements.js"></script>
</html>