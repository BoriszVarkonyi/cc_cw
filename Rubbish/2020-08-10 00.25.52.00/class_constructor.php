<?php

class Car {

    var $wheels = 10;
    var $hood = 1;
    var $engine = 1;
    var $doors = 4;

    function MoveWheels(){

      $this->doors = 6;


    }

}

$bmw = new Car();

class Plane extends Car {

    var $wheels = 20;

}


?>