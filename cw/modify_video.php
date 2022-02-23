<?php include "includes/db.php"; ?>
<?php include 'includes/username_checker.php'; ?>

<?php
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $date = date("Y/m/d");

    $qry_get_data = "SELECT URL, author, prev, comp_name, title FROM cw_videos WHERE id = $id";
    $do_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $url = $row['URL'];
        $title = $row['title'];
        $comp_name = $row['comp_name'];
        $prev_text = $row['prev'];
        $author = $row['author'];
    }

    if (isset($_POST['submit'])) {
        $title_new = htmlspecialchars($_POST['title'], ENT_QUOTES);
        $url = htmlspecialchars($_POST['url'], ENT_QUOTES);
        $comp_name = htmlspecialchars($_POST['comp_name'], ENT_QUOTES);
        $prev_text = htmlspecialchars($_POST['prev_text'], ENT_QUOTES);

        $qry_update = "UPDATE cw_videos SET comp_name = '$comp_name', title = '$title_new', prev = '$prev_text', URL = '$url',  Last_modified_by = '$username', Last_modified = '$date' WHERE title = '$title'";
        $do_update = mysqli_query($connection, $qry_update);

        echo mysqli_error($connection);
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/barebone_page_style.min.css">
    <title>Modify '<?php echo $title ?>'</title>
</head>
<body>
    <div class="basic_panel">
        <h1>Edit your video entry</h1>
        <form method="POST">
            <input name="url" type="text" placeholder="URL" value="<?php echo $url ?>"> <br>
            <input name="title" type="text" placeholder="Title" value="<?php echo $title ?>"><br>
            <input name="comp_name" type="text" placeholder="Competition's name" value="<?php echo $comp_name ?>"><br>
            <input name="prev_text" type="text" placeholder="Preview text" value="<?php echo $prev_text ?>"><br>
            <input name="submit" type="submit" value="submit">
        </from>
        <button>
            <a href="video_selector.php">Go back</a>
        </button>
    </div>
</body>
</html>
