<?php

namespace controllers\entityClass;

class Administrator
{
    public $tableOfCars;

    public $id;
    public $username;
    public $adminAccess;

    public function __construct(\classes\DatabaseController $tableOfCars)
    {
        $this->tableOfCars = $tableOfCars;
    }

    public function getCarsAdded(){
        return $this->tableOfCars->getOne('admin', $this->id);
    }

}