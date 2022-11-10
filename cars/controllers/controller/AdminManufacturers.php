<?php

namespace controllers\controller;

class AdminManufacturers
{
    private $tableOfManufacturers;

    public function __construct(\classes\DatabaseController $tableOfManufacturers)
    {
        $this->tableOfManufacturers = $tableOfManufacturers;
    }

    public function inventory(){
        $inventory = $this->tableOfManufacturers->getAll();

        return [
            'pageTemplate' => 'adminManufacturerList.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    public function addEditFillUp(){
        $new = $_POST['manufacturer'];
        $this->tableOfManufacturers->saveData($new);
        redirect("./inventory");
    }

    public function addEdit(){
        if (isset($_GET['id'])){
            $findRecord = $this->tableOfManufacturers->getOne('id', $_GET['id']);
            $record = $findRecord[0];
        }
        else{
            $record = false;
        }
        return [
            'pageTemplate' => 'adminAddManufacturer.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    public function deleteFillUp(){
        $this->tableOfManufacturers->deleteData($_GET['id']);
        redirect("./inventory");
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }
}