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
                <div id="browsing_bar">
                    <a href="my_matches_individual.php?comp_id=<?php echo $comp_id ?>" class="current">
                        <p>Pools</p>
                    </a>
                    <a href="my_matches_individual.php?comp_id=<?php echo $comp_id ?>">
                        <p>Table</p>
                    </a>
                </div>
                <div id="pool_listing">
                    <div>
                        <!-- ezt kell loopolni -->
                        <div class="entry">
                            <div class="tr">
                                <div class="td bold">No. {num}</div>
                                <div class="td">Piste {name}</div>
                                <div class="td">Ref1: {name}</div>
                                <div class="td">Re21: {name}</div>
                                <div class="td">idő</div>
                            </div>
                            <div class="entry_panel">
                                <table class="pool_table_wrapper no_interaction">
                                    <thead>
                                        <tr>
                                            <th>
                                                <p>NAME</p>
                                            </th>
                                            <th>
                                                <p>NATION</p>
                                            </th>
                                            <th class="square">
                                                <p>NO.</p>
                                            </th>
                                            <th class="square">
                                                <p>1</p>
                                            </th>
                                            <th class="square">
                                                <p>2</p>
                                            </th>
                                            <th class="square">
                                                <p>3</p>
                                            </th>

                                            <!-- Win per Lose -->
                                            <th class="square">
                                                <p>W/L</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="alt">

                                        <tr class="">
                                            <td>name</td>
                                            <td>nat</td>
                                            <td class="square row_title">1</td>
                                            <td class="square"></td>
                                            <td class="square"></td>
                                            <td class="square"></td>
                                            <td class="square">1.2</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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