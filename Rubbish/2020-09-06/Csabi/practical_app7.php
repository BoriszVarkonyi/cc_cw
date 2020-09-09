<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

if(isset($_GET['source'])){

    echo $_GET['source'];

}


?>


<a href="practical_app7.php?source=30134">CLICK HERE</a>
<br>
<?php
session_start();

$_SESSION['message'] = "Hy guys";

if(isset($_COOKIE["TheName"])) {

    echo $_COOKIE["TheName"];

}

if(isset($_SESSION['message'])){

echo $_SESSION['message']."<br>";

}

?>



<?php

$expiration = time() + (60*60*24*7);

setcookie('TheName','This is the Value', '$expiration')



?>


</body>
</html>