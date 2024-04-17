<?php

namespace App\Form;

use App\Entity\Bornes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Validator\Constraints\Regex;

class BornesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'En Attente' => 'en_attente',
                    'En Cours' => 'en_cours',
                    'Terminé' => 'termine',
                ],
            ])
            ->add('adresse', null, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d+\s[A-z]+\s[A-z]+$/',
                        'message' => 'The address should be in the format: [Number] [Street] [City]',
                    ]),
                ],
            ])
            ->add('emplacement', ChoiceType::class, [
                'choices' => [
                    'Entreprise' => 'entreprise',
                    'Co-proprieté' => 'co-proprieté',
                    'Proprieté privé' => 'proprieté privé',
                ],
            ])
            ->add('filePath', FileType::class, [
                'label' => 'Image (JPEG, PNG, GIF)',
                'mapped' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bornes::class,
        ]);
    }
}