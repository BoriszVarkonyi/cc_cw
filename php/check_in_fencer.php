<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php
    $fencer_id = $_GET['fencer_id'];

    //get base table
    $qry_get_wc = "SELECT `data` FROM `weapon_control` WHERE `assoc_comp_id` = '$comp_id'";
    $do_get_wc = mysqli_query($connection, $qry_get_wc);

    if ($row = mysqli_fetch_assoc($do_get_wc)) {
        $wc_string = $row['data'];
        $wc_table = json_decode($wc_string);
    }

    class wc {
        public $checked_out = false;
        public $array_of_issues = NULL;
        public $equipment = NULL;
        public $notes = "";
        public $id;

        public function __construct($id){
            $this -> id = $id;
        }
    }

    //get fencers data
    $qry_get_name = "SELECT `data` FROM `competitors` WHERE `assoc_comp_id` = '$comp_id'";
    $do_get_name = mysqli_query($connection, $qry_get_name);

    if ($row = mysqli_fetch_assoc($do_get_name)) {
        $compet_string = $row['data'];
        $compet_table = json_decode($compet_string);

        if ($id_to_find = findObject($compet_table, $fencer_id, "id") !== false) {
            $name =  $compet_table[$id_to_find] -> prenom . " " . $compet_table[$id_to_find] -> nom;
        }

    }

    //search for existing equipment turned in
    if ($id_to_find = findObject($wc_table, $fencer_id, "id") !== false) {
        //get data from existing check in
    } else {
        //make new check in
        $temp_wc_obj = new wc($fencer_id);
        //add to table then upload
        array_push($wc_table, $temp_wc_obj);

        $wc_string = json_encode($wc_table, JSON_UNESCAPED_UNICODE);

        //update db
        $qry_update = "UPDATE weapon_control SET data = '$wc_string' WHERE assoc_comp_id = '$comp_id'";
        $do_update = mysqli_query($connection, $qry_update);
    }

    if (isset($_POST['submit_check_in'])) {
        $array_of_equipment = [];
        foreach ($all_equipment as $key => $name) {
            if ($_POST[$key] != "") {
                $value = $_POST[$key];
                $array_of_equipment[$key] = $value;
            } else {
                $array_of_equipment[$key] = 0;
            }
        }

        //update (trade old to new) in wc_table
        if ($id_to_find = findObject($wc_table, $fencer_id, "id") !== false) {
            $wc_table[$id_to_find] -> equipment = $array_of_equipment;
        } else {
            echo "fencer can't be found by id";
        }
        $json_string = json_encode($wc_table);

        //update database
        $qry_update = "UPDATE weapon_control SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        if ($do_update = mysqli_query($connection, $qry_update)) {
            echo "vsvsvsvssv";
            header("Location: ../php/weapon_control_administrated.php?comp_id=$comp_id");
        } else {
            echo "asdadadads";
        }

    }

    echo "asdasdasdd";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check in <?php echo $name ?></title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_check_out_fencer_style.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Check in <?php echo $name ?></p>
                <div class="stripe_button_wrapper">
                    <button name="" id="" class="stripe_button" shortcut="SHIFT+P" onclick="printPage()">
                        <p>Print Check In</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                    <button name="submit_check_in" class="stripe_button primary" type="submit" form="check_in" shortcut="SHIFT+S" onclick="location.href='weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>'">
                        <p>Save Check In</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg"/>
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg"/>
                    </button>
                </div>
                <div class="view_button_wrapper fourth">
                    <button onclick="viewButton(this)" id="panelViewButton">
                        <img src="../assets/icons/view_grid_black.svg"/>
                    </button>
                    <button onclick="viewButton(this)" id="printViewButton">
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper">
                    <form action="" id="check_in" method="POST" class="db_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/backpack_black.svg"/>
                            Contents of fencer's bag
                        </div>
                        <div class="db_panel_main">
                            <div class="table">
                                <div class="table_header">
                                    <div class="table_header_text">ISSUE</div>
                                    <div class="table_header_text">QUANTITY</div>
                                    <div class="big_status_header"></div>
                                </div>
                                <div class="table_row_wrapper alt">

                                    <?php
                                        $all_equipment = ["Epee","Foil","Sabre","Electric Jacket","Plastron","Under-Plastron","Socks","Mask","Gloves","Bodywire","Maskwire","Chest protector","Metallic glove"];

                                        //display equipment that can be given to check (from info for fencers db:competitions)
                                        $qry_get_equipment = "SELECT comp_equipment FROM competitions WHERE comp_id = '$comp_id'";
                                        $do_get_equipment = mysqli_query($connection, $qry_get_equipment);

                                        if ($row = mysqli_fetch_assoc($do_get_equipment)) {
                                            $equipments_string = $row['comp_equipment'];

                                            $given_equipment = explode(',', $equipments_string);
                                        } else {
                                            echo mysqli_error($connection);
                                        }
                                        foreach ($given_equipment as $key => $value) {

                                            if ($value != 0) {
                                                $name = $all_equipment[$key];
                                                //USE THIS ATIKÁM A MAX BEIRÁSHOZ
                                                /**/$max = $value;//*************
                                                /*   így:    id ="<?php echo $max ?>"   */

                                    ?>

                                    <div class="table_row">
                                        <div class="table_item"><p><?php echo $name ?></p></div>
                                        <div class="table_item"><input value="" name="<?php $key ?>" type="number" placeholder="#"></div>
                                        <div class="big_status_item">
                                            <input type="checkbox" name="bag_content" id="<?php $name ?>" value=""/>
                                            <label for="<?php $name ?>"></label>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                        }

                                    ?>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
                //get comp_data for printing
                $qry_get_comp_data = "SELECT * FROM `competitions` WHERE `comp_id` = '$comp_id'";
                $do_get_comp_data = mysqli_query($connection, $qry_get_comp_data);

                if ($row = mysqli_fetch_assoc($do_get_comp_data)) {
                    $sex = $row['comp_sex'];
                    $w_type = $row['comp_weapon'];
                }

                //from basic info
                $qry_get_bi = "SELECT data FROM basic_info WHERE assoc_comp_id = '$comp_id'";
                $do_get_bi = mysqli_query($connection, $qry_get_bi);

                if ($row = mysqli_fetch_assoc($do_get_bi)) {
                    $json_string = $row['data'];
                    $json_table = json_decode($json_string);
                    echo "asdasdasdasda";
                    $start_time = $json_table -> starting_date;
                } else {
                    $start_time = "start time: Not defined!";
                }
            ?>
                <div class="paper_wrapper hidden">
                    <div class="paper">
                        <div class="title_container">
                            <div><p class="title"><?php echo $name ?>'S CHECKING IN CERTIFICATE</p></div>
                            <div class="comp_info small">
                                <p class="info_label"><?php echo $comp_name ?></p>
                                <div>
                                    <p><?php echo sexConverter($sex) ?></p>
                                    <p><?php echo weaponConverter($w_type) ?></p>
                                </div>
                                <p><?php echo $start_time ?></p>
                            </div>
                        </div>
                        <div class="paper_content">
                            <div class="bag_content">
                                <p class="label">BAG CONTENT</p>
                                <div class="grid_table">
                                    <div class="grid_header">
                                        <div class="grid_header_text">EQIPMENT</div>
                                        <div class="grid_header_text">QUANTITY</div>
                                    </div>
                                    <div class="grid_row_wrapper">



                                        <div class="grid_row">
                                            <div class="grid_item">Name</div>
                                            <div class="grid_item">1</div>
                                        </div>




                                    </div>
                                </div>
                            </div>
                            <div class="signatures">
                                <p class="label">SIGNATURES</p>
                                <div class="grid_table">
                                        <div class="grid_header">
                                            <div class="grid_header_text">NAME</div>
                                            <div class="grid_header_text signature">SIGNATURE</div>
                                        </div>
                                        <div class="grid_row_wrapper">
                                            <div class="grid_row">
                                                <div class="grid_item"><?php echo $name ?></div>
                                                <div class="grid_item signature"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/print.js"></script>
<script src="../js/check_fencer.js"></script>
</body>
</html>