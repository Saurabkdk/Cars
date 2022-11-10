<?php

namespace controllers\controller;

class Administrators
{
    private $tableOfAdministrators;

    public function __construct(\classes\DatabaseController $tableOfAdministrators)
    {
        $this->tableOfAdministrators = $tableOfAdministrators;
    }

    public function inventory(){
        $inventory = $this->tableOfAdministrators->getAll();

        return [
            'pageTemplate' => 'administratorsList.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    public function admin(){
        $inventory = $this->tableOfAdministrators->getOne('id', $_GET['id']);

        return [
            'pageTemplate' => 'individualAdmin.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory[0]
            ]
        ];
    }

    public function addEditFillUp(){
        $password = password_hash($_POST['administrator']['password'], PASSWORD_DEFAULT);
        $_POST['administrator']['password'] = $password;
        $new = $_POST['administrator'];
        $this->tableOfAdministrators->saveData($new);
        redirect("./inventory");
    }

    public function addEdit(){
        if (isset($_GET['id'])){
            $findRecord = $this->tableOfAdministrators->getOne('id', $_GET['id']);
            $record = $findRecord[0];
        }
        else{
            $record = false;
        }
        return [
            'pageTemplate' => 'addAdministrator.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    public function deleteFillUp(){
        $this->tableOfAdministrators->deleteData($_GET['id']);
        redirect("./inventory");
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }
}