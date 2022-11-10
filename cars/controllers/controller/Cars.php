<?php

namespace controllers\controller;

class Cars
{
    private $tableOfCars;

    public function __construct(\classes\DatabaseController $tableOfCars)
    {
        $this->tableOfCars = $tableOfCars;
    }

    public function inventory(){
        $inventory = $this->tableOfCars->getAll();

        return [
            'pageTemplate' => 'carsList.html.php',
            'titleOfThePage' => 'Our Cars',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    public function home(){
        $home = "Welcome to Claire's Cars, Northampton's specialist in classic and import cars.";
        return [
            'pageTemplate'=>'carsHome.html.php',
            'titleOfThePage'=>'Home',
            'key'=>[
                'home'=>$home
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