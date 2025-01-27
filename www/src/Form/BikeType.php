<?php

namespace App\Form;

use App\Entity\Bike;
use App\Entity\Brand;
use App\Entity\Cylenders;
use App\Entity\Model;
use App\Entity\places;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BikeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('releaseDate', null, [
                'widget' => 'single_text',
            ])
            ->add('description')
            ->add('price')
            ->add('model_id', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'id',
            ])
            ->add('brand_id', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'id',
            ])
            ->add('cylenders_id', EntityType::class, [
                'class' => Cylenders::class,
                'choice_label' => 'id',
            ])
            ->add('places', EntityType::class, [
                'class' => places::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bike::class,
        ]);
    }
}
