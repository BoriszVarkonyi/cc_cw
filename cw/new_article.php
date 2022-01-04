<?php include "db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "../includes/cw_username_checker.php" ?>
<?php

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $time = date("Y/m/d");

    if ($title != "" && $body != "") {

        $target_dir = "../article_pics/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        //Check if the new article is a duplicate
        $qry_test = "SELECT title, body FROM `cw_articles` WHERE `body` = '$body' AND `title` = '$title'";
        $do_test = mysqli_query($connection, $qry_test);

        $row_num = mysqli_num_rows($do_test);

        if ($row_num != FALSE) {
            echo "<p>Sorry, an article with this title already exists!</p>";
            $uploadOk = 0;
        }

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"]) &&  $uploadOk == 1) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }


        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "<p>Sorry, your file is too large.</p>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<p>Sorry, your file was not uploaded.</p>";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $date = new DateTime();
                $date = $date->format("Y-m-d");

                $qry_create_article = "INSERT INTO `cw_articles` VALUES (NULL, '$title', '$body', '$username', '$date', '$date');";
                $do_create_articel = mysqli_query($connection, $qry_create_article);
                if(!$do_create_articel) {
                    echo mysqli_error($connection);
                }

                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

                $qry_get_id = "SELECT `id` FROM `cw_articles` WHERE `title` = '$title'";
                $do_get_id = mysqli_query($connection, $qry_get_id);
                if ($row = mysqli_fetch_assoc($do_get_id)) {
                    $id = $row['id'];
                }

                if (rename("../article_pics/" . $_FILES["fileToUpload"]["name"], "../article_pics/" . $id . ".png")) {
                    echo $_FILES["fileToUpload"]["name"] . " 's name has been changed";

                } else {
                    echo "minden szar ÁÁÁÁÁÁÁÁÁÁÁÁ";
                }
                header("Location: ../cw/admin.php");
            } else {
                echo "<p>Sorry, there was an error uploading your file.</p>";
            }
        }
    }
}

if (isset($_POST['cancel'])) {
    header("Location: ../cw/admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_barebone_page_style.min.css">
    <title>CW Admin</title>
</head>
<body>
    <div class="basic_panel">
        <h1>New article</h1>
        <form action="" id="new_article" method="POST" enctype="multipart/form-data">
        <input name="title" type="text" placeholder="title">
        <textarea name="body" id="body" cols="30" rows="10" placeholder="ARTICLE BODY HERE"></textarea>
        <label>IMAGE</label>
        <input name="fileToUpload" type="file" placeholder="upload file" id="fileToUpload">
        <input type="submit" value="SAVE" name="submit">
        <input type="submit" value="CANCEL" name="cancel">
    </div>
</body>
</html>