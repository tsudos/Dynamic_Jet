<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class StaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email')
        ->add('firstname', TextType::class, [
            'label' => 'Prenom'
        ])
        ->add('lastname', Texttype::class, [
            'label' => 'Nom'
        ])
        ->add('ss_number', TextType::class, [
            'label' => 'N° sécurité sociale'
        ])
        ->add('me_date', DateType::class, [
            'required' => false,
            'placeholder' => [
                'year' => 'Annee', 'month' => 'Mois', 'day' => "Jour"
            ],
            'label' => 'Visite médicale'
        ])
        ->add('status', ChoiceType::class, [
            'choices' => [
                'Secretaire' => 'Secretaire',
                'Plagiste' => 'Plagiste',
                'Moniteur' => 'Moniteur'
            ],
            'label' => 'Fonction'
        ])
        // ->add('imageFile', FileType::class, [
        //     'required' => false,
        //     'label' => 'Téléchargez votre photo de profil'
        // ])
        ->add('coastal_licence', TextType::class, [
            'required' => false,
            'label' => 'N° permis cotier'
        ])
        ->add('bees', CheckboxType::class, [
            'required' => false,
            'label' => 'Brevet d\'Etat d\'Educateur Sportif'
        ])
        ->add('contract_type', ChoiceType::class, [
            'choices' => [
                'CDI' => 'CDI',
                'CDD' => 'CDD',
                'Stage' => 'Stage'
            ], 
            'label' => 'Type de contrat'
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
