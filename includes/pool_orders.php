<?php

function poolOrder($fencersin){


if($fencersin == 3){

    return $order = ["1-2","2-3","1-3"];

}
if($fencersin == 4){

    return $order = ["1-4","2-3","1-3","2-4","3-4","1-2"];
    
}
if($fencersin == 5){

    return $order = ["1-2","3-4","1-5","2-3","4-5","1-3","2-5","1-4","3-5","2-4"];
        
}
if($fencersin == 6){

    return $order = ["1-2","3-4","5-6","1-3","2-6","4-5","1-6","3-5","2-4","1-5","4-6","2-3","1-4","2-5","3-6"];
        
}
if($fencersin == 7){

    return $order = ["1-4","2-5","3-6","1-7","4-5","2-3","6-7","1-5","3-4","2-6","5-7","1-3","4-6","2-7","3-5","1-6","2-4","3-7","5-6","1-2","4-7"];
        
}
}

// $order = poolOrder(5);
// print_r($order);
?>