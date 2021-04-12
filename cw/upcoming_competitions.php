<?php $statusofpage = 2; ?>

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
    <?php include "cw_header.php"; ?>
    <main role="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">Upcoming competitions</p>
            </div>
            <div id="content_wrapper">
            <form method="POST" id="browsing_bar">
                    <!-- search by name box -->
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg"></button>
                    </div>
                    <!-- year drop-down -->
                    <div class="search_wrapper narrow">
                        <input type="text" name="" placeholder="-Year-" class="search select alt" onfocus="isOpen(this)" onblur="isClosed(this)" onkeyup="searchEngine(this)" onfocus="resultChecker(this)">
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg"></button>
                        <div class="search_results">
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
                        <button type="button" class="search select alt" onfocus="isOpen(this)" onblur="isClosed(this)">
                            <input type="text" name="" placeholder="-Sex-">
                        </button>
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg"></button>
                        <div class="search_results">
                            <button type="button" onclick="selectSystem(this)">Male</button>
                            <button type="button" onclick="selectSystem(this)">Female</button>
                        </div>
                    </div>
                    <!-- weapon type drop-down -->
                    <div class="search_wrapper narrow">
                        <button type="button" class="search select alt" onfocus="isOpen(this)" onblur="isClosed(this)">
                            <input type="text" name="" placeholder="-Weapon Type-">
                        </button>
                        <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg"></button>
                        <div class="search_results">
                            <button type="button" onclick="selectSystem(this)">Epee</button>
                            <button type="button" onclick="selectSystem(this)">Foil</button>
                            <button type="button"onclick="selectSystem(this)">Sabre</button>
                        </div>
                    </div>
                    <input name="submit_search" type="submit" value="Search">
                </form>
                <?php include "../cw/comps_display.php" ?>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>