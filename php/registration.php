<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
        <div id="flexbox_container">
            <?php include "../includes/navbar.php"; ?>
            <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                        <p class="page_title">Registration</p>
                        <button class="stripe_button orange">
                            <p>Add Fencer</p>
                            <img src="../assets/icons/add-black-18dp.svg"></img>
                        </button>
                </div>
                <div id="page_content_panel_main">

                    <div class="wrapper table_row_wrapper">
                    <!--
                            <div id="no_something_panel">
                                <p>You have no referees set up!</p>
                            </div>
               -->     

               <?php
               
               $query = "SELECT * FROM cptrs_$comp_id";
               $query_do = mysqli_query($connection, $query);
               
               
               
               ?>
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">NATIONALITY</div>
                            <div class="table_header_text">STATUS</div>
                            <div class="big_status_header"></div>
                        </div>

                        <?php
                        
                        while($row = mysqli_fetch_assoc($query_do)){

                        $name = $row["name"];
                        $nat = $row["nationality"];
                        $stat = $row["wc"];
                        


                        ?>
                        
                        <div class="table_row">
                            <div class="table_item"><?php echo $name ?></div>
                            <div class="table_item"><?php echo $nat ?></div>
                            <div class="table_item"><?php if($stat == 0){echo "Not registered";}else{echo "Registered";} ?></div>
                            <div class="big_status_item <?php if($stat == 0){echo "red";}else{echo "green";} ?>"></div> <!-- red or green style added to small_status item to inidcate status -->
                        </div>
                        <?php
                        }
                        ?>


                        



                    </div>
                </div>
        </div>
    </div>
<script src="../js/main.js"></script>
</body>
</html>