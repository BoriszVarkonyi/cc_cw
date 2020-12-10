<?php include "cw_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp name}'s final results</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_live">
        <div class="cw_panel_title_wrapper">
            <button type="button" class="back_button" onclick="location.href='cw_table.php'">
                <img  src="../assets/icons/arrow_back_ios-black-18dp.svg"/>
            </button>
            <p>LIVE RESULTS OF {COMP NAME}, {PISTE NUMBER}, {FENCERNAME} VS. {FENCERNAME}</p>
        </div>
        <div id="round_live_wrapper">
            <div id="round_livestream_wrapper">
                <p id="no_livestream" class="hidden">There is no avalible livestream for this round.</p>
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/b68b-E2UwL4?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>










    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/cw_table.js"></script>
</html>