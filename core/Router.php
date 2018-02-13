<?php
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
        // if (array_key_exists($uri, $this->routes)) {
        //     return $this->action(...explode('@', $this->routes[$uri]));
        // }
        if (array_key_exists($uri, $this->routes)) {
            
            return $this->callAction(
            ...$this->getPathAction($this->routes[$uri])
            );
        }
        else{
              foreach ($this->routes as $key => $val){
                $pattern = preg_replace('#\(/\)#', '/?', $key);
                $pattern = "@^" .preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern). "$@D";
                preg_match($pattern, $uri, $matches);
                array_shift($matches);
                if($matches){
                    $getAction = $this->getPathAction($val);
                    return $this->callAction($getAction[0],$getAction[1],$getAction[2], $matches);
                }
            }  
          
      }
      require_once VIEWS.'404'.EXT;
      throw new Exception('No route defined for this URI.');
    }

    // public function directPath($uri)
    // {
    //     if (array_key_exists($uri, $this->routes)) {
    //         return call_user_func_array('Router::action', explode('@', $this->routes[$uri]));
    //     }
    //     else{
    //       require_once VIEWS.'404'.EXT;
    //       throw new Exception('No route defined for this URI.');
    //   }
    // }

    private function getPathAction($route){
        list($segments, $action) = explode('@', $route);
        $segments = explode('\\', $segments);
        $controller = array_pop($segments);
        $controllerFile = '/';
        do {
            if(count($segments)==0){
              return array ($controller, $action, $controllerFile);
                }
                else{
                    $segment = array_shift($segments);
                    $controllerFile = $controllerFile.$segment.'/';
                }
            }while ( count($segments) >= 0);
    }
    protected function callAction($controller, $action, $controllerFile, $vars = []) // add $vars = [] in case $vars is empty
    {
        
        include(CONTROLLERS.$controllerFile.'/'.$controller.EXT);
        
        $controller = new $controller;
        
        if (! method_exists($controller, $action)) {
            throw new Exception(
            "{$controller} does not respond to the {$action} action."
            );
        }
        return $controller->$action($vars); // return $vars to the action
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
