<?php include '../includes/db.php'; ?>
<?php include '../includes/cw_username_checker.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $qry_get_data = "SELECT * FROM cw_videos";
        $do_get_data = mysqli_query($connection, $qry_get_data);

        while ($row = mysqli_fetch_assoc($do_get_data)) {

            $title = $row['title'];




    ?>

    <a href="../cw/cw_modify_video.php?title=<?php echo $title ?>"><?php echo $title ?></a>


    <?php
        }


    ?>
</body>
</html>