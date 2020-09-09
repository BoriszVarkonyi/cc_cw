<?php

$file = "example.txt";

if($handle = fopen($file, 'w')) {

fclose($handle);

} else {

echo "The files could not be written";

}




fclose($handle);




?>