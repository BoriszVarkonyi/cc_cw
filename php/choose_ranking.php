<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

$comp_org = $_COOKIE["org_id"];


$assigned_to_ranking = "SELECT * FROM ranking WHERE ass_comp_id = $comp_id";
$assigned_to_ranking_do = mysqli_query($connection, $assigned_to_ranking);

$to_get = "SELECT * FROM competitions WHERE comp_id = $comp_id";
$to_get_do = mysqli_query($connection, $to_get);

if($row = mysqli_fetch_assoc($to_get_do)){

    $toranking = $row["comp_ranking_id"];
}


if(mysqli_num_rows($assigned_to_ranking_do) == 0){
echo "NINCS HOZZÁRENDELVE";
}
elseif(mysqli_num_rows($assigned_to_ranking_do) == 1){
    echo "HOZZÁ VAN RENDELVE";

    header("Location: ranking.php?comp_id=$comp_id&rankid=$toranking");
}

//new ranking létrehozás
if(isset($_POST["submit"])){

    $name = $_POST["ranking_name"];
    $pass = $_POST["ranking_password"];


    $create_table = "INSERT INTO `ranking`(`id`, `name`, `password`, `ass_comp_id`) VALUES (NULL,'$name','$pass',$comp_id)";
    $create_table_do = mysqli_query($connection, $create_table);

    if(!$create_table){

        echo "HIBA";

    }


    $get_id = "SELECT MAX(id) FROM ranking";
    $get_id_do = mysqli_query($connection, $get_id);

    if($row = mysqli_fetch_assoc($get_id_do)){

    $maxid = $row["MAX(id)"];

    }

    echo $maxid;

    $update_id = "UPDATE competitions SET comp_ranking_id = $maxid WHERE comp_id = $comp_id";
    $update_id_do = mysqli_query($connection, $update_id);

    header("Location: ranking.php?comp_id=$comp_id&rankid=$maxid");


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
                <div id="title_stripe">
                    <p class="page_title">Choose Ranking creating method</p>
                </div>
                <div id="page_content_panel_main">

                
            


                    <div id="choose_ranking_wrapper">


                        <div id="upload_ranking_panel" onclick="toggleUploadRankingPanel()">

                            <button class="close_ranking_button hidden" id="close_upload_ranking_panel">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>
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
                                    <?php

                                        $select_ranking_rows = "SELECT * FROM ranking";
                                        $select_ranking_rows_do = mysqli_query($connection, $select_ranking_rows);

                                        while($row = mysqli_fetch_assoc($select_ranking_rows_do)){
                                            
                                            $ranking_name = $row['name'];

                                    ?>


                                            <div class="table_row">
                                                <div class="table_item"><?php echo $ranking_name ?></div>
                                            </div>

                                    <?php } ?>

                                </div> <!--From * SELECT table name LIKE sadsadas -->
                                <form action="">
                                    <input type="text" class="hidden"> <!-- IF storing the seleted ranking in text form-->
                                    <input type="submit" value="Use Ranking">
                                </form>
                                <div id="use_this_ranking">
                                    <p class="ranking_name">Ranking name</p>
                                    <form name="submit" method="POST" action="" id="use_this_ranking_form">
                                        <label for="ranking_name" class="label_text">PASSWORD</label>
                                        <input type="password" name="ranking_password">
                                        <input type="submit" name="submit" value="Use Ranking">
                                    </form>
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
                            <button class="close_ranking_button hidden" id="close_create_ranking_panel">
                                <img src="../assets/icons/close-black-18dp.svg" alt="">
                            </button>
                            <div class="desc_box">
                                <p>Create Ranking</p>
                                <p>You can create your own ranking that you can download and use later.</p>
                            </div>
                            <div id="ranking_create" class="closed">
                                <form name="submit" method="POST" action="">
                                    <label for="ranking_name" class="label_text">NAME OF THE RANKING</label>
                                    <input type="text" name="ranking_name">
                                    <label for="ranking_name" class="label_text">PASSWORD</label>
                                    <input type="password" name="ranking_password">
                                    <input type="submit" name="submit" value="Create Ranking">
                                </form>
                            </div>
                            <div class="icon_box">
                                <svg>
                                    <circle cx="50%" cy="50%" r="47.5%"/>
                                </svg>
                                <img src="../assets/icons/create-black-18dp.svg" alt="">
                            </div>
                            <div class="title_box">
                                <p>Placeholder text</p>
                                <button type="button" value="Create Ranking" onclick="chooseRankingCreate()">Create Ranking</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </body>
<script src="../js/choose_ranking.js"></script>
<script src="../js/main.js"></script>
</html>