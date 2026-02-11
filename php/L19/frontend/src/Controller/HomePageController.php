<?php

namespace pwa\Controller;

use pwa\Service\AuthService;

class HomePageController
{
    private AuthService $authService;
    
    public function __construct()
    {
        $this->authService = new AuthService();
    }
    
    public function index(): void
    {
        // Render the home page
        $htmlView = new \pwa\View\HtmlView();
        $htmlView->render('home.html');
    }
    
    public function dashboard(): void
    {
        // Render the dashboard page
        $htmlView = new \pwa\View\HtmlView();
        $htmlView->render('dashboard.html');
    }
    
}