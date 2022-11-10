<?php

namespace classes;

interface GetRoutes
{
public function getTheDefaultPageRoute();
public function getThePageController($controllerName);
public function adminLoginCheck($pageRoute);
}