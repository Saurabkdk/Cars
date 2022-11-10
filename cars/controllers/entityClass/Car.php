<?php

namespace controllers\entityClass;

class Car
{
    public $tableOfManufacturers;
    public $tableOfCarDescs;
    public $tableOfImages;

    public $id;
    public $name;
    public $price;
    public $manufacturerId;
    public $description;

    public function __construct(\classes\DatabaseController  $tableOfManufacturers, \classes\DatabaseController $tableOfCarDescs, \classes\DatabaseController $tableOfImages){
        $this->tableOfManufacturers = $tableOfManufacturers;
        $this->tableOfCarDescs = $tableOfCarDescs;
        $this->tableOfImages = $tableOfImages;
    }

    public function getManufacturerName(){
        return $this->tableOfManufacturers->getOne('id', $this->manufacturerId)[0];
    }

    public function getAllManufacturers(){
        return $this->tableOfManufacturers->getAll();
    }

    public function getCarDescription(){
        return $this->tableOfCarDescs->getOne('id', $this->id);
    }

    public function getCarImages(){
        return $this->tableOfImages->getOne('id', $this->id);
    }

}