<?php include "cw_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sheduled Competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <p class="cw_panel_title">COMPETITORS OF {COMP NAME}</p>
        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="search" name="" id="" placeholder="Search by Fencer">

            <div class="select_input">
                <button type="button" onclick="toggleYearSelect()">
                    <p>-Date of Birth-</p>
                    <input type="text" value="">
                </button>
                <div id="year_select_dropdown" class="closed">
                    <button type="button">2020</button>
                    <button type="button">2019</button>
                    <button type="button">2018</button>
                    <button type="button">2017</button>
                    <button type="button">2016</button>
                    <button type="button">2015</button>
                </div>
            </div>

            <div class="select_input">
                <button type="button" onclick="toggleSexSelect()">
                    <p>-Sex-</p>
                    <input type="text" value="">
                </button>
                <div id="sex_select_dropdown" class="closed">
                    <button type="button">Male</button>
                    <button type="button">Female</button>
                </div>
            </div>

            <div class="select_input">
                <button type="button" onclick="toggleWTSelect()">
                    <p>-Weapon Type-</p>
                    <input type="text" value="">
                </button>
                <div id="wt_select_dropdown" class="closed">
                    <button type="button">Epee</button>
                    <button type="button">Foil</button>
                    <button type="button">Sabre</button>
                </div>
            </div>

        


            <input type="submit" value="Search">
        </form>

        <div class="cw_table_wrapper competitions">
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
            </div>
            <div class="table_row" onclick="window.location.href='cw_competition.php'">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
            </div>
            <div class="table_row">
                <div class="table_item">
                    Landesmeisterschaft Mecklenburg-Vorpommern
                </div>
                <div class="table_item">
                    22 / 08 / 2020 - 30 / 08 / 2020
                </div>
                <div class="table_item">
                    Hungary
                </div>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/competitions.js"></script>
</html>