<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;


class ProductController extends AbstractController
{
    /**
     * @Route("/produit", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/creation", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request ): Response
    {
        $product = new Product();

        $user = $this->getUser();
        $product->setUser($user);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $product ->setCreatedAt(new \DateTime());

            $image = $form->get('image')->getData();

            if($image){
                $originalImage = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImage = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalImage);
                $newImage = $safeImage.'-'.uniqid().'.'.$image->guessExtension();

                try {
                    $image->move($this->getParameter('images_directory'),
                        $newImage
                    );
                } catch (FileException $e) {
                    
                }

                $product->setImage($newImage);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/produit{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product, ProductRepository $productRepository): Response
    {
            $userProduct = $product->getUser()->getId();

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'userProduct' => $userProduct
            // 'productFind' => $productFind
        ]);
    }
 
    /**
     * @Route("/editer{id}", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product): Response
    {
        $image = $product->getImage();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product ->setUpdateAt(new \DateTime());

            $imageUpdate = $form->get('image')->getData();

            if($imageUpdate){
                $originalImage = pathinfo($imageUpdate->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImage = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalImage);
                $newImage = $safeImage.'-'.uniqid().'.'.$imageUpdate->guessExtension();

                try {
                    $imageUpdate->move($this->getParameter('images_directory'),
                        $newImage
                    );
                } catch (FileException $e) {
                    
                }

                $product->setImage($newImage);
            }
            else{
                $imageUpdate = $image;
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/produit{id}", name="product_delete", methods={"DELETE"})
     *
     */
    public function delete(Request $request, Product $product): Response
    {

        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();

        }

        return $this->redirectToRoute('home');
    }
}
 