<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for archive for admin
class AdminArchive
{
    //initialzing the private variables
    private $tableOfArchive;
    private $tableOfCars;
    private $tableOfCarDescs;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfArchive, \classes\DatabaseController $tableOfCars, \classes\DatabaseController $tableOfCarDescs)
    {
        //providing values to the class variables
        $this->tableOfArchive = $tableOfArchive;
        $this->tableOfCars = $tableOfCars;
        $this->tableOfCarDescs = $tableOfCarDescs;
    }

    //function to return list all the records for the page
    public function inventory(){
        //getting all the records
        $inventory = $this->tableOfArchive->getAll();

        //return the template name and records
        return [
            'pageTemplate' => 'adminArchive.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    //function to add a record into the database
    public function addEditFillUp(){
        //get the data to be inserted
        $newCar = $_POST['car'];

        //insert with the database function
        $this->tableOfArchive->saveData($newCar);

        //redirect back to the list
        redirect("./inventory");
    }

    //function to display form to add or edit record
    public function addEdit(){
        //check to see if an id is sent
        if (isset($_GET['id'])){
            //get the saved record
            $findRecord = $this->tableOfArchive->getOne('id', $_GET['id']);
            $record = $findRecord[0];
        }
        //if no id is sent no record is there
        else{
            $record = false;
        }

        //return the template name and record
        return [
            'pageTemplate' => 'adminAddCar.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    //function to delete a record
    public function deleteFillUp(){
        //database function that deletes the record
        $this->tableOfArchive->deleteData($_GET['id']);

        //redirect back to the list
        redirect("./inventory");

        //return the template name and records
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }

    //function to remove an record from the archive
    public function remove(){
        //get one record from the table in form of an array
        $archive = $this->tableOfArchive->getOneArr('id', $_GET['id']);

        //creating an array to store records
        $data = [];

        //storing all the required data in the array
        $data['id'] = $archive[0]['id'];
        $data['name'] = $archive[0]['name'];
        $data['price'] = $archive[0]['price'];
        $data['manufacturerId'] = $archive[0]['manufacturerId'];
        $data['description'] = $archive[0]['description'];
        $data['newPrice'] = $archive[0]['newPrice'];
        $data['display'] = $archive[0]['display'];
        $data['admin'] = $archive[0]['admin'];

        //saving data into the table
        $this->tableOfCars->addData($data);

        //find the last id
        $_POST['carDesc']['id'] = $this->tableOfCars->findLastId();

        //variable to store data
        $desc = $_POST['carDesc'];

        //redirect back to the list
        redirect("../AdminCars/inventory");

        //delete the record from the table
        $this->tableOfArchive->deleteData($_GET['id']);

        //insert a record into the table
        $this->tableOfCarDescs->saveData($desc);

        //return the template name and records
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }

}