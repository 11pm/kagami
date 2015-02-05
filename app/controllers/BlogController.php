<?php 
class BlogController extends Controller{

	static function index(){

		$post = Posts::all();

		self::scope('post', $post);
		self::scope('title', 'Welcome to my blog');
		self::scope('subheader', 'Where I ramble about some random stuff');

		self::render('home');

	}

	static function show($id){
		
		$post = Posts::find($id);

		self::scope('post', $post);

		self::render('show');

	}

}