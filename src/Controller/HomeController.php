<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findBy([],['createdAt' => 'desc']);

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'product' => $product
        ]);
    } 
}
