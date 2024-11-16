<?php

namespace App\Form;

use App\Entity\Modele;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class VoitureForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('serie', TextType::class, [
                'attr' => ['class' => 'form-control'], // Add CSS class to input
                'label_attr' => ['class' => 'form-label'], // Add CSS class to label
            ])
            ->add('dateMM', DateType::class, [
                'widget' => 'single_text', // Use a single text field for date
                'attr' => ['class' => 'form-control'], // Custom class for input field
                'label_attr' => ['class' => 'form-label'], // Custom class for label
            ])
            ->add('prixJour', NumberType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('modele', EntityType::class, [
                'class' => Modele::class,
                'choice_label' => 'libelle',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
            ]);
    }
}
