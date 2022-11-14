<?php

//requiring the controller file
require "/websites/cars/controllers/controller/Administrators.php";

//creating a class that extends the TestCase class
class AdministratorsTest extends \PHPUnit\Framework\TestCase
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
        $tableOfCars = new \classes\DatabaseController($dbConnection, 'cars', 'id');

        //creating an object of the DatabaseController to access the table administrators
        $tableOfAdministrators = new \classes\DatabaseController($dbConnection, 'administrators', 'id', '\controllers\entityClass\Administrator', [$tableOfCars]);

        //store all the tables
        $tables = $tableOfAdministrators;

        //return all the tables
        return $tables;
    }

    //function to test if all the records are listed
    public function testAdministratorInventory(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Admininstrators = new \controllers\controller\Administrators($tableOfAdministrators, [], []);

        //get the result of the function
        $parinam = $Admininstrators->inventory();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'administratorsList.html.php');

    }

    //function to test the record insert
    public function testAdministratorInsert(){
        //data to insert
        $insertTest = [
            'administrator' => [
                'username' => 'Land Rover',
                'password' => 'ok'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Admininstrators = new \controllers\controller\Administrators($tableOfAdministrators, [], $insertTest);

        //get the result of the function
        $parinam = $Admininstrators->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record update
    public function testAdministratorUpdate(){
        //data to insert with id
        $insertTest = [
            'administrator' => [
                'id' => 4,
                'username' => 'Land Rover',
                'password' => 'ok'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Admininstrators = new \controllers\controller\Administrators($tableOfAdministrators, [], $insertTest);

        //get the result of the function
        $parinam = $Admininstrators->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test a record delete
    public function testAdministratorDelete(){
        //id to delete
        $id = [
            'id' => 8
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Admininstrators = new \controllers\controller\Administrators($tableOfAdministrators, $id, []);

        //get the result of the function
        $parinam = $Admininstrators->deleteFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the form page for update
    public function testAdministratorForm(){
        $id = [
            'id' => 10
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Admininstrators = new \controllers\controller\Administrators($tableOfAdministrators, $id, []);

        //get the result of the function
        $parinam = $Admininstrators->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'addAdministrator.html.php');

    }

    //function to test the form page for insert
    public function testAdministratorFormAgain(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Admininstrators = new \controllers\controller\Administrators($tableOfAdministrators, [], []);

        //get the result of the function
        $parinam = $Admininstrators->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'addAdministrator.html.php');

    }

    //function to test to get one record
    public function testOneAdministrator(){
        //id of record to be fetched
        $id = [
            'id' => 10
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Admininstrators = new \controllers\controller\Administrators($tableOfAdministrators, $id, []);

        //get the result of the function
        $parinam = $Admininstrators->admin();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'individualAdmin.html.php');
    }

}