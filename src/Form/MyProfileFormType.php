<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('profileImage', FileType::class, [
                'label' => 'Profile Image',
                'required' => false,
                'data_class' => null,
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('identityCard', TextType::class, [
                'label' => 'Carte identité',
                'required' => false,
            ])
            ->add('taxRegistrationCard', TextType::class, [
                'label' => 'Carte immatriculation fiscale',
                'required' => false,
            ])
            ->add('personalAddress', TextType::class, [
                'label' => 'Address',
                'required' => false,
            ])
            ->add('phone', TextType::class, [
                'label' => 'Telephone ',
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
