<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table of {Comp's name}</title>
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
                <p class="page_title">Table</p>
                <button class="stripe_button orange" type="submit">
                    <p>Start next Round</p>
                    <img src="../assets/icons/next_plan-black-18dp.svg"></img>
                </button>
            </div>
            <div id="page_content_panel_main">
            <div id="call_room" class="cc">
            
            <div id="e_1" class="elimination first visible">
                <div class="elimination_label">Table of __</div>
                <div class="table_round" onclick="location.href='cw_round_live.php'">
                    <div class="round_information">
                        <p>Ref: {Referee's Name}</p>
                        <p>20 / 12 / 2020 15:20</p>
                        <p>Piste No.: 5</p>
                        <p>Ref: {Referee's Name}</p>
                    </div>
                    
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer dna">
                        <div class="table_fencer_number"> <!-- Not visible if dna-->
                        25
                        </div>
                        <div class="table_fencer_name"> <!-- Has to be rewritten to dna-->
                            DDA
                        </div>
                        <div class="table_fencer_nat"> <!-- Not visible if dna-->
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div id="e_2" class="elimination visible">
                <div class="elimination_label">Table of __</div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div id="e_3" class="elimination visible">
                <div class="elimination_label">Table of __</div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div id="e_4" class="elimination visible">
                <div class="elimination_label">Table of __</div>

                <div class="table_round">
                    <div class="round_information">
                        <p>Ref: {Referee's Name}</p>
                        <p>20 / 12 / 2020 15:20</p>
                        <p>Piste No.: 5</p>
                        <p>Ref: {Referee's Name}</p>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
            

        </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>