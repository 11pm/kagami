<?php
class Router{
	private $routes = [];

	//Check if a string contains something
	private function contains($haystack, $needle){

		return strpos($haystack, $needle) !== false;

	}

	//Add an route
	public function add($route, $closure){
		$this->routes[] = func_get_args();
	}

	//TODO: Automate
	//Execute the routes
	public function run(){

		/*
		| Set the default route the user is on /
		| PATH_INFO checks if the user has typed something in the url
		| If he has, we set that as the current route
		*/
		$currentRoute = '/';

		if(isset($_SERVER['PATH_INFO'])){
			$currentRoute = $_SERVER['PATH_INFO'];
		}

		/*
		| Go through all the routes and check if the user is on any of them
		*/
		foreach ($this->routes as $key) {
			
			/*
			| Get details about what we are on
			*/
			$route      = $key[0];
			$controller = $key[1];
			$parameter  = null;

			/*
			| Check if the route defined has a parameter
			| if it has get it from the $currentRoute
			*/

			if($this->contains($route, ':')){
				$routeParam = strchr($route, ':');
				$parameter = explode('/', $currentRoute);
				$parameter = end($parameter);
				$route = str_replace($routeParam, $parameter, $route);
			}

			/*
			| Check if the current route the user is on matches the defined route
			*/

			if($currentRoute == $route){
				
				$controller = explode('@', $controller);

				$ctrl = reset($controller);
				$func = end($controller);

				if(isset($parameter)){
					call_user_func_array(array($ctrl, $func), array($parameter));
				}
				else{
					call_user_func(array($ctrl, $func));
				}
		
			}
		}
	}

}