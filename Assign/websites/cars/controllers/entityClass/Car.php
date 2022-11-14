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

    //constructor for class
    public function __construct(\classes\DatabaseController  $tableOfManufacturers, \classes\DatabaseController $tableOfCarDescs, \classes\DatabaseController $tableOfImages){
        $this->tableOfManufacturers = $tableOfManufacturers;
        $this->tableOfCarDescs = $tableOfCarDescs;
        $this->tableOfImages = $tableOfImages;
    }

    //function to get manufacturer name
    public function getManufacturerName(){
        return $this->tableOfManufacturers->getOne('id', $this->manufacturerId);
    }

    //function to get all manufacturers
    public function getAllManufacturers(){
        return $this->tableOfManufacturers->getAll();
    }

    //function to get one car description
    public function getCarDescription(){
        return $this->tableOfCarDescs->getOne('id', $this->id);
    }

    //function to get car images
    public function getCarImages(){
        return $this->tableOfImages->getOne('id', $this->id);
    }

}