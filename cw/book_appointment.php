
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Appointment for Weapon Control of {Comp name}</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="competitions">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">
                        <button type="button" class="back_button" onclick="window.history.back();">
                            <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                        </button>
                        Book Appointment for Weapon Control of {Comp name}
                    </p>
                </div>

                <form id="competition_wrapper" method="POST" action="process_pre.php">
                    <p class="column_title centered">Needed Information: (STEP 1 / 2)</p>
                    <div id="needed_information_panel">
                        <div>
                            <p class="data_label">COUNTRY / FENCING CLUB:</p>
                            <input type="text" name="f_country" placeholder="Type in the country's name" class="country_input alt">
                            <p class="data_label">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                            <input type="email" name="f_email" placeholder="Type in the email address" class="email_input alt">
                        </div>
                        <div>
                            <p class="data_label">NUMBER OF FENCERS:</p>
                            <input type="number" name="c_phone"  class="number_input centered alt" placeholder="#">
                        </div>
                    </div>
                    <p class="column_title centered">SELECT AND BOOK APPOINTMENT: (STEP 2 / 2)</p>
                    <div id="select_fencers_panel">
                    <div>
                        <p>Available Weapon Control Appointments:</p>
                    </div>
                    </div>
                    <div class="send_pre_reg_panel">
                        <input type="button" onclick="openConf()" value="Book Appointment" class="send_pre_reg_button">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
<script src="../js/cw_main.js"></script>
</body>
</html>