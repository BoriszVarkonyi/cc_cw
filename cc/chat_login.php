<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Login</title>
    <link rel="stylesheet" href="../css/chat_style.min.css">
</head>
<body class="login">
    <div id="login_wrapper" class="white_glass light">
        <div id="title_stripe" class="white_glass login">
            <p>Login</p>
        </div>
        <form id="login_form">
            <label for="username">USERNAME</label>
            <input type="text" id="username" placeholder="Type in your username">
            <label for="password">PASSWORD</label>
            <input type="password" id="password" placeholder="Type in your password">
            <label for="competiton">COMPETITION</label>
            <div class="search_wrapper">
                <button type="button" class="search" id="dropdown_button" onclick="dropDown()">
                    <input type="text" name="" id="competition" placeholder="Select Competition">
                </button>
                <div class="search_results" id="dropdown_menu">
                    <button type="button" id="1" onclick="selectSystem(this)">cOMP 1 cOMP 1 cOMP 1cOMP 1cOMP 1cOMP 1 cOMP 1</button>
                    <button type="button" id="2" onclick="selectSystem(this)">cOMP 1 cOMP 1 cOMP 1cOMP 1cOMP 1cOMP 1 cOMP 1</button>
                    <button type="button" id="3" onclick="selectSystem(this)">cOMP 1 cOMP 1 cOMP 1cOMP 1cOMP 1cOMP 1 cOMP 1</button>
                    <button type="button" id="4" onclick="selectSystem(this)">cOMP 1 cOMP 1 cOMP 1cOMP 1cOMP 1cOMP 1 cOMP 1</button>
                </div>
            </div>
            <input type="text" id="competition_id" placeholder="Comp id">
            <button type="button" class="login" onclick="location.href='chat.php'">LOGIN</button>
        </form>
    </div>
    <script src="javascript/chat_login.js"></script>
</body>
</html>