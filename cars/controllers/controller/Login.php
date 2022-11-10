<?php

namespace controllers\controller;

class Login
{
    private $tableOfAdministrators;

    public function __construct(\classes\DatabaseController $tableOfAdministrators)
    {
        $this->tableOfAdministrators = $tableOfAdministrators;
    }

    public function loginAdminFillUp(){
        $credentials = $this->tableOfAdministrators->getAll();
        $c = (array) $credentials;
        foreach ($credentials as $credential){
            if ($_POST['username'] == $credential->username && password_verify($_POST['password'], $credential->password)){
                if ($credential->adminAccess == 1){
                    $_SESSION['adminLogin'] = 'superAdmin';
                }else {
                    $_SESSION['adminLogin'] = 'admin';
                }
                $_SESSION['adminName'] = $_POST['username'];
                redirect("../Stories/inventory");
                $info = "You are logged in";
                break 1;
                return [
                    'pageTemplate' => 'displayInformation.html.php',
                    'titleOfThePage' => 'Admin',
                    'key' => [
                        'information' => $info
                    ]
                ];
            }
        }
        $info = "Credentials did not match";
        return [
            'pageTemplate' => 'displayInformation.html.php',
            'titleOfThePage' => 'Admin',
            'key' => [
                'information' => $info
            ]
        ];
    }

    public function loginAdmin(){
        return [
            'pageTemplate' => 'loginAdmin.html.php',
            'titleOfThePage' => 'Admin',
            'key' => []
        ];
    }

    public function logoutAdmin(){
        unset($_SESSION['adminLogin']);
        unset($_SESSION['adminName']);
        redirect("../Stories/inventory");
    }

}