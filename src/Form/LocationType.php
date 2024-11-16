<?php
namespace App\Form;

use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateD', DateType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'widget' => 'single_text', // Render as a single text field
            ])
            ->add('dateA', DateType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'widget' => 'single_text', // Render as a single text field
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => function ($client) {
                    return $client->getNom() . ' ' . $client->getPrenom();
                },
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('voiture', EntityType::class, [
                'class' => Voiture::class,
                'choice_label' => 'serie',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
