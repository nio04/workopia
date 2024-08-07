<?php

require __DIR__ . "/../vendor/autoload.php";

require "../helpers.php";
require basePath("Framework/Router.php");
require basePath("Framework/Database.php");

use Framework\Router;

//instantiate router
$router = new Router();

// get route
$routes = require basePath("routes.php");

// get current uri & http method
$uri =  parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// route the request
$router->route($uri,);
