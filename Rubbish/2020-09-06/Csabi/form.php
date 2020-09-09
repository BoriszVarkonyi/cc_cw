<?php

if(isset($_POST['submit'])){
    $name = array("Csaba", "Student", "Peter", "James", "Tom", "Jane");
    $minimum = 5;
    $maximum = 10;

$username = $_POST['username'];
$password = $_POST['password'];

}

if(strlen($username) < $minimum){

    echo "Username has to be longer than five characters.";

}

if(strlen($username) > $maximum){

    echo "Username cannot be longer than ten characters.";


//echo "Hello " . $username;
//echo "Your Password is " . $password;

}

if(!in_array($username, $name)){

echo "Sorry you are not allowed";

} else {

echo "Welcome.";

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<form action="form.php" method="post">

    <input type="text" name="username" placeholder="Enter Username"><br>
    <input type="password" name="password" placeholder="Enter Passowrd">
    <br>
    <input type="submit" name="submit">



</form>

</body>
</html>