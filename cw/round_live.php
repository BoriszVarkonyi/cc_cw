<?php include "static/header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp name}'s final results</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
    <link rel="stylesheet" href="../css/dv_round_live_style.min.css">
</head>
<body class="competitions">
    <?php include "static/header.php"; ?>
    <main role="main" class="full">
        <div id="content" class="full">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href="table.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to competition's table">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    Round Live gnwergnfeuwgfueu
                </h1>
            </div>
            <div id="content_wrapper" class="round">
                <div id="video" class="round">
                    <p id="no_livestream" class="hidden">There is no available livestream for this round.</p>
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/b68b-E2UwL4?autoplay=1&mute=1" title="Live vide from {comp name}, piste no, {fencer 1} vs. {fencer 2}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div id="round_info_wrapper">
                    <div id="machine_wrapper">
                        <div>
                            <div class="fencer_live_info">
                                <p>József</p>
                                <img src="../assets/icons/english.svg">
                                <p>NAT</p>
                            </div>
                            <div class="fencer_live_info">
                                <p>József</p>
                                <img src="../assets/icons/english.svg">
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
                                        <img src="../assets/icons/priority_black.svg">
                                        <img src="../assets/icons/card_gray.svg">
                                        <img src="../assets/icons/card_yellow.svg">
                                    </div>
                                    <p id="machine_fencer_1_score">5</p>
                                </div>
                                <p id="machine_period">5</p>
                                <div id="machine_fencer_2" class="machine_fencer">
                                    <div>
                                        <img src="../assets/icons/priority_gray.svg">
                                        <img src="../assets/icons/card_red.svg">
                                        <img src="../assets/icons/card_yellow.svg">
                                    </div>
                                    <p id="machine_fencer_2_score">5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="round_info">
                        <p>Ref: {Referee's Name}</p>
                        <p>20 / 12 / 2021 15:20</p>
                        <p>Piste No.: 5</p>
                        <p>Ref: {Referee's Name}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
</body>
</html>