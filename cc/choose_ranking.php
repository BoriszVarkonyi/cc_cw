<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
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

//Existing ranking használata

if(isset($_POST["valid_ranking"])){

    $hidden_rk_id = $_POST["ranking_id"];
    $user_written_pass = $_POST["ranking_password"];

    $query = "SELECT * FROM ranking WHERE id = $hidden_rk_id";
    $query_do = mysqli_query($connection, $query);

    if($row = mysqli_fetch_assoc($query_do)){

        $rk_pass = $row["password"];

    }
    if($user_written_pass == $rk_pass){

        $query_add_rk_comp = "UPDATE competitions SET comp_ranking_id = $hidden_rk_id WHERE comp_id = $comp_id";
        $query_add_rk_comp_do = mysqli_query($connection, $query_add_rk_comp);

        $query_rk_change_ass = "UPDATE ranking SET ass_comp_id = $comp_id WHERE id = $hidden_rk_id";
        $query_rk_change_ass_do = mysqli_query($connection, $query_rk_change_ass);

        header("Location: ranking.php?comp_id=$comp_id&rankid=$hidden_rk_id");

    }

}


//new ranking létrehozás
if(isset($_POST["submit"]) ){

    $name = $_POST["ranking_name"];
    $pass = $_POST["ranking_password"];

    $num_of_rows_samename = "SELECT * FROM ranking WHERE name = '$name' ";


    //check for duplicate names
    if ($result = mysqli_query($connection, $num_of_rows_samename)) {

        /* determine number of rows result set */
        $row_cnt = mysqli_num_rows($result);
    }

    if ($row_cnt == 0) {

        $create_table = "INSERT INTO `ranking`(`id`, `name`, `password`, `ass_comp_id`) VALUES (NULL,'$name','$pass',$comp_id)";
        $create_table_do = mysqli_query($connection, $create_table);

        if($create_table){

            echo "minden fasza";

        } else {
            echo mysqli_error($connection);
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
    } else {
        //output when there is a ranking with the same name
    }
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
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Choose Ranking Creating Method</p>
            </div>
            <div id="page_content_panel_main">
                <div id="choose_ranking_wrapper">
                    <div id="upload_ranking_panel" onclick="toggleUploadRankingPanel()">
                        <button class="panel_button" onclick="toggleUploadRankingPanel()">
                            <img src="../assets/icons/close_black.svg">
                        </button>
                        <div class="desc_box">
                            <p>Use existing Ranking</p>
                            <p>You can choose a ranking from our database.</p>
                        </div>
                        <div id="ranking_search" class="closed">
                            <div>
                                <form id="browse_ranking">
                                    <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
                                    <input type="text" name="" placeholder="Search by Title" class="search">
                                    <input type="button" name="" value="Search">
                                </form>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <p>NAME</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $select_ranking_rows = "SELECT * FROM ranking WHERE ass_comp_id = 0";
                                    $select_ranking_rows_do = mysqli_query($connection, $select_ranking_rows);

                                    while($row = mysqli_fetch_assoc($select_ranking_rows_do)){

                                        $ranking_name = $row['name'];
                                        $ranking_id = $row['id'];

                                    ?>

                                        <tr>
                                            <td id="<?php echo $ranking_id ?>" onclick="selectRanking(this)">
                                                <p><?php echo $ranking_name ?></p>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                    </tbody>
                                </table>
                                <form>
                                    <input type="button" value="Use Ranking" onclick="getName()">
                                </form>
                            </div>
                            <div id="use_this_ranking" class="hidden">
                                <button class="panel_button" onclick="cancelName()">
                                    <img src="../assets/icons/close_black.svg">
                                </button>
                                <p id="ranking_name">Ranking name</p>
                                <form name="ranking_password" method="POST" action="" id="use_this_ranking_form" autocomplete="off">
                                <input id="ranking_id_hidden" type="text" class="hidden" name="ranking_id">
                                    <label for="ranking_name">PASSWORD</label>
                                    <input id="ranking_password_input" type="password" name="ranking_password">
                                    <input type="submit" name="valid_ranking" value="Use this Ranking">
                                </form>
                            </div>
                        </div>
                        <div class="icon_box">
                            <svg>
                                <circle cx="50%" cy="50%" r="47.5%"/>
                            </svg>
                            <img src="../assets/icons/cloud_download_black.svg">
                        </div>
                        <div class="title_box">
                            <button value="Choose Ranking" id="choose_ranking_button" onclick="chooseRankingSearch()">Choose Ranking</button>
                        </div>
                    </div>

                    <div id="create_ranking_panel" onclick="toggleCreateRankingPanel()">
                        <button class="panel_button" onclick="toggleCreateRankingPanel()">
                            <img src="../assets/icons/close_black.svg">
                        </button>
                        <div class="desc_box">
                            <p>Create Ranking</p>
                            <p>You can create your own ranking to use for this competition.</p>
                        </div>
                        <form name="submit" method="POST" id="ranking_create" class="closed" autocomplete="off">
                            <label for="ranking_name">NAME OF THE RANKING</label>
                            <input type="text" name="ranking_name">
                            <label for="ranking_name">PASSWORD</label>
                            <input type="password" name="ranking_password">
                            <input type="submit" name="submit" value="Create Ranking" class="ranking_creation_button">
                        </form>
                        <div class="icon_box">
                            <svg>
                                <circle cx="50%" cy="50%" r="47.5%"/>
                            </svg>
                            <img src="../assets/icons/create_black.svg">
                        </div>
                        <div class="title_box">
                            <button type="button" value="Create Ranking" onclick="chooseRankingCreate()">Create Ranking</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
<script src="javascript/choose_ranking.js"></script>
<script src="javascript/cookie_monster.js"></script>
<script src="javascript/main.js"></script>
<script src="javascript/list.js"></script>
</html>