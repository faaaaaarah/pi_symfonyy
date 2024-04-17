<?php

namespace App\Form;

use App\Entity\Interventions;
use App\Entity\Bornes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;


class InterventionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_emp')
            ->add('Date', null, [
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today', // Set the value to 'today' for current date
                        'message' => 'The date cannot be in the past.',
                    ]),
                ]])
            ->add('Type', ChoiceType::class, [
                'choices' => [
                    'Maintenance' => 'maintenance',
                    'Installation' => 'installation',
                    'Désinstallation' => 'desinstallation',
                ]])
            ->add('borne', EntityType::class, [
                'class' => Bornes::class,
                'choice_label' => 'description', // Field from the Borne entity to display in the dropdown
                'placeholder' => 'Choose a Borne', // Optional: Add a placeholder text
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Interventions::class,
        ]);
    }
}
