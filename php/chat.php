<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/chat_style.min.css">
</head>
<body class="preload">
    <div id="header" class="white_glass to_r">
        <p id="app_name">CC CHAT APLHA</p>
        <div id="indentity_wrapper" class="white_glass base">
            <img src="../assets/icons/profile_picture.svg" alt="Your profile picture" width="30px" height="30px">
            <div>
                <p id="name">Name</p>
                <p id="role">Role</p>
            </div>
        </div>
    </div>
    <div id="content_wrapper">
        <div id="nav_bar" class="white_glass base">
            <div id="nav_bar_selector">
                <button class="selected">individuals</button>
                <button>Groups</button>
            </div>
            <div id="nav_bar_main">
                <div class="chat_entry" x-chat-type="individual">
                    <img src="../assets/icons/profile_picture.svg" alt="Chat's image">
                    <div>
                        <p>Chat name</p>
                        <p>If new message</p>
                    </div>
                </div>
                <div class="chat_entry" x-chat-type="individual">
                    <img src="../assets/icons/profile_picture.svg" alt="Chat's image">
                    <div>
                        <p>Chat name</p>
                    </div>
                </div>
                <div class="chat_entry" x-chat-type="individual">
                    <img src="../assets/icons/profile_picture.svg" alt="Chat's image">
                    <div>
                        <p>Chat name</p>
                    </div>
                </div>
                <div class="chat_entry current" x-chat-type="individual">
                    <img src="../assets/icons/profile_picture.svg" alt="Chat's image">
                    <div>
                        <p>Chat name</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="white_glass content">
            <div id="content_inner">
                <div id="title_stripe" class="white_glass light">
                    <p>Chat room name</p>
                    <div id="stripe_button_wrapper">
                        <button  class="white_glass base">
                            <img src="../assets/icons/volume_off-black-18dp.svg" alt="Mute button image">
                        </button>
                    </div>
                </div>
                <div id="content_main" class="white_glass light">


                </div>
            </div>
        </div>
    </div>
</body>
</html>