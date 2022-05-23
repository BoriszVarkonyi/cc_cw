<?php include "includes/db.php" ?>
<?php include "includes/functions.php" ?>
<?php include "includes/username_checker.php" ?>
<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/barebone_page_style.min.css">
    <title>Select Article to modify</title>
</head>
<body>
    <h1>Select Article to modify:</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody class="alt">
            <?php
            $qry_get_articles = "SELECT id, title, body, author FROM cw_articles";
            $do_get_articles = mysqli_query($connection, $qry_get_articles);

            while ($row = mysqli_fetch_assoc($do_get_articles)) {
                $id = $row['id'];
                $title = $row['title'];
                $body = $row['body'];
                $author = $row['author'];

            ?>
            <!-- ne bánts kristóf nem értem a htmlt :( -->
                <tr onclick="window.location.href='../cw/modify_article.php?article_id=<?php echo $id ?>'">
                    <td>
                        <p><?php echo $title ?></p>
                    </td>
                    <td>
                        <p><?php echo $author ?></p>
                    </td>
                    <td>
                        <img width="100" height="100" src="article_pics/<?php echo $id . '.png' ?>"><img>
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