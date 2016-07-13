<?php

/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 08.07.2016
 * Time: 19:41
 */
class dbConnect
{
    private $param = array();
    private $fields = array();
    private $connectToBase;

    public function close(){
        echo 'Close succesfull';
        return mysqli_close($this->connectToBase);
    }

    public function selectQuery(array $fields){
        $query = "SELECT {$fields[0]} FROM {$fields[1]}";
        $result = mysqli_query($this->connectToBase, $query);
        $row = mysqli_fetch_array($result);
        return $row;
    }

    public function connection($host, $user, $pass, $db){
        $this->connectToBase = mysqli_connect($host, $user, $pass, $db);
        return $this->connectToBase;
    }

    public function __construct(array $param){
        foreach ($param as $key => $value){
            $this->param[$key] = $value;
        }
        $this->connection($param[0],$param[1],$param[2],$param[3]);
    }
}