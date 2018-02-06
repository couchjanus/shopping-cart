<?php

class Request
{
	
    public static function uri()
	{
		if (isset($_SERVER["REQUEST_URI"]) and !empty($_SERVER["REQUEST_URI"]))
            return trim($_SERVER["REQUEST_URI"], '/');
	}

}

class Router
{
    protected $routes = [];

    protected $result;

    public function __construct(){

    }

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function directPath($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            return $this->action(...explode('@', $this->routes[$uri]));
        }
        else{
          require_once VIEWS.'404'.EXT;
          throw new Exception('No route defined for this URI.');
      }
    }

    protected function action($segments, $action, $vars = [])
    {
      $segments = explode('\\', $segments);
      $controller = array_pop($segments);
      $controllerFile = '';

      do {
          if(count($segments)==0){
             $controllerFile = CONTROLLERS .$controllerFile.$controller . EXT;
             break;
          }
          else{
              $segment = array_shift($segments);
              $controllerFile = $controllerFile.$segment.'/';
          }
      }while ( count($segments) >= 0);

      include($controllerFile);

      $controller = new $controller;
      if (! method_exists($controller, $action)) {
        require_once VIEWS.'404'.EXT;
        throw new Exception(
        "{$controller} does not respond to the {$action} action."
        );
      }
      $this->result = true;
      return $controller->$action($vars); // return $vars to the action
    }
}


$routesFile = realpath(__DIR__).'/routes.php';


Router::load($routesFile)
    ->directPath(Request::uri());