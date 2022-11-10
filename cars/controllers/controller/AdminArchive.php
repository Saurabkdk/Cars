<?php

namespace controllers\controller;

class AdminArchive
{
    private $tableOfArchive;
    private $tableOfCars;
    private $tableOfCarDescs;

    public function __construct(\classes\DatabaseController $tableOfArchive, \classes\DatabaseController $tableOfCars, \classes\DatabaseController $tableOfCarDescs)
    {
        $this->tableOfArchive = $tableOfArchive;
        $this->tableOfCars = $tableOfCars;
        $this->tableOfCarDescs = $tableOfCarDescs;
    }

    public function inventory(){
        $inventory = $this->tableOfArchive->getAll();

        return [
            'pageTemplate' => 'adminArchive.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    public function addEditFillUp(){
        $newCar = $_POST['car'];
        $this->tableOfArchive->saveData($newCar);
        redirect("./inventory");
    }

    public function addEdit(){
        if (isset($_GET['id'])){
            $findRecord = $this->tableOfArchive->getOne('id', $_GET['id']);
            $record = $findRecord[0];
        }
        else{
            $record = false;
        }

        return [
            'pageTemplate' => 'adminAddCar.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    public function deleteFillUp(){
        $this->tableOfArchive->deleteData($_GET['id']);
        redirect("./inventory");
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }

    public function remove(){
        $archive = $this->tableOfArchive->getOneArr('id', $_GET['id']);

        $data = [];
        $data['id'] = $archive[0]['id'];
        $data['name'] = $archive[0]['name'];
        $data['price'] = $archive[0]['price'];
        $data['manufacturerId'] = $archive[0]['manufacturerId'];
        $data['description'] = $archive[0]['description'];
        $data['newPrice'] = $archive[0]['newPrice'];
        $data['display'] = $archive[0]['display'];
        $data['admin'] = $archive[0]['admin'];

        $this->tableOfCars->addData($data);

        $_POST['carDesc']['id'] = $this->tableOfCars->findLastId();
        $desc = [];
        $desc = $_POST['carDesc'];

        redirect("../AdminCars/inventory");

        $this->tableOfArchive->deleteData($_GET['id']);
        $this->tableOfCarDescs->saveData($desc);

        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }

}