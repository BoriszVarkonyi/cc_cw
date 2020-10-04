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
<!-- ez miert nincs headerburgerben? -->
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
<!-- header -->
    <div id="flexbox_container">

        <!-- left navigation bar -->
        <?php include "../includes/navbar.php"; ?>
        
        <div class="page_content_flex">

                <!-- dashboard header -->  
                <div id="title_stripe">
                    <button type="button" class="back_button" onclick="location.href='choose_competition.php'">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg"></img>
                    </button>
                    <p class="comp_title"><?php echo $comp_name; ?></p>
                    
                    <button class="stripe_button orange">
                        <p>Publish Competition</p>
                        <img src="../assets/icons/send-black-18dp.svg"></img>
                    </button>

                </div>

                
                <!-- dashboard body -->  
                <div id="page_content_panel_main">
                    <div id="db_panel_wrapper">

                        <!-- blank panel top-->
                        <div class="full_width_flex">
                            <div class="db_panel">
                                <div onclick="location.href='https://www.example.com'">
                                    <p>blank top panel</p>
                                </div>
                            </div>
                        </div>


                        <!-- competition status -->
                        <div class="half_width_flex">
                            <div class="db_panel">
                                
                                <!-- competition status panel header -->
                                <?php include "../php/comp_status.php"; ?>
                                <!-- competiton status table -->
                                <?php include "../php/comp_status_table.php" ?>
                            </div>
                        </div>

                        <!-- chat panel -->
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
    <script src="../js/main.js"></script>
<script src="../js/dashboard.js"></script>
</body>
</html>