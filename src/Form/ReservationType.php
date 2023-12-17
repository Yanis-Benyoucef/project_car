<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Vehicle;
use App\Entity\Reservations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Callback;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('start_date', DateType::class, [
            'widget' => 'single_text',
        ])
        ->add('end_date', DateType::class, [
            'widget' => 'single_text',
        ])
        ->add('name')
        ->add('age', null, [
            'constraints' => [
                new Callback([$this, 'validateAge']),
            ],
        ])
        ->add('id_vehicle', EntityType::class, [
            'class' => Vehicle::class,
            'choice_label' => 'name', 
        ]);  
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }

    public function validateAge($value, ExecutionContextInterface $context)
    {
        $minimumAge = 18;

        if ($value < $minimumAge) {
            $context->buildViolation("L'âge doit être d'au moins $minimumAge ans.")
                ->atPath('age')
                ->addViolation();
        }
    }

}