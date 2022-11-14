<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for archive
class Stories
{
    //initialzing the private variables
    private $tableOfStories;
    private $get;
    private $post;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfStories, $get, $post)
    {
        //providing values to the class variables
        $this->tableOfStories = $tableOfStories;
        $this->get = $get;
        $this->post = $post;
    }

    //function to return list all the records for the page
    public function inventory(){
        //getting all the records
        $inventory = $this->tableOfStories->getAll();

        //return the template name and records
        return [
            'pageTemplate' => 'newsStories.html.php',
            'titleOfThePage' => 'Home',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    //function to insert the record into the database
    public function addEditFillUp(){
        if (isset($_SESSION['adminName'])) {
            $this->post['stories']['admin'] = $_SESSION['adminName'];
        }

        $this->post['stories']['date'] = date("d M Y");

        //get the record into a variable
        $new = $this->post['stories'];

        //save the data with the database function
        $this->tableOfStories->saveData($new);

        //variable to store the types of file allowed to be uploaded
        $fileTypeAllowed = array('jpg', 'png', 'jpeg');
            //store the file name
        if (isset($_FILES['image'])) {
            $imageName = $_FILES['image']['name'];

            //store the temporary name of the file        //code of line 53 - 71 researched from website
            $tempName = $_FILES['image']['tmp_name'];     //https://www.positronx.io/php-multiple-files-images-upload-in-mysql-database/

            //destination where the file will be stored
            $destination = './images/stories/' . $imageName;

            //get the file type of the uploaded one
            $typeFile = strtolower(pathinfo($destination, PATHINFO_EXTENSION));

            //check if the uploaded file is of correct type
            if (in_array($typeFile, $fileTypeAllowed)) {
                //move the uploaded file into the destination
                move_uploaded_file($tempName, $destination);
            }
        }

            //array to store the image record
            $imageData = [];

            //check to see if id is passed and store it
            if (isset($this->post['car']['id'])){
                $imageData['id'] = $this->post['stories']['id'];
            }
            //if id is not passed, get the last id from the table
            else{
                $imageData['id'] = $this->tableOfStories->findLastId()[0];
            }

            //check if an image is uploaded
            if (isset($imageName) && strlen($imageName) > 0) {
                //save the image name
                $imageData['image'] = $imageName;

                //store the image record into the database
                $this->tableOfStories->saveData($imageData);
            }

            //redirect back to list
//            redirect("./inventory");

        if (isset($this->get['id'])) {
            $information = "Story updated";
        }
        else{
            $information = "Story added";
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
            $findRecord = $this->tableOfStories->getOne('id', $this->get['id']);
            $record = $findRecord;
        }
        //if no id is sent no record is there
        else{
            $record = false;
        }
        //return the template name and record
        return [
            'pageTemplate' => 'adminAddStories.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    //function to delete a record
    public function deleteFillUp(){
        //database function that deletes the record
        $this->tableOfStories->deleteData($this->get['id']);

        //redirect back to the list
//        redirect("./inventory");

        $information = "Story deleted";

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