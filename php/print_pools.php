<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php

if(isset($_POST["submit"])){

$host_country = $_POST["host_country"];
$location = $_POST["location"];
$postal = $_POST["postal"];
$entry_fee = $_POST["entry_fee"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$end_pre_reg = $_POST["end_pre_reg"];

$query = "UPDATE competitions SET comp_host = '$host_country', comp_location = '$location', comp_postal = $postal, comp_entry = '$entry_fee', comp_start = '$start_date', comp_end = '$end_date', comp_pre_end = '$end_pre_reg' WHERE comp_id = $comp_id";
$query_do = mysqli_query($connection, $query);

//header("Location: basic_information.php?comp_id=$comp_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Pools</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
    <link rel="stylesheet" href="../css/printpools_style.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Print Pools</p>
                    <button class="stripe_button orange" onclick="printPage()">
                        <p id="save_text">Print All Pools</p>
                        <img src="../assets/icons/print-black-18dp.svg"/>
                    </button>
                </div>
                <div id="page_content_panel_main">
                    <div class="wrapper" id="pool_print_wrapper">
                        <div class="pool_print">
                            <div class="title_container">
                                <div><p class="title">Pools no.: 1</p></div>
                                <div class="pool_info">
                                    <div>
                                        <p class="info_label">PISTE:</p>
                                        <p>Red</p>
                                    </div>
                                    <div>
                                        <p class="info_label">REFEREES:</p>
                                        <p>Ember 1 Jajdejó</p>
                                        <p>Ember 2</p>
                                    </div>
                                    <div>
                                        <p class="info_label">TIME:</p>
                                        <p>14:30</p>
                                    </div>
                                </div>
                                <div class="comp_info">
                                    <p class="info_label">Absolute Fencing Retard 20200 If Else Statement</p>
                                    <div>
                                        <p>WOMEN'S</p>
                                        <p>EPEE</p>
                                    </div>
                                    <p>2020. 04. 29.</p>
                                </div>
                            </div>
                            <div class="pool_content">
                                <div class="pool_matches">

                                    <div class="pool_match">
                                        <div class="number">
                                            <p>1.</p>
                                        </div>
                                        <div class="numbering">
                                            <p>1.</p>
                                            <p>64.</p>
                                        </div>
                                        <div class="names">
                                            <p>Bida Sergey 2 5 5 </p>
                                            <p>Bida Sergey 2 5 5115 </p>
                                        </div>
                                        <div class="grid">
                                            <div><p>0g</p></div>
                                            <div><p>0g</p></div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script>
    function printPage() {
        window.print();
    }
</script>
</html>