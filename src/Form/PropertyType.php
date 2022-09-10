<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('chambres')
            ->add('pieces')
            ->add('etage')
            ->add('prix')
            ->add('options',EntityType::class,[
                'class'=>Option::class,
                'choice_label'=>'nom',
                'multiple'=>true
            ])
            ->add('city',null,['label'=>'Ville'])
            ->add('adresse')
            ->add('code_postal')
            ->add('vendue')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }
}
