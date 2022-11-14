<?php

//namespace of the class
namespace controllers\controller;

//controller class to handle page for contacts
class Contacts
{
    //initialzing the private variables
    private $tableOfContacts;
    private $get;
    private $post;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfContacts, $get, $post)
    {
        //providing values to the class variables
        $this->tableOfContacts = $tableOfContacts;
        $this->get = $get;
        $this->post = $post;
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

    //function to insert the record into the database
    public function addEditFillUp(){
        //get the record into a variable
        $new = $this->post['contact'];

        //save the data with the database function
        $this->tableOfContacts->saveData($new);

        $information = "Your enquiry is added. Thank you. We will contact you as soon as possible.";

        //return the template name and records
        return [
            'pageTemplate' => 'displayInformation.html.php',
            'titleOfThePage' => 'Contact us',
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
            $findRecord = $this->tableOfContacts->getOne('id', $this->get['id']);
            $record = $findRecord;
        }
        //if no id is sent no record is there
        else{
            $record = false;
        }
        //return the template name and record
        return [
            'pageTemplate' => 'contactPage.html.php',
            'titleOfThePage' => 'Contact Us',
            'key' => [
                'one' => $record,
            ]
        ];
    }

    public function enquiryCheck(){
        $record = $this->tableOfContacts->getOneArr('id', $this->get['id']);
        $data['id'] = $record[0]['id'];
        $data['name'] = $record[0]['name'];
        $data['email'] = $record[0]['email'];
        $data['telephone'] = $record[0]['telephone'];
        $data['enquiry'] = $record[0]['enquiry'];
        $data['admin'] = $record[0]['admin'];
        if ($this->get['check'] == 0){
            $data['complete'] = 1;
            $data['admin'] = $_SESSION['adminName'];
        }
        else{
            $data['complete'] = 0;
            $data['admin'] = null;
        }
        $this->tableOfContacts->updateData($data);
//        redirect("./inventory");
        $information = "Data inserted";

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
        $this->tableOfContacts->deleteData($this->get['id']);
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
}