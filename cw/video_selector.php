<?php include "db.php"; ?>
<?php include 'includes/username_checker.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_barebone_page_style.min.css">
    <title>Select Video to modify</title>
</head>
<body>
    <h1>Select Video to modify:</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
            </tr>
        </thead>
        <tbody class="alt">
            <?php
                $qry_get_data = "SELECT title, author FROM cw_videos";
                $do_get_data = mysqli_query($connection, $qry_get_data);

                while ($row = mysqli_fetch_assoc($do_get_data)) {
                    $title = $row['title'];
                    $author = $row['author'];
            ?>
            <tr onclick="window.location.href='../cw/modify_video.php?title=<?php echo $title ?>'">
                <td>
                    <p><?php echo $title ?></p>
                </td>
                <td>
                    <p><?php echo $author ?></p>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <a href="admin.php">Go back</a>
</body>
</html>