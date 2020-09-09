<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

$comp_org = $_COOKIE["org_id"];

$query = "SELECT * FROM fencers_$comp_org WHERE competition = $comp_id";
$query_do = mysqli_query($connection, $query);

if(mysqli_num_rows($query_do) != 0){

    header("Location: ranking.php?comp_id=$comp_id");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Choose Ranking</title>
    <link rel="icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<div id="confirmation" class="hidden">
        <form id="confirmation_form" action="timetable.php?comp_id=<?php echo $comp_id ?>" method="POST">
            <button id="close_button" class="round_button" type="button" onclick="closeConf()">
                <img src="../assets/icons/close-black-18dp.svg" class="round_button_icon">
            </button>
            <p id="remove_warning"></p>
            <p>You cannot withdraw this action!</p>
            <div id="confirmation_button_section">
            <input class="hidden" type="text" id="remove_date" name="remove_date">
                <button onclick="closeConf()" type="button" value="Cancel">Cancel</button>
                <button onclick="" name="sure_delete" type="submit" value="{Action}" class="action">Remove</button>
            </div>
        </form>
    </div>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div class="page_content_panel">
                <div id="title_stripe">
                    <p class="page_title">Choose Ranking creating method <?php print_r($_FILES); print_r($target_file);?></p>
                </div>
                <div id="page_content_panel_main">

                <button class="close_ranking_button hidden" onclick="toggleUploadRankingPanel()" id="close_upload_ranking_panel"></button>
                <button class="close_ranking_button hidden" onclick="toggleCreateRankingPanel()" id="close_create_ranking_panel"></button>


                    <div id="choose_ranking_wrapper">
                        <div id="upload_ranking_panel" onclick="toggleUploadRankingPanel()">
                            <div class="desc_box">
                                <p>Upload Ranking</p>
                                <p>You can upload a ranking from a specific Excel file.</p>
                            </div>
                            <div class="icon_box">
                                <svg>
                                    <circle cx="50%" cy="50%" r="47.5%"/>   
                                </svg>
                                <img src="../assets/icons/cloud_upload-black-18dp.svg" alt="">
                            </div>
                            <div class="title_box">
                                <p>Download <a href="" class="visible_link">scheme</a></p>
                                <p id="upload_panel_title">
                                    Upload Ranking
                                </p>

                                <form action='upload.php?comp_id=<?php echo $comp_id ?>' method="POST" id="upload_excel_form" class="hidden" enctype="multipart/form-data">
                                   <!-- <label for='ranking_excel'>Choose a file</label> -->
                                    <input type='file' name='ranking_excel' id='ranking_excel'/>
                                    <label> or drag it here.</label> </br>
                                    <input type="submit" name="submit" class="" value="Upload">
                                </form>
                            </div>
                        </div>
                    
                        <div id="create_ranking_panel" onclick="toggleCreateRankingPanel()">
                            <div class="desc_box">
                                <p>Create Ranking</p>
                                <p>You can create your own ranking that you can download and use later.</p>
                            </div>
                            <div class="icon_box">
                                <svg>
                                    <circle cx="50%" cy="50%" r="47.5%"/>
                                </svg>
                                <img src="../assets/icons/create-black-18dp.svg" alt="">
                            </div>
                            <div class="title_box">
                                <form action="ranking.php?comp_id=<?php echo $comp_id?>" method="POST">
                                    <p>Placeholder text</p>
                                    <input type="submit" name="create" value="Create Ranking" >
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/choose_ranking.js"></script>
<script src="../js/main.js"></script>
</html>