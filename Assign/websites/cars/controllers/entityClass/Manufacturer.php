<?php

namespace controllers\entityClass;

class Manufacturer
{
    public $tableOfCars;
    public $tableOfCarDescs;
    public $tableOfImages;

    public $id;
    public $manufacturer;

    //constructor of class
    public function __construct(\classes\DatabaseController $tableOfCars, \classes\DatabaseController $tableOfCarDescs, \classes\DatabaseController $tableOfCarImages)
    {
        $this->tableOfCars = $tableOfCars;
        $this->tableOfCarDescs = $tableOfCarDescs;
        $this->tableOfImages = $tableOfCarImages;
    }

    //function to get one manufacturer
    public function getManufacturerCar(){
        return $this->tableOfCars->getOne('manufacturerId', $this->id);
    }

    //function to get one car description
    public function getCarDescription($id){
        return $this->tableOfCarDescs->getOne('id', $id);
    }

    //function to get one car images
    public function getCarImages($id){
        return $this->tableOfImages->getOne('id', $id);
    }

}