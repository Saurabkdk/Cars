<?php session_start();


require '../classAutoLoader.php';

$pageRoutesObject = new \controllers\PageRoutes();

$enterThePageObject = new \classes\EnterThePage($pageRoutesObject);

$enterThePageObject->runThePage();

?>