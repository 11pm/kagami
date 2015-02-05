<?php
class Router{
	private $routes = [];
	private $request_method;

	//Check if a string contains something
	private function contains($haystack, $needle){

		return strpos($haystack, $needle) !== false;

	}

	/*
	| Run a get route
	*/
	public function get($route, $action){
		$this->run_route('GET', $route, $action);
	}

	/*
	| Run a get route
	*/
	public function post($route, $action){
		$this->run_route('POST', $route, $action);
	}

	private function run_route($method, $route, $controller){

		/*
		| Set the current request the user sent to the server
		*/	
		$this->request_method = $_SERVER['REQUEST_METHOD'];

		/*
		| Set the default route the user is on /
		| PATH_INFO checks if the user has typed something in the url
		| If he has, we set that as the current route
		*/
		$currentRoute = '/';
		$parameter  = null;

		if(isset($_SERVER['PATH_INFO'])){
			$currentRoute = $_SERVER['PATH_INFO'];
		}
		

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
		| and that it is the same request method
		*/
		$route_matches = $currentRoute === $route;
		$request_matches = $method === $this->request_method;

		if($route_matches and $request_matches){
			
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