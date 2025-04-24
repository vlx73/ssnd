<?php

namespace pwa\Controller;

class HomePageController
{
    public function index() : void
    {
        // Render the home page
        $htmlView = new \pwa\View\HtmlView();
        $htmlView->render('home.html');
    }
    
}