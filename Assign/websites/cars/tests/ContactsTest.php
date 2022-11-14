<?php

//requiring the controller file
require "/websites/cars/controllers/controller/Contacts.php";

//creating a class that extends the TestCase class
class ContactsTest extends \PHPUnit\Framework\TestCase
{
    //function to get the database connection
    public function connection(){
        return new PDO('mysql:dbname=cars;host=mysql', 'student', 'student');
    }

    //function to get the tables
    public function getTables(){
        //get the database connection
        $dbConnection = $this->connection();

        //creating an object of the DatabaseController to access the table contacts
        $tableOfContacts = new \classes\DatabaseController($dbConnection, 'contacts', 'id');

        //store all the tables
        $tables = $tableOfContacts;

        //return all the tables
        return $tables;
    }

    //function to test if all the records are listed
    public function testContactsInventory(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfContacts = $tables;

        //creating object of the controller
        $Contacts = new \controllers\controller\Contacts($tableOfContacts, [], []);

        //get the result of the function
        $parinam = $Contacts->inventory();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'enquiryList.html.php');

    }

    //function to test the record insert
    public function testContactsInsert(){
        //data to insert
        $insertTest = [
            'contact' => [
                'name' => 'Henry',
                'email' => 'henry@gmail.com',
                'enquiry' => 'Any new model coming soon?'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfContacts = $tables;

        //creating object of the controller
        $Contacts = new \controllers\controller\Contacts($tableOfContacts, [], $insertTest);

        //get the result of the function
        $parinam = $Contacts->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the record update
    public function testContactsUpdate(){
        //data to insert with id
        $insertTest = [
            'contact' => [
                'id' => '8',
                'name' => 'Henry',
                'email' => 'henry@gmail.com',
                'enquiry' => 'Any new model coming soon?'
            ]
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfContacts = $tables;

        //creating object of the controller
        $Contacts = new \controllers\controller\Contacts($tableOfContacts, [], $insertTest);

        //get the result of the function
        $parinam = $Contacts->addEditFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test a record delete
    public function testContactsDelete(){
        //id to delete
        $id = [
            'id' => 8
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfContacts = $tables;

        //creating object of the controller
        $Contacts = new \controllers\controller\Contacts($tableOfContacts, $id, []);

        //get the result of the function
        $parinam = $Contacts->deleteFillUp();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    //function to test the form page for update
    public function testContactsForm(){
        $id = [
            'id' => 10
        ];

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfContacts = $tables;

        //creating object of the controller
        $Contacts = new \controllers\controller\Contacts($tableOfContacts, $id, []);

        //get the result of the function
        $parinam = $Contacts->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'contactPage.html.php');

    }

    //function to test the form page for insert
    public function testContactsAgain(){

        //get all tables
        $tables = $this->getTables();

        //assign the table to another table variable
        $tableOfContacts = $tables;

        //creating object of the controller
        $Contacts = new \controllers\controller\Contacts($tableOfContacts, [], []);

        //get the result of the function
        $parinam = $Contacts->addEdit();

        //test if the result above equals to what is expected
        $this->assertEquals($parinam['pageTemplate'], 'contactPage.html.php');

    }

}