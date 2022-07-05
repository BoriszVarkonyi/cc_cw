<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
    $qry_make_table = "CREATE TABLE `ccdatabase`.`announcements` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `title` VARCHAR(255) NOT NULL , `body` TEXT NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $make_table = mysqli_query($connection, $qry_make_table);

    //update plusinfo table with new title from form
    if (isset($_POST['info_submit']) && 0 < strlen($_POST['info_title'])) {

    $title = mysqli_real_escape_string($connection, $_POST['info_title']);

    //insert row
    $qry_insert_new_row = "INSERT INTO announcements (assoc_comp_id, title) VALUES ('$comp_id', '$title')";
    if ($do_insert_new_row = mysqli_query($connection, $qry_insert_new_row)) {
        header("Refresh: 0");
    } else {
        echo mysqli_error($connection);
    }
}


//updateing info_body from text areas
if (isset($_POST['submit_body'])) {
    $body = mysqli_escape_string($connection, $_POST['text_body']);
    $id = $_POST['entry_id'];
    $title = "";

    $qry_update_with_body = "UPDATE announcements SET body = '$body' WHERE id = '$id'";
    if ($do_update_with_body = mysqli_query($connection, $qry_update_with_body)) {
        header("Refresh: 0");
    } else {
        echo mysqli_error($connection);
    }

}

//deleting w/ del button
if (isset($_POST['submit_delete'])) {
    $id_to_delete = $_POST['entry_id'];

    $qry_delete = "DELETE FROM announcements WHERE id = '$id_to_delete'";
    if (!$do_delete = mysqli_query($connection, $qry_delete)) {
        echo mysqli_error($connection);
    } else {
        header("Refresh: 0");
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
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <?php include "includes/navigation.php"; ?>
    <main>
        <div id="title_stripe">
            <p class="page_title">Announcements</p>
        </div>
        <div id="page_content_panel_main">
            <div id="announcements_wrapper">
            <div class="db_panel other">
                    <div class="db_panel_header">
                        <img src="../assets/icons/build_black.svg">
                        <p>Announcements</p>
                    </div>
                    <div class="db_panel_main table">
                        <div class="table t_c_0" id="plus_info_wrapper">
                            <div class="table t_c_0">
                                <div class="table_header">
                                    <div class="table_header_text">TITLE</div>
                                </div>
                                <div class="table_row_wrapper alt">
                                    <?php

                                        $qry_display = "SELECT id, title, body FROM announcements WHERE assoc_comp_id = '$comp_id'";
                                        $do_display = mysqli_query($connection, $qry_display);
                                        echo mysqli_error($connection);
                                        while ($row = mysqli_fetch_assoc($do_display)) {
                                    ?>

                                            <div class="entry">
                                                <div class="table_row" onclick="toggleEntry(this)">
                                                    <!-- ezt át lehetne pakolni egy inputra es akkor tudna megvaltoztatni mostmar a titlet is az nber ##KRIS -->
                                                    <input class="table_item invitation"><?php echo $row['title'] ?></input>
                                                </div>
                                                <form class="entry_panel collapsed" id="update" method="POST" action="">
                                                    <input id='Announcements_id' name='entry_id' type='text' value='<?php echo $row['id'] ?>' class='hidden' >
                                                    <button class="panel_button" type="submit" name="submit_delete" id="update">
                                                        <img src="../assets/icons/delete_black.svg">
                                                    </button>
                                                    <textarea placeholder='Type your information here...' id="update" name="text_body"><?php echo $row['body'] ?></textarea>
                                                    <input id="update" name="text_title_to_change" type="text" value="<?php echo $row['body'] ?>" class="hidden">
                                                    <input id="update" name="submit_body" type="submit" value="Save" class="panel_submit">
                                                </form>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                    <div id="add_entry" onclick="hideNshow()">
                                        <div class="table_row" onclick="">
                                            <div class="table_item">
                                                Add announcement
                                                <img src="../assets/icons/add_black.svg">
                                            </div>
                                        </div>
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
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/invitation.js"></script>

    <script src="javascript/entry_controls.js"></script>
</body>
</html>