<?php include "cw_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pre-Register for {Comp's name}</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <p class="cw_panel_title">PRE-REGISTER FENCERS FOR </p>

        <form id="competition_wrapper">
            <div>
                <div id="basic_information_panel">
                    <div>
                        <p class="data_label">FEDERATION'S NAME:</p>
                        <input type="text" name="" id="">
                        <p class="data_label">COUNTRY / FENCING CLUB:</p>
                        <input type="text" name="" id="">
                        <p class="data_label">FEDERATION'S OFFICAL EMAIL ADDRESS:</p>
                        <input type="email" name="" id="">
                        <p class="data_label">FEDERATION'S PHONE NUMBER:</p>
                        <input type="number" name="" id="" class="number_input no_web">
                    </div>
                    <div>
                        <p class="data_label">CONTACT KEEPER'S FULL NAME:</p>
                        <input type="text" name="" id="">
                        <p class="data_label">CONTACT KEEPER'S EMAIL ADDRESS:</p>
                        <input type="email" name="" id="">
                        <p class="data_label">CONTACT KEEPER'S PHONE NUMBER:</p>
                        <input type="number" name="" id="" class="number_input no_web">
                    </div>
                </div>

                <div id="equipment_panel">
                    <p class="data_label panel_title">EQUIPMENT NEEDED TO BE CHECKED</p>
                    <div>
                        <div class="table_row">
                            <div class="table_item">Epee</div>
                            <div class="table_item">max. 5</div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Jacket</div>
                            <div class="table_item">max. 1</div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div>
                <input type="submit" value="Send Pre-Registration">
            </div>
        </form>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>