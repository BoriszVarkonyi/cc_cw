<?php

class Car {

    public $wheels = 4;
    protected $hood = 1;
    private $engine = 1;
    var $doors = 4;

    function CreateDoors(){

      $this->doors = 6;


    }

}

$bmw = new Car();
$truck = new Car();

echo $bmw->wheels . "<br>";

echo $truck->wheels = 10 . "<br>";
$truck->CreateDoors();
echo $truck->doors;

?>