<?php

//requiring the controller file
require "/websites/cars/controllers/controller/Manufacturers.php";

//creating a class that extends the TestCase class
class ManufacturersTest extends \PHPUnit\Framework\TestCase
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

        //store all the tables
        $tables = $tableOfManufacturers;

        //return all the tables
        return $tables;
    }

    //function to test if all the records are listed
    public function testManufacturersInventory(){
        $id = [
            'id' => 25
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfManufacturers = $tables;

        //creating an object of the controller Cars
        $Manufacturers = new \controllers\controller\Manufacturers($tableOfManufacturers, $id, []);

        //get the result of the function
        $parinam = $Manufacturers->inventory();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'manufacturerCar.html.php');

    }

}