<?php 
class View{

	private static $view_folder = '/../app/views/';
	private static $view_ext    = '.php';  

	static function render($file, $context){

		$context = (object) $context;

		require __DIR__ . self::$view_folder . '/layout/head.php';

		require __DIR__ . self::$view_folder . $file . self::$view_ext; 

		require __DIR__ . self::$view_folder . '/layout/foot.php';

	}
}
