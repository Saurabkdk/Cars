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
    private $get;
    private $post;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfArchive, \classes\DatabaseController $tableOfCars, \classes\DatabaseController $tableOfCarDescs, $get, $post)
    {
        //providing values to the class variables
        $this->tableOfArchive = $tableOfArchive;
        $this->tableOfCars = $tableOfCars;
        $this->tableOfCarDescs = $tableOfCarDescs;
        $this->get = $get;
        $this->post = $post;
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
        $newCar = $this->post['car'];

        //insert with the database function
        $this->tableOfArchive->saveData($newCar);

        //redirect back to the list
//        redirect("./inventory");

        $information = "Data archived";

        //return the template name and records
        return [
            'pageTemplate' => 'displayInformation.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'information' => $information
            ]
        ];
    }


    //function to delete a record
    public function deleteFillUp(){
        //database function that deletes the record
        $this->tableOfArchive->deleteData($this->get['id']);

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

    //function to remove an record from the archive
    public function remove(){
        //get one record from the table in form of an array
        $archive = $this->tableOfArchive->getOneArr('id', $this->get['id']);

        //creating an array to store records
        $data = [];

        if (isset($archive[0])) {
            //storing all the required data in the array
            $data['id'] = $archive[0]['id'];
            $data['name'] = $archive[0]['name'];
            $data['price'] = $archive[0]['price'];
            $data['manufacturerId'] = $archive[0]['manufacturerId'];
            $data['description'] = $archive[0]['description'];
            $data['newPrice'] = $archive[0]['newPrice'];
            $data['display'] = $archive[0]['display'];
            $data['admin'] = $archive[0]['admin'];
        }

        //saving data into the table
        $this->tableOfCars->addData($data);

        //find the last id
        $desc['id'] = $this->tableOfCars->findLastId()[0];

        //redirect back to the list
//        redirect("../AdminCars/inventory");

        //delete the record from the table
        $this->tableOfArchive->deleteData($this->get['id']);

        //insert a record into the table
        $this->tableOfCarDescs->saveData($desc);

        $information = "Data removed";

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