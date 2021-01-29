<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

    $table_name = "wc_$comp_id";
    //feedback
    $feedback = array(
        "getrankid" => "no",
        "getfencers" => "no",
        "getcompdata" => "no"
    );


    //get ranking id by comp_id
    $qry_getrankid = "SELECT * FROM ranking WHERE ass_comp_id = $comp_id";

    $qry_getrankid_do = mysqli_query($connection, $qry_getrankid);
    if ($row = mysqli_fetch_assoc($qry_getrankid_do)) {
        $feedback['getrankid'] = "ok!";
        $ranking_id = $row['id'];
    } else {
        $feedback['getrankid'] = "ERROR " . mysqli_error($connection);
    }

    if (isset($_POST['add_wc'])) {
        $fencer_id = $_POST['fencer_id'];
        header("Location: ../php/fencers_weapon_control.php?comp_id=$comp_id&fencer_id=$fencer_id&rankid=$ranking_id");
    }
    
    //checking for dupli tables
    $check_d_table_qry = "SELECT COUNT(*)
    FROM information_schema.tables 
    WHERE table_schema = 'ccdatabase' 
    AND table_name = '$table_name';";

    if ($check_d_table_do = mysqli_query($connection, $check_d_table_qry)) {
        $num_rows = mysqli_num_rows($check_d_table_do);
        $feedback['ttest'] = "ok!";

        if ($num_rows != 0) {
            //creating weapon control  table
            $qry_creating_wc_table = "CREATE TABLE `ccdatabase`. $table_name (`id` VARCHAR(11) NOT NULL , 
                                                                `name` VARCHAR(255) NOT NULL , 
                                                                `nat` VARCHAR(255) NOT NULL , 
                                                                `weapon_errors` VARCHAR(255) NOT NULL , 
                                                                `notes` TEXT NOT NULL ) 
                                                                ENGINE = InnoDB;";

            if ($do_qry_creating_table = mysqli_query($connection, $qry_creating_wc_table)) {
                $feedback['create_table'] = "ok!";
            } else {
                $feedback['create_table'] = "ERROR " . mysqli_error($connection);
            }

        } else {
            $feedback['misc'] = "ERROR valami szar van a palacsintaban" . $num_rows;
        }

    } else {
        $feedback['ttest'] = "ERROR " . mysqli_error($connection);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weapon Control</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <form id="title_stripe" method="POST" action="" >
                    <p class="page_title">Administrated Weapon Control</p>
                    <div class="stripe_button_wrapper">
                        <a class="stripe_button blue" href="weapon_control_statistics.php?comp_id=<?php echo $comp_id; ?>">
                            <p>Weapon Control Statistics</p>
                            <img src="../assets/icons/pie_chart-black-18dp.svg"/>
                        </a>
                        <button class="stripe_button disabled" id="sendMessageButton" type="submit">
                            <p>Message Fencer</p>
                            <img src="../assets/icons/chat-black-18dp.svg"/>
                        </button>

                            IF BOTH RED
                        <a name="" class="stripe_button orange" id="checkInButton" href="check_in_fencer.php?comp_id=<?php echo $comp_id ?>">
                            <p>Check In</p>
                            <img src="../assets/icons/check_circle_outline-black-18dp.svg"/>
                        </a>
                        -->

                        IF NOT READY
                        <a name="" class="stripe_button orange" id="addWcButton" href="fencers_weapon_control.php?comp_id=<?php echo $comp_id ?>">
                            <p>Add Weapon Control</p>
                            <img src="../assets/icons/add-black-18dp.svg"/>
                        </a>
                        -->

                        IF BOTH GREEN BUT NOT CHECKED OUT
                        <a name="" class="stripe_button" id="editWcButton" type="submit" href="fencers_weapon_control.php?comp_id=<?php echo $comp_id ?>">
                            <p>Edit Weapon Control</p>
                            <img src="../assets/icons/edit-black-18dp.svg"/>
                        </a>

                        <a name="" class="stripe_button orange" id="checkOutButton" href="check_out_fencer.php?comp_id=<?php echo $comp_id ?>">
                            <p>Check Out</p>
                            <img src="../assets/icons/check_circle-black-18dp.svg"/>
                        </a>
                        -->

                        <!--    CHECKED OUT

                        -->

                    </div>
                    <input type="text" class="hidden selected_list_item_input" name="fencer_id" id="fencer_id_input" value="">
                    <div class="search_wrapper">
                        <button type="button" class="clear_search_button"><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search cc">
                        <div class="search_results">
                        <?php
                        $query = "SELECT * FROM cptrs_$comp_id";
                        $query_do = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($query_do)){
                            $idke = $row["id"];
                            $nevecske = $row["name"];
                            ?>
                            <a id="<?php echo $idke ?>A" href="#<?php echo $idke ?>" onclick="selectSearch(this), autoFill(this)" tabindex="1"><?php echo $nevecske ?></a>
                            <?php
                        }
                            ?>
                        </div>
                    </div>
                </form>
                <div id="page_content_panel_main">
                    <div class="wrapper table">
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">NATION / CLUB</div>
                            <div class="table_header_text">STATUS</div>
                            <div class="small_status_header"></div>
                            <div class="table_header_text">STATUS</div>
                            <div class="small_status_header"></div>
                        </div>
                        <div class="table_row_wrapper">
                            <div class="table_row cheked_out" onclick="selectRow(this), buttonShower(this)" id="" tabindex="0">
                                <div class="table_item"><p>NAME</p></div>
                                <div class="table_item"><p>NATION / CLUB</p></div>
                                <div class="table_item"><p>Checked In</p></div>
                                <div class="small_status_item green"></div>
                                <div class="table_item"><p>Checked Out</p></div>
                                <div class="small_status_item green"></div>
                            </div>
                            <div class="table_row not_cheked_out" onclick="selectRow(this), buttonShower(this)" id="" tabindex="0">
                                <div class="table_item"><p>NAME</p></div>
                                <div class="table_item"><p>NATION / CLUB</p></div>
                                <div class="table_item"><p>Checked In</p></div>
                                <div class="small_status_item green"></div>
                                <div class="table_item"><p>Ready</p></div>
                                <div class="small_status_item green"></div>
                            </div>
                            <div class="table_row not_ready" onclick="selectRow(this), buttonShower(this)" id="" tabindex="0">
                                <div class="table_item"><p>NAME</p></div>
                                <div class="table_item"><p>NATION / CLUB</p></div>
                                <div class="table_item"><p>Checked In</p></div>
                                <div class="small_status_item green"></div>
                                <div class="table_item"><p>Not ready</p></div>
                                <div class="small_status_item red"></div>
                            </div>
                            <div class="table_row red" onclick="selectRow(this), buttonShower(this)" id="" tabindex="0">
                                <div class="table_item"><p>NAME</p></div>
                                <div class="table_item"><p>NATION / CLUB</p></div>
                                <div class="table_item"><p>Not checked In</p></div>
                                <div class="small_status_item red"></div>
                                <div class="table_item"><p>Not ready</p></div>
                                <div class="small_status_item red"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="../js/main.js"></script>
    <script src="../js/weapon_control_administrated.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    </body>
</html>