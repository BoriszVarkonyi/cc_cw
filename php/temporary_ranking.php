<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Temporary Ranking</title>
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
            <form id="title_stripe" method="POST" action="">
                <p class="page_title">Temporary Ranking</p>
                <input type="text" class="hidden selected_list_item_input" name="fencer_ids" id="fencer_ids" value="">
            </form>
            <div id="page_content_panel_main">
                <div class="table wrapper first_column_centered">
               <?php
            
               $query = "SELECT * FROM cptrs_$comp_id ORDER BY name";
               $query_do = mysqli_query($connection, $query);
               
               ?>
                <div class="table_header">
                    <div class="table_header_text">TEMPORARY RANK</div>
                    <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)"></button>
                    <div class="table_header_text">NAME</div>
                    <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)"></button>
                    <div class="table_header_text">NATION / CLUB</div>
                </div>
                        <div class="table_row_wrapper">
                        <?php
                        
                        while($row = mysqli_fetch_assoc($query_do)){

                        $name = $row["name"];
                        $nat = $row["nationality"];
                        $id = $row["id"];
                        
                        ?>
                        
                        <div class="table_row" id="<?php echo $id ?>" onclick="selectRow(this)" tabindex="0">
                            <div class="table_item"><p>1.</p></div>
                            <div class="table_item"><p><?php echo $name ?></p></div>
                            <div class="table_item"><p><?php echo $nat ?></p></div>
                        </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/registration.js"></script>
    <script src="../js/controls.js"></script>
</body>
</html>