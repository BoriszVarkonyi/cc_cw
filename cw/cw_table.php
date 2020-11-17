<?php include "cw_comp_getdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s final results</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <?php include "cw_backbtn_choosecomp.php" ?>
            <p>TABLE OF <?php echo $comp_name ?></p>
        </div>
        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="text" name="" placeholder="Search by Title" class="search">

            <input type="button" value="Search" onclick="giveClassToFirst()">
        </form>

        <div id="call_room" >
            
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
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
                            <img src="../assets/icons/english.svg" >
                        </div>
                    </div>
                    
                </div>
            </div>
            

        </div>









    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/cw_table.js"></script>
</html>