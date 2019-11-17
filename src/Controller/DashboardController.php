<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        $pages = ['accommodaties'];

        return $this->render('dashboard/index.html.twig', [
            'pages' => $pages
        ]);
    }
}
