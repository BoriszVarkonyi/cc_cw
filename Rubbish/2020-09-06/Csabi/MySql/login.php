<?php

if(isset($_POST['submit'])){

$username = $_POST['username'];
$password = $_POST['password'];

$connection = mysqli_connect('localhost', 'root', '', 'loginapp');

if($connection) {

echo "We are connected.";

} else {

die("Database connection failed.");

}
    


//echo $username;
//echo $password;

}



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<div class="container">

<div class="col-xs-6">
    <form action="login.php" method="post">
        <div class="form-group">
        <label for="username">Username</label>
            <input type="text" name="username" class="form-control">
        </div>

        <div class="form-group">
        <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
            </form-control">
        </div>

        <input type="submit" name="submit" value="Submit">

    </form>
</div>

</div>

</body>
</html>