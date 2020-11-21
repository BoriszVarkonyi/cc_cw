<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 
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
                <div id="title_stripe">
                    <p class="page_title">Weapon Control</p>
                    <button class="stripe_button" type="submit">
                        <p>Send message to fencer</p>
                        <img src="../assets/icons/chat-black-18dp.svg" />
                    </button>
                    <form id="add_weapon_control" method="POST" action="" >
                    <button from="add_weapon_control" name="add_wc" class="stripe_button orange" type="submit">
                        <p>Add weapon control</p>
                        <img src="../assets/icons/add-black-18dp.svg" /> <!-- This should change to ../assets/icons/edit-black-18dp.svg if the fencer already has weapon control-->
                    </button>

                    <input type="text" class="hidden" name="fencer_id" id="fencer_id_input" value="">
                    </form>
                </div>
                <div id="page_content_panel_main">
                    <div class="wrapper table">
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">SEX</div>
                            <div class="table_header_text">NATION / CLUB</div>
                            <div class="table_header_text">WEAPON TYPE</div>
                            <div class="table_header_text">STATUS</div>
                            <div class="big_status_header"></div>
                        </div>
                        <div class="table_row_wrapper">
                        <?php
                            //get weapon type, comp sex from competitions
                            $qry_get_comp_data = "SELECT * FROM competitions WHERE comp_id = $comp_id";

                            $qry_get_comp_data_do = mysqli_query($connection, $qry_get_comp_data);

                            if ($row = mysqli_fetch_assoc($qry_get_comp_data_do)) {
                                $comp_sex = sexConverter($row['comp_sex']);
                                $comp_weapon = weaponConverter($row['comp_weapon']);
                                $feedback['getcompdata'] = "ok!";
                            } else {
                                $feedback['getcompdata'] = "ERROR " . mysqli_error($connection);
                            }
                            
                            //get fencers from competitors by comp id :D
                            $qry_get_fencers = "SELECT * FROM cptrs_$comp_id";

                            $qry_get_fencers_do = mysqli_query($connection, $qry_get_fencers);

                            while ($row = mysqli_fetch_assoc($qry_get_fencers_do)) {
                                $feedback['getfencers'] = "ok!";

                                $fencer_name = $row['name'];
                                $fencer_id = $row['id'];
                                $fencer_nat = $row['nationality'];

                                //get fencer status wc létezik e
                                $qry_fencer_wc_data = "";
                        ?>
                        <!-- while -->
                        <div class="table_row" onclick="selectRow(this)" id="<?php echo $fencer_id ?>">
                            <div class="table_item"><?php echo $fencer_name ?></div>
                            <div class="table_item"><?php echo $comp_sex ?></div>
                            <div class="table_item"><?php echo $fencer_nat ?></div>
                            <div class="table_item"><?php echo $comp_weapon ?></div>
                            <div class="table_item">státusza</div>
                            <div class="big_status_item red"></div> <!-- red or green style added to small_status item to inidcate status -->
                        </div>
                        <!-- ----- -->
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/weapon_control.js"></script>
</html>