<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for administrators
class Administrators
{
    //initialzing the private variables
    private $tableOfAdministrators;
    private $get;
    private $post;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfAdministrators, $get, $post)
    {
        //providing values to the class variables
        $this->tableOfAdministrators = $tableOfAdministrators;
        $this->get = $get;
        $this->post = $post;
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
        $inventory = $this->tableOfAdministrators->getOne('id', $this->get['id']);

        //return the template name and record
        return [
            'pageTemplate' => 'individualAdmin.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    //function to insert the record into the database
    public function addEditFillUp(){
        //get the password from the form and hash it
        $password = password_hash($this->post['administrator']['password'], PASSWORD_DEFAULT);

        //save the hashed password
        $this->post['administrator']['password'] = $password;

        //get all the administrator record
        $new = $this->post['administrator'];

        //insert the record into the table
        $this->tableOfAdministrators->saveData($new);

        //redirect back to the list
//        redirect("./inventory");

        $information = "Administrator added/edited";

        //return the template name and records
        return [
            'pageTemplate' => 'displayInformation.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'information' => $information
            ]
        ];

    }

    //function to display form to add or edit record
    public function addEdit(){
        //check to see if an id is sent
        if (isset($this->get['id'])){
            //get the saved record
            $findRecord = $this->tableOfAdministrators->getOne('id', $this->get['id']);
            $record = $findRecord;
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
        $this->tableOfAdministrators->deleteData($this->get['id']);

        //redirect back to the list
//        redirect("./inventory");

        $information = "Administrator deleted";

        //return the template name and records
        return [
            'pageTemplate' => 'displayInformation.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'information' => $information
            ]
        ];
    }
}