<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom'],
                'label_attr' => ['class' => 'form-label']
            ])
            ->add('prenom', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom'],
                'label_attr' => ['class' => 'form-label']
            ])
            ->add('adresse', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse'],
                'label_attr' => ['class' => 'form-label']
            ])
            ->add('cin', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'CIN'],
                'label_attr' => ['class' => 'form-label']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
