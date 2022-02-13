<?php $statusofpage = 4; ?>

<?php
    if(isset($_GET['q'])) {
        $q = filter_input(INPUT_GET, 'q');
    }
    if(isset($_GET['year'])) {
        $yearInput = filter_input(INPUT_GET, 'year');
    }
    if(isset($_GET['sex'])) {
        $sex = filter_input(INPUT_GET, 'sex');
    }
    if(isset($_GET['weapon'])) {
        $weapon = filter_input(INPUT_GET, 'weapon');
    }
?>

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
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>Finished competitions</h1>
            </div>
            <div id="content_wrapper">
            <?php include "views/SearchForm.php" ?>
            <?php include "../cw/comps_display.php" ?>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/competitions.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>