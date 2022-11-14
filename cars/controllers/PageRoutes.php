<?php

//namespace of the class
namespace controllers;

//class implementing the interface GetRoutes
class PageRoutes implements \classes\GetRoutes
{

    //function to direct to the default page
    public function getTheDefaultPageRoute()
    {
        //return the default route
        return 'Stories/inventory';
    }

    //function to get the controller of the page visited
    public function getThePageController($controllerName)
    {
        //including the page containing connection to the database
        require '../dbConnection.php';

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars1 = new \classes\DatabaseController($dbConnection, 'cars', 'id');

        //creating an object of the DatabaseController to access the table carDesc
        $tableOfCarDescs = new \classes\DatabaseController($dbConnection, 'carDesc', 'id');

        //creating an object of the DatabaseController to access the table images
        $tableOfImages = new \classes\DatabaseController($dbConnection, 'images', 'id');

        //creating an object of the DatabaseController to access the table manufacturers
        $tableOfManufacturers = new \classes\DatabaseController($dbConnection, 'manufacturers', 'id', '\controllers\entityClass\Manufacturer', [$tableOfCars1, $tableOfCarDescs, $tableOfImages]);

        //creating an object of the DatabaseController to access the table cars
        $tableOfCars = new \classes\DatabaseController($dbConnection, 'cars', 'id', '\controllers\entityClass\Car', [$tableOfManufacturers, $tableOfCarDescs, $tableOfImages]);

        //creating an object of the DatabaseController to access the table archive
        $tableOfArchives= new \classes\DatabaseController($dbConnection, 'archive', 'id');

        //creating an object of the DatabaseController to access the table administrators
        $tableOfAdministrators = new \classes\DatabaseController($dbConnection, 'administrators', 'id', '\controllers\entityClass\Administrator', [$tableOfCars]);

        //creating an object of the DatabaseController to access the table stories
        $tableOfStories = new \classes\DatabaseController($dbConnection, 'stories', 'id');

        //creating an object of the DatabaseController to access the table contacts
        $tableOfContacts = new \classes\DatabaseController($dbConnection, 'contacts', 'id');

        //creating an array to hold multiple constructors
        $pageControllers = [];

        //creating an object of the controller Cars
        $pageControllers['Cars'] = new \controllers\controller\Cars($tableOfCars);

        //creating an object of the controller Cars
        $pageControllers['Login'] = new \controllers\controller\Login($tableOfAdministrators);

        //creating an object of the controller Cars
        $pageControllers['AdminCars'] = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, $_GET, $_POST);

        //creating an object of the controller Cars
        $pageControllers['AdminManufacturers'] = new \controllers\controller\AdminManufacturers($tableOfManufacturers);

        //creating an object of the controller Cars
        $pageControllers['AdminArchive'] = new \controllers\controller\AdminArchive($tableOfArchives, $tableOfCars, $tableOfCarDescs);

        //creating an object of the controller Cars
        $pageControllers['Administrators'] = new \controllers\controller\Administrators($tableOfAdministrators);

        //creating an object of the controller Cars
        $pageControllers['Stories'] = new \controllers\controller\Stories($tableOfStories);

        //creating an object of the controller Cars
        $pageControllers['Contacts'] = new \controllers\controller\Contacts($tableOfContacts);

        //creating an object of the controller Cars
        $pageControllers['Manufacturers'] = new \controllers\controller\Manufacturers($tableOfManufacturers);

        //return the required controller
        return $pageControllers[$controllerName];

    }

    //function to check if the page requires logging in
    public function adminLoginCheck($pageRoute)
    {
        //creating an array to hold all the routes that requires logging in
        $routesLoginNeed = [];

        //all the routes that requires to be logged in stored in the array as key
        //and providing true to login required
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

        //variable to hold boolean check of login required
        $LoginRequired = isset($routesLoginNeed[$pageRoute]) ? $routesLoginNeed[$pageRoute] : false;

        //check if the page route requires to be logged in
        if ($LoginRequired && !isset($_SESSION['adminLogin'])){
            //direct to the login page
            header('location: ../Login/loginAdmin');
        }
        //return true if login required
        if ($LoginRequired){
            return true;
        }
        //return false as default
        return false;
    }
}