<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for cars for admin
class AdminCars
{
    //initialzing the private variables
    private $tableOfCars;
    private $tableOfManufacturers;
    private $tableOfArchives;
    private $tableOfCarDescs;
    private $tableOfImages;
    private $get;
    private $post;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfCars, \classes\DatabaseController $tableOfManufacturers, \classes\DatabaseController $tableOfArchives, \classes\DatabaseController $tableOfCarDescs, \classes\DatabaseController $tableOfImages, $get, $post)
    {
        //providing values to the class variables
        $this->tableOfCars = $tableOfCars;
        $this->tableOfManufacturers = $tableOfManufacturers;
        $this->tableOfArchives = $tableOfArchives;
        $this->tableOfCarDescs = $tableOfCarDescs;
        $this->tableOfImages = $tableOfImages;
        $this->get = $get;
        $this->post = $post;
    }

    //function to return list all the records for the page
    public function inventory(){
        //getting all the records
        $inventory = $this->tableOfCars->getAll();

        //return the template name and records
        return [
            'pageTemplate' => 'adminCarList.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    //function to insert the record into the database
    public function addEditFillUp()
    {
        //get the record into a variable
        $newCar = $this->post;

        //save the data with the database function
        $this->tableOfCars->saveData($newCar['car']);

        //check if there is id and store it
        if (isset($newCar['car']['id'])) {
            $newCar['carDesc']['id'] = $newCar['car']['id'];
        } //if not find the last id
        else {
            $newCar['carDesc']['id'] = $this->tableOfCars->findLastId()[0];
        }

        //storing values in variable
        $desc = $newCar['carDesc'];

        //save data into table with database function
        $this->tableOfCarDescs->saveData($desc);

        //storing the allowed files types while storing images
        $fileTypeAllowed = array('jpg', 'png', 'jpeg');

        //loop through all the images selected
        if (isset($_FILES['image'])){
            foreach ($_FILES['image']['name'] as $key => $value) {

                //store the image name
                $imageName = $_FILES['image']['name'][$key];

                //store the image temporary name                         //code of line 70 - 91 researched from website
                $tempName = $_FILES['image']['tmp_name'][$key];          //https://www.positronx.io/php-multiple-files-images-upload-in-mysql-database/

                //destination where all the images will be stored
                $destination = './images/cars/' . $imageName;

                //find the file type selected
                $typeFile = strtolower(pathinfo($destination, PATHINFO_EXTENSION));

                //if the file type matches, move the files into the destination folder
                if (in_array($typeFile, $fileTypeAllowed)) {
                    move_uploaded_file($tempName, $destination);
                }

                //array to store the image data
                $imageData = [];

                //check if id is passed
                if (isset($newCar['car']['id'])) {
                    $imageData['id'] = $newCar['car']['id'];
                } //if id is not passed, get the last id from the table
                else {
                    $imageData['id'] = $this->tableOfCars->findLastId()[0];
                }

                //if image is selected, save the image name in the database
                if (isset($imageName) && strlen($imageName) > 0) {
                    $imageData['name'] = $imageName;

                    $this->tableOfImages->saveData($imageData);
                }

            }
    }

//        redirect("./inventory");
            if (isset($this->get['id'])) {
                $information = "Data updated";
            }
            else{
                $information = "Data added";
            }
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
            $findRecord = $this->tableOfCars->getOne('id', $this->get['id']);

            //get the saved record
            $findRecordDesc = $this->tableOfCarDescs->getOne('id', $this->get['id']);
            $record = $findRecord[0];
            $record1 = $findRecordDesc;
        }
        //if no id is sent no record is there
        else{
            $record = false;
            $record1 = false;
        }

        //get the manufacturers record
        $manufacturersRec = $this->tableOfManufacturers->getAll();

        //return the template name and record
        return [
            'pageTemplate' => 'adminAddCar.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
                'manufacturers' => $manufacturersRec,
                'desc' => $record1
            ]
        ];
    }

    //function to delete a record
    public function deleteFillUp(){
        //database function that deletes the record
        $this->tableOfCars->deleteData($this->get['id']);

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

    //function to add the record into the table
    public function addArchive(){
        //get the record from the table
        $archive = $this->tableOfCars->getOneArr('id', $this->get['id']);

        //array to store all the data
        $data = [];

        if (isset($archive)) {
            //storing data in the variable with respective keys
            $data['id'] = $archive[0]['id'];
            $data['name'] = $archive[0]['name'];
            $data['price'] = $archive[0]['price'];
            $data['manufacturerId'] = $archive[0]['manufacturerId'];
            $data['description'] = $archive[0]['description'];
            $data['newPrice'] = $archive[0]['newPrice'];
            $data['display'] = $archive[0]['display'];
            $data['admin'] = $archive[0]['admin'];
        }

        //storing the data into the table in database
        $this->tableOfArchives->addData($data);

        //deleting the record from the table
        $this->tableOfCars->deleteData($this->get['id']);

        //redirect back to the list
        //redirect("../AdminArchive/inventory");

        $information = "Data archived";

        //return the template name and record
        return [
            'pageTemplate' => 'displayInformation.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'information' => $information
            ]
        ];
    }

}