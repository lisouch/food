<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Entity\ProductSearch;
use App\Entity\User;
use App\Form\ProductSearchType;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */ 
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findBy([],['createdAt' => 'desc']);

        $search = new ProductSearch();
        $form = $this->createForm(ProductSearchType::class, $search);
        
        $form->handleRequest($request);
        $city = $search->getCity();
        $productsAll = array();

        if ($form->isSubmitted() && $form->isValid()) {
            $usersResult = $this->getDoctrine()->getRepository(User::class)->findBy(['city' =>$city]);
            foreach ($usersResult as $user) {
                $productsResult = $user->getProducts();
                foreach($productsResult as $product) {
                    $productsAll[] = $product;
                }
            }
        }
        return $this->render('home/home.html.twig', [
            'form' => $form->createView(),
            'products' => $productsAll,
            'product' => $product
        ]);
    }
    
}
