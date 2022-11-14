<?php

//requiring the controller file
require "/websites/cars/controllers/controller/Cars.php";

//creating a class that extends the TestCase class
class CarsTest extends \PHPUnit\Framework\TestCase
{
    //function to get the database connection
    public function connection(){
        return new PDO('mysql:dbname=cars;host=mysql', 'student', 'student');
    }

    //function to get the tables
    public function getTables(){
        //get the database connection
        $dbConnection = $this->connection();

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars1 = new \classes\DatabaseController($dbConnection, 'cars', 'id');

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = new \classes\DatabaseController($dbConnection, 'carDesc', 'id');

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = new \classes\DatabaseController($dbConnection, 'images', 'id');

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = new \classes\DatabaseController($dbConnection, 'manufacturers', 'id', '\controllers\entityClass\Manufacturer', [$tableOfCars1, $tableOfCarDescs, $tableOfImages]);

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = new \classes\DatabaseController($dbConnection, 'cars', 'id', '\controllers\entityClass\Car', [$tableOfManufacturers, $tableOfCarDescs, $tableOfImages]);

        //store all the tables
        $tables = $tableOfCars;

        //return all the tables
        return $tables;
    }

    //function to test if all the records are listed
    public function testCarsInventory(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfCars = $tables;

        //creating an object of the controller Cars
        $Cars = new \controllers\controller\Cars($tableOfCars);

        //get the result of the function
        $parinam = $Cars->inventory();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'carsList.html.php');

    }

    //function to test the page for claire career
    public function testClaireCareer(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfCars = $tables;

        //creating an object of the controller Cars
        $Cars = new \controllers\controller\Cars($tableOfCars);

        //get the result of the function
        $parinam = $Cars->career();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'clairesCareer.html.php');

    }

}