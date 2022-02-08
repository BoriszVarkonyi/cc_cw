<?php ob_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "../includes/username_checker.php"; ?>

<?php

    $role = $_SESSION['role'];

    if ($role == "organisers") {
        $qry_get_data = "SELECT * FROM organisers WHERE username = '$username'";
        $do_get_data = mysqli_query($connection, $qry_get_data);

        if ($row = mysqli_fetch_assoc($do_get_data)) {
            $id = $row['id'];
        }

        //profile pic if not set by user
        $profile_pic = "../assets/icons/profile_picture.svg";

        //test for uploaded profil pic
        if (file_exists("../profile_pics/$id.png")) {
            $profile_pic = "../profile_pics/$id.png";
        }

        $needed_profile_pic = TRUE;
    } else {
        $needed_profile_pic = FALSE;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your profile</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body class="fencers">

    <?php include "../includes/headerburger.php" ?>

    <div class="panel">
        <div id="title_stripe">
            <p class="page_title">Your profile</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button bold" onclick="closePage()" shortcut="SHIFT+C">
                    <p>Close Page</p>
                    <img src="../assets/icons/close_black.svg"/>
                </button>
                <form id="fileToUpload" action="../profile_pics/uploads.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                    <button name="submit" class="stripe_button primary" type="submit" shortcut="SHIFT+S">
                        <p>Save Profile</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </form>
            </div>
        </div>
        <div id="panel_main">
            <div class="form_wrapper">
                <div>
                    <div>
                        <label for="name">USERNAME</label>
                        <p><?php echo $username ?></p>
                    </div>
                    <div>
                        <label for="name">PASSWORD</label>
                        <p>{password}</p>
                    </div>
                    <div>
                        <label for="name">EMAIL ADDRESS</label>
                        <p>{your email address}</p>
                    </div>
                </div>
                <div>
                    <?php if ($needed_profile_pic) { ?>
                    <div class="separate_column">
                        <label for="name">PROFILE PICTURE</label>
                        <div class="profile_picture_wrapper">
                            <img src="<?php echo $profile_pic ?>"  class="profile_picture not_icon">
                            <div>
                                <label for="file" class="file_label">Upload File (max. 0.5MB)</label>
                                <input form="fileToUpload" type="file" name="fileToUpload" id="file">
                                <p id="file_text">File name</p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script src="javascript/cookie_monster.js"></script>
<script src="javascript/main.js"></script>
    <script src="javascript/your_profile.js"></script>
</body>
</html>