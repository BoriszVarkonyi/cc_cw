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
    <title>Template</title>
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
                <p class="page_title">{Fencer 1} vs {Fencer 2}</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="submit">
                        <p>Save Match</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper width_80" id="match_result_wrapper">
                    <div class="match_fencers_wrapper">
                        <div>
                            <p>{fencer nam e1 long name long namre fencer}</p>
                            <button>
                                <img src="../assets/icons/message-black-18dp.svg">
                            </button>
                        </div>

                        <div>
                            <p>{fencer nam e1 long name long namre fencer}</p>
                            <button>
                                <img src="../assets/icons/message-black-18dp.svg">
                            </button>
                        </div>
                    </div>
                    <div class="match_referees_wrapper">
                        <div>
                            Referee: {Referee name}
                            <button class="underlined_button" type="submit">
                                <p>Change</p>
                            </button>
                        </div>
                        <div>
                            Referee: {Referee name}
                            <button class="underlined_button" type="submit">
                                <p>Change</p>
                            </button>
                        </div>
                        <div>
                            Referee: {Referee name}
                            <button class="underlined_button" type="submit">
                                <p>Change</p>
                            </button>
                        </div>
                        <div>
                            Referee: {Referee name}
                            <button class="underlined_button" type="submit">
                                <p>Change</p>
                            </button>
                        </div>
                    </div>
                    <div class="match_fencers_results">
                        <div id="fencer_1" class="fencer_wrapper">
                            <div>
                                <p>Fencer 1 Name</p>
                                <input type="number" class="match_fencer_points" placeholder="#">
                                <p class="winner_text">WINNER</p>
                            </div>
                            <form class="fencers_cards_wrapper">
                                <div>
                                    Regular
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                </div>
                                <div>
                                    Passive
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                </div>
                                <button class="disqualify_button">Disqualify</button>
                            </form>
                        </div>

                        <div id="fencer_2" class="fencer_wrapper">
                            <div>
                                <p>Fencer 2 Name</p>
                                <input type="number" class="match_fencer_points" placeholder="#">
                                <p class="winner_text">WINNER</p>
                            </div>
                            <form class="fencers_cards_wrapper">
                                <div>
                                    Regular
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                </div>
                                <div>
                                    Passive
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-yellow-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-red-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                    <div class="card_wrapper">
                                        <img src="../assets/icons/card-black-18dp.svg">
                                        <input type="number" class="match_fencer_cards" placeholder="#">
                                    </div>
                                </div>
                                <button class="disqualify_button">Disqualify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>