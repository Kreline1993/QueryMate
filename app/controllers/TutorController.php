<?php
namespace App\Controllers;

class TutorController
{
    public function indexAction(): void
    {
        // You can load data for the page here later
        $pageTitle = 'Tutor';
        require dirname(__DIR__, 2) . '/public/views/tutor.php';
    }
}