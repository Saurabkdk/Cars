<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for archive
class Stories
{
    //initialzing the private variables
    private $tableOfStories;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfStories)
    {
        //providing values to the class variables
        $this->tableOfStories = $tableOfStories;
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
        $_POST['stories']['admin'] = $_SESSION['adminName'];
        $_POST['stories']['date'] = date("D M Y");

        //get the record into a variable
        $new = $_POST['stories'];

        //save the data with the database function
        $this->tableOfStories->saveData($new);

        //variable to store the types of file allowed to be uploaded
        $fileTypeAllowed = array('jpg', 'png', 'jpeg');
            //store the file name
            $imageName = $_FILES['image']['name'];

            //store the temporary name of the file
            $tempName = $_FILES['image']['tmp_name'];

            //destination where the file will be stored
            $destination = './images/stories/' . $imageName;

            //get the file type of the uploaded one
            $typeFile = strtolower(pathinfo($destination, PATHINFO_EXTENSION));

            //check if the uploaded file is of correct type
            if (in_array($typeFile, $fileTypeAllowed)){
                //move the uploaded file into the destination
                move_uploaded_file($tempName, $destination);
            }

            //array to store the image record
            $imageData = [];

            //check to see if id is passed and store it
            if (isset($_POST['car']['id'])){
                $imageData['id'] = $_POST['stories']['id'];
            }
            //if id is not passed, get the last id from the table
            else{
                $imageData['id'] = $this->tableOfStories->findLastId()[0];
            }

            //check if an image is uploaded
            if (isset($imageName)) {
                //save the image name
                $imageData['image'] = $imageName;

                //store the image record into the database
                $this->tableOfStories->saveData($imageData);
            }

            //redirect back to list
            redirect("./inventory");
    }

    //function to display form to add or edit record
    public function addEdit(){
        //check to see if an id is sent
        if (isset($_GET['id'])){
            //get the saved record
            $findRecord = $this->tableOfStories->getOne('id', $_GET['id']);
            $record = $findRecord[0];
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
        $this->tableOfStories->deleteData($_GET['id']);

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