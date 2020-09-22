<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php"; ?>
<?php 

checkComp($connection);

    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connection, $query);
    
    if($row = mysqli_fetch_assoc($check_comp_query)){
    
    $comp_name = $row["comp_name"];
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name; ?></title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header test 1 -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <button type="button" class="back_button" onclick="location.href='choose_competition.php'">
                        <img class="stripe_button_icon" src="../assets/icons/arrow_back_ios-black-18dp.svg"></img>
                    </button>
                    <p class="comp_title"><?php echo $comp_name; ?></p>
                    <button class="stripe_button orange only_stripe_item">
                        <p class="stripe_button_text">Publish Competition</p>
                        <img class="stripe_button_icon" src="../assets/icons/send-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">
                    <div id="db_panel_wrapper">
                        <div class="full_width_flex">
                            <div class="db_panel">
                                <div onclick="location.href='https://www.example.com'">
                                </div>
                            </div>
                        </div>
                        <div class="half_width_flex">
                            <div class="db_panel">
                                <div class="db_panel_title_stripe">
                                    <img src="../assets/icons/beenhere-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                    <p>Competition's status</p>
                                </div>
                                <div class="db_panel_main">
                                    <div id="sheduled_to_do_list">
                                        <a class="sublist_title" onclick="toggle_general_to_do()">General<img src="../assets/icons/close-black-18dp.svg" alt=""></a>
                                        <ul id="general_to_do" class="sheduled_to_do_sublist">
                                            <li>Basic Information<img src="../assets/icons/close-black-18dp.svg" alt=""></li>
                                            <li>Information for fencers<img src="../assets/icons/close-black-18dp.svg" alt=""></li>
                                            <li>Timetable<img src="../assets/icons/close-black-18dp.svg" alt=""></li>
                                            <li>Invitations<img src="../assets/icons/close-black-18dp.svg" alt=""></li>
                                        </ul>
                                        <a class="sublist_title" onclick="toggle_technical_to_do()">Technical<img src="../assets/icons/close-black-18dp.svg" alt=""></a>
                                        <ul id="technical_to_do" class="sheduled_to_do_sublist">
                                            <li>Technicians<img src="../assets/icons/close-black-18dp.svg" alt=""></li>
                                            <li>Referees<img src="../assets/icons/close-black-18dp.svg" alt=""></li>
                                            <li>Pistes<img src="../assets/icons/close-black-18dp.svg" alt=""></li>
                                            <li>Formula<img src="../assets/icons/close-black-18dp.svg" alt=""></li>
                                        </ul>
                                        <a>Ranking<img src="../assets/icons/close-black-18dp.svg" alt=""></a>
                                        <a>Pre-entries<img src="../assets/icons/close-black-18dp.svg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="half_width_flex">
                            <div class="db_panel">
                                <div class="db_panel_title_stripe">
                                    <img src="../assets/icons/chat-black-18dp.svg" alt="" class="db_panel_stripe_icon">
                                    <p>Chat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <script src="../js/main.js"></script>
<script src="../js/dashboard.js"></script>
</body>
</html>