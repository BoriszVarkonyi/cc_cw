<?php include "includes/get_comp_data.php"; ?>
<?php include "./controllers/CompetitorController.php" ?>
<?php
    include "../i18n/i18n.php";
    $i18n = new I18N();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s competitors</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
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
                    Competitors of <?php echo $comp_name ?>
                </h1>
            </div>
            <div id="content_wrapper">
                <form method="POST" id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="name" placeholder="Search by Name" class="search page alt">
                        <button type="button"><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>

                    <div class="search_wrapper narrow">
                        <input type="number" name="year" class="search select alt" onfocus="isOpen(this)" onblur="isClosed(this)" placeholder="-Year-Of-Birth-" onkeyup="searchEngine(this)">
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                        <div class="search_results">
                            <?php
                                for ($i = +3; $i <= 100; $i++) {
                                    $year = date("Y") - $i;
                                    ?><button type="button" onclick="autoFill(this)"><?php echo $year ?></button><?php
                                }
                            ?>
                        </div>
                    </div>
                    <input name="submit_search" type="submit" value="Search">
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
                    <?php
                        $competitionController = new CompetitionController($comp_id);
                        $competitors = $competitionController->getCompetitors();

                        include 'views/Competitors.php';
                    ?>
                </table>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/competitions.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>