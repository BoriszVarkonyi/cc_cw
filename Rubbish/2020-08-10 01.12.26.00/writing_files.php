<?php

$file = "example.txt";

if($handle = fopen($file, 'w')) {

fclose($handle);

} else {

echo "The application was not able to write on the file";

}




fclose($handle);




?>