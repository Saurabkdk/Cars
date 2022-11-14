<?php

namespace controllers\entityClass;

class Administrator
{
    public $tableOfCars;

    public $id;
    public $username;
    public $adminAccess;

    //contructor for entity class
    public function __construct(\classes\DatabaseController $tableOfCars)
    {
        $this->tableOfCars = $tableOfCars;
    }

    //function to get one car record
    public function getCarsAdded(){
        return $this->tableOfCars->getOne('admin', $this->id);
    }

}