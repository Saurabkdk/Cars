<?php

//requiring the controller file
require "/websites/cars/controllers/controller/AdminManufacturers.php";

//creating a class that extends the TestCase class
class AdminManufacturersTest extends \PHPUnit\Framework\TestCase
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
    public function testManufacturerInventory(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfManufacturers = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\AdminManufacturers($tableOfManufacturers, [], []);

        //get the result of the function
        $parinam = $AdminManufacturers->inventory();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminManufacturerList.html.php');

    }

    //function to test the record insert
    public function testManufacturerInsert(){
        //data to insert
        $insertTest = [
            'manufacturer' => [
                'name' => 'Land Rover'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfManufacturers = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\AdminManufacturers($tableOfManufacturers, [], $insertTest);

        //get the result of the function
        $parinam = $AdminManufacturers->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record update
    public function testManufacturerUpdate(){
        //data to insert with id
        $insertTest = [
            'manufacturer' => [
                'id' => '8',
                'name' => 'Land Rover'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfManufacturers = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\AdminManufacturers($tableOfManufacturers, [], $insertTest);

        //get the result of the function
        $parinam = $AdminManufacturers->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test a record delete
    public function testManufacturerDelete(){
        //id to delete
        $id = [
            'id' => 8
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfManufacturers = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\AdminManufacturers($tableOfManufacturers, $id, []);

        //get the result of the function
        $parinam = $AdminManufacturers->deleteFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the form page for update
    public function testManufacturerForm(){
        $id = [
            'id' => 10
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfManufacturers = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\AdminManufacturers($tableOfManufacturers, $id, []);

        //get the result of the function
        $parinam = $AdminManufacturers->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminAddManufacturer.html.php');

    }

    //function to test the form page for insert
    public function testManufacturerFormAgain(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfManufacturers = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\AdminManufacturers($tableOfManufacturers, [], []);

        //get the result of the function
        $parinam = $AdminManufacturers->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminAddManufacturer.html.php');

    }

}