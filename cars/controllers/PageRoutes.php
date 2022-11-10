<?php

namespace controllers;

class PageRoutes implements \classes\GetRoutes
{

    public function getTheDefaultPageRoute()
    {
        return 'Stories/inventory';
    }

    public function getThePageController($controllerName)
    {
        require '../dbConnection.php';

        $tableOfManufacturers = new \classes\DatabaseController($dbConnection, 'manufacturers', 'id');

        $tableOfCarDescs = new \classes\DatabaseController($dbConnection, 'carDesc', 'id');

        $tableOfImages = new \classes\DatabaseController($dbConnection, 'images', 'id');

        $tableOfCars = new \classes\DatabaseController($dbConnection, 'cars', 'id', '\controllers\entityClass\Car', [$tableOfManufacturers, $tableOfCarDescs, $tableOfImages]);

        $tableOfArchives= new \classes\DatabaseController($dbConnection, 'archive', 'id');

        $tableOfAdministrators = new \classes\DatabaseController($dbConnection, 'administrators', 'id', '\controllers\entityClass\Administrator', [$tableOfCars]);

        $tableOfStories = new \classes\DatabaseController($dbConnection, 'stories', 'id');

        $tableOfContacts = new \classes\DatabaseController($dbConnection, 'contacts', 'id');

        $pageControllers = [];

        $pageControllers['Cars'] = new \controllers\controller\Cars($tableOfCars);

        $pageControllers['Login'] = new \controllers\controller\Login($tableOfAdministrators);

        $pageControllers['AdminCars'] = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages);

        $pageControllers['AdminManufacturers'] = new \controllers\controller\AdminManufacturers($tableOfManufacturers);

        $pageControllers['AdminArchive'] = new \controllers\controller\AdminArchive($tableOfArchives, $tableOfCars, $tableOfCarDescs);

        $pageControllers['Administrators'] = new \controllers\controller\Administrators($tableOfAdministrators);

        $pageControllers['Stories'] = new \controllers\controller\Stories($tableOfStories);

        $pageControllers['Contacts'] = new \controllers\controller\Contacts($tableOfContacts);

        return $pageControllers[$controllerName];

    }

    public function adminLoginCheck($pageRoute)
    {
        $routesLoginNeed = [];

        $routesLoginNeed['Login/loginAdminFillUp'] = true;
        $routesLoginNeed['AdminCars/inventory'] = true;
        $routesLoginNeed['AdminCars/addEdit'] = true;
        $routesLoginNeed['AdminCars/addEditFillUp'] = true;
        $routesLoginNeed['AdminCars/delete'] = true;
        $routesLoginNeed['AdminManufacturers/inventory'] = true;
        $routesLoginNeed['AdminManufacturers/addEdit'] = true;
        $routesLoginNeed['AdminManufacturers/addEditFillUp'] = true;
        $routesLoginNeed['AdminManufacturers/delete'] = true;
        $routesLoginNeed['AdminArchive/inventory'] = true;
        $routesLoginNeed['AdminArchive/remove'] = true;
        $routesLoginNeed['AdminArchive/delete'] = true;
        $routesLoginNeed['Administrators/inventory'] = true;
        $routesLoginNeed['Administrators/addEdit'] = true;
        $routesLoginNeed['Administrators/addEditFillUp'] = true;
        $routesLoginNeed['Administrators/delete'] = true;
        $routesLoginNeed['Administrators/admin'] = true;
        $routesLoginNeed['Stories/addEdit'] = true;
        $routesLoginNeed['Stories/addEditFillUp'] = true;
        $routesLoginNeed['Stories/delete'] = true;
        $routesLoginNeed['Contacts/inventory'] = true;
        $routesLoginNeed['Contacts/enquiryCheck'] = true;
        $routesLoginNeed['Contacts/delete'] = true;

        $LoginRequired = isset($routesLoginNeed[$pageRoute]) ? $routesLoginNeed[$pageRoute] : false;

        if ($LoginRequired && !isset($_SESSION['adminLogin'])){
            header('location: ../Login/loginAdmin');
        }
        if ($LoginRequired){
            return true;
        }
        return false;
    }
}