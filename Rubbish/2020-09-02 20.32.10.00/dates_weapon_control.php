<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

$controlon = $_GET["date"] . "_" . $comp_id;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $controlon ?>'s weapon control</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title"><?php echo $controlon ?>'s weapon control</p>
                </div>
                <div id="page_content_panel_main">
                    <div id="dates_weapon_control_wrapper">




                        <?php
                        
                        $query = "SELECT * FROM `wc_2020-08-20_52` LIMIT 500";
                        $query_do = mysqli_query($connection, $query);

                        $rowsave = "";

                        while($row = mysqli_fetch_assoc($query_do)){

                            if($rowsave != $row["hour"]){
                                
                                $rowsave = $row["hour"];
                                
                                ?>

                                <div class="period" id="period_1" onclick="togglePeriodPanel(this)">
                            <div>
                                <p><?php echo $row["hour"] . ":00" . " - " . $row["hour"] . ":59" ?></p>
                                <p>25 / 4</p>
                            </div>
                            <div class="gray">
                                <p>25 / 4</p>
                            </div>
                            <div>
                                <div>



                                    <div class="selected">
                                        <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>


                                        <?php

                                        $ora = $row["hour"];

                                        $query = "SELECT * FROM `wc_2020-08-20_52` WHERE hour = $ora LIMIT 500";
                                        $query_do = mysqli_query($connection, $query);
                                                                                
                                        for ($i=$ora; $i < $ora + 7 ; $i++) { ?>
                                            
                                            

                                            <div id='<?php echo $row["hour"] . "_" . $i?>'>
                                                    <p>10:00 - 10:10</p>
                                                        <p>8 / 1</p>
                                                </div>


                                            <?php
                                        }
                                        
                                        ?>

                                                


                                                    <div>
                                                    <p>10:00 - 10:10</p>
                                                        <p>8 / 1</p>
                                                    </div>
                                                    <div>
                                                    <p>10:00 - 10:10</p>
                                                        <p>8 / 1</p>
                                                    </div>
                                                    <div>
                                                    <p>10:00 - 10:10</p>
                                                        <p>8 / 1</p>
                                                    </div>
                                                    <div>
                                                    <p>10:00 - 10:10</p>
                                                        <p>8 / 1</p>
                                                    </div>
                                                    <div>
                                                    <p>10:00 - 10:10</p>
                                                        <p>8 / 1</p>
                                                    </div>
                                </div>
                                <div>
                                    <button type="button">
                                        <img src="../assets/icons/person_add_alt_1-black-18dp.svg" alt="">
                                    </button>
                                    <button type="button">
                                        <img src="../assets/icons/person_remove-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div id="">
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
 
                                </div>
                            </div>
                        </div>


<?php
                            }


                        }
                        
                        ?>

                        











                       <!-- <div class="period" id="period_2" onclick="togglePeriodPanel(this)">
                            <div>
                                <p>11:25 - 23:14</p>
                                <p>25 / 4</p>
                            </div>
                            <div class="gray">
                                <p>25 / 4</p>
                            </div>
                            <div>
                                <div>
                                    <div class="selected">
                                        <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button">
                                        <img src="../assets/icons/person_add_alt_1-black-18dp.svg" alt="">
                                    </button>
                                    <button type="button">
                                        <img src="../assets/icons/person_remove-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                </div>
                            </div>
                        </div>
                        <div class="period" id="period_3" onclick="togglePeriodPanel(this)">
                            <div>
                                <p>11:25 - 23:14</p>
                                <p>25 / 4</p>
                            </div>
                            <div class="gray">
                                <p>25 / 4</p>
                            </div>
                            <div>
                                <div>
                                    <div class="selected">
                                        <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button">
                                        <img src="../assets/icons/person_add_alt_1-black-18dp.svg" alt="">
                                    </button>
                                    <button type="button">
                                        <img src="../assets/icons/person_remove-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                </div>
                            </div>
                        </div>
                        <div class="period" id="period_4" onclick="togglePeriodPanel(this)">
                            <div>
                                <p>11:25 - 23:14</p>
                                <p>25 / 4</p>
                            </div>
                            <div class="gray">
                                <p>25 / 4</p>
                            </div>
                            <div>
                                <div>
                                    <div class="selected">
                                        <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button">
                                        <img src="../assets/icons/person_add_alt_1-black-18dp.svg" alt="">
                                    </button>
                                    <button type="button">
                                        <img src="../assets/icons/person_remove-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                </div>
                            </div>
                        </div>
                        <div class="period" id="period_5" onclick="togglePeriodPanel(this)">
                            <div>
                                <p>11:25 - 23:14</p>
                                <p>25 / 4</p>
                            </div>
                            <div class="gray">
                                <p>25 / 4</p>
                            </div>
                            <div>
                                <div>
                                    <div class="selected">
                                        <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button">
                                        <img src="../assets/icons/person_add_alt_1-black-18dp.svg" alt="">
                                    </button>
                                    <button type="button">
                                        <img src="../assets/icons/person_remove-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                </div>
                            </div>
                        </div>
                        <div class="period" id="period_6" onclick="togglePeriodPanel(this)">
                            <div>
                                <p>11:25 - 23:14</p>
                                <p>25 / 4</p>
                            </div>
                            <div class="gray">
                                <p>25 / 4</p>
                            </div>
                            <div>
                                <div>
                                    <div class="selected">
                                        <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                    <div>
                                    <p>10:00 - 10:10</p>
                                        <p>8 / 1</p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button">
                                        <img src="../assets/icons/person_add_alt_1-black-18dp.svg" alt="">
                                    </button>
                                    <button type="button">
                                        <img src="../assets/icons/person_remove-black-18dp.svg" alt="">
                                    </button>
                                </div>
                                <div>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                    <p>Ember</p>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div> 
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/dates_weapon_control.js"></script>
</html>