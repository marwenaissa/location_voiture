<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label' => false,  // Masquer le label
            ])
            ->add("roles", ChoiceType::class,
            [
                "choices"=> [
                    "ROLE_CLIENT"=>"ROLE_CLIENT",
                    "ROLE_AGENT"=>"ROLE_AGENT"
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            
            'attr' => ['autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
            'label' => false, // Désactiver le label pour le champ plainPassword
]);

        ;

        $builder->get('roles')
        ->addModelTransformer(new CallbackTransformer(
            function ($rolesAsArray) {
                // Transformation du tableau de rôles en chaîne de caractères
                if (is_array($rolesAsArray)) {
                    return implode(', ', $rolesAsArray);
                }
                return ''; // Si ce n'est pas un tableau, on renvoie une chaîne vide
            },
            function ($rolesAsString) {
                // Transformation de la chaîne de caractères en tableau de rôles
                return explode(', ', $rolesAsString);
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
