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
        <div id="call_room" class="">
            <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                <img src="../assets/icons/arrow_back_ios-black-18dp.svg" >
            </div>
            <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                <img src="../assets/icons/arrow_forward_ios-black-18dp.svg" >
            </div>
            <div id="e_1" class="elimination">
                <div class="elimination_label">Table of __</div>
                <div class="table_round_wrapper finished blue">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished blue">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished blue">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished blue">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished yellow">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished yellow">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished yellow">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished yellow">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished green">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished green">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished green">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished green">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished red">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished red">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished red">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished red">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
            </div>
            <div id="e_2" class="elimination">
                <div class="elimination_label">Table of __</div>
                <div class="table_round_wrapper finished blue">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished blue">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished yellow">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished yellow">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished green">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished green">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished red">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished red">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
            </div>
            <div id="e_3" class="elimination">
                <div class="elimination_label">Table of __</div>
                <div class="table_round_wrapper finished blue">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished yellow">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished green">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished red">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
            </div>
            <div id="e_4" class="elimination">
                <div class="elimination_label">Table of __</div>
                <div class="table_round_wrapper finished purple">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
                <div class="table_round_wrapper finished purple">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
            </div>
            <div id="e_5" class="elimination">
                <div class="elimination_label">Table of __</div>
                <div class="table_round_wrapper finished purple">
                    <div>
                        <p>Ref: {Referee's Name}</p>
                        <p>12:00</p>
                    </div>
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bidafrg</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>VRef: {Referee's Name}</p>
                        <p>Piste: Red</p>
                    </div>
                </div>
            </div>
            <div id="e_5" class="elimination">
                <div class="elimination_label">Table of __</div>
                <div class="table_round_wrapper finished purple">
                    <div class="table_round" onclick="tableRoundConfig(this)">
                        <div class="table_fencer">
                            <div class="table_fencer_number">
                                <p>25</p>
                            </div>
                            <div class="table_fencer_name">
                                <p>Bida Sergey Bida Sergey Bida</p>
                            </div>
                            <div class="table_fencer_nat">
                                <p>rus</p>
                            </div>
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