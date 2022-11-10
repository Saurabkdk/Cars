<?php
function autoloadTheClass($nameOfClass){
    $getFile =  '../' . str_replace('\\', '/', $nameOfClass) . '.php';
    require $getFile;
}
spl_autoload_register('autoloadTheClass');

function redirect($destination){
                        //line of code 16 was researched from a website
    echo '<script>location.replace("'. $destination .'")</script>';   //https://stackoverflow.com/questions/8028957/how-to-fix-headers-already-sent-error-in-php
}
?>
