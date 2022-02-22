<?php include "includes/db.php" ?>
<?php session_start();?>
<?php ob_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC Create Competition</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>

<body class="fencers">
    <?php include "includes/header.php"; ?>
    <!-- header -->
    <div class="panel">
        <div id="title_stripe">
            <p class="page_title">Manage Weapon Control Bookings</p>
            <form class="stripe_button_wrapper">
                <button type="button" class="stripe_button" onclick="history.back()">
                    <p>Go back</p>
                    <img src="../assets/icons/close_black.svg"/>
                </button>
                <button class="stripe_button red" onclick="" name="" id="" type="submit" shortcut="SHIFT+D">
                    <p>Disapprove</p>
                    <img src="../assets/icons/how_to_unreg_black.svg"/>
                </button>
                <button class="stripe_button green" onclick="" name="" id="" type="submit" shortcut="SHIFT+A">
                    <p>Approve</p>
                    <img src="../assets/icons/how_to_reg_black.svg"/>
                </button>
                <button class="stripe_button green" onclick="" name="" id="" type="submit" shortcut="SHIFT+A">
                    <p>Approve All</p>
                    <img src="../assets/icons/how_to_reg_black.svg"/>
                </button>
                <input type="text" class="selected_list_item_input" name="" id="" value="">
            </form>
        </div>
        <div id="panel_main">
            <table class="wrapper">
                <thead>
                    <tr>
                        <th>
                            <p>NATION / FENCING CLUB</p>
                        </th>
                        <th>
                            <p>FEDERATION'S EMAIL ADDRESS</p>
                        </th>
                        <th>
                            <p>NUMBER OF FENCERS</p>
                        </th>
                        <th>
                            <p>TIME BOOKED</p>
                        </th>
                        <th class="square"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="selectRow(this)" id="">
                        <td>
                            <p>Hungary</p>
                        </td>
                        <td>
                            <p>hunfencing@hfenc.hu</p>
                        </td>
                        <td>
                            <p>12</p>
                        </td>
                        <td>
                            <p>10:00 - 10:30</p>
                        </td>
                        <td class="square gray"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_2.js"></script>
</body>
</html>