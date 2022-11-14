<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for administrators
class Administrators
{
    //initialzing the private variables
    private $tableOfAdministrators;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfAdministrators)
    {
        //providing values to the class variables
        $this->tableOfAdministrators = $tableOfAdministrators;
    }

    //function to return list all the records for the page
    public function inventory(){
        //getting all the records
        $inventory = $this->tableOfAdministrators->getAll();

        //return the template name and records
        return [
            'pageTemplate' => 'administratorsList.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    //function to get the admin
    public function admin(){
        //get a particular admin from the table
        $inventory = $this->tableOfAdministrators->getOne('id', $_GET['id']);

        //return the template name and record
        return [
            'pageTemplate' => 'individualAdmin.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory[0]
            ]
        ];
    }

    //function to insert the record into the database
    public function addEditFillUp(){
        //get the password from the form and hash it
        $password = password_hash($_POST['administrator']['password'], PASSWORD_DEFAULT);

        //save the hashed password
        $_POST['administrator']['password'] = $password;

        //get all the administrator record
        $new = $_POST['administrator'];

        //insert the record into the table
        $this->tableOfAdministrators->saveData($new);

        //redirect back to the list
        redirect("./inventory");
    }

    //function to display form to add or edit record
    public function addEdit(){
        //check to see if an id is sent
        if (isset($_GET['id'])){
            //get the saved record
            $findRecord = $this->tableOfAdministrators->getOne('id', $_GET['id']);
            $record = $findRecord[0];
        }
        //if no id is sent no record is there
        else{
            $record = false;
        }
        //return the template name and record
        return [
            'pageTemplate' => 'addAdministrator.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    //function to delete a record
    public function deleteFillUp(){
        //database function that deletes the record
        $this->tableOfAdministrators->deleteData($_GET['id']);

        //redirect back to the list
        redirect("./inventory");

        //return the template name and records
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }
}