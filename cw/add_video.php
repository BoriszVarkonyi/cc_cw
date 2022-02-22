<?php include 'includes/db.php'; ?>
<?php include 'includes/username_checker.php'; ?>
<?php


    //create table
    $qry_table = "CREATE TABLE `ccdatabase`.`cw_videos` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `URL` VARCHAR(255) NOT NULL , `title` VARCHAR(255) NOT NULL , `comp_name` VARCHAR(255) NOT NULL , `prev` TEXT NOT NULL , `author` VARCHAR(255) NOT NULL , `Last_modified_by` VARCHAR(255) NOT NULL , `Date_of_creation` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `Last_modified` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_table = mysqli_query($connection, $qry_table);
    echo mysqli_error($connection);


    if (isset($_POST['submit'])) {
        $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
        $url = htmlspecialchars($_POST['url'], ENT_QUOTES);
        $comp_name = htmlspecialchars($_POST['comp_name'], ENT_QUOTES);
        $prev_text = htmlspecialchars($_POST['prev_text'], ENT_QUOTES);

        if ($title != "" && $url != "" && $comp_name != "" && $prev_text != "") {
            $date = date("y-m-d");
            $qry_insert = "INSERT INTO cw_videos (URL, title, comp_name, prev, author, Last_modified_by, Date_of_creation) VALUES ('$url', '$title', '$comp_name', '$prev_text', '$username', '$username', '$date')";
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
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_barebone_page_style.min.css">
    <title>Add Video</title>
</head>
<body>
    <p><h1>Add video to videos as <?php echo $username ?></h1><p>
    <div class="basic_panel">
        <form method="POST">
            <input name="url" type="text" placeholder="Put your youtube link here!"> <br>
            <input name="title" type="text" placeholder="Put your video title here"><br>
            <input name="comp_name" type="text" placeholder="Type the name of competition here!"><br>
            <input name="prev_text" type="text" placeholder="Type your previes text here!"><br>
            <input name="submit" type="submit" placeholder="Submit">
        </form>
    </div>
</body>
</html>