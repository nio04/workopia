<?php

// $router->get("/", "controllers/home.php");
$router->get("/", "HomeController@index");
$router->get("/listings", "ListingController@index");
$router->get("/listings/create", "ListingController@create");
$router->get("/listing", "ListingController@show");
// $router->get("/listings/create", "controllers/listings/create.php");
// $router->get("/listing", "controllers/listings/show.php");
