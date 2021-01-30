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
                    'placeholder' => 'Entrez votre email'
                ],
                'label'=> false
                ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
                'required' => true,
                'label'=> false,
                'first_options' =>
                    ['label' => false,
                        'attr' => 
                        ['placeholder' => "Entrez votre mot de passe"
                    ]],
                'second_options' =>
                    ['label' => false,
                        'attr' => 
                        ['placeholder' => "Confirmez votre mot de passe"
                    ]]
                ])

            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ],
                'label'=> false
                ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ],
                'label'=> false
                ])
            ->add('address', TextType::class, [
                'attr' => [
                    'placeholder' => 'Entrez votre adresse'
                ],
                'label'=> false
                ])
            ->add('cp', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Entrez votre code postal'
                ],
                'label'=> false
                ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'Entrez votre ville'
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
