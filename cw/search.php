<?php
    include "../i18n/i18n.php";
    $i18n = new I18N();
?>
<?php
    if(isset($_GET['type'])) {
        $type = filter_input(INPUT_GET, 'type');
    } else {
        $type = 0;
    }
    if(isset($_GET['q'])) {
        $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
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
    <title><?= $i18n->get('ongoing_competitions') ?></title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
</head>
<body class="ongoing_competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1><?= $i18n->get('ongoing_competitions') ?></h1>
            </div>
            <div id="content_wrapper">
                <?php include "views/SearchForm.php" ?>
                <!-- buttons menu -->
                <div id="competition_color_legend">
                    <button id="registration_lengend" value="Registration Finished" aria-label="Select Registration Finished"></button>
                    <p><?= $i18n->get('registration_finished') ?></p>
                    <button id="pools_lengend" value="Ongoing Pools" aria-label="Select Ongoing Pools"></button>
                    <p><?= $i18n->get('ongoing_pools') ?></p>
                    <button id="table_lengend" value="Ongoing Table" aria-label="Select Ongoing Table"></button>
                    <p><?= $i18n->get('ongoing_tables') ?></p>
                </div>
                <?php include "views/CompDisplay.php" ?>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/ongoing_competitions.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>
