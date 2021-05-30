<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * @Route("/", name="acc1")

     */
    public function index(): Response
    {
        return $this->render('acceuil.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }

    /**
     * @Route("/acc", name="acc")

     */
    public function index2(): Response
    {
        return $this->render('acceuil.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
}
