<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * homepage function
     * just to see the dashboard 
     * @return void
     */
    public function homepage()
    {
        return $this->render('homepage/homepage.html.twig');
    }
}
