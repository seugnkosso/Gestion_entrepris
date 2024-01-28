<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Point;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'query_builder' => function (UserRepository $er){
            //         $er->findByUser();
            //     },
            //     'choice_label' => 'nomComplet',
            //     'multiple' => true,
            //     'attr' => [
            //         'class' => 'select2 w-full'
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Point::class,
        ]);
    }
}
