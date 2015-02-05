<?php 
class Controller{

	/*
	| $scope - key - value pair of current view scope
	| $view_folder - where the client views are stored
	| $view_ext - what files the clients view are
	*/
	private static $scope = [];
	private static $view_folder = '/../app/views/';
	private static $view_ext    = '.php';  

	/*
	| Set new scope item
	*/
	public static function scope($key, $value){

		self::$scope[$key] = $value;

	}

	/*
	| Render a view with the correct scope
	*/
	public static function render($file){

		$scope = (object) self::$scope;

		require __DIR__ . self::$view_folder . '/layout/head.php';

		require __DIR__ . self::$view_folder . '/layout/nav.php';

		require __DIR__ . self::$view_folder . $file . self::$view_ext; 

		require __DIR__ . self::$view_folder . '/layout/foot.php';

	}
}