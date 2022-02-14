<?php
//Loading configurations files
require "config.php";
//autoloader
require __DIR__ . "/vendor/autoload.php";
//custom autoloader
spl_autoload_register(function($class){

    require LIBS . $class . ".php";
});
$app = new Bootstrap();
$app->init();


