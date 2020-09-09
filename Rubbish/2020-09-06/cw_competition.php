<?php include "cw_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp's name}</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <p class="cw_panel_title">{Comp's name}</p>
        <p id="comp_status">{STATUS}</p>
        <div id="comp_data">
            <p>FEMALE</p>
            <p>EPEE</p>
            <p>2020</p>
        </div>
        <div id="competition_wrapper">
            <div>
                <div id="basic_information_panel">
                    <div>
                        <p class="data_label">HOST COUNTRY:</p>
                        <p>{Country}</p>
                        <p class="data_label">LOCATION AND ADDRESS:</p>
                        <p>{City},</p>
                        <p>{Address}</p>
                        <p>{Zip Code}</p>
                        <p class="data_label">ENTRY-FEE:</p>
                        <p>{Entry Fee}</p>
                    </div>
                    <div>
                        <p class="data_label">STARTING DATE:</p>
                        <p>{Starting Date}</p>
                        <p class="data_label">ENDING DATE:</p>
                        <p>{Ending Date}</p>
                        <p class="data_label pre_reg">END OF PRE-REGISTRTATION:</p>
                        <p>{Pre-Reg Ending Date}</p>
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

                <div id="additional_panel">
                    <p class="data_label panel_title">ADDITIONAL INFORMATION</p>
                    <div>
                        <p>{Text}{Text}{Text}{Text}{Text}{Text}{Text}{Text}{Text}{Text}{Text}</p>
                    </div>
                </div>

                <div id="weapon_control_panel">
                    <p class="data_label panel_title">WEAPON CONTROL</p>
                    <div>
                        <div class="weapon_control_day">
                            <p>{Weapon Control Date}</p>
                            <a>Book appointment</a>
                        </div>

                        <div class="weapon_control_day">
                            <p>{Weapon Control Date}</p>
                            <a>Book appointment</a>
                        </div>
                    </div>
                </div>

            </div>
        
            <div>
                <a href="cw_pre_registration.php" class="disabled">Pre-Register</a>
                <a href="">Competitors</a>
                <a href="">Pools</a>
                <a href="">Temporary Ranking</a>
                <a href="">Table</a>
                <a href="">Final Results</a>

                <a href="">Watch Video / Watch Live</a>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>