<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php


    class announcement {
        public $title;
        public $body;

        function __construct ($title, $body) {
            $this -> title = $title;
            $this -> body = $body;
        }
    }

    //make announcements table
    $qry_make_table = "CREATE TABLE `ccdatabase`.`announcements` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_make_table = mysqli_query($connection, $qry_make_table);

    //get data from table
    $qry_get_data = "SELECT * FROM announcements WHERE assoc_comp_id = '$comp_id'";
    $do_get_data = mysqli_query($connection, $qry_get_data);
    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $test_row = TRUE;
        $json_string = $row['data'];
        $json_table_temp = json_decode($json_string);
        $json_table = [];
        foreach ($json_table_temp as $values) {
            print_r($values);
            $title = $values -> title;
            $body = $values -> body;
            $object_to_push = new announcement($title, $body);
            array_push($json_table, $object_to_push);
        }
        print_r($json_table);
    } else {
        $test_row = FALSE;
        //make template row
        $json_table = [];
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
        $qry_make_template = "INSERT INTO `announcements` (assoc_comp_id, data) VALUES ('$comp_id', '$json_string')";
        $do_make_template = mysqli_query($connection, $qry_make_template);
    }

    //add announcement
    if (isset($_POST['input_submit'])) {
        //get data from form
        $title = $_POST['input_title'];
        $announcement = new announcement($title, NULL);

        //push
        array_push($json_table, $announcement);

        //json -> string
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        //send data to db
        if ($title != "") {
            $qry_new_announcement = "UPDATE announcements SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
            $do_new_announcement = mysqli_query($connection, $qry_new_announcement);
            header("Refresh: 0");
        }
    }

    //update body
    if (isset($_POST["submit_body"])) {
        $body = $_POST['text_body'];
        $id_to_change = $_POST['text_title_to_change'];

        $json_table[$id_to_change] -> body = $body;
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        //update in db
        $qry_update_body = "UPDATE announcements SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        $do_update_body = mysqli_query($connection, $qry_update_body);

        header("Refresh: 0");
    }

    //delete announcement
    if (isset($_POST['submit_delete'])) {
        $id_to_change = $_POST['text_title_to_change'];
        unset($json_table[$id_to_change]);
        $json_table = array_values($json_table);

        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        $qry_update_delete = "UPDATE announcements SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        $do_update_delete = mysqli_query($connection, $qry_update_delete);
        header("Refresh: 0");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Announcements</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Announcements</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="button" onclick="toggleAddPanel()">
                        <p>Add Announcement</p>
                        <img src="../assets/icons/add_black.svg"/>
                    </button>

                    <div id="add_announcement_panel" class="overlay_panel hidden">
                        <button class="panel_button" onclick="toggleAddPanel()">
                            <img src="../assets/icons/close_black.svg">
                        </button>
                        <form class="overlay_panel_form" autocomplete="off" action="" method="POST" id="new_announcement" autocomplete="off">
                            <label for="name">TITLE</label>
                            <input type="text" placeholder="Type in the announcement's title" class="name_input" name="title">

                            <button type="submit" name="submit_announcement" class="panel_submit">Add</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="announcements_wrapper" class="wrapper">
                    <div class="db_panel other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/build_black.svg">
                            <p>Manage Announcements</p>
                        </div>
                        <div class="db_panel_main table">
                            <table class="full">
                                <thead>
                                    <tr>
                                        <th>
                                            <p>TITLE</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="alt no_scale">
                                    <?php

                                    for ($i = 0; $i < count($json_table); $i++) {

                                    ?>


                                    <tr onclick="this.nextElementSibling.classList.toggle('collapsed')" class="selected">
                                        <td><p><?php echo $json_table[$i] -> title; ?></td>
                                    </tr>


                                    <!-- updateing entry -->
                                    <tr class="entry collapsed">
                                        <td>
                                            <form id="update" method="POST" action="">
                                                <button class="panel_button" type="submit" name="submit_delete" id="update">
                                                    <img src="../assets/icons/delete_black.svg">
                                                </button>
                                                <textarea name="text_body" placeholder="Type the Announcement's body text here"><?php echo $json_table[$i] -> body ?></textarea>
                                                <input name="submit_body" type="submit" value="Save" class="panel_submit">
                                            </form>
                                        </td>
                                    </tr>

                                <?php
                                }

                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/announcements.js"></script>
<script src="../js/entry_controls.js"></script>
</html>