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
<body class="competitions">
<div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content">
                <div id="title_stripe">
                    <p class="stripe_title">
                        <button type="button" class="back_button" onclick="window.history.back();">
                            <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                        </button>
                        Round Live gnwergnfeuwgfueu
                    </p>
                </div>
                <div id="round_live_wrapper">
                    <div id="round_livestream_wrapper">
                        <p id="no_livestream" class="hidden">There is no available livestream for this round.</p>
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/b68b-E2UwL4?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div id="round_info_wrapper">
                        <div id="machine_wrapper">
                            <div>
                                <div class="fencer_live_info">
                                    <p>József</p>
                                    <img src="../assets/icons/english.svg" >
                                    <p>NAT</p>
                                </div>
                                <div class="fencer_live_info">
                                    <p>József</p>
                                    <img src="../assets/icons/english.svg" >
                                    <p>NAT</p>
                                </div>
                            </div>
                            <div id="machine">
                                <div id="red_fencer" class="fencer_color"></div>
                                <div id="green_fencer" class="fencer_color"></div>
                                <p id="round_time">3:00</p>
                                <div class="fencer_score_wrapper">
                                    <div id="machine_fencer_1" class="machine_fencer">
                                        <div>
                                            <img src="../assets/icons/priority-black-18dp.svg" >
                                            <img src="../assets/icons/card-gray-18dp.svg" >
                                            <img src="../assets/icons/card-yellow-18dp.svg" >
                                        </div>
                                        <p id="machine_fencer_1_score">5</p>
                                    </div>
                                    <p id="machine_period">5</p>
                                    <div id="machine_fencer_2" class="machine_fencer">
                                        <div>
                                            <img src="../assets/icons/priority-gray-18dp.svg" >
                                            <img src="../assets/icons/card-red-18dp.svg" >
                                            <img src="../assets/icons/card-yellow-18dp.svg" >
                                        </div>
                                        <p id="machine_fencer_2_score">5</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="round_info">
                            <p>Ref: {Referee's Name}</p>
                            <p>20 / 12 / 2020 15:20</p>
                            <p>Piste No.: 5</p>
                            <p>Ref: {Referee's Name}</p>
                        </div>
                    </div>
                </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>