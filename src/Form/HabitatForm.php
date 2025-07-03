<?php

namespace App\Form;

use App\Entity\Habitat;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HabitatForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('image', FileType::class, [
                // ça régle le problème mais n'enregsitre plus la photo
             'data_class' => null,
             'required' => false,


             'constraints' => [
                  new File([
                     'mimeTypes' => ['image/jpeg', 'image/png'],
                     'mimeTypesMessage' => 'Veuillez uploader une image valide.',
                          ])
                              ],
            ])
           
            ->add('description')
            ->add('Ajouter', SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Habitat::class,
        ]);
    }
}
