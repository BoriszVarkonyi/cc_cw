<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

    // array of all issues
    $array_issues = array(
        "FIE mark on blade",
        "Arm gap and weight",
        "Arm lenght",
        "Blade lenght",
        "Grip lenght",
        "Form and depthof the guard",
        "Guard oxydation/ deformation",
        "Excentricity of the blade",
        "Blade flexibility",
        "Curve on the blade",
        "Foucault current device",
        "Point and arm size",
        "Spring of the point",
        "Total travel of the point",
        "Residual travel of the point",
        "Isolation of the point",
        "Resistance of the arm",
        "Length / condition of body / mask wire",
        "Resistance of body/ mask wire",
        "Mask: FIE mark",
        "Mask: condition and insulation",
        "Mask: resistance (sabre, foil)",
        "Metallic jacket condition",
        "Metallic jacket resistance",
        "Sabre glove/ overlay condition",
        "Sabre glove/ overlay resistance",
        "Glove condition",
        "Jacket condition",
        "Breeches condition",
        "Under-plastron condition",
        "Foil chest protector",
        "Socks",
        "Incorrect name printing",
        "Incorrect national logo",
        "Commercial",
        "Other items"
    );
    $array_real_issues = array();
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

                    <button name="submit_cancel" id="buttonstop" class="stripe_button" type="submit" onclick="location.href='weapon_control.php?comp_id=<?php echo $comp_id ?>'">
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
                        <div id="issues_panel" class="table_row_wrapper">
                            <div class="table_header">
                                <div class="table_header_text">ISSUE</div>
                                <div class="table_header_text">QUANTITY</div>
                                <div class="big_status_header"></div>
                            </div>

                            <?php 
                                foreach ($array_issues as $issue) {

                                $issue_id = array_search($issue, $array_issues);

                            ?>

                            <div class="table_row">
                                <div class="table_item"><?php echo $issue ?></div>
                                <div class="table_item"><input type="number" placeholder="-"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_<?php echo $issue_id ?>" id="<?php echo $issue_id ?>" value=""/>
                                    <label for="<?php echo $issue_id ?>"></label>
                                </div>
                            </div>

                            <?php 
                                }
                            ?>

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