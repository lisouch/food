<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr'=> [
                    'placeholder' => "Indiquez le nom de votre plat"
                ],
                'label' => false
            ])
            ->add('timeMin', TimeType::class,[
                'label' => "De"
            ])
            ->add('timeMax', TimeType::class,[
                'label' => "Jusqu'à"
            ])
            ->add('price', MoneyType::class, [
                'attr'=> [
                    'placeholder' => "Indiquez votre prix"
                ],
                'label' => false
            ])
            ->add('description', TextType::class, [
                'attr'=> [
                    'placeholder' => "Votre description ..."
                ],
                'label' => false
            ])
            ->add('image', FileType::class, [
                'attr'=> [
                    'placeholder' => "Téléchargez votre image"
                ],
                'label' => false,
                'mapped' => false,
                'constraints' => [
                  new File([
                      'maxSize' => '5M',
                      'mimeTypes' => [
                          'image/jpg',
                          'image/jpeg',
                          'image/png',
                      ],
                      'mimeTypesMessage' => "Les formats acceptés : jpg, jpeg, png. Veuillez télécharger vos fichiers sous ce format"
                  ])  
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Publier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
