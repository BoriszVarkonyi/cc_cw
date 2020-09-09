<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

function calculation(){

$number1 = 20;
$number2 = 50;

$sum = $number1 + $number2;

return $sum;


}

$theSum = calculation();

echo $theSum . "<br>";


function Hello($hola){

echo $hola;


}

Hello('Hey is that english?');
?>


</body>
</html>