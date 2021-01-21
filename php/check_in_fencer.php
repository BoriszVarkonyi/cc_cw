<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check in {Fencer's name}</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Check in {Fencer's name}</p>
                <div class="stripe_button_wrapper">
                    <button name="" id="" class="stripe_button" shortcut="SHIFT+P">
                        <p>Print Check In</p>
                        <img src="../assets/icons/print-black-18dp.svg"/>
                    </button>
                    <button name="" class="stripe_button orange" type="submit" form="" shortcut="SHIFT+S" onclick="location.href='weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>'">
                        <p>Save Check In</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper">
                    <form action="" id="" method="POST" class="db_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/backpack-black-18dp.svg"/>
                            Contents of fencer's bag
                        </div>
                        <div class="db_panel_main">
                            <div class="table">
                                <div class="table_header">
                                    <div class="table_header_text">ISSUE</div>
                                    <div class="table_header_text">QUANTITY</div>
                                    <div class="big_status_header"></div>
                                </div>
                                <div class="table_row_wrapper alt">
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><input value="" name="" type="number" placeholder="#"></div>
                                        <div class="big_status_item">
                                            <input type="checkbox" name="" id="" value=""/>
                                            <label for=""></label>
                                        </div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><input value="" name="" type="number" placeholder="#"></div>
                                        <div class="big_status_item">
                                            <input type="checkbox" name="" id="" value=""/>
                                            <label for=""></label>
                                        </div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><input value="" name="" type="number" placeholder="#"></div>
                                        <div class="big_status_item">
                                            <input type="checkbox" name="" id="" value=""/>
                                            <label for=""></label>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
</body>
</html>