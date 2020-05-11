<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Customer;
use App\Entity\Equipment;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateTimeType::class, [
                'label' => 'Date et heure de début',
                'years' => range(date('Y'), date('Y')+2),
                'months' => range(date('m'), date('m')+11),
                'days' => range(date('d'), date('d')+(31-date('d'))),
                'hours' => range(10, 16),
                'minutes' => [0, 30]
            ])
            ->add('timeRange', ChoiceType::class, [
                'label' => 'Durée',
                'choices' => [
                    '30 minutes' => '0',
                    '1 heure' => '1',
                    '2 heure' => '2',
                ]
            ])
            ->add('equipments', EntityType::class, [
                'label' => 'Équipements',
                'placeholder' => 'Choisir un ou plusieurs équipments',
                'multiple' => true,
                'class' => Equipment::class,
                'choice_label' => 'name',
                'choice_value' => 'id'
            ])
            ->add('staffs', EntityType::class, [
                'label' => 'Moniteurs',
                'multiple' => true,
                'placeholder' => 'Choisir un moniteur',
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where("u.status = 'Moniteur'")
                    ;
                },
                'choice_label' => function ($staff) {
                    return $staff->getFirstname() . ' ' . $staff->getLastname();
                }
            ])
            ->add('customer', EntityType::class, [
                'label' => 'Client',
                'placeholder' => 'Choisir le client',
                'class' => Customer::class,
                'choice_label' => function ($customer) {
                    return $customer->getFirstname() . ' ' . $customer->getLastname();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
