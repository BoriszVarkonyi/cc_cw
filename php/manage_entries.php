<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

print_r($_POST);


if(isset($_POST["approve"])){




}
if(isset($_POST["disapprove"])){

$idtoremove = $_POST["hidden_id"];

$query = "UPDATE pre_$comp_id SET stat = 2 WHERE id = $idtoremove";
$query_do = mysqli_query($connection, $query);

header("Location: manage_entries.php?comp_id=$comp_id");


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Entries</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="confirmation" class="hidden">
        <form id="confirmation_form">
            <button class="panel_button" onclick="">
                <img src="../assets/icons/close-black-18dp.svg" >
            </button>
            <p>Are you sure you want to {action} {object}?</p>
            <p>You cannot withdraw this action!</p>
            <div id="confirmation_button_section">
                <button type="submit" value="Cancel">Cancel</button>
                <button type="submit" value="{Action}" class="action">{Action}</button>
            </div>
        </form>
    </div>
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Manage Entries</p>
                </div>
                <div id="page_content_panel_main">
                    <div id="manage_entries_wrapper">
                    
                    <div id="new_entries_panel" class="entry_table_row_wrapper">


                    <p>New Entries</p>

                        <?php
                        
                        
                        $query = "SELECT * FROM pre_$comp_id WHERE stat = 0";
                        $query_do = mysqli_query($connection, $query);


                        while($row = mysqli_fetch_assoc($query_do)){

                            $f_name = $row["fed_name"];
                            $f_country = $row["country_club"];
                            $f_mail = $row["fed_mail"];
                            $f_phone = $row["fed_phone"];
                            $c_name = $row["con_name"];
                            $c_mail = $row["con_mail"];
                            $c_phone = $row["con_phone"];

                            $ids = $row["reg_fencers"];

                            $entry_id = $row["id"];
                            
                            
                            $get_assigned_ranking_id = "SELECT * FROM competitions WHERE comp_id = $comp_id";
                            $get_assigned_ranking_id_do = mysqli_query($connection, $get_assigned_ranking_id);

                            if($row = mysqli_fetch_assoc($get_assigned_ranking_id_do)){

                                $rkid = $row["comp_ranking_id"];

                            }

                            $get_fencers_query = "SELECT * FROM rk_$rkid WHERE id IN ($ids)";
                            $get_fencers_query_do = mysqli_query($connection, $get_fencers_query);

                            
                            
                            
                            ?>

                        
                            <div class="entry" id="entry_1">
                                <div class="table_row" id="<?php echo $entry_id ?>" onclick="toggleEntry(this)">
                                    <div class="table_item"><?php echo $f_name ?></div>
                                    <div class="table_item"><?php echo $f_mail ?></div>
                                    <div class="table_item"><?php echo $f_country ?></div>
                                    <div class="big_status_item gray"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <button type="button" class="entry_info_button" onclick="toggleEntryInfo(this)">
                                        <img src="../assets/icons/info-black-18dp.svg" >
                                    </button>
                                    <form id="appdisapp_<?php  echo $entry_id  ?>" class="approve_fencers_wrapper table_row_wrapper" action="" method="POST">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                        </div>

                                            <?php
                                            
                                            while($rowtwo = mysqli_fetch_assoc($get_fencers_query_do)){

                                                $fen_name = $rowtwo["name"];
                                                $fen_nat = $rowtwo["nationality"];
                                                $fen_dob = $rowtwo["dob"];


                                                ?>  
                                            
                                            <div class="table_row">
                                            <div class="table_item"><?php echo $fen_name ?></div>
                                            <div class="table_item"><?php echo $fen_nat ?></div>
                                            <div class="table_item"><?php echo $fen_dob ?></div>
                                        </div>
                                            <?php
                                            }
                                            ?>

                                        <input type="text" class="hidden" name="hidden_id" id="hidden_id_<?php echo $entry_id ?>" form="appdisapp_<?php echo $entry_id ?>">


                                        <input type="submit" name="disapprove" value="Disapprove" class="panel_submit secondary red">
                                        <input type="submit" name="approve" value="Approve" class="panel_submit green">
                                    </form>

                                    <div class="entry_overlay_info hidden">
                                        <div>
                                            <p class="label_text">FEDERATION'S NAME:</p>
                                            <p><?php echo $f_name ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">COUNTRY / FENCING CLUB:</p>
                                            <p><?php echo $f_country ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                                            <p><?php echo $f_mail ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S PHONE NUMBER:</p>
                                            <p><?php echo $f_phone ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S FULL NAME:</p>
                                            <p><?php echo $c_name ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S EMAIL ADDRESS:</p>
                                            <p><?php echo $c_mail ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S PHONE NUMBER:</p>
                                            <p><?php echo $c_phone ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        </div>

                        <div id="managed_entries_panel" class="entry_table_row_wrapper">
                            <p>Managed Entries</p>
                            <?php
                        
                        
                        $query = "SELECT * FROM pre_$comp_id WHERE stat in (1,2)";
                        $query_do = mysqli_query($connection, $query);


                        while($row = mysqli_fetch_assoc($query_do)){

                            $f_name = $row["fed_name"];
                            $f_country = $row["country_club"];
                            $f_mail = $row["fed_mail"];
                            $f_phone = $row["fed_phone"];
                            $c_name = $row["con_name"];
                            $c_mail = $row["con_mail"];
                            $c_phone = $row["con_phone"];

                            $ids = $row["reg_fencers"];

                            $status = $row["stat"];
                            
                            
                            $get_assigned_ranking_id = "SELECT * FROM competitions WHERE comp_id = $comp_id";
                            $get_assigned_ranking_id_do = mysqli_query($connection, $get_assigned_ranking_id);

                            if($row = mysqli_fetch_assoc($get_assigned_ranking_id_do)){

                                $rkid = $row["comp_ranking_id"];

                            }

                            $get_fencers_query = "SELECT * FROM rk_$rkid WHERE id IN ($ids)";
                            $get_fencers_query_do = mysqli_query($connection, $get_fencers_query);

                            
                            
                            
                            ?>

                        
                            <div class="entry" id="entry_1">
                                <div class="table_row" onclick="toggleEntry(this)">
                                    <div class="table_item"><?php echo $f_name ?></div>
                                    <div class="table_item"><?php echo $f_mail ?></div>
                                    <div class="table_item"><?php echo $f_country ?></div>
                                    <div class="big_status_item <?php 
                                    
                                    if($status == 1){

                                        echo "green";

                                    }
                                    if($status == 2){

                                        echo "red";

                                    }

                                    ?>"></div>
                                </div>
                                <div class="entry_panel collapsed">
                                    <button type="button" class="entry_info_button" onclick="toggleEntryInfo(this)">
                                        <img src="../assets/icons/info-black-18dp.svg" >
                                    </button>
                                    <form class="approve_fencers_wrapper table_row_wrapper">
                                        <div class="table_header">
                                            <div class="table_header_text">FENCER'S NAME</div>
                                            <div class="table_header_text">FENCER'S NATIONALITY</div>
                                            <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                        </div>

                                            <?php
                                            
                                            while($rowtwo = mysqli_fetch_assoc($get_fencers_query_do)){

                                                $fen_name = $rowtwo["name"];
                                                $fen_nat = $rowtwo["nationality"];
                                                $fen_dob = $rowtwo["dob"];


                                                ?>  
                                            
                                            <div class="table_row">
                                            <div class="table_item"><?php echo $fen_name ?></div>
                                            <div class="table_item"><?php echo $fen_nat ?></div>
                                            <div class="table_item"><?php echo $fen_dob ?></div>
                                        </div>
                                            <?php
                                            }
                                            ?>
                                    </form>

                                    <div class="entry_overlay_info hidden">
                                        <div>
                                            <p class="label_text">FEDERATION'S NAME:</p>
                                            <p><?php echo $f_name ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">COUNTRY / FENCING CLUB:</p>
                                            <p><?php echo $f_country ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                                            <p><?php echo $f_mail ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">FEDERATION'S PHONE NUMBER:</p>
                                            <p><?php echo $f_phone ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S FULL NAME:</p>
                                            <p><?php echo $c_name ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S EMAIL ADDRESS:</p>
                                            <p><?php echo $c_mail ?></p>
                                        </div>
                                        <div>
                                            <p class="label_text">CONTACT KEEPER'S PHONE NUMBER:</p>
                                            <p><?php echo $c_phone ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script src="../js/manage_entries.js"></script>
</html>