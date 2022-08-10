<?php include "../includes/db.php"; ?>
<?php include '../includes/username_checker.php'; ?>

<?php
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $date = date("Y/m/d");

    $qry_get_data = "SELECT * FROM cw_videos WHERE id = $id";
    $do_get_data = mysqli_query($connection, $qry_get_data);

    if ($row = mysqli_fetch_assoc($do_get_data)) {
        $url = $row['url'];
        $title = $row['title'];
        $comp_name = $row['comp_name'];
        $comp_id = $row['comp_id'];
        $prev_text = $row['prev'];
        $author = $row['author'];
    }

    if (isset($_POST['submit'])) {
        $title_new = htmlspecialchars($_POST['title'], ENT_QUOTES);
        $url = htmlspecialchars($_POST['url'], ENT_QUOTES);
        $comp_name = htmlspecialchars($_POST['comp_name'], ENT_QUOTES);
        $comp_id = filter_input(INPUT_POST, 'comp_id', FILTER_VALIDATE_INT) ?? null;
        $prev_text = htmlspecialchars($_POST['prev_text'], ENT_QUOTES);

        $qry_update = "UPDATE cw_videos
            SET comp_name = '$comp_name', comp_id = '$comp_id', title = '$title_new', prev = '$prev_text', url = '$url'
            WHERE id = '$id'";
        $do_update = mysqli_query($connection, $qry_update);

        echo mysqli_error($connection);
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/basestyle.min.css">
    <link rel="stylesheet" href="../../css/barebone_page_style.min.css">
    <title>Modify '<?php echo $title ?>'</title>
</head>
<body>
    <div class="basic_panel">
        <h1>Edit your video entry</h1>
        <form method="POST">
            <label for="url">Youtube link</label>
            <input id="url" name="url" type="text" placeholder="Put your youtube link here!" value="<?php echo $url ?>"><br>
            <label for="title">Video title</label>
            <input id="title" name="title" type="text" placeholder="Put your video title here" value="<?php echo $title ?>"><br>
            <label for="comp_name">Competition name</label>
            <input id="comp_name" name="comp_name" type="text" placeholder="Type the name of competition here!" value="<?php echo $comp_name ?>"><br>
            <label for="comp_id">Competition id</label>
            <input id="comp_id" name="comp_id" type="text" placeholder="Type the id of the comp here" value="<?php echo $comp_id ?>"><br>
            <label for="prev_text">Preview text</label>
            <input id="prev_text" name="prev_text" type="text" placeholder="Type your preview text here!" value="<?php echo $prev_text ?>"><br>
            <input name="submit" type="submit" value="Submit">
        </from>
        <button>
            <a href="select.php">Go back</a>
        </button>
    </div>
</body>
</html>
