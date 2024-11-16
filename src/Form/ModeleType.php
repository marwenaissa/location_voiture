<?php

namespace App\Form;

use App\Entity\Modele;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add the fields for the 'Modele' entity
        $builder
            ->add('libelle', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Libelle',
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('pays', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Pays',
                'label_attr' => ['class' => 'form-label'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Set the data class to the Modele entity
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
