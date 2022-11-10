<?php

namespace controllers\controller;

class Manufacturers
{
    private $tableOfManufacturers;

    public function __construct(\classes\DatabaseController $tableOfManufacturers)
    {
        $this->tableOfManufacturers = $tableOfManufacturers;
    }

    public function inventory(){
        $manufacturers = $this->tableOfManufacturers->getAll();
        $inventory = $this->tableOfManufacturers->getOne('id', $_GET['id']);

        return [
            'pageTemplate' => 'manufacturerCar.html.php',
            'titleOfThePage' => 'Our Cars',
            'key' => [
                'all' => $manufacturers,
                'one' => $inventory
            ]
        ];
    }
}