<?php

namespace App\Form;

use App\Entity\RechercheBiens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheBiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixMax', IntegerType::class ,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                'placeholder'=>'Prix maximale'
                ]
            ])
            ->add('surfaceMin',IntegerType::class ,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                'placeholder'=>'surface minimale'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheBiens::class,
            'method'=>'get',
            'csrf_protection'=>false,
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
