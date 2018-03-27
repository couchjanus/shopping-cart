<?php

class App
{

    private $_result = null;

    public function __construct()
    {
        // Запускаем сессию
        Session::init();
    }

    public function init()
    {

        $routesFile = CONFIG.'routes.php';

        Router::load($routesFile)
            ->directPath(Request::uri(), Request::method());

    }
}
