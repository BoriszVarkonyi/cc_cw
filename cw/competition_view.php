<?php include "cw_header.php"; ?>
<?php include "../includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CompetitionView</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>

    <!-- slideshow top -->
    <div id="slideshow">
        <div id="slide_nav">
            <button class="active" id="first_button" onclick="toggleFirst()"></button>
            <button id="second_button" onclick="toggleSecond()"></button>
            <button id="third_button" onclick="toggleThird()"></button>
            <button id="fourth_button" onclick="toggleForth()"></button>
        </div>
        <!-- slide1 -->
        <div class="slide">
            <p>Check Competitions</p>
            <button>Competitions</button>
            <img src="../assets/img/fencers_bg.svg" alt="">
        </div>

        <!-- slide2 -->
        <div class="slide hidden">
            <p>Check Results</p>
            <button>Finished Competitions</button>
            <img src="../assets/img/fencers_bg.svg" alt="">
        </div>

        <!-- slide3 -->
        <div class="slide hidden">
            <p>Watch Competitions Live</p>
            <button>Ongoing Competitions</button>
            <img src="../assets/img/fencers_bg.svg" alt="">
        </div>
        
        <!-- slide4 -->
        <div class="slide hidden">
            <p>Watch Videos</p>
            <button>Videos</button>
            <img src="../assets/img/fencers_bg.svg" alt="">
        </div>
    </div>



    <div id="cw_main">

        <!-- ongoing competitions panel (left) (placeholder)  -->
        <div id="ongoing_competitions_panel">
            <p class="cw_panel_title">Ongoing Competitions</p>
            <div class="cw_table_wrapper">
            <?php
                //query comp_status = 3 (comps with ongoing comp_status orederd by comp_start)
                $qry = "SELECT * FROM competitions WHERE comp_status = 3 ORDER BY comp_start DESC";
                $qry_do = mysqli_query($connection, $qry);


                //displays row in the table with parameters
                while ($row = mysqli_fetch_assoc($qry_do)) {
                    $comp_name =  $row['comp_name'];

                    //displays the compnames in a table with href button (live)
                    ?>
                    <div class="table_row">
                        <!-- comp_name displayed -->
                        <div class="table_item">
                            <?php echo $comp_name ?>
                        </div>
                        <!-- live button href -->
                        <div class="table_item live">
                            <a href="">Live</a>
                        </div>
                        <div class="big_status_item">
                            <button class="favourite_button">
                                <img src="../assets/icons/star_border-black-18dp.svg" alt="">
                            </button>
                        </div>
                    </div>

                    <?php
                }
                    ?>
            </div>
        </div>

        <!-- latest videos (right) (placeholder)  -->
        <div id="latest_videos_panel">
            <p class="cw_panel_title">Latest Videos</p>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>

            <div class="video_wrapper">
                <img src="../assets/img/fencers_bg.svg" alt="">
                <div>
                    <p>Title</p>
                    <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                </div>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>