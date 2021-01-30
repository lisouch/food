<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BagController extends AbstractController
{
    /**
     * @Route("/panier", name="bag")
     */
    public function index(): Response
    {
        return $this->render('bag/bag.html.twig', [
            'controller_name' => 'BagController',
        ]);
    }
}
