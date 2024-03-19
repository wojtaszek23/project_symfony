<?php
// src/Form/RecipeType.php

namespace App\Form;

use App\Entity\CookingRecipe;
use App\Entity\Ingedient;
use App\Form\IngredientType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nazwa przepisu'])
            ->add('shortDescription', TextareaType::class, ['label' => 'Krótki opis'])
            ->add('preparation', TextareaType::class, ['label' => 'Przygotowanie'])
            ->add('image', FileType::class, ['label' => 'Zdjęcie', 'mapped' => false, 'required' => false])
            ->add('ingredients', CollectionType::class, [
                'entry_type' => IngredientType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Dodaj Przepis'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CookingRecipe::class,
        ]);
    }
}