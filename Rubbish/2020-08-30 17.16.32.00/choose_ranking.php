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
                                <p>Use existing Ranking</p>
                                <p>You can choose a ranking from our database.</p>
                            </div>
                            <div id="ranking_search" class="closed">
                                <form>
                                    <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
                                    <input type="search" name="" id="" placeholder="Search by name">
                                    <input type="button" name="" id="" value="Search">

                                </form>
                                <div>
                                    <div class="table_row">
                                        <div class="table_item">Név</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Név</div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item">Név</div>
                                    </div>
                                </div>
                            </div>
                            <div class="icon_box">
                                <svg>
                                    <circle cx="50%" cy="50%" r="47.5%"/>   
                                </svg>
                                <img src="../assets/icons/cloud_download-black-18dp.svg" alt="">
                            </div>
                            <div class="title_box">
                                <p id="upload_panel_title">
                                    Use existing Ranking
                                </p>
                                <button value="Choose Ranking" id="choose_ranking_button" onclick="chooseRankingSearch()">Choose Ranking</button>
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