<?php

namespace controllers\controller;

class AdminCars
{
    private $tableOfCars;
    private $tableOfManufacturers;
    private $tableOfArchives;
    private $tableOfCarDescs;
    private $tableOfImages;

    public function __construct(\classes\DatabaseController $tableOfCars, \classes\DatabaseController $tableOfManufacturers, \classes\DatabaseController $tableOfArchives, \classes\DatabaseController $tableOfCarDescs, \classes\DatabaseController $tableOfImages)
    {
        $this->tableOfCars = $tableOfCars;
        $this->tableOfManufacturers = $tableOfManufacturers;
        $this->tableOfArchives = $tableOfArchives;
        $this->tableOfCarDescs = $tableOfCarDescs;
        $this->tableOfImages = $tableOfImages;
    }

    public function inventory(){
        $inventory = $this->tableOfCars->getAll();

        return [
            'pageTemplate' => 'adminCarList.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    public function addEditFillUp(){
        $newCar = $_POST['car'];
        $this->tableOfCars->saveData($newCar);

        if (isset($_POST['car']['id'])){
            $_POST['carDesc']['id'] = $_POST['car']['id'];
        }
        else{
            $_POST['carDesc']['id'] = $this->tableOfCars->findLastId()[0];
        }

        $desc = $_POST['carDesc'];
        $this->tableOfCarDescs->saveData($desc);

            $fileTypeAllowed = array('jpg', 'png', 'jpeg');
            foreach ($_FILES['image']['name'] as $key=>$value){
                $imageName = $_FILES['image']['name'][$key];
                $tempName = $_FILES['image']['tmp_name'][$key];
                $destination = './images/cars/' . $imageName;
                $typeFile = strtolower(pathinfo($destination, PATHINFO_EXTENSION));

                if (in_array($typeFile, $fileTypeAllowed)){
                    move_uploaded_file($tempName, $destination);
                }

                $imageData = [];
                if (isset($_POST['car']['id'])){
                    $imageData['id'] = $_POST['car']['id'];
                }
                else{
                    $imageData['id'] = $this->tableOfCars->findLastId()[0];
                }
                $imageData['name'] = $imageName;

                $this->tableOfImages->saveData($imageData);

            }

        redirect("./inventory");
    }

    public function addEdit(){
        if (isset($_GET['id'])){
            $findRecord = $this->tableOfCars->getOne('id', $_GET['id']);
            $findRecordDesc = $this->tableOfCarDescs->getOne('id', $_GET['id']);
            $record = $findRecord[0];
            $record1 = $findRecordDesc;
        }
        else{
            $record = false;
            $record1 = false;
        }
        $manufacturersRec = $this->tableOfManufacturers->getAll();
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

    public function deleteFillUp(){
        $this->tableOfCars->deleteData($_GET['id']);
        redirect("./inventory");
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }

    public function addArchive(){
//        $archive = $this->tableOfCars->getOne('id', $_GET['id']);
//        $val = (array) $archive;
//        var_dump($val);
//        $data = [];
//        $data['name'] = $val[0]['name'];
//        $data['price'] = $val['price'];
//        $data['manufactureId'] = $val['manufacturerId'];
//        $data['description'] = $val['description'];
        $archive = $this->tableOfCars->getOneArr('id', $_GET['id']);
        $data = [];
//        $data = $archive[0];
//        var_dump($data);
        $data['id'] = $archive[0]['id'];
        $data['name'] = $archive[0]['name'];
        $data['price'] = $archive[0]['price'];
        $data['manufacturerId'] = $archive[0]['manufacturerId'];
        $data['description'] = $archive[0]['description'];
        $data['newPrice'] = $archive[0]['newPrice'];
        $data['display'] = $archive[0]['display'];
        $data['admin'] = $archive[0]['admin'];
        $this->tableOfArchives->addData($data);
        $this->tableOfCars->deleteData($_GET['id']);
        redirect("../AdminArchive/inventory");
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }

}