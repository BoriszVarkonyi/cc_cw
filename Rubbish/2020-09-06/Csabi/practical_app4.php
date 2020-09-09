<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

echo rand(1,100);

echo "<br>";

$string = "Csabi szereti a tejet.";
$valueLength = strlen($string);
echo $valueLength . "<br>";
$values = ['Csaba',1234,'Borisz',1234, $string];
$found = in_array($string,$values);
if($found) {

echo "Wow we did it together";

} else {

echo "We messed up, we could not find it";
    
}

?>

</body>
</html>