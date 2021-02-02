<?php

namespace App\Form;

use App\Entity\Diet;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
                'label' => "De "
            ])
            ->add('timeMax', TimeType::class,[
                'label' => "à "
            ])

            ->add('category', EntityType::class,
            [
                'class'=> Category::class,
                'placeholder' => 'Catégorie',
                'choice_label' => function ($category) {return $category->getName();},
                'label' => false,
                'required' => false
            ])

            ->add('diet', EntityType::class,
            [
                'class'=> Diet::class,
                'placeholder' => 'Régime alimentaire',
                'choice_label' => function ($diet) {return $diet->getName();},
                'label' => false,
                'required' => false
            ]
            )

            ->add('price', MoneyType::class, [
                'attr'=> [
                    'placeholder' => "Indiquez votre prix"
                ],
                'label' => false
            ])
            ->add('description', TextareaType::class, [
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
