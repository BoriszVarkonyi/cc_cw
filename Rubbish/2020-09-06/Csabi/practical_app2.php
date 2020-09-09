<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

if(1 < 3){

echo "I love PHP <br>";

} elseif(20 < 10){


echo "this is not a good PHP";

} else {

    echo "this is not a good PHP too.";


}

for($i = 0; $i <= 10; $i++){


echo $i . "<br>";

}

$value = 10;
switch($value){

    case 10:

        echo "this is 10 man";
    break;
    case 16:

        echo "this is it man";
    break;
    case 17:

        echo "this is it man";
    break;
    case 8:

        echo "this is it man";
    break;
    case 14:

        echo "this is it man";
    break;



}


?>


</body>
</html>