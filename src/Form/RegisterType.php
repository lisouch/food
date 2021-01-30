<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'entrez votre email'
                ],
                'label'=> false
                ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
                'required' => true,
                'first_options' => 
                ['label'=> false,
                 'attr' => 
                    ['placeholder' => "mdp"]
                ],
                'second_options' => 
                ['label'=> false,
                 'attr' => 
                    ['placeholder' => "confirmez mdp"]
                ]
                ])
                
            // ->add('passwordConfirm', PasswordType::class, [
            //     'attr' => [
            //         'placeholder' => 'Confirmez votre mot de passe',
            //         'mapped' => false,
            //     ],
            //     'label'=> false
            //     ])

            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'entrez votre nom'
                ],
                'label'=> false
                ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'entrez votre prénom'
                ],
                'label'=> false
                ])
            ->add('address', TextType::class, [
                'attr' => [
                    'placeholder' => 'entrez votre adresse'
                ],
                'label'=> false
                ])
            ->add('cp', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'entrez votre code postal'
                ],
                'label'=> false
                ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'entrez votre ville'
                ],
                'label'=> false
                ])
            ->add('details', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Décrivez vous en quelques mots'
                ],
                'label'=> false
                ]) 
            ->add('submit', SubmitType::class,[
                'label' => 'S\'inscrire'
            ] )      
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
