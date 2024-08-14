<?php
ob_start();
session_start();
$server = $_SERVER;
$protocol = $_SERVER['REQUEST_SCHEME'] ?? 'http'; 
$host = $_SERVER['HTTP_HOST'] ?? 'localhost'; 
$path = $_SERVER['REQUEST_URI'] ?? ''; 
$path = realpath(dirname(__DIR__));
$path = str_replace('\\', '/', $path);
$projectPath = explode('/',$path);
$projectPath = end($projectPath);

$fullPath = $protocol.'://'.$host.'/'.$projectPath;

define('SITE',$fullPath);
define('DB_NAME','databasename');
define('DB_PASS','');
define('DB_USER','root');
define('DB_HOST','localhost');




require_once realpath(dirname(__DIR__)).'/config/functions.php';