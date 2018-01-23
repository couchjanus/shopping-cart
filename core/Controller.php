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
}
