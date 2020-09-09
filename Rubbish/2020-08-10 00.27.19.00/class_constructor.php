<?php

class Car {

    var $wheels = 10;
    var $hood = 1;
    var $engine = 1;
    var $doors = 4;

    function __construct(){

        echo $this->wheels = 10;

    }

}

$bmw = new Car();


?>