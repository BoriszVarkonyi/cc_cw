<?php include 'includes/db.php'; ?>
<?php include 'includes/username_checker.php'; ?>
<?php
    if (isset($_POST['submit'])) {
        $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
        $url = htmlspecialchars($_POST['url'], ENT_QUOTES);
        $comp_name = htmlspecialchars($_POST['comp_name'], ENT_QUOTES);
        $comp_id = htmlspecialchars($_POST['comp_id'], ENT_QUOTES) ?? null;
        $prev_text = htmlspecialchars($_POST['prev_text'], ENT_QUOTES);

        if ($title != "" && $url != "" && $comp_name != "" && $prev_text != "") {
            $date = date("y-m-d");
            $qry_insert = "INSERT INTO cw_videos (url, title, comp_name, prev, author, comp_id, created) VALUES ('$url', '$title', '$comp_name', '$prev_text', '$username', '$comp_id', '$date')";
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
    <link rel="stylesheet" href="../css/barebone_page_style.min.css">
    <title>Add Video</title>
</head>
<body>
    <p><h1>Add video to videos as <?php echo $username ?></h1><p>
    <div class="basic_panel">
        <form method="POST">
            <label for="url">Youtube link</label>
            <input id="url" name="url" type="text" placeholder="Put your youtube link here!"> <br>
            <label for="title">Video title</label>
            <input id="title" name="title" type="text" placeholder="Put your video title here"><br>
            <label for="comp_name">Competition name</label>
            <input id="comp_name" name="comp_name" type="text" placeholder="Type the name of competition here!"><br>
            <label for="comp_id">Competition id</label>
            <input id="comp_id" name="comp_id" type="text" placeholder="Type the id of the comp here"><br>
            <label for="prev_text">Preview text</label>
            <input id="prev_text" name="prev_text" type="text" placeholder="Type your preview text here!"><br>
            <input name="submit" type="submit" placeholder="Submit">
        </form>
    </div>
</body>
</html>