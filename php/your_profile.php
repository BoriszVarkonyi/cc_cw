<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your profile</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body id="illustration_bg">

    <?php include "../includes/headerburger.php" ?>

    <div id="your_competitions_panel" class="panel">
        <div id="title_stripe">
            <p class="page_title">Your profile</p>
            <div class="stripe_button_wrapper">
                <button class="stripe_button bold" onclick="closePage()" shortcut="SHIFT+C">
                    <p>Close Page</p>
                    <img src="../assets/icons/close-black-18dp.svg"/>
                </button>
                <button class="stripe_button orange" type="submit" form="profile_form" shortcut="SHIFT+S">
                    <p>Save Profile</p>
                    <img src="../assets/icons/save-black-18dp.svg"/>
                </button>
            </div>
        </div>
        <div id="panel_main">
            <form class="form_wrapper" id="profile_form">
                <div>
                    <label for="name">NAME</label>
                    <p>{your name}</p>
                </div>
                <div>
                    <label for="name">ROLE</label>
                    <p>{role}</p>
                </div>
                <div>
                    <label for="name">EMAIL ADDRESS</label>
                    <p>{your email address}</p>
                </div>
                <div class="separate_column">
                    <label for="name">PROFILE PICTURE</label>
                    <img src="../assets/icons/profile_picture.svg"  class="profile_picture not_icon">
                    <label for="file" class="file_label">Upload File</label>
                    <input type="file" id="file">
                    <p id="fileText">File name</p>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/your_profile.js"></script>
    <script>
        function closePage() {
            close();
        }
    </script>
</body>
</html>