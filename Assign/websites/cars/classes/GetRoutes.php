<?php

//namespace of the interface
namespace classes;

//creating an interface
interface GetRoutes
{
    //functions that are to be run when implementing this interface
    public function getTheDefaultPageRoute();
    public function getThePageController($controllerName);
    public function adminLoginCheck($pageRoute);
}