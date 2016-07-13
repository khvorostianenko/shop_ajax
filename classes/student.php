<?php

/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 08.07.2016
 * Time: 20:45
*/
$arr = array('Nick');
$nickolka = new student();

class student
{
    private $name;
    private $age;
    private $skorostrel;
    private $initial = array();

    public  function __construct(array $initial){
        $this->name = $initial[0];
        $this->age = $initial[1];
        $this->skorostrel = $initial[2];
    }

    public  function ban(){
        $this->skorostrel = 0;
    }

    public function echoName(){
        echo $this->name;
    }


}