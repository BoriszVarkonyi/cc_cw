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
            </div>
            <div id="page_content_panel_main">
                <div id="announcements_wrapper">

                    <div class="annoucement active">
                        <div class="annoucement_image">
                            <img src="../assets/icons/announcement_black.svg">
                        </div>
                        <form class="annoucement_content">
                            <input type="text" class="edit_annoucement_title title_input alt" placeholder="Type in the announcement's title">
                            <textarea name="" class="edit_annoucement_body" cols="30" rows="10" placeholder="Type in the announcement"></textarea>
                            <p class="annoucement_title">This is an annoucement</p>
                            <p class="annoucement_body">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi reiciendis pariatur quidem quaerat commodi, nisi molestias nulla quas sit ea laborum similique, dolore quod voluptate qui culpa sequi libero minima.</p>
                        </form>
                        <div class="annoucement_controls">
                            <div class="button_wrapper">
                                <p>Edit</p>
                                <button onclick="editAnnouncement(this)">
                                    <img src="../assets/icons/edit_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper">
                                <p>Delete</p>
                                <button>
                                    <img src="../assets/icons/delete_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper">
                                <p>Enable</p>
                                <button>
                                    <img src="../assets/icons/visibility_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper save" onclick="cancelEditAnnouncement(this)">
                                <p>Cancel</p>
                                <button>
                                    <img src="../assets/icons/close_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper save">
                                <p>Save</p>
                                <button>
                                    <img src="../assets/icons/save_black.svg">
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="annoucement disabled">
                        <div class="annoucement_image">
                            <img src="../assets/icons/announcement_black.svg">
                        </div>
                        <form class="annoucement_content">
                            <input type="text" class="edit_annoucement_title title_input alt" placeholder="Type in the announcement's title">
                            <textarea name="" class="edit_annoucement_body" cols="30" rows="10" placeholder="Type in the announcement"></textarea>
                            <p class="annoucement_title">This is a disabled annoucement</p>
                            <p class="annoucement_body">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi reiciendis pariatur quidem quaerat commodi, nisi molestias nulla quas sit ea laborum similique, dolore quod voluptate qui culpa sequi libero minima.</p>
                        </form>
                        <div class="annoucement_controls">
                            <div class="button_wrapper">
                                <p>Edit</p>
                                <button onclick="editAnnouncement(this)">
                                    <img src="../assets/icons/edit_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper">
                                <p>Delete</p>
                                <button>
                                    <img src="../assets/icons/delete_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper">
                                <p>Enable</p>
                                <button>
                                    <img src="../assets/icons/visibility_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper save" onclick="cancelEditAnnouncement(this)">
                                <p>Cancel</p>
                                <button>
                                    <img src="../assets/icons/close_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper save">
                                <p>Save</p>
                                <button>
                                    <img src="../assets/icons/save_black.svg">
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="annoucement not_used">
                        <div class="annoucement_image">
                            <img src="../assets/icons/new_announcement_black.svg">
                        </div>
                        <form class="annoucement_content">
                            <input type="text" class="edit_annoucement_title title_input alt" placeholder="Type in the announcement's title">
                            <textarea name="" class="edit_annoucement_body" cols="30" rows="10" placeholder="Type in the announcement"></textarea>
                            <p class="annoucement_title">Add an Annoucement</p>
                            <p class="annoucement_body">This annoucement will be visible for anybody on the competititon's dedicated page</p>
                        </form>
                        <div class="annoucement_controls">
                            <div class="button_wrapper">
                                <p>Add</p>
                                <button onclick="addAnnouncement(this)">
                                    <img src="../assets/icons/add_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper save" onclick="cancelEditAnnouncement(this)">
                                <p>Cancel</p>
                                <button>
                                    <img src="../assets/icons/close_black.svg">
                                </button>
                            </div>
                            <div class="button_wrapper save">
                                <p>Save</p>
                                <button>
                                    <img src="../assets/icons/save_black.svg">
                                </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/announcements.js"></script>
</html>