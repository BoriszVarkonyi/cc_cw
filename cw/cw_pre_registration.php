<?php include "cw_comp_getdata.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pre-Register for <?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <?php include "cw_backbtn_choosecomp.php"; ?>
            <p>PRE-REGISTER FENCERS FOR <?php echo $comp_name ?></p>
        </div>

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

                <div id="select_fencers_panel">
                    <p class="data_label panel_title">SELECT FENCERS FROM THE COMPEITION'S RANKING</p>
                    

                    <div id="selected_fencers_wrapper">
                        <p>Selected fencers:</p>

                        <span>
                            <p>Fencer's Name</p>
                            <button onclick="" type="button">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>
                        </span>

                        <span>
                            <p>Fencer's Name</p>
                            <button onclick="" type="button">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>
                        </span>

                        <span>
                            <p>Fencer's Name</p>
                            <button onclick="" type="button">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>
                        </span>

                        <span>
                            <p>Fencer's Name</p>
                            <button onclick="" type="button">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>
                        </span>

                        <span>
                            <p>Fencer's Name</p>
                            <button onclick="" type="button">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>
                        </span>

                    </div>

                    <div>
                        <div class="table_header">
                            <div class="table_header_text">RANKING</div>
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">DATE OF BIRTH</div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                        </div>
                        <div class="table_row">
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
                            <div class="table_item">Sh</div>
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