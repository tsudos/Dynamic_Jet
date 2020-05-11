<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['placeholder' => "Prénom du client"]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => "Nom du client"]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => "Email du client"]
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse',
                'attr' => ['placeholder' => "Adresse du client"]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => ['placeholder' => "Numéro de téléphone du client"]
            ])
            ->add('birth_date', DateType::class, [
                'label' => 'Date de naissance',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'years' => range(date('Y')-80, date('Y')-15),
                'required' => false
            ])
            ->add('coastal_license', TextType::class, [
                'label' => 'Permis côtier',
                'attr' => ['placeholder' => "Permis côtier du client"],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
