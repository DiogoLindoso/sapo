<?php

use App\App;
use App\Lib\Erro;
require_once("vendor/autoload.php");
error_reporting(E_ALL & ~E_NOTICE);
try{
    $app = new App();
    $app->run();
}catch(\Exception $e){
    $oError = new Erro($e);
    $oError->render();
}
?>