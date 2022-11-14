<?php

//namespace of the class
namespace controllers\controller;

//class for the administrator login
class Login
{
    //initializing the private variable
    private $tableOfAdministrators;
    private $get;
    private $post;

    //creating a constructor of the class
    public function __construct(\classes\DatabaseController $tableOfAdministrators, $get, $post)
    {
        //assigning values to the class variables
        $this->tableOfAdministrators = $tableOfAdministrators;
        $this->get = $get;
        $this->post = $post;
    }

    //function to check the administrator credentials
    public function loginAdminFillUp(){
        //get the credentials of the administrators from the table
        $credentials = $this->tableOfAdministrators->getAll();

        //loop to check if the inserted credentials match that from the database
        foreach ($credentials as $credential){
            //check if the provided username and password matches from the table
            if ($this->post['username'] == $credential->username && password_verify($this->post['password'], $credential->password)){

                //if adminAccess is 1, define session variable
                if ($credential->adminAccess == 1){
                    $_SESSION['adminLogin'] = 'superAdmin';
                }
                //if adminAccess not one, define different session variable
                else {
                    $_SESSION['adminLogin'] = 'admin';
                }
                //get the name of the administrator
                $_SESSION['adminName'] = $this->post['username'];

                //redirect back to home
                redirect("../Stories/inventory");
                $info = "You are logged in";
                //break the loop
                break 1;
                //return the template name and record
                return [
                    'pageTemplate' => 'displayInformation.html.php',
                    'titleOfThePage' => 'Admin',
                    'key' => [
                        'information' => $info
                    ]
                ];
            }
        }
        //in case credential does not match
        $info = "Credentials did not match";

        //return the template name and record
        return [
            'pageTemplate' => 'displayInformation.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'information' => $info
            ]
        ];
    }

    //function to provide the template to login
    public function loginAdmin(){
        //return the template name
        return [
            'pageTemplate' => 'loginAdmin.html.php',
            'titleOfThePage' => 'Admin',
            'key' => []
        ];
    }

    //function to logout the administrator
    public function logoutAdmin(){
        //unset the session variables
        if (isset($_SESSION['adminLogin'])) {
            unset($_SESSION['adminLogin']);
        }
        if (isset($_SESSION['adminName'])) {
            unset($_SESSION['adminName']);
        }

        //redirect back to the home page
//        redirect("../Stories/inventory");

        $information = "You are logged out";

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