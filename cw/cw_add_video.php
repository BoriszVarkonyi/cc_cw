<?php include '../includes/db.php'; ?>
<?php include '../includes/cw_username_checker.php'; ?>
<?php

    //create table
    $qry_table = "CREATE TABLE `ccdatabase`.`cw_videos` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `URL` VARCHAR(255) NOT NULL , `title` VARCHAR(255) NOT NULL , `comp_name` VARCHAR(255) NOT NULL , `prev` TEXT NOT NULL , `author` VARCHAR(255) NOT NULL , `Last_modified_by` VARCHAR(255) NOT NULL , `Date_of_creation` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `Last_modified` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_table = mysqli_query($connection, $qry_table);
    echo mysqli_error($connection);


    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $url = $_POST['URL'];
        $comp_name = $_POST['comp_name'];
        $prev_text = $_POST['prev_text'];
        if ($title != "" && $url != "" && $comp_name != "" && $prev_text != "") {
            $qry_insert = "INSERT INTO cw_videos (URL, title, comp_name, prev, author) VALUES ('$url', '$title', '$comp_name', '$prev_text', '$username')";
            $do_insert = mysqli_query($connection, $qry_insert);
            echo mysqli_error($connection);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><h1>Add video to videos as <?php echo $username ?></h1><p>
    <form method="POST">
        <input name="URL" type="text" placeholder="Put your youtube link here!"> <br>
        <input name="title" type="text" placeholder="Put your video title here"><br>
        <input name="comp_name" type="text" placeholder="Type the name of competition here!"><br>
        <input name="prev_text" type="text" placeholder="Type your previes text here!"><br>
        <input name="submit" type="submit" placeholder="Submit">
    </form>
</body>
</html>