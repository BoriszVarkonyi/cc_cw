<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

$get_assigned_ranking_id = "SELECT * FROM competitions WHERE comp_id = $comp_id";
$get_assigned_ranking_id_do = mysqli_query($connection, $get_assigned_ranking_id);

if($row = mysqli_fetch_assoc($get_assigned_ranking_id_do)){

    $rkid = $row["comp_ranking_id"];

}

$idtoremove = $_POST["hidden_id"];


print_r($_POST);


if(isset($_POST["approve"])){

$ids_to_cp = $_POST["hidden_apporove"];

$query = "SELECT *
FROM `information_schema`.`tables`
WHERE table_schema = 'ccdatabase'
    AND table_name = 'cptrs_$comp_id'
LIMIT 1;";
$query_do = mysqli_query($connection, $query);

if(mysqli_num_rows($query_do) == 0){

$query = "CREATE TABLE cptrs_$comp_id ( `id` VARCHAR(255) NOT NULL , `name` VARCHAR(255) NOT NULL , `nationality` VARCHAR(255) NOT NULL , `reg` INT NOT NULL , `wc` INT NOT NULL , `rank` INT NOT NULL , `comp_rank` INT NOT NULL, `temporary_rank` INT NOT NULL, `final_rank` INT NOT NULL, `ass_match` INT NOT NULL ) ENGINE = InnoDB;";
$query_do = mysqli_query($connection, $query);

}

$query_cp = "INSERT INTO cptrs_$comp_id(id,name,nationality,rank) SELECT id,name,nationality,position FROM rk_$rkid WHERE id IN ($ids_to_cp)";
$query_cp_do = mysqli_query($connection, $query_cp);

$query_set_stat = "UPDATE pre_$comp_id SET stat = 1 WHERE id = $idtoremove";
$query_set_stat_do = mysqli_query($connection, $query_set_stat);

header("Location: manage_entries.php?comp_id=$comp_id");

}





    if(isset($_POST["disapprove"])){

    $query = "UPDATE pre_$comp_id SET stat = 2 WHERE id = $idtoremove";
    $query_do = mysqli_query($connection, $query);

    header("Location: manage_entries.php?comp_id=$comp_id");


    }

    if(isset($_POST["send_pre"])){

        $f_name = $_POST["f_name"];
        $f_country = $_POST["f_country"];
        $f_email = $_POST["f_email"];
        $f_phone = $_POST["f_phone"];

        $c_name = $_POST["c_name"];
        $c_email = $_POST["c_email"];
        $c_phone = $_POST["c_phone"];

        $fencer_ids = $_POST["fencer_ids"];

        $compet_id = $_POST["compet_id"];

    }



    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'borisz.varkonyi@gmail.com';                     // SMTP username
        $mail->Password   = 'boborisz2003';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('borisz.varkonyi@gmail.com', 'PLEASE CONFIRM');
        $mail->addAddress($f_mail, 'Federation');     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Please confirm your pre registration';
        $mail->Body    = '

        <a style="color:red;" href="http://localhost/php/manage_entries.php?comp_id='. $comp_id . '&f_name='. $f_name .'&f_country='. $f_country  .'&f_email='. $f_email .'&f_phone='. $f_phone .'&c_name='. $c_name .'&c_email='.$c_email.'&c_phone='.$c_phone.'&fencer_ids='.$fencer_ids.'&compet_id='.$compet_id.'">Confirm</a>

        ';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
                <img src="../assets/icons/close-black-18dp.svg">
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

                    <div id="new_entries_panel">
                        <p>New Entries</p>
                        <div class="table">
                            <div class="table_header">
                                <div class="table_header_text">FEDERATION'S NAME</div>
                                <div class="table_header_text">FEDERATION'S EMAIL ADDRESS</div>
                                <div class="table_header_text">CONTACT KEEPER'S NAME</div>
                                <div class="big_status_header"></div>
                            </div>
                            <div class="table_row_wrapper">

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



                                    //$ids = substr($ids, 0, -1);

                                    $get_fencers_query = "SELECT * FROM rk_$rkid WHERE id IN ($ids)";
                                    $get_fencers_query_do = mysqli_query($connection, $get_fencers_query);

                                    if(!$get_fencers_query_do){
                                        echo mysqli_error($connection);
                                    }




                                    ?>


                                    <div class="entry" id="<?php echo $ids ?>">
                                        <div class="table_row" id="<?php echo $entry_id ?>" onclick="toggleEntry(this)">
                                            <div class="table_item"><?php echo $f_name ?></div>
                                            <div class="table_item"><?php echo $f_mail ?></div>
                                            <div class="table_item"><?php echo $f_country ?></div>
                                            <div class="big_status_item gray"></div>
                                        </div>
                                        <div class="entry_panel collapsed">
                                            <button type="button" class="entry_info_button" onclick="toggleEntryInfo(this)">
                                                <img src="../assets/icons/info-black-18dp.svg">
                                            </button>
                                            <form id="appdisapp_<?php  echo $entry_id  ?>" class="approve_fencers_wrapper table" action="" method="POST">
                                                <div class="table_header">
                                                    <div class="table_header_text">FENCER'S NAME</div>
                                                    <div class="table_header_text">FENCER'S NATION / CLUBY</div>
                                                    <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                                </div>
                                                <div class="table_row_wrapper">
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
                                                </div>
                                                <input type="text" class="hidden" name="hidden_id" id="hidden_id_<?php echo $entry_id ?>" form="appdisapp_<?php echo $entry_id ?>">
                                                <input type="text" class="hidden" name="hidden_apporove" id="hidden_approve_<?php echo $entry_id ?>" form="appdisapp_<?php echo $entry_id ?>">


                                                <input type="submit" name="disapprove" value="Disapprove" class="panel_submit secondary red">
                                                <input type="submit" name="approve" value="Approve" class="panel_submit green">
                                            </form>

                                            <div class="entry_overlay_info hidden">
                                                <div>
                                                    <p >FEDERATION'S NAME:</p>
                                                    <p><?php echo $f_name ?></p>
                                                </div>
                                                <div>
                                                    <p >COUNTRY / FENCING CLUB:</p>
                                                    <p><?php echo $f_country ?></p>
                                                </div>
                                                <div>
                                                    <p >FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                                                    <p><?php echo $f_mail ?></p>
                                                </div>
                                                <div>
                                                    <p >FEDERATION'S PHONE NUMBER:</p>
                                                    <p><?php echo $f_phone ?></p>
                                                </div>
                                                <div>
                                                    <p >CONTACT KEEPER'S FULL NAME:</p>
                                                    <p><?php echo $c_name ?></p>
                                                </div>
                                                <div>
                                                    <p >CONTACT KEEPER'S EMAIL ADDRESS:</p>
                                                    <p><?php echo $c_mail ?></p>
                                                </div>
                                                <div>
                                                    <p >CONTACT KEEPER'S PHONE NUMBER:</p>
                                                    <p><?php echo $c_phone ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="managed_entries_panel">
                            <p>Managed Entries</p>
                            <div class="table">
                                <div class="table_header">
                                    <div class="table_header_text">FEDERATION'S NAME</div>
                                    <div class="table_header_text">FEDERATION'S EMAIL ADDRESS</div>
                                    <div class="table_header_text">CONTACT KEEPER'S NAME</div>
                                </div>
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
                                                <img src="../assets/icons/info-black-18dp.svg">
                                            </button>
                                            <form class="approve_fencers_wrapper table">
                                                <div class="table_header">
                                                    <div class="table_header_text">FENCER'S NAME</div>
                                                    <div class="table_header_text">FENCER'S NATION / CLUB</div>
                                                    <div class="table_header_text">FENCER'S DATE OF BIRTH</div>
                                                </div>
                                                <div class="table_row_wrapper">
                                                    <?php

                                                    while($rowtwo = mysqli_fetch_assoc($get_fencers_query_do)){

                                                        $fen_name = $rowtwo["name"];
                                                        $fen_nat = $rowtwo["nationality"];
                                                        $fen_dob = $rowtwo["dob"];


                                                        ?>

                                                    <div class="table_row">
                                                        <div class="table_item"><p><?php echo $fen_name ?></p></div>
                                                        <div class="table_item"><p><?php echo $fen_nat ?></p></div>
                                                        <div class="table_item"><p><?php echo $fen_dob ?></p></div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </form>

                                            <div class="entry_overlay_info hidden">
                                                <div>
                                                    <p>FEDERATION'S NAME:</p>
                                                    <p><?php echo $f_name ?></p>
                                                </div>
                                                <div>
                                                    <p>COUNTRY / FENCING CLUB:</p>
                                                    <p><?php echo $f_country ?></p>
                                                </div>
                                                <div>
                                                    <p>FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                                                    <p><?php echo $f_mail ?></p>
                                                </div>
                                                <div>
                                                    <p>FEDERATION'S PHONE NUMBER:</p>
                                                    <p><?php echo $f_phone ?></p>
                                                </div>
                                                <div>
                                                    <p>CONTACT KEEPER'S FULL NAME:</p>
                                                    <p><?php echo $c_name ?></p>
                                                </div>
                                                <div>
                                                    <p>CONTACT KEEPER'S EMAIL ADDRESS:</p>
                                                    <p><?php echo $c_mail ?></p>
                                                </div>
                                                <div>
                                                    <p>CONTACT KEEPER'S PHONE NUMBER:</p>
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
        </div>
    </body>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/manage_entries.js"></script>
</html>