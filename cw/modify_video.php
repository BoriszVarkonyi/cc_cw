<?php include '../includes/db.php'; ?>
<?php include '../includes/cw_username_checker.php'; ?>

<?php
    $title = $_GET['title'];
    $date = date("Y/m/d");

    $qry_get_data = "SELECT * FROM cw_videos WHERE title = '$title'";
    $do_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $url = $row['URL'];
        $author = $row['author'];
        $prev_text = $row['prev'];
        $comp_name = $row['comp_name'];
        $title = $row['title'];
    }

    if (isset($_POST['submit'])) {
        $title_new = $_POST['title'];
        $url = $_POST['url'];
        $comp_name = $_POST['comp_name'];
        $prev_text = $_POST['prev_text'];

        $qry_update = "UPDATE cw_videos SET comp_name = '$comp_name', title = '$title_new', prev = '$prev_text', URL = '$url',  Last_modified_by = '$username', Last_modified = '$date' WHERE title = '$title'";
        $do_update = mysqli_query($connection, $qry_update);

        echo mysqli_error($connection) . "asd";
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_barebone_page_style.min.css">
    <title>Document</title>
</head>
<body>
    <div class="basic_panel">
        <h1>Edit your video entry</h1>
        <form method="POST">
            <input name="url" type="text" value="<?php echo $url ?>"> <br>
            <input name="title" type="text" value="<?php echo $title ?>"><br>
            <input name="comp_name" type="text" value="<?php echo $comp_name ?>"><br>
            <input name="prev_text" type="text" value="<?php echo $prev_text ?>"><br>
            <input name="submit" type="submit" value="submit">
        </from>
        <button>
            <a href="video_selector.php">Go back</a>
        </button>
    </div>
</body>
</html>
