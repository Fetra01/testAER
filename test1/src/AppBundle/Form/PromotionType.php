<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('promo')
            ->add('entryDate')
            ->add('leavingDate')
            ->add('localization', ChoiceType::class,
                ['choices' =>[
                    'Toulouse'=>'Toulouse',
                    'Montpellier'=>'Montpellier',
                    'Tarbe'=>'Tarbe',
                    'Sites délocalisés (ERN)'=>'Sites délocalisés (ERN)',
                    'Formation à distance sur l\'Occitanie'=>'Formation à distance sur l\'Occitanie'
                ],
                ])
            ->add('teacher');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Promotion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_promotion';
    }


}
