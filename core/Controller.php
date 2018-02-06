<?php

class Controller {

    protected $_view;
    
    function __construct()
    {
        $this->_view = new View();
    }

    // действие (action), вызываемое по умолчанию
    function actionIndex()
    {
        // todo
    }

    public static function redirect($redirect_url = '/')
    {
        header('HTTP/1.1 200 OK');
        header('Location: http://'.$_SERVER['HTTP_HOST'].$redirect_url);
        exit();

        // header('Location: ' . $redirect_url);
        // die();
    }

}
