<?php include "cw_comp_getdata.php"; ?>
<?php include "../includes/db.php"; ?>
<?php

    $logo_path = "../assets/icons/delete_black.svg";

    if (file_exists("../uploads/$comp_id.png")) {
        $logo_path = "../uploads/$comp_id.png";
    }


    $qry_get_basic_info = "SELECT data FROM basic_info WHERE assoc_comp_id = '$comp_id'";
    $do_get_basic_info = mysqli_query($connection, $qry_get_basic_info);

    if ($row = mysqli_fetch_assoc($do_get_basic_info)) {
        $json_string = $row['data'];

        $json_table = json_decode($json_string);

        if ($json_table != "") {
            $host_country = $json_table -> host_country;
            $city_street = $json_table -> city_street;
            $zip_code = $json_table -> zip_code;
            $entry_fee = $json_table -> entry_fee;
            $starting_date = $json_table -> starting_date;
            $ending_date = $json_table -> ending_date;
            $end_of_pre_reg = $json_table -> end_of_pre_reg;

        } else {
            $host_country = "";
            $city_street = "";
            $zip_code = "";
            $entry_fee = "";
            $starting_date = "";
            $ending_date = "";
            $end_of_pre_reg = "";
        }
    } else {
            $host_country = "No information given";
            $city_street = "No information given";
            $zip_code = "No information given";
            $entry_fee = "No information given";
            $starting_date = "No information given";
            $ending_date = "No information given";
            $end_of_pre_reg = "No information given";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_invitation_style.min.css" media="print">
</head>
<body class="competitions">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe" class="big">
                <img src="<?php echo $logo_path ?>" width="50" height="50" alt="<?php echo $comp_name ?>'s logo">
                <form action="../cw/competition.php?comp_id=<?php echo $comp_id ?>" method="POST" class="big_status_item" id="fav_button"></form>
                <p class="stripe_title"><?php echo $comp_name ?></p>
                <button value="<?php echo $comp_id ?>" class="bookmark_button" onclick="favButton(this)">
                    <img src="../assets/icons/bookmark_border_black.svg" alt="Save Competition">
                </button>
                <p id="comp_status"><?php echo statusConverter($comp_status) ?></p>
                <div>
                    <p><?php echo sexConverter($comp_sex) . "'s" ?></p>
                    <p><?php echo weaponConverter($comp_weapon) ?></p>
                    <p><?php echo $starting_date ?></p>
                    <p>{IDE KIÍRNI INDIVIDUAL VAGY TEAM}</p>
                </div>
            </div>
            <div id="content_wrapper" class="reverse_wrap">
                <div class="column big no_top">
                    <?php
                    $qry_get_announcements = "SELECT `data` FROM `announcements` WHERE `assoc_comp_id` = '$comp_id'";
                    $do_get_announcements = mysqli_query($connection, $qry_get_announcements);

                    if ($row = mysqli_fetch_assoc($do_get_announcements)) {
                        $string_json = $row['data'];

                        $json_table = json_decode($string_json);
                    }

                    if (count($json_table) != 0 ) {
                    ?>
                        <div id="announcements" class="column_panel">

                            <?php
                                foreach ($json_table as $ann_objects) {

                                $title = $ann_objects -> title;
                                $body = $ann_objects -> body;
                            ?>
                            <div class="breakpoint">
                                <p><?php echo $title ?></p>
                                <p><?php echo $body ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                        <div id="basic_information_panel" class="column_panel breakpoint">
                            <p class="column_panel_title">Basic Information:</p>
                            <div>
                                <div class="form_wrapper">
                                    <div>
                                        <div>
                                            <label>HOST COUNTRY</label>
                                            <p><?php echo $host_country ?></p>
                                        </div>
                                        <div>
                                            <label>LOCATION AND ADDRESS</label>
                                            <p><?php echo $city_street ?></p>
                                            <p><?php echo $zip_code ?></p>
                                        </div>
                                        <div>
                                            <label>ENTRY-FEE</label>
                                            <p><?php echo $entry_fee ?></p>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label>STARTING DATE</label>
                                            <p><?php echo $starting_date ?></p>
                                        </div>
                                        <div>
                                            <label>ENDING DATE</label>
                                            <p><?php echo $ending_date ?></p>
                                        </div>
                                        <div>
                                            <label>END OF PRE-REGISTRTATION</label>
                                            <p><?php echo $end_of_pre_reg ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- equipment panel -->
                        <div id="equipment_panel" class="column_panel breakpoint">
                            <p class="column_panel_title">Equipment needed to be checked:</p>
                            <!-- weapons check table rows -->
                            <table class="fixed">
                                <thead>
                                    <tr>
                                        <th><p>Equipment's name</p></th>
                                        <th><p>Needed Quantity</p></th>
                                    </tr>
                                </thead>
                                <tbody class="alt">
                                    <?php
                                        $equipment = array("Epee","Foil","Sabre","Electric Jacket","Plastron","Under-Plastron","Socks","Mask","Gloves","Bodywire","Maskwire","Chest protector","Metallic glove");

                                        $array_equipment = explode(",", $comp_equipment);

                                        for ($i = 0; $i < count($equipment); $i++) {

                                            if ($array_equipment[$i] != 0) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $equipment[$i] ?></td>
                                                        <td><?php echo $array_equipment[$i] ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    ?>

                                    <!-- ha üres

                                                    <tr>
                                                        <td colspan="1">No equipment</td>
                                                    </tr>
                                    -->
                                </tbody>
                            </table>
                        </div>

                        <!-- additional info panel -->
                        <div id="additional_panel" class="column_panel breakpoint">
                            <p class="column_panel_title">Additional information for Fencers:</p>
                            <div>
                                <p><?php echo $comp_info ?></p>
                            </div>
                        </div>

                        <!-- weapon control panel -->
                        <div id="weapon_control_panel" class="column_panel breakpoint">
                            <p class="column_panel_title">Weapon Control appointments and bookings:</p>
                            <div>
                                <div class="weapon_control_day">
                                    <p>{Weapon Control Date}</p>
                                </div>

                                <div class="weapon_control_day">
                                    <p>{Weapon Control Date}</p>
                                </div>
                            </div>
                        </div>

                        <div id="plus_information_panel" class="column_panel breakpoint">
                            <p class="column_panel_title">Plus Information:</p>
                            <div>
                                <?php

                                    //display plus info from DB

                                    $get_plsuinfo_qry = "SELECT * FROM info_$comp_id";
                                    if (!$get_plsuinfo_do = mysqli_query($connection, $get_plsuinfo_qry)) {
                                        $feedback = "ERROR: " . mysqli_error($connection);
                                    }

                                    if ($get_plsuinfo_do !== FALSE) {//checks whether table exists
                                        while ($row = mysqli_fetch_assoc($get_plsuinfo_do)) {

                                            $info_title = $row['info_title'];
                                            $info_body = $row['info_body'];
                                ?>
                                            <div class="breakpoint">
                                                <p><?php echo $info_title ?></p>
                                                <p><?php echo $info_body ?></p>
                                            </div>
                                <?php
                                        }
                                    } else  { // displayed when there are no plus infos for comp_id
                                ?>

                                    <p>This competition has no plus information!</p>

                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="column small no_top">
                        <div id="competition_controls" class="column_panel no_bottom">
                            <p class="column_panel_title">Competition Controls:</p>
                            <div class="competition_controls_wrapper">
                                <button <?php echo $test = ($comp_status  != 2) ? "disabled" : "" ?> onclick="location.href='pre_registration.php?comp_id=<?php echo $comp_id ?>'">Pre-Register</button>
                                <button <?php echo $test = ($comp_status  != 2) ? "disabled" : "" ?> onclick="location.href='book_appointment.php?comp_id=<?php echo $comp_id ?>'">Book Appointment</button>
                                <button onclick="location.href='competitors.php?comp_id=<?php echo $comp_id ?>'">Competitors</button>
                                <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='pools.php?comp_id=<?php echo $comp_id ?>'">Pools</button>
                                <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='temporary_ranking.php?comp_id=<?php echo $comp_id ?>'">Temporary Ranking</button>
                                <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='table.php?comp_id=<?php echo $comp_id ?>'">Table</button>
                                <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href='final_results.php?comp_id=<?php echo $comp_id ?>'">Final Results</button>
                                <button onclick="printPage()">Print</a>
                                <button <?php echo $test = ($comp_status  == 2) ? "disabled" : "" ?> onclick="location.href=''">Watch Video / Watch Live</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/cw_bookmark_competition.js"></script>
    <script src="../js/cw_main.js"></script>
</body>
</html>