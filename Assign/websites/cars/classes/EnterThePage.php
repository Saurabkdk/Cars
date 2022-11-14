<?php

//nameapace of the class
namespace classes;

//class for the entrypoint of the site
class EnterThePage
{
    //initializing a private variable
    private $routeObject;

    //constructor of the class
    public function __construct(GetRoutes $routeObject)
    {
        //assigning value to the class variable
        $this->routeObject = $routeObject;
    }

    //function to run the site
    public function runThePage(){
        //get the route or path of the page visited
        $routeOfPage = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

        //check to see if the page requires logging in
        $admin = $this->routeObject->adminLoginCheck($routeOfPage);

        //if no route is provided
        if($routeOfPage == ''){
            //direct to the default page
            $routeOfPage = $this->routeObject->getTheDefaultPageRoute();
        }

        //get the controller and function name from the route of the page
        list($nameOfController, $nameOfFunction) = explode('/', $routeOfPage);

        //check to see if the request method of the page is post
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            //in case of post add FillUp to the function name
            $nameOfFunction = $nameOfFunction . 'FillUp';
        }

        //get the object of the controller
        $pageController = $this->routeObject->getThePageController($nameOfController);

        //run the function with the controller
        $contentBlock = $pageController->$nameOfFunction();

        //run the template to be display in the page
        $contentOfThePage = $this->runTheTemplate('../templates/' . $contentBlock['pageTemplate'], $contentBlock['key']);

        //get the title of the page
        $titleOfThePage = $contentBlock['titleOfThePage'];

        //check if admin is logged in
        if ($admin){
            //load the page layout for admin
            require '../templates/adminPageLayout.html.php';
        }
        //if not admin
        else{
            //load the normal page layout
            require '../templates/pageLayout.html.php';
        }

    }

    //function to return the template required by the page
    public function runTheTemplate($nameOfFile, $keywords){
        //extract the keys from the argument passed
        extract($keywords);

        //create an output buffer
        ob_start();

        //load the template provided
        require $nameOfFile;

        //end the output buffer and store everything in buffer into a variable
        $contentOfThePage = ob_get_clean();

        //return the variable with template
        return $contentOfThePage;
    }

}