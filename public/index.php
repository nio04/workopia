<?php

require "../helpers.php";
require basePath("Framework/Router.php");
require basePath("Framework/Database.php");

//instantiate router
$router = new Router();

// get route
$routes = require basePath("routes.php");

// get current uri & http method
$uri =  parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

// route the request
$router->route($uri, $method);
