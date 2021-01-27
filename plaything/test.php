<?php

$table_of = 8;

for ($num_of_groups = 1; pow(2, $num_of_groups) < $table_of/2; $num_of_groups++);

echo $num_of_groups;
echo "<br>";
$array_group_additions = [];

for ($i = 0; $i < $num_of_groups; $i++) {
    if ($i == 0) {
        $num_to_push = $table_of;
        array_push($array_group_additions, $num_to_push);
    } else {
        $num_to_push = $num_to_push - pow(2, $i);
        array_push($array_group_additions, $num_to_push);
    }
}

print_r($array_group_additions);

$array_of_pos = [];
//first and 3rd
$last_pos = $array_group_additions[count($array_group_additions) - 1] - 1;
$array_of_pos['1'] = 1;
$array_of_pos['3'] = $last_pos;

//5th and 7th
$five_pos = $array_group_additions[count($array_group_additions) - 2] - $array_of_pos['3'];

$seven_pos = $array_group_additions[count($array_group_additions) - 2] - $array_of_pos['1'];

$array_of_pos["5"] = $five_pos;
$array_of_pos['7'] = $seven_pos;

$addition_counter = count($array_group_additions) - 1;
for ($group_num = 2; $group_num <= $table_of/2; $group_num*=2) {
    $addition_counter--;

    for () {
        
    }

}




//get 2nd fencers
for ($i = 2; $i <= $table_of; $i+=2) {
    $array_of_pos[$i] = 9 - $array_of_pos[$i-1];
}

ksort($array_of_pos);










echo "<br>";
print_r($array_of_pos);

?>
