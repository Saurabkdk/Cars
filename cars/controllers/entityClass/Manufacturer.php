<?php

namespace controllers\entityClass;

class Manufacturer
{
    public $tableOfCars;
    public $tableOfCarDescs;
    public $tableOfImages;

    public $id;
    public $manufacturer;

    public function __construct(\classes\DatabaseController $tableOfCars, \classes\DatabaseController $tableOfCarDescs, \classes\DatabaseController $tableOfCarImages)
    {
        $this->tableOfCars = $tableOfCars;
        $this->tableOfCarDescs = $tableOfCarDescs;
        $this->tableOfImages = $tableOfCarImages;
    }

    public function getManufacturerCar(){
        return $this->tableOfCars->getOne('manufacturerId', $this->id);
    }

    public function getCarDescription($id){
        return $this->tableOfCarDescs->getOne('id', $id);
    }

    public function getCarImages($id){
        return $this->tableOfImages->getOne('id', $id);
    }

}