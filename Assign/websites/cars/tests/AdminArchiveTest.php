<?php

require "/websites/cars/controllers/controller/AdminArchive.php";

class AdminArchiveTest extends \PHPUnit\Framework\TestCase
{
    public function connection(){
        return new PDO('mysql:dbname=cars;host=mysql', 'student', 'student');
    }

    public function getTables(){
        $dbConnection = $this->connection();

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = new \classes\DatabaseController($dbConnection, 'cars', 'id');

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = new \classes\DatabaseController($dbConnection, 'carDesc', 'id');

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= new \classes\DatabaseController($dbConnection, 'archive', 'id');

        //return all the tables
        $tables = array($tableOfArchives, $tableOfCars, $tableOfCarDescs);

        //return all the tables
        return $tables;
    }

//function to test if all the records are listed
    public function testArchiveInventory(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfArchives = $tables[0];

        //assign the table to another table variable
        $tableOfCars = $tables[1];

        //assign the table to another table variable
        $tableOfCarDescs = $tables[2];

        //creating object of the controller
        $AdminArchive = new \controllers\controller\AdminArchive($tableOfArchives, $tableOfCars, $tableOfCarDescs, [], []);

        //get the result of the function
        $parinam = $AdminArchive->inventory();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminArchive.html.php');

    }

    //function to test the record insert
    public function testArchiveInsert(){
        //data to insert
        $insertTest = [
            'car' => [
                'name' => 'Buggati',
                'price' => '350000',
                'manufacturerId' => '2',
                'description' => 'Good'
            ],
            'carDesc' => [
                'mileage' => '20',
                'engine' => 'Nitro'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfArchives = $tables[0];

        //assign the table to another table variable
        $tableOfCars = $tables[1];

        //assign the table to another table variable
        $tableOfCarDescs = $tables[2];

        //creating object of the controller
        $AdminArchive = new \controllers\controller\AdminArchive($tableOfArchives, $tableOfCars, $tableOfCarDescs, [], $insertTest);

        //get the result of the function
        $parinam = $AdminArchive->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record update
    public function testArchiveUpdate(){
        //data to insert with id
        $insertTest = [
            'car' => [
                'id' => '45',
                'name' => 'Buggati',
                'price' => '350000',
                'manufacturerId' => '2',
                'description' => 'Good'
            ],
            'carDesc' => [
                'mileage' => '20',
                'engine' => 'Nitro'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfArchives = $tables[0];

        //assign the table to another table variable
        $tableOfCars = $tables[1];

        //assign the table to another table variable
        $tableOfCarDescs = $tables[2];

        //creating object of the controller
        $AdminArchive = new \controllers\controller\AdminArchive($tableOfArchives, $tableOfCars, $tableOfCarDescs, [], $insertTest);

        //get the result of the function
        $parinam = $AdminArchive->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test a record delete
    public function testArchiveDelete(){
        //id to delete
        $id = [
            'id' => 8
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfArchives = $tables[0];

        //assign the table to another table variable
        $tableOfCars = $tables[1];

        //assign the table to another table variable
        $tableOfCarDescs = $tables[2];

        //creating object of the controller
        $AdminArchive = new \controllers\controller\AdminArchive($tableOfArchives, $tableOfCars, $tableOfCarDescs, $id, []);

        //get the result of the function
        $parinam = $AdminArchive->deleteFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to archive a record
    public function testCarArchive(){
        //id of record to be archived
        $id = [
            'id' => 35
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfArchives = $tables[0];

        //assign the table to another table variable
        $tableOfCars = $tables[1];

        //assign the table to another table variable
        $tableOfCarDescs = $tables[2];

        //creating object of the controller
        $AdminArchive = new \controllers\controller\AdminArchive($tableOfArchives, $tableOfCars, $tableOfCarDescs, $id, []);

        //get the result of the function
        $parinam = $AdminArchive->remove();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');
    }

}