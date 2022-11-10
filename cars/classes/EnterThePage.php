<?php

namespace classes;

class EnterThePage
{
    private $routeObject;

    public function __construct(GetRoutes $routeObject)
    {
        $this->routeObject = $routeObject;
    }

    public function runThePage(){
        $routeOfPage = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

        $admin = $this->routeObject->adminLoginCheck($routeOfPage);

        if($routeOfPage == ''){
            $routeOfPage = $this->routeObject->getTheDefaultPageRoute();
        }

        list($nameOfController, $nameOfFunction) = explode('/', $routeOfPage);

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nameOfFunction = $nameOfFunction . 'FillUp';
        }

        $pageController = $this->routeObject->getThePageController($nameOfController);

        $contentBlock = $pageController->$nameOfFunction();

        $contentOfThePage = $this->runTheTemplate('../templates/' . $contentBlock['pageTemplate'], $contentBlock['key']);

        $titleOfThePage = $contentBlock['titleOfThePage'];

        if ($admin){
            require '../templates/adminPageLayout.html.php';
        }
        else{
            require '../templates/pageLayout.html.php';
        }


    }

    public function runTheTemplate($nameOfFile, $keywords){
        extract($keywords);
        ob_start();
        require $nameOfFile;
        $contentOfThePage = ob_get_clean();
        return $contentOfThePage;
    }

}