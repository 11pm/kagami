<?php 
class BlogController{

	static function home(){

		$context = [
			'title' => 'Welcome to my blog'
		];

		View::render('home', $context);

	}

}