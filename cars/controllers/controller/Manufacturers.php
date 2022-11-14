<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for manufacturers
class Manufacturers
{
    //initialzing the private variables
    private $tableOfManufacturers;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfManufacturers)
    {
        //providing values to the class variables
        $this->tableOfManufacturers = $tableOfManufacturers;
    }

    //function to return list all the records for the page
    public function inventory(){
        //getting all the records
        $manufacturers = $this->tableOfManufacturers->getAll();

        //getting one particular record
        $inventory = $this->tableOfManufacturers->getOne('id', $_GET['id']);

        //return the template name and records
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