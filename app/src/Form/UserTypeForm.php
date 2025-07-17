<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class, [
            'choices' => [
                'Administrateur' => 'ROLE_ADMIN',
                'Employé' => 'ROLE_EMPLOYE',
                'Vétérinaire' => 'ROLE_VETERINAIRE',
                ],
             'expanded' => false, 
             'multiple' => true, 
             'label' => 'Rôle de l’utilisateur',
             ])

             //  'expanded' => false, 
             //'multiple' => true, 

            ->add('password', PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('Ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
