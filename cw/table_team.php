<?php include "includes/get_comp_data.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s table</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
    <link rel="stylesheet" href="../css/table_style.min.css">
</head>
<body class="competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href="competition.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    Table of <?php echo $comp_name ?>
                </h1>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                </form>
                <div id="call_room" class="cw">
                    <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()" aria-label="Go to previous Table Column">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </div>
                    <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()" aria-label="Go to next Table Column">
                        <img src="../assets/icons/arrow_forward_ios_black.svg" alt="Go forward button">
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
                    <div id="e_6" class="elimination">
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
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/table.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>