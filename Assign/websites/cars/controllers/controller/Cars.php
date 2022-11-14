<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for cars
class Cars
{
    //initialzing the private variables
    private $tableOfCars;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfCars)
    {
        //providing values to the class variables
        $this->tableOfCars = $tableOfCars;
    }

    //function to return list all the records for the page
    public function inventory(){
        //getting all the records
        $inventory = $this->tableOfCars->getAll();

        //return the template name and records
        return [
            'pageTemplate' => 'carsList.html.php',
            'titleOfThePage' => 'Our Cars',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    public function career(){
        $career = "Claire’s Cars currently has no job opportunities available, but keep checking as new positions become available regularly!";
        return [
            'pageTemplate'=>'clairesCareer.html.php',
            'titleOfThePage'=>'Career',
            'key'=>[
                'career'=>$career
            ]
        ];
    }

}