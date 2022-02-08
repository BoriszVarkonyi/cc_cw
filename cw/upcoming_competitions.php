<?php $statusofpage = 2; ?>

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
    <title>Upcoming competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="upcoming_competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>Upcoming competitions</h1>
            </div>
            <div id="content_wrapper">
            <form method="GET" id="browsing_bar">
                    <!-- search by name box -->
                    <div class="search_wrapper wide">
                        <input type="text" name="q" placeholder="Search by Title" class="search page alt" value="<?php if(isset($_GET['q'])) echo $q ?>">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                    <!-- year drop-down -->
                    <div class="search_wrapper narrow">
                        <input type="text" name="year" placeholder="-Year-" value="<?php if(isset($_GET['year'])) echo $yearInput?>" class="search select alt" onfocus="isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" onfocus="resultChecker(this)" autocomplete="off">
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                        <div class="search_results">
                            <button type="button" onclick="autoFill(this)" default="default">Every</button>
                            <?php
                                for ($i = -1; $i <= 10; $i++) {

                                    $year = date("Y") - $i;

                                    ?><button type="button" onclick="autoFill(this)"><?php echo $year ?></button><?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- sex drop-down -->
                    <div class="search_wrapper narrow">
                        <button type="button" class="search select alt" onfocus="isOpen(this)" onblur="isClosed(this)" aria-label="Select Sex">
                            <input type="text" name="sex" placeholder="-Sex-" value="<?php if(isset($_GET['sex'])) echo $sex ?>" autocomplete="off">
                        </button>
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                        <div class="search_results">
                            <button type="button" onclick="selectSystem(this)" aria-label="Both">Both</button>
                            <button type="button" onclick="selectSystem(this)" aria-label="Male">Male</button>
                            <button type="button" onclick="selectSystem(this)" aria-label="Female">Female</button>
                        </div>
                    </div>
                    <!-- weapon type drop-down -->
                    <div class="search_wrapper narrow">
                        <button type="button" class="search select alt" onfocus="isOpen(this)" onblur="isClosed(this)" aria-label="Select Weapon Type">
                            <input type="text" name="weapon" placeholder="-Weapon Type-" value="<?php if(isset($_GET['weapon'])) echo $weapon ?>" autocomplete="off">
                        </button>
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                        <div class="search_results">
                            <button type="button" onclick="selectSystem(this)" aria-label="All">All</button>
                            <button type="button" onclick="selectSystem(this)" aria-label="Epee">Epee</button>
                            <button type="button" onclick="selectSystem(this)" aria-label="Foil">Foil</button>
                            <button type="button"onclick="selectSystem(this)" aria-label="Sabre">Sabre</button>
                        </div>
                    </div>
                    <input name="submit_search" type="submit" value="Search">
                </form>
                <?php include "../cw/comps_display.php" ?>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>