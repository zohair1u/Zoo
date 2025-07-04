<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/admin', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('main/admin/dashboard.html.twig');
    }

    #[Route('/lol', name: 'app_main')]
    public function index2(): Response
    {
        return $this->render('main/index.html.twig');
    }
}
