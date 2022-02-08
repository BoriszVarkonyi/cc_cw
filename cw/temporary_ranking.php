<?php include "cw_comp_getdata.php"; ?>
<?php include "./controllers/CompetitorController.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s temporary ranking</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
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
                    Temporary Ranking of <?php echo $comp_name ?>
                </h1>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                </form>
                <div id="competition_color_legend">
                    <button id="fencing_lengend" value="Registration Finished" aria-label="Select Still Fencing"></button>
                    <p>Still fencing</p>
                    <button id="eliminated_lengend" value="Ongoing Pools" aria-label="Select Eliminated"></button>
                    <p>Eliminated</p>
                    <button id="passed_lengend" value="Ongoing Table" aria-label="Select Passsed"></button>
                    <p>Passed</p>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th><p>POSITION</p></th>
                            <th><p>NAME</p></th>
                            <th><p>NATION / CLUB</p></th>
                            <th class="small"></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
                        <?php
                            $competitorsController = new CompetitionController($comp_id);
                            $competitors = $competitorsController->getCompetitors();
                            if(count($competitors) > 0) {
                                $competitors = $competitorsController->sortCompetitorsByRank($competitors);
                                foreach($competitors as $comp) {
                        ?>

                        <tr>
                            <td>
                                <p>
                                    <?php echo $comp->rank . "." ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $comp->fullName ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $comp->nation ?>
                                </p>
                            </td>
                            <td class="small red"></td>
                        </tr>

                    <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="javascript/temporary_ranking.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>