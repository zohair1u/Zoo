<?php

namespace App\Form;

use App\Document\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Votre nom',
            ])
            ->add('note', IntegerType::class, [
                'label' => 'Note (1 à 5)',
                'constraints' => [
                    new Range(['min' => 1, 'max' => 5])
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
            ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
}
}