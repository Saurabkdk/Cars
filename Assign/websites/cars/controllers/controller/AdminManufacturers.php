<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for manufacturers for admin
class AdminManufacturers
{
    //initialzing the private variables
    private $tableOfManufacturers;
    private $get;
    private $post;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfManufacturers, $get, $post)
    {
        //providing values to the class variables
        $this->tableOfManufacturers = $tableOfManufacturers;
        $this->get = $get;
        $this->post = $post;
    }

    //function to return list all the records for the page
    public function inventory(){
        //getting all the records
        $inventory = $this->tableOfManufacturers->getAll();

        //return the template name and records
        return [
            'pageTemplate' => 'adminManufacturerList.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    //function to insert the record into the database
    public function addEditFillUp(){
        //get the record into a variable
        $new = $this->post['manufacturer'];
        //save the data with the database function
        $this->tableOfManufacturers->saveData($new);

        //redirect back to list
//        redirect("./inventory");

        if (isset($this->get['id'])) {
            $information = "Data updated";
        }
        else{
            $information = "Data added";
        }

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
            $findRecord = $this->tableOfManufacturers->getOne('id', $this->get['id']);
            $record = $findRecord;
        }
        //if no id is sent no record is there
        else{
            $record = false;
        }
        //return the template name and record
        return [
            'pageTemplate' => 'adminAddManufacturer.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    //function to delete a record
    public function deleteFillUp(){
        //database function that deletes the record
        $this->tableOfManufacturers->deleteData($this->get['id']);

        //redirect back to the list
//        redirect("./inventory");

        $information = "Data deleted";

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