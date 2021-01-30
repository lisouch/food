<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController 
{
    /**
     * @Route("/inscription", name="register")
     */
    public function index(HttpFoundationRequest $request): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted()  && $form->isValid()){

            $hash = $encoder->encodePassword($user, $user->getPassword());
            
            $user = $form->getData();

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($user);
            $doctrine->flush();

        }

        return $this->render('register/register.html.twig', [
            'formRegister' => $form->createView()
        ]);
    }
}
