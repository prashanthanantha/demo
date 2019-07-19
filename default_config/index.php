<?php
//echo phpinfo(); exit;


require_once 'vendor/autoload.php';


require_once 'plugins/HTTP/Request2.php';



ob_start();

error_reporting(0);

session_start();

// Instantiate the app

$settings = require __DIR__ . '/settings.php';

$app = new \Slim\App($settings);


// Fetch DI Container

$container = $app->getContainer($settings);




// all global variables will be loaded here



require __DIR__ . '/manast_init.php';




