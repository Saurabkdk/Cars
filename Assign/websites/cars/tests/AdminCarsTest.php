<?php
//requiring the controller file
require "/websites/cars/classes/DatabaseController.php";
require "/websites/cars/controllers/controller/AdminCars.php";

//creating a class that extends the TestCase class
class AdminCarsTest extends \PHPUnit\Framework\TestCase
{
    //function to get the database connection
    public function connection(){
        return new PDO('mysql:dbname=cars;host=mysql', 'student', 'student');
    }

    //function to get the tables
    public function getTables(){
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

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= new \classes\DatabaseController($dbConnection, 'archive', 'id');

        //store all the tables
        $tables = array($tableOfCars, $tableOfCarDescs, $tableOfImages, $tableOfManufacturers, $tableOfArchives);

        //return all the tables
        return $tables;

    }

    //function to test if all the records are listed
    public function testCarInventory(){

        //get all tables
        $tables = $this->getTables();

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = $tables[1];

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = $tables[2];

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = $tables[3];

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = $tables[1];

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= $tables[4];

        //creating object of the controller
        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, [], []);

        //get the result of the function
        $parinam = $AdminCar->inventory();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminCarList.html.php');
    }

    //function to test the form page for update
    public function testCarForm(){
        $dbConnection = $this->connection();

        $id = [
            'id' => 35
        ];

        //get all tables
        $tables = $this->getTables();

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = $tables[1];

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = $tables[2];

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = $tables[3];

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = $tables[1];

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= $tables[4];

        //creating object of the controller
        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, $id, []);

        //get the result of the function
        $parinam = $AdminCar->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminAddCar.html.php');
    }

    //function to test the form page for insert
    public function testCarFormAgain(){
        $dbConnection = $this->connection();

        //get all tables
        $tables = $this->getTables();

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = $tables[1];

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = $tables[2];

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = $tables[3];

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = $tables[1];

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= $tables[4];

        //creating object of the controller
        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, [], []);

        //get the result of the function
        $parinam = $AdminCar->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'adminAddCar.html.php');
    }

    //function to test the record insert
    public function testCarInsert(){
        //data to insert
        $testDataAdminCar = [
            'car' => [
                'name' => 'Buggati',
                'price' => '300000',
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

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = $tables[1];

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = $tables[2];

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = $tables[3];

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = $tables[1];

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= $tables[4];

        //creating object of the controller
        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, [], $testDataAdminCar);

        //get the result of the function
        $parinam = $AdminCar->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record insert with image
    public function testCarInsertImage(){
        //data to insert with image
        $testDataAdminCar = [
            'car' => [
                'name' => 'Buggati',
                'price' => '300000',
                'manufacturerId' => '2',
                'description' => 'Good',
                'image' => 'db4.jpg'
            ],
            'carDesc' => [
                'mileage' => '20',
                'engine' => 'Nitro'
            ]
        ];

        //get all tables

        $tables = $this->getTables();

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = $tables[1];

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = $tables[2];

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = $tables[3];

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = $tables[1];

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= $tables[4];

        //creating object of the controller
        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, [], $testDataAdminCar);

        //get the result of the function
        $parinam = $AdminCar->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record update
    public function testCarUpdate(){
        //data to insert with id
        $testDataAdminCar = [
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

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = $tables[1];

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = $tables[2];

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = $tables[3];

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = $tables[1];

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= $tables[4];

        //creating object of the controller
        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, [], $testDataAdminCar);

        //get the result of the function
        $parinam = $AdminCar->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record update with image
    public function testCarUpdateImage(){
        //data to update with image
        $testDataAdminCar = [
            'car' => [
                'id' => '45',
                'name' => 'Buggati',
                'price' => '350000',
                'manufacturerId' => '2',
                'description' => 'Good',
                'image' => 'car.jpg'
            ],
            'carDesc' => [
                'mileage' => '20',
                'engine' => 'Nitro'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = $tables[1];

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = $tables[2];

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = $tables[3];

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = $tables[1];

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= $tables[4];

        //creating object of the controller
        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, [], $testDataAdminCar);

        //get the result of the function
        $parinam = $AdminCar->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test a record delete
    public function testCarDelete(){
        //id to delete
        $id = [
            'id' => 44
        ];

        //get all tables
        $tables = $this->getTables();

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = $tables[1];

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = $tables[2];

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = $tables[3];

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = $tables[1];

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= $tables[4];

        //creating object of the controller
        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, $id, []);

        //get the result of the function
        $parinam = $AdminCar->deleteFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }


}