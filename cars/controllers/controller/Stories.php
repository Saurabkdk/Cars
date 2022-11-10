<?php

namespace controllers\controller;

class Stories
{
    private $tableOfStories;

    public function __construct(\classes\DatabaseController $tableOfStories)
    {
        $this->tableOfStories = $tableOfStories;
    }

    public function inventory(){
        $inventory = $this->tableOfStories->getAll();

        return [
            'pageTemplate' => 'newsStories.html.php',
            'titleOfThePage' => 'Home',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    public function addEditFillUp(){
        $_POST['stories']['admin'] = $_SESSION['adminName'];
        $_POST['stories']['date'] = date("D M Y");
        $new = $_POST['stories'];
        $this->tableOfStories->saveData($new);

        $fileTypeAllowed = array('jpg', 'png', 'jpeg');
            $imageName = $_FILES['image']['name'];
            $tempName = $_FILES['image']['tmp_name'];
            $destination = './images/stories/' . $imageName;
            $typeFile = strtolower(pathinfo($destination, PATHINFO_EXTENSION));

            if (in_array($typeFile, $fileTypeAllowed)){
                move_uploaded_file($tempName, $destination);
            }

            $imageData = [];
            if (isset($_POST['car']['id'])){
                $imageData['id'] = $_POST['stories']['id'];
            }
            else{
                $imageData['id'] = $this->tableOfStories->findLastId()[0];
            }
            $imageData['image'] = $imageName;

            $this->tableOfStories->saveData($imageData);


            redirect("./inventory");
    }

    public function addEdit(){
        if (isset($_GET['id'])){
            $findRecord = $this->tableOfStories->getOne('id', $_GET['id']);
            $record = $findRecord[0];
        }
        else{
            $record = false;
        }
        return [
            'pageTemplate' => 'adminAddStories.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    public function deleteFillUp(){
        $this->tableOfStories->deleteData($_GET['id']);
        redirect("./inventory");
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }
}