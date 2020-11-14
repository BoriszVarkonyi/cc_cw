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
        "create" => ""
    );



    //update announcement_$comp_id table with new title from form
    if (isset($_POST['adding_entry_submit'])) {

        $check_d_table_qry = "SHOW TABLES LIKE 'announcement_$comp_id'";
        $check_d_table_do = mysqli_query($connection, $check_d_table_qry);
        $row = mysqli_num_rows($check_d_table_do);

        if ($row == 0) {

            $create_table_qry = "CREATE TABLE `announcement_$comp_id` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `ann_title` VARCHAR(255) NOT NULL , `ann_body` TEXT NOT NULL, PRIMARY KEY (id)) ENGINE = InnoDB";

            
            if (mysqli_query($connection, $create_table_qry)){
                $feedback['create'] = "Minden fasza!";
            } else {
                $feedback['create'] = "ERROR " . mysqli_error($connection);
            }

        }

        $ann_title = $_POST['input_title'];

        $dupli_rows_qry = "SELECT * FROM announcement_$comp_id WHERE ann_title = '$ann_title'";
        if ($dupli_rows_do = mysqli_query($connection, $dupli_rows_qry)) {

            $numrows = mysqli_num_rows($dupli_rows_do);

        } else {
            $feedback['getnumrows'] = "ERROR: " . mysqli_error($connection);
        }

        if ($numrows == 0) {

            $insert_info_qry = "INSERT INTO announcement_$comp_id (ann_title) VALUE ('$ann_title')";
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
            <div id="page_content_panel_main">
                <div id="announcements_wrapper" class="wrapper">
                    <div class="db_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/build-black-18dp.svg"  class="db_panel_stripe_icon">
                            <p>Manage Announcements</p>
                        </div>
                        <div class="db_panel_main ">
                            <div id="plus_info_wrapper" class="entry_table_row_wrapper">



                                <div class="entry" >


                                    <div class="table_row" onclick="toggleEntry(this)">
                                        <div class="table_item invitation">announcement nece te gibbon</div>
                                    </div>


                                    <form class="entry_panel collapsed" id="update" method="POST" action="../php/invitation.php?comp_id=<?php echo $comp_id ?>">
                                        <button class="panel_button" type="submit" name="submit_delete" id="update" >
                                            <img src="../assets/icons/delete-black-18dp.svg">
                                        </button>
                                        <textarea id="update" name="text_body" ></textarea>
                                        <input id="update" name="text_title_to_change" type="text" value="" class="hidden">
                                        <input id="update" name="submit_body" type="submit" value="Save" class="panel_submit">
                                    </form>

                                </div>

                                <form action="" id="adding_entry" class="hidden" method="POST">
                                    <div class="table_row">
                                        <div class="table_item">
                                            <input name="info_title" type="text" class="title_input" placeholder="Type in the title">
                                            <input name="info_submit" type="submit" class="save_entry" value="Create">
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