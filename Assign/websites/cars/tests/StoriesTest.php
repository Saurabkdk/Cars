<?php

//requiring the controller file
require "/websites/cars/controllers/controller/Stories.php";

//creating a class that extends the TestCase class
class StoriesTest extends \PHPUnit\Framework\TestCase
{
    //function to get the database connection
    public function connection(){
        return new PDO('mysql:dbname=cars;host=mysql', 'student', 'student');
    }

    //function to get the tables
    public function getTables(){
        //get the database connection
        $dbConnection = $this->connection();

        //creating an object of the DatabaseController to access the table stories
        $tableOfStories = new \classes\DatabaseController($dbConnection, 'stories', 'id');

        //store all the tables
        $tables = $tableOfStories;

        //return all the tables
        return $tables;
    }

    //function to test if all the records are listed
    public function testStoriesInventory(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfStories = $tables;

        //creating object of the controller
        $Stories = new \controllers\controller\Stories($tableOfStories, [], []);

        //get the result of the function
        $parinam = $Stories->inventory();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'newsStories.html.php');

    }

    //function to test the record insert
    public function testStoriesInsert(){
        //data to insert
        $insertTest = [
            'stories' => [
                'title' => 'Busy nights',
                'content' => 'Late night working',
                'admin' => 'Claire'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfStories = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\Stories($tableOfStories, [], $insertTest);

        //get the result of the function
        $parinam = $AdminManufacturers->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record insert with image
    public function testStoriesInsertImage(){
        //data to insert with image
        $insertTest = [
            'stories' => [
                'title' => 'Busy nights',
                'content' => 'Late night working',
                'image' => 'worldcup.jpg',
                'admin' => 'Claire'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfStories = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\Stories($tableOfStories, [], $insertTest);

        //get the result of the function
        $parinam = $AdminManufacturers->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record update
    public function testStoriesUpdate(){
        //data to update with id
        $insertTest = [
            'manufacturer' => [
                'id' => '8',
                'title' => 'Busy nights',
                'content' => 'Late night working',
                'admin' => 'Claire'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfStories = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\Stories($tableOfStories, [], $insertTest);

        //get the result of the function
        $parinam = $AdminManufacturers->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record update with image
    public function testStoriesUpdateImage(){
        //data to update with image
        $insertTest = [
            'manufacturer' => [
                'id' => '8',
                'title' => 'Busy nights',
                'content' => 'Late night working',
                'image' => 'worldcup.jpg',
                'admin' => 'Claire'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfStories = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\Stories($tableOfStories, [], $insertTest);

        //get the result of the function
        $parinam = $AdminManufacturers->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test a record delete
    public function testStoriesDelete(){
        //id to delete
        $id = [
            'id' => 8
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfStories = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\Stories($tableOfStories, $id, []);

        //get the result of the function
        $parinam = $AdminManufacturers->deleteFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the form page for update
    public function testStoriesForm(){
        $id = [
            'id' => 10
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfStories = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\Stories($tableOfStories, $id, []);

        //get the result of the function
        $parinam = $AdminManufacturers->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminAddStories.html.php');

    }

    //function to test the form page for insert
    public function testStoriesAgain(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfStories = $tables;

        //creating object of the controller
        $AdminManufacturers = new \controllers\controller\Stories($tableOfStories, [], []);

        //get the result of the function
        $parinam = $AdminManufacturers->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminAddStories.html.php');

    }

}