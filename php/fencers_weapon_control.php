<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fencer's name weapon control</title>
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
                    <p class="page_title">{Fencer's name}'s weapon control</p>
                    <button class="stripe_button" type="submit">
                        <p>Cancel</p>
                        <img src="../assets/icons/close-black-18dp.svg"></img>
                    </button>
                    <button class="stripe_button orange" type="submit" form="fencers_weapon_control_wrapper" onclick="location.href='weapon_control.php?comp_id=<?php echo $comp_id ?>'">
                        <p>Save weapon control</p>
                        <img src="../assets/icons/save-black-18dp.svg"></img>
                    </button>
                </div>
                <div id="page_content_panel_main">
                    <form action="" id="fencers_weapon_control_wrapper" class="wrapper">
                        <div id="issues_panel">
                            <div class="table_header">
                                <div class="table_header_text">ISSUE</div>
                                <div class="table_header_text">QUANTITY</div>
                                <div class="big_status_header"></div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_1" value=""/>
                                    <label for="issue_1"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">arm gap and weight</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">arm length</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            
                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            <div class="table_row">
                                <div class="table_item">FIE mark on blade</div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_1" id="issue_2" value=""/>
                                    <label for="issue_2"></label>
                                </div>
                            </div>

                            

                        </div>
                        <div id="notes_panel">
                            <div class="table_header">
                                <div class="table_header_text title">NOTES</div>
                            </div>
                            <textarea name="" id="wc_notes" placeholder="Type the notes here"></textarea>
                        </div>
                    </form>
                </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>