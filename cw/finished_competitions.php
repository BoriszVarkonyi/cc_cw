<?php $statusofpage = 3; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finished competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="finished_competitions">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">Finished competitions</p>
                </div>
                <form method="POST" id="browsing_bar">
                    <!-- search by name box -->
                    <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
                    <input type="text" name="name" placeholder="Search by Name" class="search">
                    <!-- year drop-down -->
                    <div class="select_input">
                        <button type="button" onclick="toggleDropdown(this)">
                            <p>-Year-</p>
                            <input name="year" type="text" value="">
                        </button>
                        <div id="year_select_dropdown" class="closed">
                            <button type="button" onclick="selectSystem(this)">2020</button>
                            <button type="button" onclick="selectSystem(this)">2019</button>
                            <button type="button" onclick="selectSystem(this)">2018</button>
                            <button type="button" onclick="selectSystem(this)">2017</button>
                            <button type="button" onclick="selectSystem(this)">2016</button>
                            <button type="button" onclick="selectSystem(this)">2015</button>
                        </div>
                    </div>
                    <!-- sex drop-down -->
                    <div class="select_input">
                        <button type="button" onclick="toggleDropdown(this)">
                            <p>-Sex-</p>
                            <input name="sex" type="text" value="">
                        </button>
                        <div id="sex_select_dropdown" class="closed">
                            <button type="button" onclick="selectSystem(this)">Male</button>
                            <button type="button" onclick="selectSystem(this)">Female</button>
                        </div>
                    </div>
                    <!-- weapon type drop-down -->
                    <div class="select_input">
                        <button type="button" onclick="toggleDropdown(this)">
                            <p>-Weapon Type-</p>
                            <input name="wt" type="text" value="">
                        </button>
                        <div id="wt_select_dropdown" class="closed">
                            <button type="button" onclick="selectSystem(this)">Epee</button>
                            <button type="button" onclick="selectSystem(this)">Foil</button>
                            <button type="button" onclick="selectSystem(this)">Sabre</button>
                        </div>
                    </div>
                    <input name="submit_search" type="submit" value="Search">
                </form>
                <?php include "../cw/comps_display.php" ?>
            </div>
        </div>
        </div>
        <?php include "cw_footer.php"; ?>
        </div>
    </div>
<script src="../js/cw_main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/competitions.js"></script>
</body>
</html>