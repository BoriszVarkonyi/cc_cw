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
<body class="home">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="slideshow">
                <p id="slideshow_title">Check Competitions</p>
                <!--
                <div id="text">
                    <div class="perspective-text">
                        <div class="perspective-line">
                            <p></p>
                            <p>Check Competition</p>
                        </div>
                        <div class="perspective-line">
                            <p>Check Competition</p>
                            <p>Is Only</p>
                        </div>
                        <div class="perspective-line">
                            <p>Is Only</p>
                            <p>A Matter Of</p>
                        </div>
                        <div class="perspective-line">
                            <p>A Matter Of</p>
                            <p>Perception</p>
                        </div>
                        <div class="perspective-line">
                            <p>Perception</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                -->
                <div id="sildes">
                    <div id="slide_nav">
                        <button class="slideButtons active" onclick="toggleButton(this)"></button>
                        <button class="slideButtons" onclick="toggleButton(this)"></button>
                        <button class="slideButtons" onclick="toggleButton(this)"></button>
                        <button class="slideButtons" onclick="toggleButton(this)"></button>
                    </div>
                    <!-- slide1 -->
                    <div class="slide">
                        <img src="../assets/img/fencers_bg.svg" >
                    </div>

                    <!-- slide2 -->
                    <div class="slide blurred">
                        <img src="../assets/img/call_room_bg.svg" >
                    </div>

                    <!-- slide3 -->
                    <div class="slide">
                        <img src="../assets/img/fencers_bg.svg" >
                    </div>
                    
                    <!-- slide4 -->
                    <div class="slide">
                        <img src="../assets/img/fencers_bg.svg" >
                    </div>
                </div>
            </div>
            <div id="content">
                <div class="column">
                    <p class="column_title">Ongoing Competitions</p>
                    <div class="cw_table_wrapper table t_c_1">
                        <div class="table_row_wrapper">
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
                                    <p>
                                        <?php echo $comp_name ?>
                                    </p>
                                </div>
                                <!-- live button href -->
                                <div class="table_item live">
                                    <a href="">Live</a>
                                </div>
                                <div class="big_status_item">
                                    <button class="favourite_button">
                                        <img src="../assets/icons/star_border-black-18dp.svg" >
                                    </button>
                                </div>
                            </div>

                            <?php
                        }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- latest videos (right) (placeholder)  -->
                <div class="column">
                    <p class="column_title">Latest Videos</p>

                    <div class="video_wrapper">
                        <img src="../assets/img/fencers_bg.svg" >
                        <div>
                            <p>Title</p>
                            <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                        </div>
                    </div>

                    <div class="video_wrapper">
                        <img src="../assets/img/fencers_bg.svg" >
                        <div>
                            <p>Title</p>
                            <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                        </div>
                    </div>

                    <div class="video_wrapper">
                        <img src="../assets/img/fencers_bg.svg" >
                        <div>
                            <p>Title</p>
                            <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                        </div>
                    </div>

                    <div class="video_wrapper">
                        <img src="../assets/img/fencers_bg.svg" >
                        <div>
                            <p>Title</p>
                            <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                        </div>
                    </div>

                    <div class="video_wrapper">
                        <img src="../assets/img/fencers_bg.svg" >
                        <div>
                            <p>Title</p>
                            <p>Landesmeisterschaft Mecklenburg-Vorpommern</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php include "cw_footer.php"; ?>
        </div>
    </div>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/cw_slideshow.js"></script>
<script src="../js/list.js"></script>
</html>