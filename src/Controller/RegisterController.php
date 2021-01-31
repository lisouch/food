<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController 
{
    /**
     * @Route("/inscription", name="register")
     */
    public function index(HttpFoundationRequest $request, UserPasswordEncoderInterface $encoder): Response
    {

        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted()  && $form->isValid()){

            $user ->setCreatedAt(new \DateTime());

            $hash = $encoder->encodePassword($user, $user->getPassword());
            
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $user = $form->getData();

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($user);
            $doctrine->flush();

            return $this->redirectToRoute('app_login');

        }

        return $this->render('register/register.html.twig', [
            'formRegister' => $form->createView()
        ]);
    }
}
