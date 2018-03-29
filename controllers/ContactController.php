<?php

class ContactController extends Controller
{
    public function index()
    {
        $title = "Contact <strong>Page</strong>";
        // Render our view
        echo $this->_twig->render('contact/index.html', ['title' => $title] );

    }
}
