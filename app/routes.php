<?php 
$router = new Router();

$router->add('/', 'BlogController@index');

$router->add('/posts/:id', 'BlogController@show');

$router->run();