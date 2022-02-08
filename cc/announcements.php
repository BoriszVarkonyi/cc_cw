<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php


    class announcement {
        public $title;
        public $body;
        public $is_disabled = false;

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
        $json_table = json_decode($json_string);
    } else {
        $test_row = FALSE;
        //make template row
        $json_table = [];
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
        $qry_make_template = "INSERT INTO `announcements` (assoc_comp_id, data) VALUES ('$comp_id', '$json_string')";
        $do_make_template = mysqli_query($connection, $qry_make_template);
    }

    //function to update database & sort by disabled & get rid of keys
    function updateDB($data, $comp_id, $connection) {
        //sort by disabledness
        $temp = [];
        for ($i = 0; $i < count($data); $i++) {
            if (!$data[$i] -> is_disabled) {
                $temp[] = $data[$i];
            }
        }
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i] -> is_disabled) {
                $temp[] = $data[$i];
            }
        }
        $data = $temp;
        $data_s = json_encode($data, JSON_UNESCAPED_UNICODE);
        $qry_update = "UPDATE `announcements` SET `data` = '$data_s' WHERE assoc_comp_id = '$comp_id'";
        if ($do_update = mysqli_query($connection, $qry_update)) {
            header("Refresh:0");
        } else {
            echo "MINDEN SZAR GECKI FOS uindormany datbase error";
        }

    }
    //add announcement
    if (isset($_POST['saveAnnouncement'])) {
        $annoNum = $_POST["saveAnnouncement"];
        $title = $_POST["announcementTitle"];
        $body = $_POST["announcementBody"];
        $json_table[$annoNum] = new announcement($title, $body);
        updateDB($json_table, $comp_id, $connection);
    }

    //delete announcement
    if (isset($_POST['deleteAnnouncement'])) {
        $annoNum = $_POST["deleteAnnouncement"];
        $temp = [];
        for ($i = 0; $i < count($json_table); $i++) {
            if ($i != $annoNum) {
                $temp[] = $json_table[$i];
            }
        }
        $json_table = array_values($temp);
        updateDB($json_table, $comp_id, $connection);
    }

    //disableEnable announcement
    if (isset($_POST['enableDisableAnnouncement'])) {
        $annoNum = $_POST["enableDisableAnnouncement"];
        $json_table[$annoNum] -> is_disabled = !$json_table[$annoNum] -> is_disabled;
        updateDB($json_table, $comp_id, $connection);
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
            </div>
            <div id="page_content_panel_main">
                <div id="announcements_wrapper">
                    <?php
                        for ($annoNum = 0; $annoNum < 3; $annoNum++){

                            $deleteButton = true;
                            if (!isset($json_table[$annoNum])) {
                            //NOT USED
                                $class = "not_used";
                                $title = "Add an Announcement!";
                                $body = "This announcement will be publicly visible on the competition's dedicated page!";
                                $deleteButton = false;
                                $enableDisabledButtonTxt = null;
                            /********/
                            } else if ($json_table[$annoNum] -> is_disabled) {
                            //DISABLED
                                $class = "disabled";
                                $title = $json_table[$annoNum] -> title;
                                $body = $json_table[$annoNum] -> body;
                                $enableDisabledButtonTxt = "Enable";
                            /********/
                            } else {
                            //ACTIVE
                                $class = "active";
                                $title = $json_table[$annoNum] -> title;
                                $body = $json_table[$annoNum] -> body;
                                $enableDisabledButtonTxt = "Disable";
                            /******/
                            }
                    ?>
                            <div class="annoucement <?php echo $class ?>">
                                <div class="annoucement_image">
                                    <img src="../assets/icons/announcement_black.svg">
                                </div>
                                <form class="annoucement_content" method="POST" action="" id="annoForm_<?php echo $annoNum ?>">
                                    <input name="announcementTitle" value="<?php echo $title ?>" type="text" class="edit_annoucement_title title_input alt" placeholder="Type in the announcement's title">
                                    <textarea name="announcementBody" class="edit_annoucement_body" cols="30" rows="10" placeholder="Type in the announcement"><?php echo $body ?></textarea>
                                    <p class="annoucement_title"><?php echo $title ?></p>
                                    <p class="annoucement_body"><?php echo $body ?></p>
                                </form>
                                <div class="annoucement_controls">
                                    <div class="button_wrapper">
                                        <p>Edit</p>
                                        <button onclick="editAnnouncement(this)">
                                            <img src="../assets/icons/edit_black.svg">
                                        </button>
                                    </div>
                                    <?php
                                        if ($deleteButton) {
                                    ?>
                                            <div class="button_wrapper">
                                                <p>Delete</p>
                                                <button form="annoForm_<?php echo $annoNum ?>" name="deleteAnnouncement" type="submit" value="<?php echo $annoNum ?>">
                                                    <img src="../assets/icons/delete_black.svg">
                                                </button>
                                            </div>
                                    <?php
                                        }
                                        if ($enableDisabledButtonTxt !== null) {
                                    ?>
                                            <div class="button_wrapper">
                                                <p><?php echo $enableDisabledButtonTxt ?></p>
                                                <button form="annoForm_<?php echo $annoNum ?>" name="enableDisableAnnouncement" type="submit" value="<?php echo $annoNum ?>">
                                                    <img src="../assets/icons/visibility_black.svg">
                                                </button>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="button_wrapper save" onclick="cancelEditAnnouncement(this)">
                                        <p>Cancel</p>
                                        <button>
                                            <img src="../assets/icons/close_black.svg">
                                        </button>
                                    </div>
                                    <div class="button_wrapper save">
                                        <p>Save</p>
                                        <button form="annoForm_<?php echo $annoNum ?>" name="saveAnnouncement" type="submit" value="<?php echo $annoNum ?>">
                                            <img src="../assets/icons/save_black.svg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>

                </div>
            </div>
        </div>
    </main>
</body>
<script src="javascript/cookie_monster.js"></script>
<script src="javascript/main.js"></script>
<script src="javascript/announcements.js"></script>
</html>