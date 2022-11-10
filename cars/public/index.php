<?php
require '../classAutoLoader.php';

session_start();

$pageRoutesObject = new \controllers\PageRoutes();

$enterThePageObject = new \classes\EnterThePage($pageRoutesObject);

$enterThePageObject->runThePage();

?>