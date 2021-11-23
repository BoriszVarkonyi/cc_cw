<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finished competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="finished_competitions">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">My Matches</p>
            </div>
            <div id="content_wrapper">
                <form method="POST" id="browsing_bar">
                    <input name="submit_search" type="submit" value="Search">
                </form>
                <div id="matches_wrapper">
                    <div class="match">
                        <div class="match_header upcoming">
                            <p>UPCOMING</p>
                        </div>
                        <div class="match_data">
                            <p>11:40</p>
                            <p>{piste name} PISTE</p>
                        </div>
                        <div class="match_content">
                            <div>
                                <p>OPPONENT:</p>
                                <p>Name</p>
                            </div>
                            <div>
                                <p>TABLE:</p>
                                <p>t32</p>
                            </div>
                            <!-- IF FINISHED -->
                            <div>
                                <p>RESULTS:</p>
                                <p class="winner">{Logged in fencer} - {score}</p>
                                <p>{Opponent} - {score}</p>
                            </div>
                        </div>
                    </div>
                    <div class="match">
                        <p></p>
                    </div>
                    <div class="match">
                        <p></p>
                    </div>
                    <div class="match">
                        <p></p>
                    </div>
                    <div class="match">
                        <p></p>
                    </div>
                    <div class="match">
                        <p></p>
                    </div>
                    <div class="match">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/cw_bookmark_competition.js"></script>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>