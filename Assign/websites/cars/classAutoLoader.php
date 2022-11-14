<?php
function autoloadTheClass($nameOfClass){
    $getFile =  '../' . str_replace('\\', '/', $nameOfClass) . '.php';
    require $getFile;
}
spl_autoload_register('autoloadTheClass');

function redirect($destination){

    echo '<script>location.replace("'. $destination .'")</script>';
    //line of code 10 was researched from a website
    //https://stackoverflow.com/questions/8028957/how-to-fix-headers-already-sent-error-in-php
}
?>


