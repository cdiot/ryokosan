<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Destination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextareaType::class, [
                'label' => 'label.description',
                'attr' => [
                    'placeholder' => 'placeholder.description',
                    'class' => 'pb-5'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_description',
                    ])
                ]
            ])
            ->add('destinations', EntityType::class, [
                'label' => 'label.destinations',
                'required' => true,
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
                'placeholder' => 'placeholder.select',
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_start_date',
                    ]),
                ],
                'widget' => 'single_text',
            ])
            ->add('endDate', DateType::class, [
                'label' => 'label.end_date',
                'placeholder' => 'placeholder.select',
                'constraints' => [
                    new NotBlank([
                        'message' => 'constraints.blank_end_date',
                    ]),
                ],
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
