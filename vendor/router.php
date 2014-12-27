<?php
class Router{
	private $uri;
	private $routes = [];

	public function __construct($url){
		
		$this->uri = $url;
	}

	private function contains($haystack, $needle){

		return strpos($haystack, $needle) !== false;

	}

	public function add($route, $closure){
		$this->routes[] = func_get_args();
	}
	public function run(){
		//shitty hack(temp)
		$currentRoute = explode('index.php', $this->uri);
		$currentRoute = end($currentRoute);
		
		foreach ($this->routes as $key) {
			
			$route      = $key[0];
			$controller = $key[1];

			$parameter  = null;

			if($this->contains($route, ':')){
				$routeParam = strchr($route, ':');
				$parameter = explode('/', $currentRoute);
				$parameter = end($parameter);
				$route = str_replace($routeParam, $parameter, $route);
			}
			//echo $route;
			//if route matches
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
				// if(isset($parameter)){
				// 	call_user_func_array($func, [$parameter]);
				// }
				// else{
				// 	call_user_func($func);
				// }
			}
		}
	}

}