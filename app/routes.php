<?php 
$router = new Router();

$router->get('/', 'BlogController@index');

$router->get('/posts/:id', 'BlogController@show');