<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC Create Competition</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body id="illustration_bg">
<?php include "../includes/headerburger.php";?>
<!-- header -->
    <div id="create_competition_panel" class="panel">
        <div id="title_stripe">
            <p class="page_title">Create new Tournament</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button" onclick="location.href='choose_tournament.php'">
                    <p>Cancel</p>
                    <img src="../assets/icons/close-black-18dp.svg"/>
                </button>
                <button type="submit" name="submit" form="" class="stripe_button primary">
                    <p>Create</p>
                    <img src="../assets/icons/add-black-18dp.svg"/>
                </button>
            </div>
        </div>
        <div id="panel_main">
            <form id="" class="column_form_wrapper" action="" method="POST">
                <div class="form_column">
                    <label for="comp_name" >NAME</label>
                    <input type="text" placeholder="Type in the title" class="title_input" name="comp_name" class="name_input">
                </div>
            </form>
        </div>
    </div>
<script src="../js/main.js"></script>
</body>
</html>

