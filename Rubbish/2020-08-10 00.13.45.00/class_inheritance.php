<?php

class Car {

    var $wheels = 4;
    var $hood = 1;
    var $engine = 1;
    var $doors = 4;

    function CreateDoors(){

      $this->doors = 6;


    }

}

$bmw = new Car();

class Plane extends Car {



}

$jet = new Plane();

echo $jet->wheels;

$jet->wheels

//if(class_exists("Plane")) {

  //echo "It does";

//}


?>