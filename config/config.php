<?php
// A constant that shows whehter it's in dev mode or not. Dev Mode = True Live = false
define("DEV", true);

//path from root to site
define("Dev_ROOT", '\Blog\public\ ');

// hold the name of the document root folder
define("ROOT_FOLDER", 'public');


//Database settings
$type = 'mysql';
$server = 'localhost';
$db = 'blog';
$port = 3306;
$charset = 'utf8mb4';
$username = 'dgcruz';
$password = 'occupied';

// create DSN
$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

?>