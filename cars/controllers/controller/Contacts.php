<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for contacts
class Contacts
{
    //initialzing the private variables
    private $tableOfContacts;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfContacts)
    {
        //providing values to the class variables
        $this->tableOfContacts = $tableOfContacts;
    }

    //function to return list all the records for the page
    public function inventory(){
        //getting all the records
        $inventory = $this->tableOfContacts->getAll();

        //return the template name and records
        return [
            'pageTemplate' => 'enquiryList.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'all' => $inventory
            ]
        ];
    }

    public function addEditFillUp(){
        $new = $_POST['contact'];
        $this->tableOfContacts->saveData($new);
        $information = "Your enquiry is added. Thank you. We will contact you as soon as possible.";
        return [
            'pageTemplate' => 'displayInformation.html.php',
            'titleOfThePage' => 'Contact us',
            'key' => [
                'information' => $information
            ]
        ];
    }

    public function addEdit(){
        if (isset($_GET['id'])){
            $findRecord = $this->tableOfContacts->getOne('id', $_GET['id']);
            $record = $findRecord[0];
        }
        else{
            $record = false;
        }
        return [
            'pageTemplate' => 'contactPage.html.php',
            'titleOfThePage' => 'Contact Us',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    public function enquiryCheck(){
        $record = $this->tableOfContacts->getOneArr('id', $_GET['id']);
        $data['id'] = $record[0]['id'];
        $data['name'] = $record[0]['name'];
        $data['email'] = $record[0]['email'];
        $data['telephone'] = $record[0]['telephone'];
        $data['enquiry'] = $record[0]['enquiry'];
        $data['admin'] = $record[0]['admin'];
        if ($_GET['check'] == 0){
            $data['complete'] = 1;
            $data['admin'] = $_SESSION['adminName'];
        }
        else{
            $data['complete'] = 0;
            $data['admin'] = null;
        }
        $this->tableOfContacts->updateData($data);
        redirect("./inventory");
        return[
            'pageTemplate' => '',
            '$titleOfThePage' => '',
            'key' => []
        ];
    }

    public function deleteFillUp(){
        $this->tableOfContacts->deleteData($_GET['id']);
        redirect("./inventory");
        return [
            'pageTemplate' => '',
            'titleOfThePage' => '',
            'key' => []
        ];
    }
}