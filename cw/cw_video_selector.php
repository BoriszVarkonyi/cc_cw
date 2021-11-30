<?php include '../includes/db.php'; ?>
<?php include '../includes/cw_username_checker.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Video to modify</title>
</head>
<body>
    <h1>Select Video to modify:</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
        </tr>
        <?php
            $qry_get_data = "SELECT title, author FROM cw_videos";
            $do_get_data = mysqli_query($connection, $qry_get_data);

            while ($row = mysqli_fetch_assoc($do_get_data)) {
                $title = $row['title'];
                $author = $row['author'];
        ?>
        <tr>
            <td>
                <a href="../cw/cw_modify_video.php?title=<?php echo $title ?>"><?php echo $title ?></a>
            </td>
            <td>
                <p><?php echo $author ?></p>
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
    <a href="admin.php">go back</a>
</body>
</html>