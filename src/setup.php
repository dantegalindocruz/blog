<?php

//Application root directory

define("APP_ROOT", dirname(__FILE__,2));

//Functions
require APP_ROOT . '\src\includes\functions.php';

// configuration data
require APP_ROOT . '\config\config.php';


// set autoload fuction

spl_autoload_register(function($class){
    $path = APP_ROOT . '\src\classes\\';
    require $path . $class . '.php';
});

// create Blog object
$blog = new blog($dsn, $username, $password);
// remove database connection data
unset($dsn, $username, $password); //removes database connection data 

?>