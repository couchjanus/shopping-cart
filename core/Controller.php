<?php

class Controller
{

    protected $_view;

    protected $_breadcrumb;
    protected $_twig;
    private $_loader;

    function __construct()
    {
        $this->_view = new View();
        $this->_breadcrumb = new Breadcrumb();

        // Specify our Twig templates location
        $this->_loader = new Twig_Loader_Filesystem(ROOT.'/templates');

        // Instantiate our Twig
        $this->_twig = new Twig_Environment($this->_loader);

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
