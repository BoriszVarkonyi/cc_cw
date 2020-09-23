<?php include "cw_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp name}'s final results</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <button type="button" class="back_button" onclick="location.href='choose_competition.php'">
                <img class="stripe_button_icon" src="../assets/icons/arrow_back_ios-black-18dp.svg"></img>
            </button>
            <p>TABLEU OF {COMP NAME}</p>
        </div>
        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="search" name="" id="" placeholder="Search by Fencer">

            <input type="button" value="Search" onclick="giveClassToFirst()">
        </form>

        <div id="call_room" class="">
            
            <div id="e_1" class="elimination first visible">
                <div class="elimination_label">Table of __</div>
                <div class="tableu_round" onclick="location.href='cw_round_live.php'">
                    <div class="round_information">
                        <p>Ref: {Referee's Name}</p>
                        <p>20 / 12 / 2020 15:20</p>
                        <p>Piste No.: 5</p>
                        <p>Ref: {Referee's Name}</p>
                    </div>
                    
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer dna">
                        <div class="tableu_fencer_number"> <!-- Not visible if dna-->
                        25
                        </div>
                        <div class="tableu_fencer_name"> <!-- Has to be rewritten to dna-->
                            DDA
                        </div>
                        <div class="tableu_fencer_nat"> <!-- Not visible if dna-->
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div id="e_2" class="elimination visible">
                <div class="elimination_label">Table of __</div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div id="e_3" class="elimination visible">
                <div class="elimination_label">Table of __</div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="tableu_round">
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div id="e_4" class="elimination visible">
                <div class="elimination_label">Table of __</div>

                <div class="tableu_round">
                    <div class="round_information">
                        <p>Ref: {Referee's Name}</p>
                        <p>20 / 12 / 2020 15:20</p>
                        <p>Piste No.: 5</p>
                        <p>Ref: {Referee's Name}</p>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="tableu_fencer">
                        <div class="tableu_fencer_number">
                        25
                        </div>
                        <div class="tableu_fencer_name">
                            Szia Enber
                        </div>
                        <div class="tableu_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
            

        </div>









    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/cw_tableu.js"></script>
</html>