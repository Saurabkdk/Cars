<?php

//requiring the controller file
require "/websites/cars/controllers/controller/Login.php";

//creating a class that extends the TestCase class
class LoginTest extends \PHPUnit\Framework\TestCase
{
    //function to get the database connection
    public function connection(){
        return new PDO('mysql:dbname=cars;host=mysql', 'student', 'student');
    }

    //function to get the tables
    public function getTables(){
        //get the database connection
        $dbConnection = $this->connection();

        //creating an object of the DatabaseController to access the table administrators
        $tableOfAdministrators = new \classes\DatabaseController($dbConnection, 'administrators', 'id');

        //store all the tables
        $tables = $tableOfAdministrators;

        //return all the tables
        return $tables;
    }

    public function testLogin(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Login = new \controllers\controller\Login($tableOfAdministrators, [], []);

        //get the result of the function
        $parinam = $Login->loginAdmin();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'loginAdmin.html.php');
    }

    //function to test the form for login
    public function testLoginFillUp(){
        $loginData = [
            'username' => 'Max',
            'password' => password_hash('max2022', PASSWORD_DEFAULT)
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Login = new \controllers\controller\Login($tableOfAdministrators, [], $loginData);

        //get the result of the function
        $parinam = $Login->loginAdminFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');
    }

    //function to test the logout of admin
    public function testLogoutAdmin(){

        //assign the table to another table variable
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfAdministrators = $tables;

        //creating object of the controller
        $Login = new \controllers\controller\Login($tableOfAdministrators, [], []);

        //get the result of the function
        $parinam = $Login->logoutAdmin();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');
    }

}