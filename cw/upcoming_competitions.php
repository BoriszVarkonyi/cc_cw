<?php include "../includes/cw_fav_button_list.php" ?>
<?php $statusofpage = 2; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upcoming competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="upcoming_competitions">
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">Upcoming competitions</p>
            </div>
            <div id="content_wrapper">
                <form method="POST" id="browsing_bar">
                    <!-- search by name box -->
                    <div class="search_wrapper">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                    </div>
                    <!-- year drop-down -->
                    <div class="select_input dense">
                        <input type="number" name="year" placeholder="-Year-" onkeyup="selectSystemWithSearch(this, event)" tabindex="2">
                        <div class="closed">
                            <?php
                            for ($i = -1; $i <= 10; $i++) {

                                $year = date("Y") - $i;

                                ?><button type="button" onclick="selectSystem(this)"><?php echo $year ?></button><?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- sex drop-down -->
                    <div class="select_input">
                        <input type="text" name="sex" placeholder="-Sex-" onkeyup="selectSystemWithSearch(this)" tabindex="3">
                        <div>
                            <button type="button" onclick="selectSystem(this)">Male</button>
                            <button type="button" onclick="selectSystem(this)">Female</button>
                        </div>
                    </div>
                    <!-- weapon type drop-down -->
                    <div class="select_input">
                        <input type="text" name="wt" placeholder="-Weapon type-" onkeyup="selectSystemWithSearch(this)" tabindex="4">
                        <div>
                            <button type="button" onclick="selectSystem(this)">Epee</button>
                            <button type="button" onclick="selectSystem(this)">Foil</button>
                            <button type="button" onclick="selectSystem(this)">Sabre</button>
                        </div>
                    </div>
                    <input name="submit_search" type="submit" value="Search" tabindex="5">
                </form>
                <?php include "../cw/comps_display.php" ?>
            </div>
        </div>
    </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
</body>
</html>