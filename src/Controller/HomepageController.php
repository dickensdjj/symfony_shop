<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    public function index()
    {
        // display homepage
        return $this->render('pages/homepage.html.twig', []);
    }
}