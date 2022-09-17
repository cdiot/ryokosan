<?php

namespace App\Form;

use App\Service\ActivitySearch;
use App\Entity\Destination;
use App\Form\Type\GenderType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitySearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('destinations', EntityType::class, [
                'label' => 'label.destinations',
                'required' => false,
                'class' => Destination::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'js-example-basic-single'
                ]
            ])
            ->add('startDate', DateType::class, [
                'label' => 'label.start_date',
                'required' => false,
                'placeholder' => 'placeholder.select',
                'widget' => 'single_text',
            ])
            ->add('minAge', IntegerType::class, [
                'label' => 'label.minAge',
                'required' => false,
                'attr' => [
                    'placeholder' => '18'
                ]
            ])
            ->add('maxAge', IntegerType::class, [
                'label' => 'label.maxAge',
                'required' => false,
                'attr' => [
                    'placeholder' => '120'
                ]
            ])
            ->add('gender', GenderType::class, [
                'label' => 'label.gender',
                'required' => false,
                'placeholder' => 'placeholder.select'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'action.search',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActivitySearch::class,
            'method' => 'GET'
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
