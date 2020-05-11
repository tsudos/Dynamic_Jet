<?php

namespace App\Form;

use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => "Nom de l'équipment"]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['placeholder' => "Description de l'équipment"]
            ])
            ->add('power', IntegerType::class, [
                'label' => 'Puissance',
                'required' => false,
                'attr' => ['placeholder' => "Puissance de l'équipment"]
            ])
            ->add('isValid', CheckboxType::class, [
                'label' => 'En état de marche',
                'required' => false
            ])
            ->add('price', CollectionType::class, [
                'entry_type' => TextType::class,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipment::class,
        ]);
    }
}
