<?php

namespace App\Form;

use App\Entity\CarWashPoint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CarWashPointType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',  TextType::class, [
                'label' => 'Nom',
                'required' => true,

        ])
            ->add('address' ,TextType::class, [
                'label' => 'adresse',
                'required' => true,
            ])
            ->add('phone', NumberType::class, [
                'label' => 'telephone',
                'required' => true,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarWashPoint::class,
        ]);
    }
}
