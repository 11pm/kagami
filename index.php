<?php 
include __DIR__ . '/autoload.php';

$request_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$router = new Router($request_url);

$router->add('/', 'BlogController@home');

$router->add('/posts/:id', 'BlogController@show');

$router->run();