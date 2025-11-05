<?php
namespace App\Controllers;

class HomeController
{
    public function indexAction(): void
    {
        // Load the home view
        require __DIR__ . '/../../public/views/home.php';
    }
}